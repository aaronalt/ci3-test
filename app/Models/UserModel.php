<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'is_verified',
        'created_at'
    ];

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }
}