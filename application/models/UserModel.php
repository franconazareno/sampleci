<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	public function find_all_users()
	{
		$query = $this->db->select("u_seq,u_id,u_name,u_phone,created_at,updated_at")
		                  ->from('user')
		                  ->limit('10');
		$return_response = $query->get()->result_array();
		return $return_response;
	}

	public function find_user_by_useq($u_seq)
	{
		$query = $this->db->select("u_seq,u_id,u_name,u_phone,created_at,updated_at")
		                  ->from('user')
		                  ->where('u_seq', $u_seq)
		                  ->limit('1');
		$return_response = $query->get()->result_array();
		return $return_response;
	}

	public function find_user_by_uid($u_id)
	{
		$query = $this->db->select("u_seq,u_id,u_name,u_phone,created_at,updated_at")
		                  ->from('user')
		                  ->where('u_id', $u_id)
		                  ->limit('1');
		$return_response = $query->get()->result_array();
		return $return_response;
	}

	public function edit_user($data)
	{
		if(!empty($data['u_name'])){
			$this->db->set('u_name', $data['u_name']);
		}

		if(!empty($data['u_phone'])){
			$this->db->set('u_phone', $data['u_phone']);
		}

		$this->db->where('u_seq', $data['u_seq']);
		$this->db->update('user');

		if ($this->db->affected_rows() === 1)
		{
			return true;
		}
		else
		{
			return $this->db->affected_rows();
		}
	}

	public function create_user($data)
	{
		if(!empty($data['u_id'])){
			$this->db->set('u_id', $data['u_id']);
		}

		if(!empty($data['u_name'])){
			$this->db->set('u_name', $data['u_name']);
		}

		if(!empty($data['u_phone'])){
			$this->db->set('u_phone', $data['u_phone']);
		}

		$this->db->insert('user');

		if ($this->db->affected_rows() === 1)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

}