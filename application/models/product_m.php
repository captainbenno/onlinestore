<?php
/**
 * Products Base Model
 *
 * @package		Products
 * @author		Ben
 */

class Product_m extends CI_Model 
{

	function __construct()
	{
		$this->load->database();
        $this->load->model('category_m');        
	}

	/**
	 * Gets all product records
	 *
	 * @access	public
	 * @return	array
	 */
 	public function get_all()
	{
		$query = $this->db->get_where('product', array('deleted' => 0));
		
		return $query->result();
	}
	
	/**
	 * Gets all product records filtered by category slug
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	public function filter_by_category_slug($category_slug)
	{
		// Get the category_id to filter by from the category slug.
		$category_recordset = $this->category_m->get_by_slug($category_slug);
		$category_id = $category_recordset[0]->id;
		$query = $this->db->get_where('product', array('category_id' => $category_id,'deleted' => 0));

		return $query->result();
	}
		
}