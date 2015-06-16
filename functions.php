<?php

require 'libs/XapoCreditAPI.php';

function get_main_url($omitHost = false)
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === '443') ? 'https://' : 'http://';
    if ($omitHost) {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    return $protocol . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
}


function get_ip()
{
    if (!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        echo 'Invalid IP.<br /><a href="' . htmlspecialchars(get_main_url()) . '">Main page</a>';
        exit;
    }

    if ($GLOBALS['settings']['behind_proxy']) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ipList                          = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $_SERVER['HTTP_X_FORWARDED_FOR'] = array_pop($ipList);
        } else {
            $_SERVER['HTTP_X_FORWARDED_FOR'] = false;
        }

        if (filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $query = "insert into sarlanga_settings (name, value) values('behind_proxy', '0') on duplicate key update value = values(value)";
            mysqli_query($GLOBALS['db'], $query);
            $GLOBALS['settings']['behind_proxy'] = '0';

            return $_SERVER['REMOTE_ADDR'];
        }
    }

    return $_SERVER['REMOTE_ADDR'];
}


function get_rewards($rewards = null)
{
    if (is_null($rewards)) {
        $rewards = $GLOBALS['settings']['rewards'];
    }
    $rewards         = explode(',', $rewards);
    $rewardList      = array();
    $totalMultiplier = 0;
    foreach ($rewards as $reward) {
        @list($reward, $multiplier) = explode('*', $reward);
        $reward     = (int) trim(abs($reward));
        $multiplier = (int) trim(abs($multiplier));
        if (!$multiplier)
            $multiplier = 1;
        if (!$reward)
            continue;
        if (!isset($rewardList[$reward])) {
            $rewardList[$reward] = 0;
        }
        $rewardList[$reward] += $multiplier;
        $totalMultiplier += $multiplier;
    }
    krsort($rewardList);
    $result['reward_list']      = array();
    $result['reward_list_html'] = '';
    $result['full_reward_list'] = array();
    $totalAmount                = 0;
    foreach ($rewardList as $reward => $multiplier) {
        $odds = round($totalMultiplier / $multiplier);
        if ($odds > 10000) {
            $percentage = '<0.01%';
        } else {
            $percentage = rtrim(rtrim(number_format($multiplier / $totalMultiplier * 100, 2), '0'), '.') . '%';
        }
        $result['reward_list'][] = array(
            'reward' => $reward,
            'percentage' => $percentage,
            'odds' => '1:' . $odds
        );
        $result['reward_list_html'] .= htmlspecialchars($reward) ." " ;
        $result['full_reward_list'] = array_merge($result['full_reward_list'], array_fill(0, $multiplier, $reward));
        $totalAmount += $reward;
    }
    //$result['reward_list_html'] = . $result['reward_list_html'];

    if (!$result['reward_list']) {
        return false;
    }

    $result['random_reward']  = $result['full_reward_list'][mt_rand(0, count($result['full_reward_list']) - 1)];
    $result['average_reward'] = (int) ($totalAmount / $totalMultiplier);

    return $result;
}

function format_timer($totalSeconds)
{
    $totalSeconds = (int) abs($totalSeconds);
    $hours        = (int) floor($totalSeconds / 3600);
    $minutes      = (int) floor(($totalSeconds - ($hours * 3600)) / 60);
    $seconds      = $totalSeconds % 60;

    $result = '';
    if ($hours === 1) {
        $result .= '1 hour';
    } elseif ($hours > 1) {
        $result .= $hours . ' hours';
    }
    if ($hours && $minutes) {
        $result .= ', ';
    }
    if ($minutes === 1) {
        $result .= '1 min';
    } elseif ($minutes > 1) {
        $result .= $minutes . ' mins';
    }
    if (($hours || $minutes) && $seconds) {
        $result .= ', ';
    }
    if ($seconds === 1) {
        $result .= '1 sec';
    } elseif ($seconds > 1) {
        $result .= $seconds . ' secs';
    }

    return $result;
}

function fix_magic_quotes()
{
    if (get_magic_quotes_gpc()) {
        $process = array(
            &$_GET,
            &$_POST,
            &$_COOKIE,
            &$_REQUEST
        );
        while (list($key, $val) = each($process)) {
            foreach ($val as $k => $v) {
                unset($process[$key][$k]);
                if (is_array($v)) {
                    $process[$key][stripslashes($k)] = $v;
                    $process[] =& $process[$key][stripslashes($k)];
                } else {
                    $process[$key][stripslashes($k)] = stripslashes($v);
                }
            }
        }
        unset($process);
    }
}



function pay($to, $amount, $comment)
{
    $settings = $GLOBALS["settings"];
    $myHashKey = $GLOBALS["hashKey"];
    $serviceUrl = "https://api.xapo.com/v1";
    $xapo_app_id = trim(decryption($myHashKey,$settings['xapo_app_id']));
    $xapo_secret_key = trim(decryption($myHashKey,$settings['xapo_secret_key']));
    $creditAPI = new XapoCreditAPI($serviceUrl, $xapo_app_id, $xapo_secret_key);
    $currency = "SAT"; // SAT | BTC
    $unique_request_id = uniqid();
    $ret = $creditAPI->credit($to, $currency, $unique_request_id, $amount, $comments);
    return $ret;
}

function encryption($key,$data){
  return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, 'ecb'));
}

function decryption($key,$data){
  return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($data), 'ecb');
}

function validHash($myHashKey){
  //A-Z,a-z,0-9, 32 char
  return preg_match("/^[A-Z0-9_]*[A-Z0-9][A-Z0-9]{31}$/i",$myHashKey);
}

?>
