<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Basic Authentication Library
 *
 * @author		Ben
 */

class Basic_auth
{

	public function __construct()
    {
    	$this->CI =& get_instance();
    	$this->CI->load->helper('cookie');
    }
		
	/**
	 * Authenticate credentials
	 * 
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	array
	 * 
	 */
	public function authenticate($username,$password)
	{
		$login_results = array();
				
		$admin_password = $this->CI->config->item('admin_password');
		$admin_username = $this->CI->config->item('admin_user');

		if($username==$admin_username && $password==$admin_password)
		{
			$login_results['success'] = 1;
			$this->set_admin_cookie();
		}
		else 
		{
			$login_results['success'] = 0;
			$login_results['error_message'] = 'Authentication failed, please try again.';
		}		
		
		return $login_results;
	}	

	/**
	 * Logged in or not?
	 *
	 * @access	public
	 * @return	boolean
	 *
	 */
	public function is_authenticated()
	{
		if($this->CI->input->cookie('admin_access')==1)
		{
			return true;
		}
		else 
		{
			return false;	
		}
	}
	
	/**
	 * Set admin cookie
	 *
	 */
	function set_admin_cookie()
	{	
		//Set cookie to expire in 2 hours.
		$cookie = array(
				'name'   => 'admin_access',
				'value'  => '1',
				'expire' => '7200'
		);
		set_cookie($cookie);
	}
	
	/**
	 * Delete admin cookie
	 *
	 */
	function remove_admin_cookie()
	{	
		delete_cookie('admin_access');
	}
}