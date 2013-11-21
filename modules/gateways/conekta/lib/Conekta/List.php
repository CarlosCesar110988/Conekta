<?php

class Conekta_List extends Conekta_Object
{
  public static function constructFrom($values, $apiKey=null)
  {
    $class = get_class();
    return self::scopedConstructFrom($class, $values, $apiKey);
  }

  public function all($params=null)
  {
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    list($response, $apiKey) = $requestor->request('get', $this['url'], $params);
    return Conekta_Util::convertToConektaObject($response, $apiKey);
  }

  public function create($params=null)
  {
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    list($response, $apiKey) = $requestor->request('post', $this['url'], $params);
    return Conekta_Util::convertToConektaObject($response, $apiKey);
  }

  public function retrieve($id, $params=null)
  {
    $requestor = new Conekta_ApiRequestor($this->_apiKey);
    $base = $this['url'];
    $id = Conekta_ApiRequestor::utf8($id);
    $extn = urlencode($id);
    list($response, $apiKey) = $requestor->request('get', "$base/$extn", $params);
    return Conekta_Util::convertToConektaObject($response, $apiKey);
  }

}
