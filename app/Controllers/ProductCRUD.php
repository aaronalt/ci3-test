<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class ProductCRUD extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('ProductCRUDModel'); // create model
        $this->prodCrud = new ProductCRUDModel; // create model
    }

    public function index()
    {
        $data['data'] = $this->prodCrud->get_prodCrud();
        $this->load->view('prodCrud/list', $data);
    }

    public function show($id)
    {
        $product = $this->prodCrud->find_product($id);
        $this->load->view('prodCrud/show', array('product'=>$product));
    }

    public function create()
    {
        $this->load->view('prodCrud/create');
    }

    public function store()
    {
        $this->prodCrud->insert_product();
    }

    public function edit($id)
    {
        $product = $this->prodCrud->find_product();
        $this->load->view('prodCrud/edit', array('product'=>$product));
    }

    public function update($id)
    {
        $this->prodCrud->update_product($id);
    }

    public function delete($id)
    {
        $product = $this->prodCrud->delete_product($id);
    }
}