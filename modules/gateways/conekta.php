<?php

// Copyright (c) 2013, Carlos Cesar Peña Gomez <CarlosCesar110988@gmail.com>
//
// Permission to use, copy, modify, and/or distribute this software for any 
// purpose with or without fee is hereby granted, provided that the above copyright 
// notice and this permission notice appear in all copies.

// THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL 
// WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED 
// WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL 
// THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL 
// DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA 
// OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR 
// OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE 
// USE OR PERFORMANCE OF THIS SOFTWARE.


function conekta_config() {
    $configarray = array(
     						'FriendlyName' 	=> array(
     													'Type' 			=>'System', 
     													'Value'			=>'Conekta Visa/MasterCard'
     												),
	 						'private_key' 	=> array(
	 													'FriendlyName' 	=> 'Llave Privada', 
	 													'Type' 			=> 'text', 
	 													'Size' 			=> '50'
	 												),
	 						'instructions' 	=> array(
	 													'FriendlyName' 	=> 'Instrucciones de pago', 
	 													'Type' 			=> 'textarea', 
	 													'Rows' 			=> '5', 
	 													'Description' 	=> ''
	 												)
    );
	return $configarray;
}

function conekta_capture($params) {

    # Variables de Conekta
	$private_key 	= $params['private_key'];

    # Variables de la Factura
	$invoiceid 		= $params['invoiceid'];
	$amount 		= $params['amount']; # Format: ##.##
    $currency 		= $params['currency']; # Currency Code

    # Variables del cliente
	$firstname 		= $params['clientdetails']['firstname'];
	$lastname 		= $params['clientdetails']['lastname'];
	$email 			= $params['clientdetails']['email'];
	$address1 		= $params['clientdetails']['address1'];
	$address2 		= $params['clientdetails']['address2'];
	$city 			= $params['clientdetails']['city'];
	$state 			= $params['clientdetails']['state'];
	$postcode 		= $params['clientdetails']['postcode'];
	$country 		= $params['clientdetails']['country'];
	$phone 			= $params['clientdetails']['phonenumber'];

	# Informacion de la Tarjeta
	$cardtype 		= $params['cardtype'];
	$cardnumber 	= $params['cardnum'];
	$cardexpiry 	= $params['cardexp']; # Format: MMYY
	$cardstart 		= $params['cardstart']; # Format: MMYY
	$cardissuenum 	= $params['cccvv'];
	
	$results = array();
	
	# Preparamos todos los parametros para enviar a Conekta.io
	
	$card_num 			= $cardnumber;
	$card_cvv			= $cardissuenum;
	$card_exp_month		= substr($cardexpiry, 0, 2);
	$card_exp_year		= substr($cardexpiry, 2, 4);
	$card_name			= $firstname.' '.$lastname;
	
	$data_amount		= str_replace('.', '', $amount);
	$data_currency		= strtolower($currency);
	$data_description	= 'Pago Factura No. '.$invoiceid;
	
	# Incluimos la libreria de Conecta
	
	require_once('conekta/lib/Conekta.php');
	
	# Creamos el Objeto de Cargo
	
	Conekta::setApiKey($private_key);
	
	# Arraglo con informacion de tarjeta
	$card = array(
						'number' 		=> $card_num, 
						'exp_month' 	=> intval($card_exp_month), 
						'exp_year' 		=> intval('20'.$card_exp_year), 
						'cvc' 			=> intval($card_cvv), 
						'name' 			=> $card_name
				);
	try {
	
	# Arraglo con informacion del cargo
	$conekta = array(
	  					'card' 			=> $card, 
	  					'description' 	=> $data_description, 
	  					'amount' 		=> intval($data_amount), 
	  					'currency'		=> $data_currency
	  			);
	
	  $charge = Conekta_Charge::create($conekta);
	  
	  // Transaccion Correcta
	  $data 				= json_decode($charge);;
	  $results["status"] 	= "success";
	  $results["transid"] 	= $data->payment_method->auth_code;
	  $results['data'] 		= 'OK';

	} 
	
	
	catch (Exception $e) 
	{
	  // Transaccion Declinada
	  $results["status"] 	= "declined";
	  $results["transid"] 	= $data->payment_method->auth_code;
	  $results['data'] 		= $e->getMessage();
	}

	
	# Validamos los resultados
	if ($results["status"]=="success") {
		return array("status"=>"success","transid"=>$results["transid"],"rawdata"=>'OK');
	} elseif ($gatewayresult=="declined") {
        return array("status"=>"declined","rawdata"=>$results);
    } else {
		return array("status"=>"error","rawdata"=>$results);
	}

}

?>