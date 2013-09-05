<?php

/**
 * Displays all user flashes in an unordered list.
 *
 * List items use Yii standard CSS classes for flash
 * messages.
 *
 */

class FlashBehavior extends CBehavior
{
    /** CSS class assigned to unordered list. */
    public $cssClass = 'flash-list';

    /**
     * Dumps HTML representation of all user flash messages
     * as an unordered list of divs.
     *
     * @return string HTML of user flash messages
     */

    public function dumpFlashHtml()
    {
        $html  = "";

        $flash = Yii::app()->user->getFlashes();
        if ($flash)
        {
            foreach($flash as $key => $message)
            {    
                $div = CHtml::tag('div', array(
                    'class'=>'flash-'.$key
                ), $message);

                $html .= CHtml::tag('li', array(), $div);
            }

            $html = CHtml::tag(
                'ul',
                array(
                    'class'=>$this->cssClass
                ),
                $html
            );
        }

        return $html;
    }
}
