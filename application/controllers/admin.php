<?php
/**
 * Admin Controller
 *
 * @package		Admin
 * @author		Ben
 */

class Admin extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('product_m');        
        $this->load->library('template');        
        $this->load->library('basic_auth');
        $this->load->helper('url');
        $this->load->library('data_import');
        
    }
	
	/**
	 * Index
	 *
	 * @access	public
	 */
    public function index()
    {    	     	
        $view_data = array();
    	// Check to see if the user is authenticated as the admin before allowing
        // further access to anything in the admin section.
        if(!$this->basic_auth->is_authenticated())
        {
        	$this->login();
    		return false;
        }
        
        // Import products from the remote source.
    	if($this->input->post('import_products')==1){
    		$imported = $this->data_import->import_data();
    		if($imported)
    		{
    			$view_data['info_message'] = 'The import process completed succesfully.';
    		}
    		else
    		{
    			$view_data['error_message'] = 'The import process failed.';
       		}
    	}
    	
       	$this->template->show_admin('product_import_form', $view_data);
    }

	/**
	 * Login
	 *
	 * @access	public
	 */
    public function login()
    {
        $view_data = array();
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Check for login credentials being passed in.
    	if(strlen($username)>0 && strlen($password)>0)
    	{
    		$login = $this->basic_auth->authenticate($username,$password);
    		if(!$login['success'])
    		{
    			$view_data['error_message'] = $login['error_message'];
    		}
    		else
    		{
    			redirect('/admin/', 'refresh');
    		}
    	}
    	
    	$this->template->show_admin('login_form', $view_data);
    }

    /**
     * Logout
     *
     * @access	public
     */
    public function logout()
    {
    	$login = $this->basic_auth->remove_admin_cookie();
    	redirect('/admin/', 'refresh');
    }
}