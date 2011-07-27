<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//$this->load->library('Layouts');
		$this->layouts->set_title('welcome!');
		$this->layouts->view('welcome_message','','default');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */