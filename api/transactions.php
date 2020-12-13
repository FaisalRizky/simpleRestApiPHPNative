<?php
// Connect to database
include("../connection.php");
include("helper.php");
$faker = Faker\Factory::create();
$db = new dbObj();
$helper = new helper();
$connection =  $db->getConnstring();
$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method){
		case 'GET':
			// Retrive Payment Detail
			if(!empty($_GET["references_id"]) && !empty($_GET["merchant_id"])){
				$references_id=intval($_GET["references_id"]);
				$merchant_id=intval($_GET["merchant_id"]);
				getPaymentDetail($references_id, $merchant_id);
			} else {
				$response = $helper->sendResponse(0,null, 'Parameters references_id and merchant_id is empty');
				echo json_encode($response);
			}
			break;
		case 'POST':
			// Insert payment Detail
			createPaymentDetail();
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
}


function getPaymentDetail($references_id=0, $merchant_id=0){
	global $connection;
	global $helper;
	$query ="SELECT references_id, invoice_id, status FROM transactions_detail where references_id ='".$references_id."'AND merchant_id = '".$merchant_id."'";
	$result =mysqli_query($connection, $query);
	$data = [];
	while($row=mysqli_fetch_object($result)){
		$data[]=$row;
	}
	if(count($data) <= 0){
		$response = $helper->sendResponse(1, null, "No Records Found");
	} else {			
		$response = $helper->sendResponse(1, $data, "Success Get Data Transaction");
	}
	
	header('Content-Type: application/json');
	echo json_encode($response);
}

function createPaymentDetail(){
		global $connection;
		global $helper;
		global $faker;
			
		$data = json_decode(file_get_contents('php://input'), true);
		$invoice_id=$data["invoice_id"];
		$item_name=$data["item_name"];
		$amount=$data["amount"];
		$payment_type=$data["payment_type"];
		$customer_name=$data["customer_name"];
		$merchant_id=$data["merchant_id"];
		$paymentType = ["virtual account", "credit card"];
		$response = [];
		if(!empty($invoice_id) &&
		   !empty($item_name) &&
		   !empty($amount) && is_numeric($amount) &&
		   !empty($payment_type) && in_array(strtolower($payment_type), $paymentType) &&
		   !empty($customer_name) &&
		   !empty($merchant_id)
		  ) {
			  $date = date('Y-m-d H:i:s');
			  $references_id = $faker->ean13;
			  $number_va = $payment_type == "Virtual Account" ? $faker->numerify('###-##########') : null;
			  $query="INSERT INTO transactions_detail SET 
						  item_name='". $item_name."',
						  invoice_id='". $invoice_id."',
						  amount='". $amount."',
						  payment_type ='".$payment_type."',
						  customer_name ='".$customer_name."', 
						  number_va ='". $number_va."',
						  merchant_id ='".$merchant_id."',
						  status = 'pending',
						  created_at='".$date."',
						  updated_at='".$date."',
						  references_id ='".$references_id."'";
			  if(mysqli_query($connection, $query)){
				$response=array(
					'status' => 1,
					'status_message' =>'Transaction Created Successfully.');
			  }
			  else {
				 $response=array(
					'status' => 0,
					'status_message' =>'Transaction Creation Failed.'
				);
			  }
		  } else { 
				$response = $helper->sendResponse(1, null, "Please Verify your Data");
		  }
		header('Content-Type: application/json');
		echo json_encode($response);
}