<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model{
 
    public function get_employees(){
   	   $query = $this->db->get('employee');
   	   return $query->result();
    }

    public function insert_employees($data){
    	return $this->db->insert('employee', $data);    
    }

    public function edit_employees($id){
    	$this->db->where('id', $id);
    	$query = $this->db->get('employee');
   	    return $query->row();
    }

    public function update_employees($id,$data){
    	$this->db->where('id', $id);
    	return $this->db->update('employee', $data);
    }

    public function delete_employees($id){
    	return $this->db->delete('employee', ['id' => $id]);
    }
}

?>