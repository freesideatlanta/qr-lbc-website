<?php
 
/**
 * Layout management library based on:
 * a library that used to be in the CodeIgniter Wiki*
 * Extended layout placeholders and javascript and css files inclusion.
 */
class Layout
{
 
    public $obj;
    public $layout;
    public $js;
    public $css;
    public $placeholder;
 
    public function __construct($layout = "layouts/default_layout")
    {
        $this->obj = & get_instance();
        $this->layout = $layout;
        $this->js = $this->css = $this->placeholder = array();
    }
 
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
 
    public function view($view, $data=null, $return=false)
    {
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);
        if ($return)
        {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else
        {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
 
    public function load_js($file=null)
    {
        if (is_array($file))
        {
            foreach ($file as $f)
                $this->js[] = $f;
        }else
            $this->js[] = $file;
    }
 
    public function js()
    {
        $stream = "";
        foreach ($this->js as $js)
            $stream .= '<script type="text/javascript" src="' . $js . '"></script>' . "\n";
 
        return $stream;
    }
 
    public function load_css($file=null)
    {
        if (is_array($file))
        {
            foreach ($file as $f)
                $this->css[] = $f;
        }else
            $this->css[] = $file;
    }
 
    public function css()
    {
        $stream = "";
        foreach ($this->css as $css)
        {
            $stream .= '<link href="' . $css . '" rel="stylesheet" type="text/css" media="screen" />' . "\n";
        }
        return $stream;
    }
 
    public function placeholder($key, $value=null)
    {
        if ($value == null)
            return $this->placeholder[$key];
        else
            $this->placeholder[$key] = $value;
    }
}
