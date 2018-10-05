# Microsoft Cognitive Vision Service APIs Client Library for PHP #

The cloud-based Vision API provides developers with access to advanced face algorithms. Microsoft Vision algorithms enable ocr attribute detection

## Requirements ##
* [PHP 7.1.0 or higher](http://www.php.net/)

## Installation ##

You can use **Composer** or simply **Download the Release**

### Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require hymns/microsoft-cognitive-vision
```

Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

### Download the Release

If you abhor using composer, you can download the package in its entirety. The [Releases](https://github.com/hymns/microsoft-cognitive-vision/releases) page lists all stable versions. Download any file
with the name `microsoft-cognitive-vision-[RELEASE_NAME].zip` for a package including this library and its dependencies.

Uncompress the zip file you download, and include the autoloader in your project:

```php
require_once '/path/to/microsoft-cognitive-vision/vendor/autoload.php';
```

## Examples ##

### Analyze Example ###

```php
// include your composer dependencies
require_once 'vendor/autoload.php';

$client = new \Hymns\MicrosoftCognitiveVision\Client('YOUR_APP_KEY', 'YOUR_REGION');
$vision  = $client->vision()->analyze('URL_IMAGE');

print_r($vision);
```

### Describe image ###

```php
require_once 'vendor/autoload.php';

$client = new \Hymns\MicrosoftCognitiveVision\Client('YOUR_APP_KEY', 'YOUR_REGION');
$vision  = $client->vision()->describe('URL_IMAGE');

print_r($vision);
```

### Optical Character Recognition ###
```php
require_once 'vendor/autoload.php';

$client = new \Hymns\MicrosoftCognitiveVision\Client('YOUR_APP_KEY', 'YOUR_REGION');
$vision  = $client->vision()->ocr('URL_IMAGE');

print_r($vision);

```