<?php

abstract class Conekta
{
  public static $apiKey;
  public static $apiBase = 'https://api.conekta.io';
  public static $apiVersion = '0.2.0';
  public static $verifySslCerts = true;
  const VERSION = '1.8.3';

  public static function getApiKey()
  {
    return self::$apiKey;
  }

  public static function setApiKey($apiKey)
  {
    self::$apiKey = $apiKey;
  }

  public static function getApiVersion()
  {
    return self::$apiVersion;
  }

  public static function setApiVersion($apiVersion)
  {
    self::$apiVersion = $apiVersion;
  }

  public static function getVerifySslCerts() {
    return self::$verifySslCerts;
  }

  public static function setVerifySslCerts($verify) {
    self::$verifySslCerts = $verify;
  }
}
