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
            array('images', 'validateImages', 'on'=>'create'),
            array('name, tags, summary', 'required'),
            array('custom, name, tags, summary', 'safe'),
            array('custom', 'validateCustom')
        );
    }

    /**
     * Populate properties using models collected from form.
     *
     * @param array $metadata Information about asset
     * @param array $custom_array Array of key value pairs for custom attributes
     * @param array $images Array of {@link CUploadedFile} images
     * @return void
     */
    public function populate($metadata, $custom_array, $images)
    {
        $this->attributes = $metadata;


        // We want to make sure we do not add redundant attribute keys.
        // Find all existing custom attribute keys so we overwrite
        // existing attributes instead of adding a second attribute
        // with the same key in $this->custom
        $keys = array();

        if (!empty($this->custom))
        {
            foreach ($this->custom as $c)
            {
                $keys[] = $c->key;
            }
        }

        foreach ($custom_array as $c)
        {
            $index = array_search($c['key'], $keys, true);
    
            // Prevent redefinitions
            if ($index !== FALSE)
            {
                // existing key
                $this->custom[$index]->val = $c['val'];
            }
            else
            {
                // key not found.
                $n = new AssetCustomAttribute();
                $n->attributes = $c;
                $this->custom[] = $n;
            }

        }

        // Note that these represent images
        // to upload to the back end.
        // Once finished, use $this->imageUrls
        // to refer to images associated with the asset
        $this->images = $images;
    }

    /**
     * Allows a nested model to validate.
     *
     * @param string $attr Attribute name to validate
     * @param array $params Data passed to this validator (Not used)
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
                Yii::trace("Failed to upload image $fn");
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
        $ok &= QratitudeHelper::postAsset($this);

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
        $ok &= QratitudeHelper::putAsset($this);

        return $ok;
    }


    /**
     * Returns true if asset exists on the back end
     *
     * @param string $id ID of asset as hex string
     * @return bool True if asset exists
     */
    public static function doesAssetExist($id)
    {
        return !is_null(QratitudeHelper::getAsset($id));
    }


    /**
     * Make sure at least one image is uploaded.
     *
     * @param string $attr Attribute name to validate
     * @param array $params Data passed to this validator (Not used)
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
     * Checks to make sure all custom attributes are valid.
     *
     * @param string $attr Attribute name to validate
     * @param array $params Data passed to this validator (Not used)
     * @return bool True if all custom attributes are valid
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
