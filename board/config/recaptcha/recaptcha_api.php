<?php
//	google reCAPTCHA 는 캡차 코드가 사용되는 도메인을 등록해야 사용할 수 있습니다.
//	웹사이트 도메인 등록하는 곳 : https://www.google.com/recaptcha/admin
//	캡챠 코드가 사용되는 웹사이트 도메인을 등록한 후에, 주어지는 Site Key 와 Secret Key 를 아래 변수값에 입력하면 됩니다.
//	Site Key 에 등록된 도메인이 아니면, 구글 리캡차는 동작하지 않습니다.

$recaptcha_site_key = "6LfgJw0UAAAAAMnUVxpnMl96X-L10sAYt_WCuoyE";
$recaptcha_secret_key = "6LfgJw0UAAAAAAciyHjaSTluO8ri_NXMJ0Yd_UmL";

// 구글 리캡챠 HTML 코드 출력
function recaptcha_html()
{
	global $recaptcha_site_key;

	$html = "";
	$html .= "\n".'<div id="google-recaptcha">';
	$html .= "\n".'	<script src="https://www.google.com/recaptcha/api.js"></script>';
	$html .= "\n".'	<div class="g-recaptcha" data-sitekey="'.$recaptcha_site_key.'"></div>';
	$html .= "\n".'</div">';
	$html .= "\n";
	return $html;
}

if ($_POST['gubun'] == "1") { echo recaptcha_html(); }
?>
