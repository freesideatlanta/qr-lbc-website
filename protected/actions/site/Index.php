<?php

class Index extends CAction
{
    public function run()
    {
        $this->controller->layout = '//layouts/column2';
        $this->controller->render('index');
    }
}
