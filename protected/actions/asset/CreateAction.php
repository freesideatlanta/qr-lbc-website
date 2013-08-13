<?php

class CreateAction extends ActiveFormAction
{
    public function afterGoodSubmission($model)
    {
        echo "create";
    }    
}
