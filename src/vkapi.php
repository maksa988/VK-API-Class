<?php
 
/**
 * PHP class for working with VK API
 *
 * @package API methods
 * @author maksa988.ru
 * @version 1.1.0
 * @license https://github.com/maksa988/VK-API-Class/blob/master/LICENSE
 */
 
namespace MAKSA;

class VKAPI {
  	
  	// VK application id.
  	private $app_id;

  	// VK application secret key.
  	private $api_secret;

  	// VK API version.
  	// If null uses lastest version.
  	private $api_version;

  	// VK access token.
  	private $access_token;

  	// Instance curl.
  	private $curl;


  	/**
     * Constructor.
     * @param   string $app_id
     * @param   string $api_secret
     * @param   string $access_token
     */
  	public function __construct($app_id, $api_secret, $access_token = null){
  		$this->app_id = $app_id;
        $this->api_secret = $api_secret;
        $this->setAccessToken($access_token);
        $this->curl = curl_init();
  	} 

  	/**
     * Executes request on link.
     * @param   string $url
     * @param   string $method
     * @param   array $postfields
     * @return  string
     */
  	private function request($url, $method = 'GET', $postfields = array()) {
        curl_setopt_array($this->curl, array(
            CURLOPT_USERAGENT => 'VKAPI/1.1.0 (+Maksa988.su)',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => ($method == 'POST'),
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_URL => $url
        ));
        return curl_exec($this->curl);
    }

	/**
     * Set special API version.
     * @param   int $version
     * @return  void
     */
  	public function setApiVersion($api_version){
  		$this->api_version = $api_version;
  	}

  	/**
     * Set Access Token.
     * @param   string $access_token
     * @throws  VKException
     * @return  void
     */
  	public function setAccessToken($access_token){
  		$this->access_token = $access_token;
  	}

  	/**
     * Returns base API url.
     * @param   string $method
     * @param   string $response_format
     * @return  string
     */
  	public function getUrl($method, $response_format = 'json') {
        return 'https://api.vk.com/method/' . $method . '.' . $response_format;
    }

    /**
     * Concatenate keys and values to url format and return url.
     * @param   string $url
     * @param   array $parameters
     * @return  string
     */
    private function createUrl($url, $parameters) {
        $url .= '?' . http_build_query($parameters);
        return $url;
    }

    /**
     * Execute API method with parameters and return result.
     * @param   string $method
     * @param   array $parameters
     * @param   string $format
     * @param   string $requestMethod
     * @return  mixed
     */
    public function api($method, $parameters = array(), $format = 'array', $requestMethod = 'get') {
        $parameters['timestamp'] = time();
        $parameters['api_id'] = $this->app_id;
        $parameters['random'] = rand(0, 10000);
        if (!array_key_exists('access_token', $parameters) && !is_null($this->access_token)) {
            $parameters['access_token'] = $this->access_token;
        }
        if (!array_key_exists('v', $parameters) && !is_null($this->api_version)) {
            $parameters['v'] = $this->api_version;
        }
        ksort($parameters);
        $sig = '';
        foreach ($parameters as $key => $value) {
            $sig .= $key . '=' . $value;
        }
        $sig .= $this->api_secret;
        $parameters['sig'] = md5($sig);
        if ($method == 'execute' || $requestMethod == 'post') {
            $rs = $this->request(
                $this->getUrl($method, $format == 'array' ? 'json' : $format), "POST", $parameters);
        } else {
            $rs = $this->request($this->createUrl(
                $this->getUrl($method, $format == 'array' ? 'json' : $format), $parameters));
        }
        return $format == 'array' ? json_decode($rs, true) : $rs;
    }

    /**
     * Destructor.
     */
	public function __destruct() {
        curl_close($this->curl);
    }
}
?>