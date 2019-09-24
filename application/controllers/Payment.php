<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct() {
				parent::__construct();
				$this->data['status'] = "";
				$this->data['menu'] ="";
        $this->load->model('payment_model');
    }

	public function index()
	{

		$this->load->view('layout/header');
		$this->load->view('payment/product_form',$this->data);		
	}

	public function check()
	{
		//check whether stripe token is not empty
		if(!empty($_POST['stripeToken']))
		{
			//get token, card and user info from the form
			$token  = $_POST['stripeToken'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$card_num = $_POST['card_num'];
			$card_cvc = $_POST['cvc'];
			$card_exp_month = $_POST['exp_month'];
			$card_exp_year = $_POST['exp_year'];
			
			//include Stripe PHP library
			require_once APPPATH."third_party/stripe/init.php";
			
			//set api key
			$stripe = array(
			  "secret_key"      => "",
			  "publishable_key" => ""
			);
			
			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			
			//add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			
			//item information
			$itemName = "Stripe Donation";
			$itemNumber = "PS123456";
			$itemPrice = 50;
			$currency = "usd";
			$orderID = "SKA92712382139";
			
			//charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $itemPrice,
				'currency' => $currency,
				'description' => $itemNumber,
				'metadata' => array(
					'item_id' => $itemNumber
				)
			));
			
			//retrieve charge details
			$chargeJson = $charge->jsonSerialize();

			//check whether the charge is successful
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
			{
				//order details 
				$amount = $chargeJson['amount'];
				$balance_transaction = $chargeJson['balance_transaction'];
				$currency = $chargeJson['currency'];
				$status = $chargeJson['status'];
				$date = date("Y-m-d H:i:s");
			
				
				//insert tansaction data into the database
				$dataDB = array(
					'name' => $name,
					'email' => $email, 
					'card_num' => $card_num, 
					'card_cvc' => $card_cvc, 
					'card_exp_month' => $card_exp_month, 
					'card_exp_year' => $card_exp_year, 
					'item_name' => $itemName, 
					'item_number' => $itemNumber, 
					'item_price' => $itemPrice, 
					'item_price_currency' => $currency, 
					'paid_amount' => $amount, 
					'paid_amount_currency' => $currency, 
					'txn_id' => $balance_transaction, 
					'payment_status' => $status,
					'created' => $date,
					'modified' => $date
				);

				if ($this->payment_model->pay('orders', $dataDB)) {
					if( $status == 'succeeded'){
						//$this->db->insert_id() && inside if statement
						//$data['insertID'] = $this->db->insert_id();
						$this->data['status'] = $status;
						$this->payment_success();
					}else{
						$this->data['status'] = "Transaction has been failed";
						$this->payment_error();

					}
				}
				else
				{
					$this->data['status'] = "not inserted. Transaction has been failed";
					$this->payment_error();
				}

			}
			else
			{
				$this->data['status'] = "Invalid Token";
				$statusMsg = "";
				$this->payment_error();
			}
		}
	}

	public function payment_success()
	{
		$this->load->view('layout/header');
		$this->load->view('payment/payment_success', $this->data);
	}

	public function payment_error()
	{
		$this->load->view('layout/header');
		$this->load->view('payment/payment_error', $this->data);
	}

	public function loadPage()
	{
		$name = $this->input->get('name');
		$details = $this->input->get('details');
		$category = $this->input->get('category');
		$price = $this->input->get('price');
		$filename = $this->input->get('filename');
		$menu= array(
			'name' => $name,
			'details' => $details,
			'price'=> $price,
			'filename'=>$filename
		);
		$this->data['menu'] = $menu;
		$this->index();
	}
}
