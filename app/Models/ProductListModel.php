<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ProductModel extends Model{
    protected $table = 'products';
    
    protected $allowedFields = [
        'title',
        'qty',
        'price',
        'owned_by',
        'timestamp'
    ];

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }
}