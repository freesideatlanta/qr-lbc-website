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
            $query = 't='.implode('t=',$tags);
        }
        else
        {
            $query = "t=${tags}";
        }

        $json_php = Yii::app()->get("/assets?${query}");

        $out = array();

        if (!empty($json_php['assets']))
        {
            foreach ($json_php as &$v)
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

        header('Content-Type: text/plain');
        die(json_encode($json_php));

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
        $orig_name = $file->getName();
        $imgPath   = 'images/assets';

        $md5 = md5_file($tmp_name);
        $ext = pathinfo($orig_name, PATHINFO_EXTENSION);
        $fn  = $imgPath . '/' . $md5 . '.' . $ext;

        // IMPORTANT: This is how everyone else will find the image.
        // Make sure it ends up in persistent storage with meaningful
        // data around it, since it is not a human friendly name.

        $yii = Yii::app();
        $url = $yii->baseUrl.'/'.$fn;

        $ok = $file->saveAs($yii->basePath.'/../'.$fn);

        return $ok ? $url : null;
    }
}
