<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    private $data;
    private $js_file;
    private $css_file;
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
	$this->CI->load->library('Tank_auth');

        // default CSS and JS that they must be load in any pages

        $this->addJS( base_url('assets/js/jquery.js'));
        $this->addJS( base_url('assets/js/lodash.min.js'));
        $this->addJS( base_url('assets/js/bootstrap.min.js'));
	$this->addJS( base_url('assets/js/menu.js'));
        $this->addCSS( base_url('assets/css/bootstrap.min.css'));
        $this->addCSS( base_url('assets/css/font-awesome.min.css'));
        $this->addCSS( base_url('assets/css/main.css'));
    }

    public function show($folder, $page, $data, $side_menu=false)
    {
        if ( ! file_exists('application/views/'.$folder.'/'.$page.'.php' ) )
        {
            show_404();
        }
        else
        {
            $this->data['page_var'] = $data;
            //$this->data = $data;
               
            if ($this->CI->tank_auth->is_logged_in()) {
                $this->addCSS(base_url('assets/css/side-menu.css'));
                $this->data['side_menu'] = $this->CI->load->view('side_menu', $this->data, true);    
            }
	    else{
		$this->data['side_menu'] = '';
	    }
	    $this->load_JS_and_css();
            $this->init_menu();
            $this->data['menu'] = $this->CI->load->view('menu.php', $this->data, true); 

            $this->data['content'] = $this->CI->load->view($folder.'/'.$page.'.php', $data, true);
	    if($this->CI->tank_auth->is_logged_in()){
		$this->data['side_menu'] = $this->CI->load->view('side_menu.php', $this->data, true);	
	    }
            $this->CI->load->view('template.php', $this->data);
        }
    }

    public function addJS( $name )
    {
        $js = new stdClass();
        $js->file = $name;
        $this->js_file[] = $js;
    }

    public function addCSS( $name )
    {
        $css = new stdClass();
        $css->file = $name;
        $this->css_file[] = $css;
    }

    private function load_JS_and_css()
    {
        $this->data['html_head'] = '';
        $this->data['html_footer'] = '';

        if ( $this->css_file )
        {
            foreach( $this->css_file as $css )
            {
                $this->data['html_head'] .= "<link rel='stylesheet' type='text/css' href=".$css->file.">". "\n";
            }
        }

        if ( $this->js_file )
        {
            foreach( $this->js_file as $js )
            {
                $this->data['html_footer'] .= "<script type='text/javascript' src=".$js->file."></script>". "\n";
            }
        }
    }

    private function init_menu()
    {        
      // your code to init menus
      // it's a sample code you can init some other part of your page
    }
}
