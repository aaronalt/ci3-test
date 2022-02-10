<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\ProductListModel;
use App\Models\UserModel;

class ProductCRUD extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('ProductModel'); 
        $this->prodCrud = new ProductModel; 
        $this->prodList = new ProductListModel;
    }

    public function index()
    {
        // user gets list of all products 
        $data['data'] = $this->prodCrud->get_products();
        $this->load->view('prodCrud/list', $data);
    }

    public function edit_list($prodID, $qty)
    {
        $user = $this->session->$_GET('id', $this->UserModel);
        $product = $this->prodCrud->find_product($prodID);
        $prod_list = [
            'user' => $this->$user,
            'product' => $this->$product,
            'quantity' => $this->$qty
        ];
        $this->update_list($prod_list);
    }

    public function update_list($data)
    {
        // users product list updates when product is added
        $this->prodList->save($data);
    }
}