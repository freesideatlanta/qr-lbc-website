<?php

/** 
 * Static helpers for common operations between the front end and back end.
 * 
 * The back end of the application is not powered by Yii, and is interfaced
 * with in particular ways. This class makes it easier to talk to the back
 * end.
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
     * @param AssetFormModel Asset metadata
     * @param UploadedPhoto Picture of the asset
     *
     * @return array Associative array matching JSON schema for assets
     */

    public static function encodeAsset($assetFormModel, $uploadedPhotoModel)
    {
        $out = array();
        $out['name'] = $assetFormModel->name;
        $tags = explode(',', $assetFormModel->tags);

        foreach ($tags as &$t)
        {
            $t = trim($t);
        }

        $out['photos']     = array($uploadedPhotoModel->url);
        $out['tags']       = $tags;
        $out['attributes'] = $assetFormModel->pairs;

        return $out;
    }
}
