<?php
/**
 * Categories Base Model
 *
 * @package		Categories
 * @author		Ben
 */

class Category_m extends CI_Model 
{

	function __construct()
	{
		$this->load->database();
	}

	/**
	 * Gets all category records, ordered by category_name
	 *
	 * @access	public
	 * @return	array
	 */
 	public function get_all()
	{
		// Get all categories that are used by products.
		$this->db->select('category.*');
		$this->db->join('product', 'product.category_id = category.id');
		$this->db->order_by('category_name');
		$this->db->group_by(array("category_id"));
		$query = $this->db->get_where('category', array());

		return $query->result();
	}

	/**
	 * Gets all category records, ordered by category_name
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
 	public function get_by_slug($slug)
	{
		if(strlen($slug) > 0)
		{
			$query = $this->db->get_where('category', array('slug' => $slug));
			return $query->result();
		}

		return array();
	}	

	/**
	 * Gets all category records, ordered by category_name
	 *
	 * @access	public
	 * @param	string
	 * @return	int
	 */
	public function get_id_from_name($category_name)
	{
		$query = $this->db->get_where('category', array('category_name' => $category_name));
		$row = $query->row();

		return $row->id;
	}
}