<?php
// Connect to database
include("connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();
$paymentStatus = ["pending", "paid", "failed"];
if(isset($argv[1]) && 
   isset($argv[2]) && in_array(strtolower($argv[2]), $paymentStatus)) {
	$references_id = $argv[1];
	$status = $argv[2];
	updateTransactionDetailStatus($references_id, $status);
} else {
	$paymentStatus = json_encode($paymentStatus);
	echo "Please Check your Data, Status only accept $paymentStatus";
}

function updateTransactionDetailStatus($references_id, $status){
	global $connection;
	$date = date('Y-m-d H:i:s');
	$query ="UPDATE transactions_detail SET updated_at='".$date."',status ='".$status."' where references_id ='".$references_id."'";
	$result =mysqli_query($connection, $query);
	if($result) {
		echo "Success update status $status for data with references id = $references_id";
	} else {
		echo "No Transaction with references id = $references_id";
	}
}

?>