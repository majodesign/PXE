<?php

class Layouts
{
	private $CI;
	
	private $title_layout = NULL;
	
	private $title_sep = ' | ';
	
	private $includes = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function set_title($title)
	{
		$this->title_layout = $title;
	}
	
	public function view($view_name, $params = array(), $layout)
	{
		$render_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if($this->title_layout !== NULL)
		{
			$this->title_layout = $this->title_sep . $this->title_layout;
		}
		
		$this->CI->load->view('layouts/'. $layout, array(
			'content_layout'	=>	$render_view,
			'title_layout'		=>	$this->title_layout
		));
	}
	
	public function add_includes($path, $prepend_base_url = TRUE)
	{
		if($prepend_base_url)
		{
			$this->CI->load->helper('url');
			$this->includes[] = base_url() . $path;
		}else
		{
			$this->includes[] = $path;
		}
		
		return $this; //$this->layouts->add_include('blahblah')->add_include('blaaahblaah')
	}
	
	public function print_includes()
	{
		
		$final_includes = '';
		
		foreach ($this->includes as $include)
		{
			if(preg_match('/js$/', $include))
			{
				$final_includes .= '<script src="' . $include . '"></script>';
			}
			elseif(preg_match('/css$/', $include))
			{
				$final_includes .= '<link rel="stylesheet" href="' . $include . '" />';
			}
		}
		
		return $final_includes;
	}
}