<?php
	// payload encryption and service calling function
	class XapoUtil {
		// payload encryption method
  	static public function encrypt($value, $key) {
    	if (!empty($value)) {
      	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $value, 'ecb'));
    	} else {
      	return '';
    	}
  	}

  	// REST API call method
  	static function callAPI($method, $url, $data = false) {
  		$curl = curl_init();

  		switch ($method) {
    		case "POST":
      		curl_setopt($curl, CURLOPT_POST, true);

      		if ($data)
          	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      		break;
    		case "PUT":
        		curl_setopt($curl, CURLOPT_PUT, true);
        		break;
    		default:
        	if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
  		}

  		curl_setopt($curl, CURLOPT_URL, $url);
  		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  		$result = curl_exec($curl);

  		if ($result === false) {
  			$info = curl_getinfo($curl);
  			curl_close($curl);
  			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		  }

  		curl_close($curl);

  		return $result;
		}
  }
?>