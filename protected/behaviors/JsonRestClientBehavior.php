<?php

class JsonRestClientBehavior extends CBehavior
{
    private $_rest_client;
    public $api_prefix = "";

    public function attach($owner)
    {
        parent::attach($owner);
        $this->_rest_client = new RestCurlClient();
    }

    private function _encode_params($arr)
    {
        return is_array($arr) ? json_encode($arr) : array();
    }

    public function get($route)
    {
        return json_decode(
            $this->_rest_client->get($this->api_prefix.$route),
            true
        );
    }

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
