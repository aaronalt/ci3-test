<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('ProductModel'); 
        $this->adminCrud = new AdminModel;
        $this->prodCrud = new ProductModel; 
        $this->prodList = new ProductListModel;
    }

    public function index()
    {
        $this->load->view('admin/dashboard_view');
    }

    function get_active_verified_users($onlysum = '')
    {
        $query = "SELECT * FROM users WHERE is_active = TRUE AND is_verified = TRUE";
        $users_list = $this->adminCrud->query_db('users', $query);
        foreach ($users_list->result() as $row)
        {
            echo $row->name;
            echo $row->email;
            echo $row->attached_products;
            echo $row->is_active;
            echo $row->is_verified;
        }
        $sum = $users_list->num_rows();
        if ($onlysum)
        {
            return $sum;
        } else {
            return $users_list;
        }
    }

    function get_active_users_with_products_attached()
    {
        $sum = 0;
        $users_list = $this->get_active_verified_users(FALSE);
        foreach ($users_list->result() as $row)
        {
            if ($row->attached_products == TRUE)
            {
                echo $sum++;
            } 
        }
        return $sum;
    }

    function get_active_products();
    {
        $query = "SELECT * FROM products WHERE is_active = TRUE";
        $product_list = $this->adminCrud->query_db('products', $query);
        foreach ($product_list->result() as $row)
        {
            echo $title;
            echo $is_active;
        }
        return $product_list->num_rows();
    }

    function get_active_products_detail($check = '')
    {
        $productID_array = array(1 => 0, 2 => 0, 3 => 0, 4 => 0);
        $productQty_array = array(1 => 0, 2 => 0, 3 => 0, 4 => 0);
        $query = "SELECT * FROM product_list WHERE is_active = TRUE";
        $product_list = $this->adminCrud->query_db('product_list', $query);
        foreach ($product_list->result() as $row)
        {
            echo $id;
            echo $title;
            echo $qty;
            echo $price;
            echo $owned_by;
        }
        /* $check variable used as filter for controller actions */
        // count products not owned by a user
        if ($check == 'no_user')
        {
            $sum = 0;
            foreach ($product_list->result() as $row)
            {
                if (!$owned_by){
                    $sum++;
                }
            }
            return $sum;
        } else if ($check == 'count_active_products')
        {
            // count quantities of each active product
            $active_prod = 0;
            foreach ($product_list->result() as $row)
            {
                $active_prod++;
            }
            return $active_prod;
        } else if ($check == 'sum_price_attached_products')
        {
            // summarized price of attached products
            $sum_products = 0;
            foreach ($product_list->result() as $row)
            {
                $factor = $price * $qty;
                $sum_products = $sum_products + $factor;
            }
            return $sum_products;
        } else if ($check == 'count_products_per_active_user')
        {
            // count active products per user
            $array = array();
            foreach ($product_list->result() as $row)
            {
                if (array_key_exists($owned_by, $array))
                {
                    $array[$owned_by] = $array[$owned_by] + $price; 
                } else 
                {
                    $array[$owned_by] = $price;
                }
                foreach ($array as $key => $value)
                {
                    echo "$key: $value /n";
                }
            }
        }
    }

    function get_exchange_rates()
    {
        $endpoint = 'latest';
        $access_key = 'API_KEY';
        $ch = curl_init('https://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $exchangeRates = json_decode($json, true);

        echo $exchangeRates['rates']['USD'];
        echo $exchangeRates['rates']['RON'];
    }
}