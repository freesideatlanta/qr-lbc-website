<?php

/**
 * Asset information provided by the end-user
 */

class AssetMetadata extends CFormModel
{
    public $name;  // Human-friendly name of the asset
    public $tags;  // Comma-delimited tags describing the asset.

    /*
     * $pairs
     *
     * Associative array of custom attributes. Populated by
     * application.actions.asset.CreateAction.
     *
     * The tight coupling is justified by the awkward tabular
     * input methods offered by Yii. It is easier to just let
     * the action do some of the heavy lifting. 
     */

    public $pairs; 

    public function rules()
    {
        return array(
            array('name, tags', 'required'),
        );
    }
}
