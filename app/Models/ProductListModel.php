<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ProductModel extends Model{
    protected $table = 'product_list';
    
    protected $allowedFields = [
        'id',
        'title',
        'qty',
        'price',
        'owned_by',
        'is_active',
        'timestamp'
    ];

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }
}