<?php

/** 
 * This is an interface for the back end. Application state must be 
 * manipulated through this class.
 * 
 * The back end of the application is not powered by Yii, and is interfaced
 * with in particular ways. This class makes it easier to talk to the back
 * end. The additional layer let's the Yii application work without getting
 * too coupled with backend communication.
 *
 * @author Sage Gerard
 * @package application.phplib
 */

class QratitudeHelper
{

    /**
     * Generates JSON request body representing passed credentials.
     * @return string Credentials JSON
     */

    public static function encodeCredentials($username, $password)
    {
        $json = json_encode(array(
            'username'=>$username,
            'password'=>$password
        ));

        return $json;
    }



    /**
     * Generates array of authentication headers to be appended to\
     * another array for a call to curl_setopt_array.
     *
     * @return array Array to use in call to curl_setopt_array
     */

    public static function getCredentialHeaders($username, $password)
    {
        $http_options = array(
            CURLOPT_HTTPHEADER=>array(
                "username: $username",
            )
        );

        return $http_options;
    }




    /**
     * Creates a new user with given credentials.
     */

    public static function createUser($username, $password)
    {
        $json = self::encodeCredentials($username, $password);
        Yii::app()->post('/users', $json);
    }




    /**
     * Generates a new token for given credentials.
     *
     * @return string Token for session
     */

    public static function getToken($username, $password)
    {
        $json  = self::encodeCredentials($username, $password);
        $token = Yii::app()->post('/tokens', $json);

        return $token;
    }




    /**
     * True if the passed token is associated with passed credentials
     *
     * @return boolean
     */

    public static function validateToken($token, $username, $password)
    {
        $http_options = self::getCredentialHeaders($username, $password);
        Yii::app()->get('/tokens', $http_options);
    }




    /**
     * Returns PHP array that follows asset JSON schema.
     *
     * Assets have a JSON representation, and this method
     * returns a PHP array equivelent that can be encoded
     * into JSON when ready. The asset information is 
     * extracted from several models supplied as arguments.
     *
     * @param Asset $asset
     *
     * @return array Associative array matching JSON schema for assets
     */

    public static function encodeAsset($asset)
    {
        $out = array();
        $out['name'] = $asset->name;
        $tags = explode(',', $asset->tags);

        foreach ($tags as &$t)
        {
            $t = trim($t);
        }

        $out['photos']     = $asset->imageUrls;
        $out['summary']    = $asset->summary;
        $out['tags']       = $tags;
        $out['attributes'] = array();

        foreach ($asset->custom as $a)
        {
            $out['attributes'][$a->key] = $a->val;
        }

        return $out;
    }
    
    /**
     * Returns Asset model from JSON schema
     *
     * @param Asset $asset JSON representing back end asset
     * @return Asset Asset object for Yii use
     */

    public static function decodeAsset($json_php)
    {
        $out = new Asset();

        $out->id        = $json_php['id'];
        $out->name      = $json_php['name'];
        $out->summary   = $json_php['summary'];
        $out->tags      = join(',', $json_php['tags']);
        $out->imageUrls = $json_php['photos'];

        foreach ($json_php['attributes'] as $k=>$v)
        {
            $c = new AssetCustomAttribute();
            
            $c->key = $k;
            $c->val = $v;

            $out->custom[] = $c;
        }

        return $out;
    }

    /**
     * Returns all assets from the back end
     *
     * @return array(Asset)
     */

    public static function getAllAssets()
    {
        $json_php = Yii::app()->get("/assets");

        // what I want is nested one level deep for some reason
        $json_php = $json_php['assets'];

        if (empty($json_php))
        {
            return array();
        }

        Sugar::dump($json_php);

        $out = array();

        foreach ($json_php as &$v)
        {
            $out[] = self::decodeAsset($v);
        }

        return $out;
    }

    /**
     * Returns Asset instance from the back end by ID.
     * @return Asset
     */

    public static function getAsset($id)
    {
        $json_php = Yii::app()->get("/assets/$id");
        return is_null($json_php) ? null : self::decodeAsset($json_php);
    }

    /**
     * Returns assets identified by a list of comma delimited tags
     * @return array(Asset)
     */

    public static function getAssetsByTags($tags)
    {
        $query = "";
        if (strpos($tags,',') !== FALSE)
        {
            $tags = array_map('trim',explode(',', $tags));
            $query = 't='.implode('&t=',$tags);
        }
        else
        {
            $query = "t=${tags}";
        }

        $json_php = Yii::app()->get("/assets?${query}");

        $out = array();

        if (!empty($json_php['assets']))
        {
            foreach ($json_php['assets'] as &$v)
            {
                $out[] = self::decodeAsset($v);
            }
        }

        return $out;
    }

    /**
     * Deletes an asset from the back end
     */

    public static function deleteAsset($id)
    {
        Yii::app()->delete("/assets/$id");
    }

    /**
     * Posts new asset to the back end
     */

    public static function postAsset($asset)
    {
        $json_php = self::encodeAsset($asset);
        Yii::app()->post('/assets', $json_php);
    }

    /**
     * Updates an existing asset on the back end
     */
    
    public static function putAsset($asset)
    {
        $json_php = self::encodeAsset($asset);
        $id = $asset->id;

        Yii::app()->put("/assets/$id", $json_php);
    }

    /**
     * Saves an image to the back end.
     *
     * @param CUploadedFile $file
     * @return bool True if successful.
     */

    public static function saveImage($file)
    {
        // Compute new file name based on MD5 sum.
        $tmp_name  = $file->getTempName();

        $url = shell_exec("curl -X POST -F file=@${tmp_name} ".
        "http://localhost:8080/qratitude-service/api/photos");
    
        $ok = filter_var($url, FILTER_VALIDATE_URL) !== FALSE;

        return $ok ? $url : null;
    }
}
