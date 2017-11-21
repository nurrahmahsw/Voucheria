<?php
	$curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://tugas-sit.komsi.ga/voucher/public/api/list/vendor",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 300,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(),
	));
 
	$response = curl_exec($curl);
	$err = curl_error($curl);
 
	curl_close($curl);
 
    $data = json_decode($response);
    // echo $data->status;
    // echo $data->result;


//LIST VENDOR DAN PRODUCT
    $curl = curl_init();	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://tugas-sit.komsi.ga/voucher/public/api/list/vendor",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 300,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(),
	));
 
	$response = curl_exec($curl);
	$err = curl_error($curl);
 
	curl_close($curl);
 
    $data = json_decode($response);

//custom Vendor

//ambil product 1

?>