# VK API

[![Build Status](https://travis-ci.org/maksa988/VK-API-Class.svg)](https://travis-ci.org/maksa988/VK-API-Class)
[![Total Downloads](https://poser.pugx.org/maksa988/vk/downloads)](https://packagist.org/packages/maksa988/vk)
[![Latest Stable Version](https://poser.pugx.org/maksa988/vk/v/stable)](https://packagist.org/packages/maksa988/vk)
[![Latest Unstable Version](https://poser.pugx.org/maksa988/vk/v/unstable)](https://packagist.org/packages/maksa988/vk)
[![License](https://poser.pugx.org/maksa988/vk/license)](https://packagist.org/packages/maksa988/vk)

PHP class for working with [VK API](https://vk.com/dev)

## Usage

1. Connect class

        require('VK.php');
        
2. Create VK object
    1. without access token (examples/example-1.php)

            $vk = new MAKSA\VKAPI('{APP_ID}', '{API_SECRET}');

    2. with access token (examples/example-2.php)

            $vk = new MAKSA\VKAPI('{APP_ID}', '{API_SECRET}', '{ACCESS_TOKEN}');
            
            
3. Usage API

        $vk->api('{METHOD_NAME}', '{PARAMETERS}');

### Other methods
* Set version of API.
    `$vk->setApiVersion({NUBMER});`
    
### Variables
* `{APP_ID}` — Your application's identifier.
* `{API_SECRET}` — Secret application key.
* `{ACCESS_TOKEN}` — Access token.
* `{METHOD_NAME}` — Name of the API method. [All methods.](http://vk.com/dev/methods)
* `{PARAMETERS}` — Parameters of the corresponding API methods.

## Development

- Source hosted at [GitHub](https://github.com/maksa988/VK-API-Class)
- Report issues, questions, feature requests on [GitHub Issues](https://github.com/maksa988/VK-API-Class/issues)

## Author

Website: [Maksa988](https://github.com/zelenin/)
Email: [admin@maksa988.ru](mailto:admin@maksa988.ru)
