<?php

// Desarrollo por Carlos Cesar Peña Gomez
// CarlosCesar110988@gmail.com
// twitter @carlirox


function conekta_config() {
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"Conekta Visa/MasterCard"),
     "private_key" => array("FriendlyName" => "Llave Privada", "Type" => "text", "Size" => “50”, ),
     "instructions" => array("FriendlyName" => "Instrucciones de pago", "Type" => "textarea", "Rows" => "5", "Description" => "", ),
    );
	return $configarray;
}

function conekta_capture($params) {

    # Gateway Specific Variables
	$public_key = $params['public_key'];
	$private_key = $params['private_key'];

    # Invoice Variables
	$invoiceid = $params['invoiceid'];
	$amount = $params['amount']; # Format: ##.##
    $currency = $params['currency']; # Currency Code

    # Client Variables
	$firstname = $params['clientdetails']['firstname'];
	$lastname = $params['clientdetails']['lastname'];
	$email = $params['clientdetails']['email'];
	$address1 = $params['clientdetails']['address1'];
	$address2 = $params['clientdetails']['address2'];
	$city = $params['clientdetails']['city'];
	$state = $params['clientdetails']['state'];
	$postcode = $params['clientdetails']['postcode'];
	$country = $params['clientdetails']['country'];
	$phone = $params['clientdetails']['phonenumber'];

	# Card Details
	$cardtype = $params['cardtype'];
	$cardnumber = $params['cardnum'];
	$cardexpiry = $params['cardexp']; # Format: MMYY
	$cardstart = $params['cardstart']; # Format: MMYY
	$cardissuenum = $params['cccvv'];
	
	
	$results = array();
	
	// Preparamos todos los parametros para enviar a Conekta.io
	
	$card_num 			= $cardnumber;
	$card_cvv			= $cardissuenum;
	$card_exp_month		= substr($cardexpiry, 0, 2);
	$card_exp_year		= substr($cardexpiry, 2, 4);
	$card_name			= $firstname.' '.$lastname;
	
	$data_amount		= str_replace('.', '', $amount);
	$data_currency		= strtolower($currency);
	$data_description	= 'Pago Factura No. '.$invoiceid;
	
	// Procesamos solicitud
	
	require_once('conekta/lib/Conekta.php');
	
	Conekta::setApiKey($private_key);
	
	$card = array(
						'number' 		=> $card_num, 
						'exp_month' 	=> intval($card_exp_month), 
						'exp_year' 		=> intval('20'.$card_exp_year), 
						'cvc' 			=> intval($card_cvv), 
						'name' 			=> $card_name
					);
	try {
	
	$conekta = array(
	  					'card' 			=> $card, 
	  					'description' 	=> $data_description, 
	  					'amount' 		=> intval($data_amount), 
	  					'currency'		=> $data_currency
	  				);
	
	  $charge = Conekta_Charge::create($conekta);
	  
	  // Cargo Correcto
	  $data 				= json_decode($charge);;
	  $results["status"] 	= "success";
	  $results["transid"] 	= $data->payment_method->auth_code;
	  $results['data'] 		= 'OK';

	} 
	
	
	catch (Exception $e) 
	{
	  // Ocurrio un error
	  $results["status"] 	= "declined";
	  $results["transid"] 	= $data->payment_method->auth_code;
	  $results['data'] 		= $e->getMessage().'-->'.json_encode($conekta);
	}

	
	# Return Results
	if ($results["status"]=="success") {
		return array("status"=>"success","transid"=>$results["transid"],"rawdata"=>'OK');
	} elseif ($gatewayresult=="declined") {
        return array("status"=>"declined","rawdata"=>$results);
    } else {
		return array("status"=>"error","rawdata"=>$results);
	}

}

?>