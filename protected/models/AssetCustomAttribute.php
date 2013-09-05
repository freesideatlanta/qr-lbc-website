<?php

/**
 * User defined attribute for asset.
 */

class AssetCustomAttribute extends CFormModel
{
    public $key;
    public $val;

    public function rules()
    {
        return array(
            array('key,val','required'),
        );
    }
}
