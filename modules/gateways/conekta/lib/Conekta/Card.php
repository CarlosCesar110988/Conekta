<?php

class Conekta_Card extends Conekta_ApiResource
{
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public function instanceUrl()
  {
    $id = $this['id'];
    $customer = $this['customer'];
    $class = get_class($this);
    if (!$id) {
      throw new Conekta_InvalidRequestError("Could not determine which URL to request: $class instance has invalid ID: $id", null);
    }
    $id = Conekta_ApiRequestor::utf8($id);
    $customer = Conekta_ApiRequestor::utf8($customer);

    $base = self::classUrl('Conekta_Customer');
    $customerExtn = urlencode($customer);
    $extn = urlencode($id);
    return "$base/$customerExtn/cards/$extn";
  }

  public function delete($params=null)
  {
    $class = get_class();
    return self::_scopedDelete($class, $params);
  }

  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }
}