<?php

abstract class Conekta_Util
{
  public static function isList($array)
  {
    if (!is_array($array))
      return false;
    // TODO: this isn't actually correct in general, but it's correct given Conekta's responses
    foreach (array_keys($array) as $k) {
      if (!is_numeric($k))
        return false;
    }
    return true;
  }

  public static function convertConektaObjectToArray($values)
  {
    $results = array();
    foreach ($values as $k => $v) {
      // FIXME: this is an encapsulation violation
      if ($k[0] == '_') {
        continue;
      }
      if ($v instanceof Conekta_Object) {
        $results[$k] = $v->__toArray(true);
      }
      else if (is_array($v)) {
        $results[$k] = self::convertConektaObjectToArray($v);
      }
      else {
        $results[$k] = $v;
      }
    }
    return $results;
  }

  public static function convertToConektaObject($resp, $apiKey)
  {
    $types = array(
      'card' => 'Conekta_Card',
      'charge' => 'Conekta_Charge',
      'customer' => 'Conekta_Customer',
      'list' => 'Conekta_List',
      'invoice' => 'Conekta_Invoice',
      'invoiceitem' => 'Conekta_InvoiceItem',
      'event' => 'Conekta_Event',
      'transfer' => 'Conekta_Transfer',
      'plan' => 'Conekta_Plan',
      'recipient' => 'Conekta_Recipient'
    );
    //if (self::isList($resp)) {
      //$mapped = array();
      //foreach ($resp as $i)
        //array_push($mapped, self::convertToConektaObject($i, $apiKey));
      //return $mapped;
    //} else 
    if (is_array($resp)) {
      if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']]))
        $class = $types[$resp['object']];
      else
        $class = 'Conekta_Object';
      return Conekta_Object::scopedConstructFrom($class, $resp, $apiKey);
    } else {
      return $resp;
    }
  }
}
