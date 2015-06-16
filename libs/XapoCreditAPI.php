<?php
    require 'XapoUtil.php';

    // Xapo Credit API
    class XapoCreditAPI {
      public $appID;
      public $appSecret;
      public $serviceUrl;

      function __construct($serviceUrl, $appID, $appSecret) {
        $this->serviceUrl = $serviceUrl;
        $this->appID = $appID;
        $this->appSecret = $appSecret;
        $this->resource = "/credit/";
      }

      public function credit($to, $currency, $unique_request_id, $amount, $comments) {

        // build the payload
        $payload = new stdClass;
        $payload->to = $to;
        $payload->currency = $currency;
        $payload->amount = $amount;
        $payload->comments = $comments;
        $payload->timestamp = time();

        $payload->unique_request_id = $unique_request_id;

        // convert to json and encrypt

        $json = json_encode($payload);
        $hash = XapoUtil::encrypt($json, $this->appSecret);
        $payload = array("appID" => $this->appID, "hash" => $hash);

        // call de API

        $result = XapoUtil::callAPI("POST", $this->serviceUrl . $this->resource, $payload);
        return json_decode($result);
      }
    }
?>
