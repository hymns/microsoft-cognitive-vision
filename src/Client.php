<?php

namespace Hymns\MicrosoftCognitiveVision;

use Hymns\MicrosoftCognitiveVision\Model\Vision;
use Hymns\MicrosoftCognitiveVision\Exception\ClientException;

class Client
{
    private const BASE_URL = 'https://%s.cognitiveservices.azure.com/vision/%s/';

    private $guzzleClient;

    public function __construct(string $key, string $region = 'australiaeast', string $version = 'v3.2')
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_uri' => sprintf(self::BASE_URL, $region, $version),
            'headers'  => [
                'Ocp-Apim-Subscription-Key' => $key,
                'Content-Type'              => 'application/json',
                'User-Agent'                => 'hymns/microsoft-cognitive-vision'
            ]
        ]);
    }

    /**
     * @param string     $method
     * @param string     $uri
     * @param array|null $formParameters
     * @param array|null $bodyParameters
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws Exception\ClientException
     */
    public function request(string $method, string $uri, array $bodyParameters = null, array $formParameters = null)
    {
        if (\is_array($bodyParameters)) 
        {
            $parameters = [
                \GuzzleHttp\RequestOptions::BODY => json_encode($bodyParameters)
            ];
        } 
        else 
        {
            $parameters = array();
        }

        $responseUri = $uri;
        
        if (\is_array($formParameters)) 
        {
            $params = array();

            foreach ($formParameters as $key => $value) 
            {
                $params[] = $key . '=' . $value;
            }

            if ($params !== array()) 
            {
                $responseUri .= '?' . implode($params, '&');
            }
        }

        try 
        {
            return $this->guzzleClient->request($method, $responseUri, $parameters);
        }
        
        catch (\GuzzleHttp\Exception\ClientException $e)
        {
            $response = json_decode($e->getResponse()->getBody());
            throw new ClientException($response->message, $e->getCode(), $e);
        }

        catch (\GuzzleHttp\Exception\GuzzleException $e)
        {
            throw new ClientException($e->getResponse(), $e->getCode(), $e);
        }
    }

    /**
     * Vision instance model
     * 
     * @return mixed
     */
    public function vision(): Vision
    {
        return new Vision($this);
    }
}
