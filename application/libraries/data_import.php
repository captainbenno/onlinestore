<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 *  Product Data Import Library
 *
 * @author		Ben
 */

class Data_import
{

	public function __construct()
    {
    	$this->CI =& get_instance();
    	$this->CI->load->model('category_m');
    }

	/**
	 * Import products data from remote location
	 *
	 * @access	public
	 * @return	boolean
	 */
	public function import_data()
	{
		$csv_content = $this->get_remote_product_data();		

		if(is_array($csv_content))
		{
			$this->insert_to_temp_tables($csv_content);
		} 
		else 
		{
			return false;
		}
		
		$this->add_missing_categories();
		$this->update_existing_products();
		$this->add_new_products();
		$this->delete_old_products();
		
		return true;
	}
	
	/**
	 * Retrieve remote product data csv from URL in config
	 *
	 * @return	mixed
	 */
	function get_remote_product_data()
	{
		$remote_product_data_url = $this->CI->config->item('remote_product_data_url');
		$file_content = file_get_contents($remote_product_data_url);

		// No file, no need to continue.
		if($file_content == false)
		{
			return false;	
		}
		else
		{
			return explode("\n", $file_content);				
		}
	}
	
	/**
	 * Insert the csv data into temp tables
	 *
	 */
	function insert_to_temp_tables($csv_content)
	{
		// Clear out the product_import_temp table.
		$this->CI->db->query('DELETE FROM product_import_temp');
		
		$i = 0;
		foreach ($csv_content as $row) 
		{	
			// Skip the first line of the csv... we don't need the headers.
			if($i>1)
			{
				$csv_data = str_getcsv($row);
				// Make sure the array of csv_data has atleast 4 columns of data.
				if(count($csv_data)>3) 
				{	
					// Insert each row of the csv into the product_import_temp.
					$data = array(
							'product_id' => $csv_data[0],
							'category' => $csv_data[1],
							'product_name' => $csv_data[2],
							'price' => $csv_data[3]);
					$this->CI->db->insert('product_import_temp', $data);
				}
			}
			$i++;			
		}
	}
	
	/**
	 * Add any missing categories that do not exist in the category table
	 *
	 */
	function add_missing_categories()
	{
		// Look for the missing categories.
		$query = $this->CI->db->query('SELECT DISTINCT category
										FROM product_import_temp
										WHERE TRIM(category) NOT IN 
											(SELECT DISTINCT TRIM(category_name) FROM category)');

		foreach ($query->result() as $row)
		{
			$data = array(
					'category_name' => $row->category,
					'slug' => $this->generate_slug($row->category));
			$this->CI->db->insert('category', $data);
		}
	}

	/**
	 * Update existing product records
	 *
	 */
	function update_existing_products()
	{
		// Look for all imported products that already exist in products.
		$query = $this->CI->db->query('SELECT *
										FROM product_import_temp
										WHERE product_id IN
											(SELECT DISTINCT product_id FROM product)');

		foreach ($query->result() as $row)
		{
			// Update the existing product with the imported product details.
			$data = array(
					'price' => $row->price,
					'product_name' => $row->product_name,
					'slug' => $this->generate_slug($row->product_name),
					'deleted' => 0,
					'category_id' => $this->CI->category_m->get_id_from_name($row->category)
			);
			$this->CI->db->where('product_id', $row->product_id);
			$this->CI->db->update('product', $data);
		}
	}
	
	/**
	 * Add new products
	 *
	 */
	function add_new_products()
	{
		// Look for the imported products missing from the poducts table.
		$query = $this->CI->db->query('SELECT *
										FROM product_import_temp
										WHERE product_id NOT IN 
											(SELECT DISTINCT product_id FROM product)');

		foreach ($query->result() as $row)
		{
			// Add the new product.
			$data = array(
					'price' => $row->price,
					'product_id' => $row->product_id,
					'product_name' => $row->product_name,
					'slug' => $this->generate_slug($row->product_name),
					'deleted' => 0,
					'category_id' => $this->CI->category_m->get_id_from_name($row->category)
			);
			$this->CI->db->insert('product', $data);
		}
	}

	/**
	 * Delete old products - flag as deleted
	 *
	 */
	function delete_old_products()
	{
		// Look for products missing from the import.
		$query = $this->CI->db->query('SELECT id
										FROM product
										WHERE product_id NOT IN 
											(SELECT DISTINCT product_id FROM product_import_temp)');

		foreach ($query->result() as $row)
		{
			// Flag the product as deleted.
			$data = array('deleted' => 1);
			$this->CI->db->where('id', $row->id);
			$this->CI->db->update('product', $data);
			
		}
	}
	
	/**
	 * Generate a slug from a string - a URL friendly string
	 *
	 * @return	string
	 */
	function generate_slug($text)
	{
		return strtolower(preg_replace("/[^\w\d]/ui", '_', $text));
	}
	
}