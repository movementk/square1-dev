<?php
include_once('recaptcha_api.php');

// 캡챠 HTML 코드 출력
function captcha_html($class="captcha")
{
	//$html .= "\n".'<script src="/board/config/recaptcha/recaptcha.js"></script>';
	$html .= "\n".'<fieldset id="captcha" class="'.$class.'" style="display:none;">';
	$html .= "\n".'<legend><label for="captcha_key">자동등록방지</label></legend>';
	$html .= "\n".'<button type="button" id="captcha_reload"><span></span>새로고침</button>';
	$html .= "\n".'</fieldset>';
	$html .= "\n\n";
	return $html;
}

// 자바스크립트에서 캡챠를 검사함
function chk_captcha_js()
{
	return "if (!chk_captcha()) return;\n";
}

// $_POST 로 넘어온 캡챠값을 체크
function chk_captcha()
{
	global $recaptcha_secret_key;

	if (!isset($_POST['g-recaptcha-response'])) return false;
	if (!trim($_POST['g-recaptcha-response'])) return false;
	if ($_POST['g-recaptcha-response'] == "") {
		return false;
	}

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array('secret' => $recaptcha_secret_key, 'response' => $_POST['g-recaptcha-response']);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, sizeof($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	$obj = json_decode($result);

	if ( $obj->success != "1" ) { return false; }

	return true;
}
?>