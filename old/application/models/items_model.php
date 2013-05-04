<?php

class Items_model extends CI_Model {
	public function __construct() {
		$this->rest->initialize(array('server' => 'http://localhost:3000'));
	}
	
	/**
	 * Gets all the possible items (large)
	 */
	public function getAllItems() {
		return $this->rest->get('');
	}
	
	/**
	 * Gets an item based on the pid sent to the query
	 * @param string $item The product ID
	 */
	public function getItem($item = false) {
		
	}
	
	/* public function createItem() {
		
	} */
	
	/**
	 * Alters the data for an item based on its pid, and then POST/PUTs 
	 * the attributes of the changed item
	 * @param string $item The product ID
	 */
	public function alterItem($item = false) {
		
	}
	
	/**
	 * Deletes the item based on its pid
	 * @param string $item The product ID
	 */
	public function deleteItem($item = false) {
		
	}
}