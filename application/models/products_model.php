<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 
  
class Products_model extends CI_Model { 
  
  function Products_model() { 
    parent::__construct(); 
  } 

  function get_all($table) { 
     return $this->db->get( $table )->result(); 
  }

  function get( $id ) {
      $r = $this->db->where( 'product_id', $id )->get( 'products' )->result();
      if ( $r ) return $r[0];
      return false;
  }

  function get_sub_products($category) {
      $query = $this->db->query('SELECT p.product_id, p.name, p.description, p.price, p.image_name FROM products as p, sub_categories as s WHERE p.sub_category_id = s.id AND s.name = "' . $category . '"');
      return $query->result();
  } 
  function get_sub_products_2($category) {
      $query = $this->db->query('SELECT p.product_id, p.name, p.description, p.price, p.image_name FROM products as p, sub_categories_2 as s WHERE p.sub_category_id = s.id AND s.name = "' . $category . '"');
      return $query->result();
  } 

  function get_products($category) {
      $query = $this->db->query('SELECT p.product_id, p.name, p.description, p.price, p.image_name FROM products as p, categories as c WHERE p.category_id = c.category_id AND c.name = "' . $category . '"');
      return $query->result();
  } 

  function get_category() {
     $query = $this->db->query('SELECT * FROM categories');
     return $query->result();
  }

  function get_sub_category() {
      $query = $this->db->query('SELECT * FROM sub_categories');
      return $query->result();
  }
  function get_sub_category_2() {
      $query = $this->db->query('SELECT * FROM sub_categories_2');
      return $query->result();
  }  

  function get_size($id) {
      $query = $this->db->query('SELECT * FROM sizes');
      return $query->result();
  }  

  function get_product_size_id($id) {
      $query = $this->db->query('SELECT s.name FROM size as s, products as p WHERE s.id = p.size_id AND p.product_id = "' . $id . '"');
      return $query->result_array(); 
  }

  function get_size_id($id) {
      $r = $this->db->where('id', $id )->get('sizes')->result();
      if ( $r ) return $r[0];
      return false;
  }  

  function get_keys($value) {
      $query = $this->db->query('SELECT s.id FROM sizes as s WHERE s.name  = "' . $value . '"');
      return $query->result_array();   
  }

  function level_tree($parent, $level) {
     $query = $this->db->query('SELECT node.category_id, node.name, node.lft, node.rgt, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                                FROM categories AS node,
                                        categories AS parent,
                                        categories AS sub_parent,
                                        (
                                                SELECT node.category_id, node.name, node.lft, node.rgt, (COUNT(parent.name) - 1) AS depth
                                                FROM categories AS node,
                                                        categories AS parent
                                                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                                        AND node.name = "' . $parent  
                                                 . '" GROUP BY node.name
                                                ORDER BY node.lft
                                        )AS sub_tree
                                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                                        AND sub_parent.name = sub_tree.name
                                GROUP BY node.name
                                HAVING depth <= "' . $level  . '"
                                ORDER BY node.lft');
     return $query->result_array();
  }

  function sub_node($parent) {
     $query = $this->db->query('SELECT node.category_id, node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
FROM categories AS node,
    categories AS parent,
    categories AS sub_parent,
    (
        SELECT node.name, (COUNT(parent.name) - 1) AS depth
        FROM categories AS node,
        categories AS parent
        WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.name = "' . $parent . '"
        GROUP BY node.name
        ORDER BY node.lft
    )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
    AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
    AND sub_parent.name = sub_tree.name
GROUP BY node.name
HAVING depth = 1
ORDER BY node.lft;');
     return $query->result();
  }
}