<?php

/**
 * An item in the inventory.
 *
 * This class represents a single item in the inventory
 * of a business.
 *
 * @author Sage Lennon Gerard
 * @package application.models
 */

class Asset extends CFormModel
{
    /**
     * @var string Represents PK in back end
     *
     * This is the UID for the asset in the back.
     * Yii cannot touch the database directly,
     * so this is only used for indexing purposes
     */

    public $id;

    /**
     * @var string Human-friendly name of the asset
     */

    public $name;
    
    /**
     * @var string Comma-delimited tags describing the asset.
     */

    public $tags;
    
    /**
     * @var string Brief, human-friendly description of the asset.
     */

    public $summary;

    /**
     * @var array(AssetCustomAttribute) User defined attributes
     */

    public $custom;

    /**
     * @var array(CUploadedFile) Represents uploaded images
     */

    public $images = array();

    /**
     * @var array(string) Array of URLs to uploaded files
     */

    public $imageUrls;

    /**
     * Business logic oriented validation rule config
     *
     * @return array Array of Yii-standard validation rules
     */

    public function rules()
    {
        return array(
            array('images', 'validateImages'),
            array('name, tags, summary', 'required'),
            array('custom, name, tags, summary', 'safe'),
            array('custom', 'validateCustom')
        );
    }

    /**
     * Populate properties using models collected from form.
     *
     * @param Asset Asset containing only identifying information 
     * @param AssetCustomAttribute $custom User-defined attributes
     * @param array(CUploadedFile) $images Array of uploaded images
     * @return void
     */

    public function populate($metadata, $custom, $images)
    {
        $this->attributes = $metadata;

        foreach ($custom as $c) {
            $n = new AssetCustomAttribute();
            $n->attributes = $c;
            $this->custom[] = $n;
        }

        $this->images = $images;
    }

    /**
     * Allows a nested model to validate.
     *
     * @return bool True if validation was successful.
     */

    public function nestedValidate($attr, $params)
    {
        $model = $this->$attr;
        if (!$model->validate())
        {
            $this->addErrors($model->getErrors());
            return false;
        }

        return true;
    }

    /**
     * Saves uploaded images to disk.
     * URLs to images are kept in Asset::imageUrls
     *
     * @return bool True if all images are saves successfully
     */

    public function saveImages()
    {
        $ok = true;

        // Save all uploaded images
        foreach ($this->images as $i)
        {
            $url = QratitudeHelper::saveImage($i);
            
            if (is_null($url))
            {
                $fn = $i->getName();
                $this->addError("images","Failed to upload image $fn");
                $ok = false;
            }
            else
            {
                $this->imageUrls[] = $url;
            }
        }

        return $ok;
    }

    /**
     * Saves asset to back, assuming it is new.
     * @return True if successful
     */

    public function saveNew()
    {
        $ok = true;

        $ok &= $this->saveImages();
        QratitudeHelper::postAsset($this);

        return $ok;
    }
    
    /**
     * Saves existing asset to back
     * @return True if successful
     */

    public function save()
    {
        $ok = true;

        $ok &= $this->saveImages();
        QratitudeHelper::putAsset($this);

        return $ok;
    }

    /**
     * @return bool If asset exists on the back end
     */

    public static function doesAssetExist($id)
    {
        return !is_null(QratitudeHelper::getAsset($id));
    }

    /**
     * Make sure at least one image is uploaded.
     *
     * @return bool True if validation is successful
     */

    public function validateImages($attr, $params)
    {
        if (count($this->$attr) == 0)
        {
            $this->addError($attr, "Please upload at least one image");
            return false;
        }

        return true;
    }

    /**
     * Returns the default custom attributes the user
     * can set. Determined by retail outlet admin.
     *
     * @return array AssetCustomAttributes the user may define by default.
     */

    public static function getDefaultCustomAttrs()
    {
        $custom_attrs = array();

        $default_custom_attrs = array(
            'Quantity',
            'Size',
            'Color',
            'Price'
        );

        // in future...
        // $default_custom_attrs = Yii::app()->get('/attrs');

        foreach ($default_custom_attrs as $a)
        {
            $c = new AssetCustomAttribute();
            $c->key = $a;
            $c->val = "";
            $custom_attrs[] = $c;
        }

        return $custom_attrs;
    }

    /**
     * Checks to make sure all custom attributes are okay.
     */

    public function validateCustom($attr, $params)
    {
        $ok = true;

        foreach ($this->$attr as $k=>$v)
        {
            if (!$v->validate())
            {
                $this->addErrors($v->getErrors());
                $ok = false;
            }
        }

        return $ok;
    }
}
