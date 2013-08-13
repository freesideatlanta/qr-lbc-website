<?php

class UpdateAction extends ActiveFormAction
{
    public function afterGoodSubmission($model)
    {
        echo "update";
    }    
}
