<?php

/**
 * Communicates with REST API exclusively with JSON.
 * Interface with this class using PHP arrays,
 * since JSON encoding and incoding are handled internally.
 *
 * Call getResponseInfo() for details on last call as it
 * appears in a gall to curl_getinfo().
 */

class JsonRestClientBehavior extends CBehavior
{
    private $_rest_client;
    public $api_prefix = "";

    /**
     * Initializes the class once it is attached to it's owner.
     */

    public function attach($owner)
    {
        parent::attach($owner);
        $this->_rest_client = new RestCurlClient();
    }

    /**
     * Converts PHP array to JSON
     */

    private function _encode_params($arr)
    {
        return is_array($arr) ? json_encode($arr) : array();
    }

    /**
     * GET <route>. Returns JSON body as PHP array.
     */

    public function get($route)
    {
        return json_decode(
            $this->_rest_client->get($this->api_prefix.$route),
            true
        );
    }

    /**
     * Returns details on the last call as it appears
     * in curl_getinfo()
     */

    public function getResponseInfo()
    {
        return $_rest_client->response_info;
    }
    
    /**
     * POST to route. PHP array passed in $params
     * will be sent as JSON. JSON response body
     * will be returned as PHP array.
     */

    public function post($route, $params = array())
    {
        return json_decode(
                $this->_rest_client->post(
                    $this->api_prefix.$route,
                    $this->_encode_params($params)
                ),
                true
            );
    }

    /**
     * PUT to route. PHP array passed in $params
     * will be sent as JSON. JSON response body
     * will be returned as PHP array.
     */

    public function put($route, $params = array())
    {
        return json_decode(
                $this->_rest_client->put(
                    $this->api_prefix.$route,
                    $this->_encode_params($params)
                ),
                true
            );
    }

    /**
     * DELETE route. PHP array passed in $params
     * will be sent as JSON. JSON response body
     * will be returned as PHP array.
     */

    public function delete($url, $params = array())
    {
        return json_decode(
                $this->_rest_client->delete(
                    $this->api_prefix.$route,
                    $this->_encode_params($params)
                ),
                true
            );
    }
}
