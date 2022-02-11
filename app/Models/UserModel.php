<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'attached_products',
        'is_active',
        'is_verified',
        'created_at'
    ];

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }

    function get_user($id)
    {
        $this->db->select($id);
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
}