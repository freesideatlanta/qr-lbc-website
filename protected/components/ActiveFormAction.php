<?php

/**
 * Automatically performs common setup operations for CActiveForm.
 */
 
class ActiveFormAction extends CAction
{    
    public $scenario = '';
    private $_model;
    private $_view_name;
    
    protected function afterGoodSubmission($model)
    {
    }
    
    public function run()
    {        
        $this->processActiveForm( $this->getId(), $this->scenario );
    }
    
    public function processActiveForm($name, $scenario)
    {
        // conventions
        $modelName = ucfirst($name)."FormModel";
        $formID = $name."Form";
        $this->_view_name = $name;
        
        $this->_model = new $modelName($scenario);
    
        // return JSON results on AJAX validation
        if(isset($_POST['ajax']) && $_POST['ajax']===$formID)
        {
            echo CActiveForm::validate($this->_model);
            Yii::app()->end();
        }

        // collect input
        if(isset($_POST[$modelName]))
        {
            $this->_model->attributes=$_POST[$modelName];
            
            if (!$this->_model->validate() ||
                !$this->afterGoodSubmission($this->_model))
            {
                $this->showForm();
            }
        }
        else
        {
            $this->showForm();
        }
    }
    
    private function showForm()
    {
        $this->controller->render('application.views.forms.'.$this->getId(),
            array('model'=>$this->_model));
    }
}
