<?php

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field'=>'email',
                'label'=>'Email',
                'rules'=>'required|valid_email|max_length[254]|trim'
            ),
            array(
                'field'=>'subject',
                'label'=>'Subject',
                'rules'=>'required|min_length[3]|max_length[80]|trim'
            ),
            array(
                'field'=>'message',
                'label'=>'Message',
                'rules'=>'required|trim'
            ),
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run())
        {
            $this->load->view('contact_form_success');
        }
        else
        {
            $this->load->view('contact_form');
        }
    }

}
