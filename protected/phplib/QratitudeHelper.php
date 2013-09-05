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
        $out['name'] = $asset->metadata->name;
        $tags = explode(',', $asset->metadata->tags);

        foreach ($tags as &$t)
        {
            $t = trim($t);
        }

        $out['photos']     = $asset->imageUrls;
        $out['tags']       = $tags;
        $out['attributes'] = array();

        foreach ($asset->metadata->custom as $a)
        {
            $out['attributes'][$a->key] = $a->val;
        }

        return $out;
    }

    public static function getAsset($id)
    {
        $a = new Asset();
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

        $md5 = md5_file($tmp_name);
        $ext = pathinfo($orig_name, PATHINFO_EXTENSION);
        $fn  = $imgPath . '/' . $md5 . '.' . $ext;

        // IMPORTANT: This is how everyone else will find the image.
        // Make sure it ends up in persistent storage with meaningful
        // data around it, since it is not a human friendly name.

        $yii = Yii::app();
        $this->url = $yii->baseUrl.'/'.$fn;

        return $file->saveAs($yii->basePath.'/../'.$fn);
    }
}
