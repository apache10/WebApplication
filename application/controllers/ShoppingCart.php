<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingCart extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->library('cart');
            $this->loadCart();
    }

	public function index()
	{
        $this->load->view('layout/header');
        $this->load->view('cart');
        
    }
        
       
    public function loadCart()
    {
        $data = array(
            'id'      => 'sku_123ABC',
            'qty'     => 1,
            'price'   => 39.95,
            'name'    => 'T-Shirt',
            'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $this->cart->insert($data);

        $data = array(
            array(
                    'id'      => 'sku_123ABC',
                    'qty'     => 1,
                    'price'   => 39.95,
                    'name'    => 'T-Shirt',
                    'options' => array('Size' => 'L', 'Color' => 'Red')
            ),
            array(
                    'id'      => 'sku_567ZYX',
                    'qty'     => 1,
                    'price'   => 9.95,
                    'name'    => 'Coffee Mug'
            ),
            array(
                    'id'      => 'sku_965QRS',
                    'qty'     => 1,
                    'price'   => 29.95,
                    'name'    => 'Shot Glass'
            )
    );
    
    $this->cart->insert($data);
    }

    public function updateCart()
    {

        $data = array(
            array(
                    'rowid'   => 'b99ccdf16028f015540f341130b6d8ec',
                    'qty'     => 3
            ),
            array(
                    'rowid'   => 'xw82g9q3r495893iajdh473990rikw23',
                    'qty'     => 4
            ),
            array(
                    'rowid'   => 'fh4kdkkkaoe30njgoe92rkdkkobec333',
                    'qty'     => 2
            )
        );

        $this->cart->update($data);
    }
}