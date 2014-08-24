<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Basic Template Library
 *
 * @author		Ben
 */

class Template
{

	public function __construct()
    {
    	$this->CI =& get_instance();
    	$this->CI->load->model('category_m');
    	$this->CI->load->helper('url');
    }
	
	/**
	 * Show main template
	 *
	 * @access	public
	 */
    public function show($view,$view_data)
    {
    	// Load in categories html to view data.
    	$view_data['category_menu_html'] = $this->get_category_menu();

    	$this->CI->load->view('header', $view_data);
    	$this->CI->load->view($view, $view_data);
    	$this->CI->load->view('footer');
	}
	
	/**
	 * Build category menu html
	 *
	 * @return	string (HTML)
	 */
	function get_category_menu()
	{
		$category_menu_html = '';
		
		// Load in categories.
		$category_recordset = $this->CI->category_m->get_all();
		foreach ($category_recordset as $row)
		{
			$row->url = site_url('/product/'.$row->slug);
			$category_menu_html = $category_menu_html.$this->CI->load->view('snippets/category_menu_item',$row,TRUE);
		}
		
		return $category_menu_html;
	}	

	/**
	 * Show admin template
	 *
	 * @access	public
	 */
	public function show_admin($view,$view_data)
	{	
		$this->CI->load->view('admin/header', $view_data);
    	$this->CI->load->view('admin/'.$view, $view_data);
		$this->CI->load->view('admin/footer');
	}
	
}