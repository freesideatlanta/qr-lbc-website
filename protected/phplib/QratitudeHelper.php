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
     * Generates request body representing passed credentials.
     * @return array
     */

    public static function encodeCredentials($username, $password)
    {
        return array(
            'username'=>$username,
            'password'=>$password
        );
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
     * Authenticates user, generating new token in the process.
     *
     * @return array Array containing user token and id
     */

    public static function authenticate($username, $password)
    {
        $json  = self::encodeCredentials($username, $password);
        $yii   = Yii::app();
        
        $json_php = $yii->post('/tokens', $json);
        $response = $yii->getResponseInfo();

        return $response["http_code"] == 200 ? $json_php : null;
    }



    /**
     * Searches assets by query string
     */

    public static function searchAssets($s)
    {
        $json_php = Yii::app()->get("/assets?s=$s");
        return self::decodeAssetArray($json_php['assets']);
    }



    /**
     * Creates an array of Asset models from a set of
     * assets encoded as a PHP associative array
     * created by json_decode().
     *
     * @param $json_php array PHP array of asset data.
     * @return array(Asset)
     */

    public static function decodeAssetArray($json_php)
    {
        $out = array();

        foreach ($json_php as &$v)
        {
            $out[] = self::decodeAsset($v);
        }

        return $out;
    }



    /**
     * True if the user (identified by $user_id) has a particular role
     *
     * @return boolean
     */

    public static function checkRole($user_id, $role)
    {
        $user = Yii::app()->get("/user/$user_id");
        
        if (is_null($user))
        {
            return false;
        }

        return $role === $user["role"];
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

        $response = $yii->getResponseInfo();
        return $response["http_code"] == 200;
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
        $out['tags']       = $tags;
        $out['attributes'] = array();
        $out['attributes']['summary'] = $asset->summary;

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
        $out->summary   = $json_php['attributes']['summary'];
        $out->tags      = join(',', $json_php['tags']);
        $out->imageUrls = $json_php['photos'];

        // avoid double assignment
        unset($json_php['attributes']['summary']);

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
        return self::decodeAssetArray($json_php['assets']);
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
        /*
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
        */

        $tags = urlencode($tags);
        $json_php = Yii::app()->get("/assets?t=$tags");
        return self::decodeAssetArray($json_php['assets']);
    }



    /**
     * Deletes an asset from the back end
     */

    public static function deleteAsset($id)
    {
        Yii::app()->delete("/assets/$id");
    }



    /**
     * Throws 403 if a token is not in the
     * session or the user is not logged in,
     * otherwise returns token
     */

    public static function tokenRequired()
    {
        $user  = Yii::app()->user;
        $token = $user->getState('token', null);

        if (is_null($token) || $user->isGuest)
        {
            throw new CHttpException(403, "Unauthorized access");
        }

        return $token;
    }



    /**
     * Posts new asset to the back end
     */

    public static function postAsset($asset)
    {
        $json_php = self::encodeAsset($asset);

        $token = self::tokenRequired();

        $http_options = array(
            CURLOPT_HTTPHEADER=>array(
                "token: $token",
            )
        );

        Yii::app()->post('/assets', $json_php, $http_options);
    }



    /**
     * Updates an existing asset on the back end
     */
    
    public static function putAsset($asset)
    {
        $json_php = self::encodeAsset($asset);
        $id = $asset->id;

        $token = self::tokenRequired();
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
        $tmp_name = $file->getTempName();
        $token = self::tokenRequired();

        /*
         //hacky shit
            
        $url = shell_exec("curl -X POST -F file=@${tmp_name} ".
        "-H \"token: $token\" ".
        "http://localhost:8080/qratitude-service/api/photos");

         */

        // Upload data to back end
        $ch = curl_init();

        $data['Filedata'] = "@${tmp_name}";

        curl_setopt($ch, CURLOPT_URL,
            Yii::app()->params['api_prefix'].'/photos');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);

        Sugar::dump($response);

        $ok = filter_var($url, FILTER_VALIDATE_URL) !== FALSE;

        return $ok ? $url : null;
    }
}
