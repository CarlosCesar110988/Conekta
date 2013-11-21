<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Conekta needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Conekta needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Conekta needs the Multibyte String PHP extension.');
}

// Conekta singleton
require(dirname(__FILE__) . '/Conekta/Conekta.php');

// Utilities
require(dirname(__FILE__) . '/Conekta/Util.php');
require(dirname(__FILE__) . '/Conekta/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/Conekta/Error.php');
require(dirname(__FILE__) . '/Conekta/ApiError.php');
require(dirname(__FILE__) . '/Conekta/ApiConnectionError.php');
require(dirname(__FILE__) . '/Conekta/AuthenticationError.php');
require(dirname(__FILE__) . '/Conekta/CardError.php');
require(dirname(__FILE__) . '/Conekta/InvalidRequestError.php');

// Plumbing
require(dirname(__FILE__) . '/Conekta/Object.php');
require(dirname(__FILE__) . '/Conekta/ApiRequestor.php');
require(dirname(__FILE__) . '/Conekta/ApiResource.php');
require(dirname(__FILE__) . '/Conekta/SingletonApiResource.php');
require(dirname(__FILE__) . '/Conekta/List.php');

// Conekta API Resources
require(dirname(__FILE__) . '/Conekta/Account.php');
require(dirname(__FILE__) . '/Conekta/Card.php');
require(dirname(__FILE__) . '/Conekta/Balance.php');
require(dirname(__FILE__) . '/Conekta/BalanceTransaction.php');
require(dirname(__FILE__) . '/Conekta/Charge.php');
require(dirname(__FILE__) . '/Conekta/Customer.php');
require(dirname(__FILE__) . '/Conekta/Invoice.php');
require(dirname(__FILE__) . '/Conekta/InvoiceItem.php');
require(dirname(__FILE__) . '/Conekta/Plan.php');
require(dirname(__FILE__) . '/Conekta/Token.php');
require(dirname(__FILE__) . '/Conekta/Coupon.php');
require(dirname(__FILE__) . '/Conekta/Event.php');
require(dirname(__FILE__) . '/Conekta/Transfer.php');
require(dirname(__FILE__) . '/Conekta/Recipient.php');
