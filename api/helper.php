<?php
Class helper{
	/* Database connection start */
	function sendResponse($statusCode, $data, $statusMassage) {
		$response = array(
				'status' => $statusCode,
				'statusMessage' => $statusMassage ? $statusMassage : '',
				'data' => $data ? $data : '[]',
		);
		foreach($response as $key=>$value){
			if(is_null($value) || $value == '[]' || $value == '')
				unset($response[$key]);
		}
		return $response;
	}
}