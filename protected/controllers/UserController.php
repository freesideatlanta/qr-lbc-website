<?php

/**
 * Provides CRUD ops on users and maintains their accounts
 *
 *
 * @author Sage Gerard
 * @version 1.0
 * @package application.controllers
 */
class UserController extends Controller
{

    /**
     * Returns array of actions this controller uses.
     *
     * Returns an array of actions used by the controller
     * to view or modify site users. Array keys are action IDs,
     * and array values are path aliases to the classes representing
     * the actions.
     *
     * @return Array of actions used by the controller
     */
    public function actions()
    {
        return array(
        //    'admin'=>'application.actions.user.AdminAction',
        //    'delete'=>'application.actions.user.DeleteAction',
            'index'=>'application.actions.user.IndexAction',
            'login'=>'application.actions.user.LoginAction',
            'logout'=>'application.actions.user.LogoutAction',
            'register'=>'application.actions.user.RegisterAction',
        //    'update'=>'application.actions.user.UpdateAction',
        //    'view'=>'application.actions.user.ViewAction',
        );
    }

    /**
     * Returns action filters
     *
     * @return array action filters
     */     
    public function filters()
    {
        return array(
            'accessControl', // access control for CRUD operations
            'postOnly + delete', // delete only via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */ 
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('admin','delete','update'),
                'roles'=>array('admin'),
            ),
            array('allow',
                'actions'=>array('index','view'),
                'roles'=>array('staff'),
            ),
            array('allow',  // allow all users
                'actions'=>array('login','logout','forgot','reset',
                                 'verify','register'),
                'users'=>array('*'),
            ),
            array('deny',  // catch-all
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Performs AJAX validation on a model
     *
     * Performs AJAX validation on a model and
     * echos the result of CActiveForm::validate()
     *
     * @param CModel $model to validate
     * @return void
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
