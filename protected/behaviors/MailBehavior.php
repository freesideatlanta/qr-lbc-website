<?php

/**
 * Sends no-reply emails from the application
 */
class MailBehavior extends CBehavior
{
    /**
     * @var string Email address for From: header
     */
    public $from;

    /**
     * @var string Prefix for every email subject line
     */
    public $subject_prefix = "";
    
    /**
     * Sends an email (TODO: Add success return value)
     *
     * @param string $to Email address to send message to
     * @param string $subject Message subject
     * @param string $view View containing email body
     * @param array $viewVars Data to send to view
     * @param string $from Optional "from" address to override $this->from.
     */
    public function mail($to, $subject, $view, $viewVars = array(), $from = null)
    {
        $email = Yii::app()->email;
        $email->to      = $to;
        $email->from    = is_null($from) ? $this->from : $from;
        $email->subject = $this->subject_prefix.$subject;

        $email->view = $view;
        $email->viewVars = $viewVars;
        $email->send();
    }
}
