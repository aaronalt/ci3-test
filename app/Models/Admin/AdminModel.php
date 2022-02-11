<?php 
namespace App\Models;  
use CodeIgniter\Model;
use App\Models\UserModel;
  
class AdminModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'is_verified',
        'created_at'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->prodCrud = new ProductModel; 
        $this->userCrdu = new UserModel;
    }

    function save($data)
    {
        $this->db->insert($data);
        return TRUE;
    }

    public function query_db($table = FALSE, $query)
    {
        if ($table == 'users')
        {
            return $this->db->simple_query($query);
        } else if ($table == 'products')
        {
            return ($this->db->simple_query($query));
        }
    }
}