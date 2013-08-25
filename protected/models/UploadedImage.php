<?php

/**
 * Represents an image an end-user uploaded to the web app.
 *
 * @author Sage Gerard
 * @package application.models
 */

class UploadedImage
{
    public $image;
    public $url;
 
    /*
     * Saves uploaded photo to the filesystem, naming
     * it after it's own MD5 sum. Returns URL to
     * uploaded photo.
     *
     * @param string $imgPath Webroot relative directory to store image.
     * @return boolean True if file was successfully saved
     */

    public function processPhoto($imgPath)
    {
        // Extract the photo
        $this->image = CUploadedFile::getInstance($this,'image');

        // Compute new file name based on MD5 sum.
        $tmp_name  = $this->image->getTempName();
        $orig_name = $this->image->getName();

        $md5 = md5_file($tmp_name);
        $ext = pathinfo($orig_name, PATHINFO_EXTENSION);
        $fn  = $imgPath . '/' . $md5 . '.' . $ext;

        // IMPORTANT: This is how everyone else will find the photo.
        // Make sure it ends up in persistent storage with meaningful
        // data around it, since it is not a human friendly name.
        $this->url = $yii->baseUrl.'/'.$fn;

        $yii = Yii::app();
        return $this->image->saveAs($yii->basePath.'/'.$fn);
    }

    /*
     * Business logic for attributes
     */

    public function rules()
    {
        return array(
            array('photo', 'required'),
            array('photo','file', 'types'=>'jpg, gif, png'),
        );
    }
}
