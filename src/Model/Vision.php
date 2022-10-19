<?php

namespace Hymns\MicrosoftCognitiveVision\Model;

use Hymns\MicrosoftCognitiveVision\Model;

class Vision extends Model
{
    /**
     * it can be used to determine if an image contains mature content, or it can be used to find all the 
     * faces in an image. It also has other features like estimating dominant and accent colors, categorizing 
     * the content of images, and describing an image with complete English sentences
     * 
     * @param string $url
     * @param bool   $visualFeatures
     * @param bool   $details
     * @param string $language
     * @param string $model
     *
     * @return mixed
     * @throws \Hymns\MicrosoftCognitiveVision\Exception\ClientException
     */
    public function analyze(string $url = '', string $visualFeatures = null, string $details = null, string $language = 'en', $model = 'latest')
    {
        $parameters = [
            'url' => $url
        ];

        $form_params = [
            'visualFeatures'  => $visualFeatures,
            'details'         => $details,
            'language'        => $language,
            'model-version'   => $model
        ];

        $response = $this->client->request('POST', 'analyze', $parameters, $form_params);

        return json_decode((string)$response->getBody());
    }

    /**
     * This operation generates a description of an image in human readable language with complete sentences. 
     * The description is based on a collection of content tags, which are also returned by the operation. 
     * More than one description can be generated for each image. Descriptions are ordered by their confidence score.
     * 
     * @param string $url
     * @param bool   $visualFeatures
     * @param bool   $details
     * @param string $language
     *
     * @return mixed
     * @throws \Hymns\MicrosoftCognitiveVision\Exception\ClientException
     */
    public function describe(string $url = '', int $maxCandidates = 1, string $language = 'en')
    {
        $parameters = [
            'url' => $url
        ];

        $form_params = [
            'maxCandidates'  => (int) $maxCandidates,
            'language'        => $language
        ];

        $response = $this->client->request('POST', 'describe', $parameters, $form_params);

        return json_decode((string)$response->getBody());
    }
        
    /**
     * Optical Character Recognition (OCR) detects text in an image and extracts the recognized characters into 
     * a machine-usable character stream.
     * 
     * Upon success, the OCR results will be returned.
     * 
     * Upon failure, the error code together with an error message will be returned. The error code can be one 
     * of InvalidImageUrl, InvalidImageFormat, InvalidImageSize, NotSupportedImage, NotSupportedLanguage, or 
     * InternalServerError
     * 
     * @param  string  $url               
     * @param  boolean $detectOrientation 
     * @return mixed
     */
    public function ocr(string $url = '')
    {
        $bodyParameters = [
            'url' => $url
        ];

        $response = $this->client->request('POST', 'ocr', $bodyParameters);

        return json_decode((string)$response->getBody());
    }
}
