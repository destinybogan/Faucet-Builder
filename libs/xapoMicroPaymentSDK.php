<?php
    
  class XapoMicroPaymentSDK
  {
    
    static $serviceUrl;
    static $appID;
    static $appSecret;
   
    static public function setEnvironmentUrl($url)
    {
      XapoMicroPaymentSDK::$serviceUrl = $url;
    }
  
    static public function setApplication($appID, $secret)
    {
      XapoMicroPaymentSDK::$appID = $appID;
      XapoMicroPaymentSDK::$appSecret = $secret;
    }
    
    static private function encrypt($data)
    {
      //pkcs7 padding
      $block = 16;
      $pad = $block - (strlen($data) % $block);
      $data .= str_repeat(chr($pad), $pad);
      
      $key = XapoMicroPaymentSDK::$appSecret;
      
      $enc = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, 'ecb'));
      
      return $enc;
    }
    
    static private function buildWidgetUrl($buttonRequest, $customization = null)
    {
      $buttonRequest->timestamp = time() * 1000;
      $buttonRequestJson = json_encode($buttonRequest);

      if(!isset($customization)){
        $customization = new stdClass();
      }

      $customizationJson = json_encode($customization);
      
      $queryStrObj = new stdClass;      
      if(isset(XapoMicroPaymentSDK::$appID) && isset(XapoMicroPaymentSDK::$appSecret)){
        $buttonRequestEnc = XapoMicroPaymentSDK::encrypt($buttonRequestJson);
        $queryStrObj->app_id = XapoMicroPaymentSDK::$appID;
        $queryStrObj->button_request = $buttonRequestEnc;
      }else{
        $queryStrObj->payload = $buttonRequestJson;
      }
      $queryStrObj->customization = $customizationJson;      

      $queryStr = http_build_query($queryStrObj);
      
      $widgetUrl = XapoMicroPaymentSDK::$serviceUrl.'?'.$queryStr;
      return $widgetUrl;      
    }
    
    static public function buildIframeWidget($buttonRequest, $customization = null)
    {
      $widgetUrl = XapoMicroPaymentSDK::buildWidgetUrl($buttonRequest, $customization);
      $res = '<iframe id="tipButtonFrame" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:22px;" allowTransparency="true" src="'.$widgetUrl.'"></iframe>';
      return $res;
    }
    
    //mandatory fields: sender_user_id, receiver_user_id, receiver_user_email, pay_object_id
    //pay_type possible values: pay, tip, deposit, donation
    //button_css possible values: red, grey
    //redirect_uri callback to be invoked by http get with the following query parameters: id, reference_code
    //end_mpayment_redirect_uri callback by redirect at the end of the flow
    static public function iframeWidget($sender_user_id, $sender_user_email, $sender_user_cellphone, $receiver_user_id, $receiver_user_email, $pay_object_id, 
          $amount_BIT, $pay_type, $reference_code, $end_mpayment_uri, $end_mpayment_redirect_uri, $redirect_uri, $predefined_pay_values, $button_css, $login_cellphone_header_title)
    {
      $buttonRequest = new stdClass();
      $buttonRequest->sender_user_id = $sender_user_id;
      $buttonRequest->sender_user_email = $sender_user_email;
      $buttonRequest->sender_user_cellphone = $sender_user_cellphone;
      $buttonRequest->receiver_user_id = $receiver_user_id;
      $buttonRequest->receiver_user_email = $receiver_user_email;
      $buttonRequest->pay_object_id = $pay_object_id;
      $buttonRequest->amount_BIT = $amount_BIT;
      $buttonRequest->pay_type = $pay_type; 
      $buttonRequest->reference_code = $reference_code; 
      $buttonRequest->end_mpayment_uri = $end_mpayment_uri; 
      $buttonRequest->end_mpayment_redirect_uri = $end_mpayment_redirect_uri; 
      $buttonRequest->redirect_uri = $redirect_uri; 
      
      $customization = new stdClass();
      $customization->predefined_pay_values = $predefined_pay_values; 
      $customization->button_css = $button_css;     
      $customization->login_cellphone_header_title = $login_cellphone_header_title;     
      
      $res = XapoMicroPaymentSDK::buildIframeWidget($buttonRequest, $customization);
      return $res;
    }    
    
  }

?>