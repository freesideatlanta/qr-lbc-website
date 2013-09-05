<?php

/**
 * An item in the inventory.
 */

class Asset extends CFormModel
{
    public $name;   // Human-friendly name of the asset
    public $tags;   // Comma-delimited tags describing the asset.

    /**
     * @var array(AssetCustomAttribute) User defined attributes
     */

    public $custom; // Custom attributes. Array of AssetCustomAttribute models

    /**
     * @var int Represents PK in back end
     *
     * This is the UID for the asset in the back.
     * Yii cannot touch the back-end directoy,
     * so this is only used for indexing purposes
     */

    public $id;

    /**
     * @var array(CUploadedFile) Represents uploaded images
     */

    public $images;

    /**
     * @var AssetMetaData 
     */

    public $metadata; // Information about the asset

    /**
     * @var array(string) Array of URLs to uploaded files
     */

    public $imageUrls;

    /**
     * If an id is passed, then the properties will be populated
     * with information returned from the back end if the asset
     * exists. If the asset does not exist in these circumstances,
     * an exception is thrown.
     */

    public function __construct($id = null)
    {
        if (is_null($id))
        {
            $this->images   = array();
            $this->metadata = new AssetMetadata();    
        }
        else
        {
            $asset = QratitudeHelper::getAsset($id);

            if (is_null($asset))
            {
                throw new CHttpException(404, "Asset not found");
            }

            $this->attributes = $asset->attributes;
        }

        parent::__construct();
    }

    /**
     * Business logic oriented validation rule config
     *
     * @return array Array of Yii-standard validation rules
     */

    public function rules()
    {
        return array(
            array('metadata', 'nestedValidate'),
            array('images', 'validateImages'),
        );
    }


    /**
     * Populate properties using models collected from form.
     *
     * @param AssetMetadata $metadata Identifying information for asset
     * @param AssetCustomAttribute $custom User-defined attributes
     * @param array(CUploadedFile) $images Array of uploaded images
     * @return void
     */

    public function populate($metadata, $custom, $images)
    {
        header('Content-Type: text/plain');

        $this->metadata->attributes = $metadata;
        foreach ($custom as $c) {
            $n = new AssetCustomAttribute();
            $n->attributes = $c;
            $this->metadata->custom[] = $n;
        }

        $this->images = $images;

        die(var_export($this));
    }

    /**
     * Stores asset in back end.
     *
     * @return bool True if asset was successfully stored
     */

    public function save()
    {
        return QratitudeHelper::saveAsset($this);
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
     * 
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
     * Business logic oriented validation rule config
     *
     * @return array Array of Yii-standard validation rules
     */

    public function rules()
    {
        return array(
            array('name, tags', 'required'),
            array('custom, name, tags', 'safe'),
            array('custom', 'validateCustom')
        );
    }

    /**
     * Returns the default custom attributes the user
     * can set. Determined by retail outlet admin.
     *
     * @return array Array of AssetCustomAttribute models reflecting what the user may define by default.
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

        foreach ($attr as $k=>$v)
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
