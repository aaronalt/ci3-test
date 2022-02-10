<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ProductModel extends Model{
    protected $table = 'products';
    
    protected $allowedFields = [
        'title',
        'description',
        'price',
        'image',
        'status',
        'created_at',
        'deleted_at'
    ];

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }
}