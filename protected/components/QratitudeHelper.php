<?php

/** 
 * Interface for the back end. Application state must be 
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
     *
     * @param string $username User-specified string id
     * @param string $password Unhashed password for given username
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
     * @param string $username User-specified string id
     * @param string $password Unhashed password for given username
     * @return void
     */
    public static function createUser($username, $password)
    {
        $json = self::encodeCredentials($username, $password);
        Yii::app()->post('/users', $json);
    }



    /**
     * Authenticates user, generating new token in the process.
     *
     * @param string $username User-specified string id
     * @param string $password Unhashed password for given username
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
     *
     * @param string $query String used to search assets
     * @return array Array of {@link Asset} instances
     */
    public static function searchAssets($query)
    {
        $query = urlencode($query);
        $json_php = Yii::app()->get("/assets?s=$query");

        if (!isset($json_php['assets']))
        {
            return array();
        }

        return self::decodeAssetArray($json_php['assets']);
    }



    /**
     * Creates an array of Asset models from a set of
     * assets encoded as a PHP associative array
     * created by json_decode().
     *
     * @param array $json_php array PHP array of asset data.
     * @return array(Asset)
     */
    public static function decodeAssetArray($json_php)
    {
        $out = array();

        if (is_array($json_php))
        {
            foreach ($json_php as &$v)
            {
                $out[] = self::decodeAsset($v);
            }
        }

        return $out;
    }



    /**
     * True if the user (identified by $user_id) has a particular role
     *
     * @param string $user_id ID of user known to back end
     * @param string $role Human readable role for user (i.e. "admin")
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
     * @param string $token Token used for authentication
     * @param string $username User-specified string id
     * @param string $password Unhashed password for given username
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
     * Assets have a JSON representation, and this method returns
     * a PHP array equivelent that can be encoded into JSON when
     * ready. The asset information is extracted from several
     * models supplied as arguments.
     * 
     * @param Asset $asset Asset to encode
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
     * @param array $json_php PHP array (decoded from JSON) of asset data
     * @return Asset Asset object for Yii use
     */
    public static function decodeAsset($json_php)
    {
        $out = new Asset();

        $out->id        = $json_php['id'];
        $out->name      = $json_php['name'];
        $out->summary   = isset($json_php['attributes']['summary']) ?
                            $json_php['attributes']['summary'] : "";
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
        
        if (!isset($json_php['assets']))
        {
            return array();
        }

        return self::decodeAssetArray($json_php['assets']);
    }



    /**
     * Returns Asset instance from the back end by ID.
     *
     * @param string $id Asset ID as hex string
     * @return Asset
     */
    public static function getAsset($id)
    {
        $json_php = Yii::app()->get("/assets/$id");
        return is_null($json_php) ? null : self::decodeAsset($json_php);
    }



    /**
     * Returns assets identified by a list of comma delimited tags
     *
     * @param string $tags Comma-delimited set of tags
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
        
        if (!isset($json_php['assets']))
        {
            return array();
        }

        return self::decodeAssetArray($json_php['assets']);
    }



    /**
     * Deletes an asset from the back end
     *
     * @param string $id Asset ID as hex string
     * @return void
     */
    public static function deleteAsset($id)
    {
        Yii::app()->delete("/assets/$id");
    }



    /**
     * Returns auth headers QRatitude expects for guarded routes
     *
     * Throws 403 if a token is not in the
     * session or the user is not logged in.
     * We throw an exception because the front
     * end should not have exposed any sensitive
     * actions through the interface to guests.
     * In other words, if this method is called
     * by a guest, that is unusual, and therefore
     * exceptional.
     *
     * @return array Flat array of headers for use in curl_setopt()
     */
    private static function getAuthHeaders()
    {
        $user  = Yii::app()->user;
        $token = $user->getState('token', null);
        $username = $user->getName();

        if (is_null($token) || $user->isGuest)
        {
            throw new CHttpException(403, "Unauthorized access");
        }

        return array(
            "token: $token",
            "username: $username"
        );
    }



    /**
     * Posts new asset to the back end
     *
     * @param Asset $asset Asset to save to back end
     * @return bool True if successful
     */
    public static function postAsset($asset)
    {
        $json_php = self::encodeAsset($asset);
        $headers  = self::getAuthHeaders();
        $yii      = Yii::app();

        $http_options = array(
            CURLOPT_HTTPHEADER=>$headers
        );


        $yii->post('/assets', $json_php, $http_options);

        $info = $yii->getResponseInfo();
        return $info["http_code"] == 201;
    }



    /**
     * Updates an existing asset on the back end
     *
     * @param Asset $asset Changed asset. Must have valid {@link Asset::id}
     * @return void
     */
    public static function putAsset($asset)
    {
        $json_php = self::encodeAsset($asset);

        $yii = Yii::app();

        $id = $asset->id;

        // Make sure the back end knows what to target.
        $json_php['id'] = $id;

        $headers = self::getAuthHeaders();
        $http_options = array(
            CURLOPT_HTTPHEADER=>$headers
        );

        $response = $yii->put("/assets/$id", $json_php);

        $info = $yii->getResponseInfo();
        $code = $info["http_code"];

        return $code >= 200 && $code < 300;
    }



    /**
     * Saves an image to the back end.
     *
     * @param CUploadedFile $file File uploaded for current request
     * @return bool True if successful.
     */
    public static function saveImage($file)
    {
        $tmp_name = $file->getTempName();
        $headers = self::getAuthHeaders();

        $mime = CFileHelper::getMimeType($tmp_name, null, false);
        $new_name = null;

        switch ($mime)
        {
            case "image/jpeg":
            case "image/png":
            case "image/gif":
                // Add extension to temp file because PHP
                // stripped it off. The back end
                // checks for an extension.
                list($junk, $extension) = explode('/', $mime);
                
                $new_name = $tmp_name.".$extension";
                rename($tmp_name, $new_name);

                if (!file_exists($new_name))
                {
                    Yii::log(
                        "Could not prepare $new_name for upload",
                        "error",
                        "application.phplib.QratitudeHelper"
                    );

                    throw new CHttpException(
                        500,
                        "Could not upload image. Please try again."
                    );
                }

                break;

            default:
                throw new CHttpException(415,
                    "Please only use .jpg, .png or .gif images");
                break;
        }

        Yii::trace("Saving image $new_name to back end");

        $ch = curl_init();

        // Forces Content-Type: multipart/formdata
        $fields = array(
            "file"=>"@${new_name}",
            "submit"=>"submit"
        );

        $url = Yii::app()->params['api_prefix'].'/photos';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        
        $response = curl_exec($ch);
        $response = json_decode($response, true);

        // PHP does not like having it's temp files
        // touched. Put it back so it can be 
        // deleted as intended.
        rename($new_name, $tmp_name);

        if (!isset($response['url']))
        {
            Yii::trace("Failed to POST image $new_name");
            return null;
        }

        return $response['url'];
    }
}
