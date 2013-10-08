<?php

/**
 * Communicates with REST API exclusively with JSON.
 * Interface with this class using PHP arrays,
 * since JSON encoding and incoding are handled internally.
 *
 * Call getResponseInfo() for details on last call as it
 * appears in a gall to curl_getinfo().
 *
 * @author Sage Gerard
 */

class JsonRestClientBehavior extends CBehavior
{

    /**
     * @var RestCurlClient REST client used to make requests
     */
    private $_rest_client;


    /**
     * @var string URL Prefix placed before every route.
     * By convention, try not to end with a trailing '/'
     * Set this value in your Yii configuration in /protected/config
     */
    public $api_prefix = "";


    /**
     * Attaches behavior object and initializes object.
     *
     * @param CComponent $owner Component behavior is attached to
     * @return void
     */
    public function attach($owner)
    {
        parent::attach($owner);
        $this->_rest_client = new RestCurlClient();
    }

    /**
     * Converts PHP array to JSON.
     * If $php_array is not an array, an empty PHP array
     * is returned instead (which is understood as no 
     * parameters by internally used REST client)
     *
     * @param array $php_array Associative array to be encoded
     * as JSON
     *
     * @return mixed
     */
    private function _encode_params($php_array)
    {
        return is_array($php_array) && count($php_array) > 0
            ? json_encode($php_array) : array();
    }

    /**
     * Make HTTP request via cURL using JSON request and response bodies.
     * Call {@link JsonRestClientBehavior::getResponseInfo} to check
     * response status.
     * 
     * @param string $method HTTP verb (GET, POST, PUT ...)
     * @param string $route URL after API prefix starting with '/'
     * @param array $params Associative array to be encoded as JSON
     * @param array $http_options Options for curl_setopt_array() 
     * @return string JSON response body
     */
    private function _request($method, $route, $params, $http_options)
    {
        $response = null;

        if ($method === "get")
        {
            $response = $this->_rest_client->$method(
                $this->api_prefix.$route,
                $http_options
            );
        }
        else
        {
            $response = $this->_rest_client->$method(
                $this->api_prefix.$route,
                $this->_encode_params($params),
                $http_options
            );
        }

        return json_decode($response, true);
    }


    /**
     * Invoke GET request. See {@link JsonRestClientBehavior::_request}
     * for more details on parameters.
     *
     * @param string $route URL after API prefix starting with '/'
     * @param array $http_options Options for curl_setopt_array() 
     * @return string JSON response body
     */
    public function get($route, $http_options = array())
    {
        return $this->_request("get", $route, array(), $http_options);
    }


    /**
     * Returns details on the last request as it appears
     * in curl_getinfo()
     *
     * @return array Response info from curl_getinfo()
     */
    public function getResponseInfo()
    {
        return $this->_rest_client->response_info;
    }


    /**
     * Invoke POST request. See {@link JsonRestClientBehavior::_request}
     * for more details on parameters.
     *
     * @param string $route URL after API prefix starting with '/'
     * @param array $params Associative array to be encoded as JSON
     * @param array $http_options Options for curl_setopt_array() 
     * @return string JSON response body
     */
    public function post($route, $params = array(), $http_options =array())
    {
        return $this->_request("post", $route, $params, $http_options);
    }


    /**
     * Invoke PUT request. See {@link JsonRestClientBehavior::_request}
     * for more details on parameters.
     *
     * @param string $route URL after API prefix starting with '/'
     * @param array $params Associative array to be encoded as JSON
     * @param array $http_options Options for curl_setopt_array() 
     * @return string JSON response body
     */
    public function put($route, $params = array(), $http_options = array())
    {
        return $this->_request("put", $route, $params, $http_options);
    }


    /**
     * Invoke DELETE request. See {@link JsonRestClientBehavior::_request}
     * for more details on parameters.
     *
     * @param string $route URL after API prefix starting with '/'
     * @param array $params Associative array to be encoded as JSON
     * @param array $http_options Options for curl_setopt_array() 
     * @return string JSON response body
     */
    public function delete($route, $params = array(),$http_options=array())
    {
        return $this->_request("delete", $route, $params, $http_options);
    }
}
