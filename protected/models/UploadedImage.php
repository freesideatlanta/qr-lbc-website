<?php

/**
 * Represents an image an end-user uploaded to the web app.
 *
 * @author Sage Gerard
 * @package application.models
 */

class UploadedImage extends CFormModel
{
    public $image;
    public $url;
 
    /*
     * Saves uploaded image to the filesystem, naming
     * it after it's own MD5 sum. Returns URL to
     * uploaded image.
     *
     * @param string $imgPath Webroot relative directory to store image.
     * @return boolean True if file was successfully saved
     */

    public function saveImage($imgPath)
    {
        // Extract the image
        $this->image = CUploadedFile::getInstance($this,'image');

        // Compute new file name based on MD5 sum.
        $tmp_name  = $this->image->getTempName();
        $orig_name = $this->image->getName();

        $md5 = md5_file($tmp_name);
        $ext = pathinfo($orig_name, PATHINFO_EXTENSION);
        $fn  = $imgPath . '/' . $md5 . '.' . $ext;

        // IMPORTANT: This is how everyone else will find the image.
        // Make sure it ends up in persistent storage with meaningful
        // data around it, since it is not a human friendly name.

        $yii = Yii::app();
        $this->url = $yii->baseUrl.'/'.$fn;

        return $this->image->saveAs($yii->basePath.'/../'.$fn);
    }

    /*
     * Business logic for attributes
     */

    public function rules()
    {
        return array(
            array('image','file', 'types'=>'jpg, gif, png'),
        );
    }
}
