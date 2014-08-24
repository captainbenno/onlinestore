<?php
/**
 * Products Controller
 *
 * @package		Products
 * @author		Ben
 */

class Product extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('product_m');        
        $this->load->model('category_m');        
        $this->load->library('template');        
    }
	
	/**
	 * Index
	 *
	 * @access	public
	 */
    public function index()
    {
       	$view_data = array();
    	$req = array_merge($_GET, $_POST);
    	
    	// Check the URL for a valid category slug.
    	$category_slug = $this->uri->segment(2, FALSE);
    	$category_recordset = $this->category_m->get_by_slug($category_slug);
    	     			
    	if(count($category_recordset) > 0)
    	{
	    	$view_data['category_name'] = $category_recordset[0]->category_name;
    		
	    	// Get all products by category.
    		$view_data['product_list_html'] = $this->get_product_list($category_slug);
	  		$this->template->show('product_list', $view_data);
    	}
    	else
    	{
			// Get random product for welcome page.
    		$view_data['product_list_html'] = $this->get_random_product();
    		$this->template->show('welcome', $view_data);    		
    	}
    }
    
    /**
     * Build product item list
     *
     * @param	string
     * @return	string (HTML)
     */
    function get_product_list($category_slug)
    {    	
    	$product_list_html = '';
    	
	    // Get all products by category and format using the product_list_item view.
    	$product_recordset = $this->product_m->filter_by_category_slug($category_slug);
    	foreach ($product_recordset as $row)
    	{
    		$product_list_html = $product_list_html.$this->load->view('snippets/product_list_item',$row,TRUE);
    	}
    
    	return $product_list_html;
    }


    /**
     * Select a random product for display
     *
     * @return	string (HTML)
     */
    function get_random_product()
    {    	

	    // Get all products by category, select one ramdomly and format using the product_list_item view.
    	$product_recordset = $this->product_m->get_all();
    	$show_record = rand(1,count($product_recordset));
 		$product_list_html = $this->load->view('snippets/product_list_item_large',$product_recordset[$show_record-1],TRUE);
    
    	return $product_list_html;
    }
    
    
}