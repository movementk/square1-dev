<?
##-------------------------------------------------------------------##
##                           ����ȯ��
##-------------------------------------------------------------------##
##  ���� OS : ������, ������
##  ����ȯ�� : PHP 4.3, MYSQL 4.0
##-------------------------------------------------------------------##
// ������ ����Ʈ üũ�ð� 60��*30�� = 1800
ob_start();
$visit_time_chk = 1800;
$times = time();

// ��Ʈ�� ������
$data['addrchk'] = 'data/addrchk';

// ��¥ ����
$y_date = date("Y");
$m_date = date("m");
$d_date = date("d");
$h_date = date("H");

$ipaddr = $_SERVER['REMOTE_ADDR'];
$server_cookie = md5($_SERVER['HTTP_HOST'].$ipaddr);


if(empty($_COOKIE['cookie_log'][0])){
	SetCookie("cookie_log[0]",$ipaddr,$times+86400,'/');
}

if($_SESSION['server_cookie'] == false){
	$_SESSION['server_cookie'] = $server_cookie;
}
// VISIT �湮�� ���� üũ
function visit_chk(){
	global $tb,$data,$y_date,$m_date,$d_date,$h_date,$visit_time_chk,$times,$ipaddr,$site_prefix;

	$checktime = $times-$visit_time_chk;
	$agent = strtolower(adds_trim($_SERVER['HTTP_USER_AGENT']));
	$refer = adds_trim($_SERVER['HTTP_REFERER']);
	$view = adds_trim($_SERVER['PHP_SELF']);
	//echo $refer;
	$log_chk = './'.$data['addrchk'].'/';
$login_mode = $site_prefix."login_info";
$visit_mode = $site_prefix."visit_info";


	if(empty($_COOKIE['cookie_log'][1])) {

		// ������ üũ
		$ipaddr_log = md5($ipaddr.'.'.$times);

		// ����
		$idx = 1;
		SetCookie("cookie_log[1]",$times,$times+86400,'/');
	}
	else {

		// ����
		$idx = 2;

		// ������ üũ��
		$ipaddr_log = md5($ipaddr.'.'.$_COOKIE['cookie_log'][1]);
	}

	
	/////////////////////////////////////////////////////////////////
	/////   �������� ȸ��, ��ȸ�� üũ
	/////////////////////////////////////////////////////////////////

	if(!is_file($log_chk.'log_1.dat')){
		
		// �ð��� ���� �ڷ�� ��� ����
		$query="delete from  ".$login_mode." where date < '".$checktime."' or code='".$ipaddr_log."'";
		mysql_query($query);


		// ȸ������ �����Ͽ��ٸ� ....
		if($_SESSION['gm_ssid']['id']){

			$query="insert into  ".$login_mode." values ('1','".$_SESSION['gm_ssid']['id']."','".$ipaddr_log."','".$times."')";
			mysql_query($query);
		}
		
		// ��ȸ������ �����Ͽ��ٸ� ....
		else{
			$query="insert into ".$login_mode." values ('2','".$ipaddr."','".$ipaddr_log."','".$times."')";
			mysql_query($query);
		}
	} // end if



	/////////////////////////////////////////////////////////////////
	/////   ����
	/////////////////////////////////////////////////////////////////

	if(!is_file($log_chk.'log_2.dat') || ($idx==1)){

		// os ����
		if(preg_match("'95'",$agent)) $os = 1;
		elseif(preg_match("'98'",$agent)) $os = 10;
		elseif(preg_match("'nt 4'",$agent)) $os = 11;
		elseif(preg_match("'nt 5.0'",$agent)) $os = 12;
		elseif(preg_match("'nt 5.1'",$agent)) $os = 13;
		elseif(preg_match("'nt 5.2'",$agent)) $os = 14;
		elseif(preg_match("'9x'",$agent)) $os = 15;
		elseif(preg_match("'ce'",$agent)) $os = 16;

		elseif(preg_match("'mac'",$agent)) $os = 2;
		elseif(preg_match("'linux'",$agent)) $os = 3;
		elseif(preg_match("'unix'",$agent)) $os = 4;
		elseif(preg_match("'craw'",$agent)) $os = 5;
		elseif(preg_match("'sun'",$agent)) $os = 6;
		else $os = 9;


		// ������
		if(preg_match("'msie 4'",$agent)) $browser = 1;
		elseif(preg_match("'msie 5'",$agent)) $browser = 10;
		elseif(preg_match("'msie 6'",$agent)) $browser = 11;
		elseif(preg_match("'mozilla'",$agent)) $browser = 2;
		elseif(preg_match("'opera'",$agent)) $browser = 3;
		elseif(preg_match("'icab'",$agent)) $browser = 4;
		elseif(preg_match("'lynx'",$agent)) $browser = 5;
		elseif(preg_match("'konqueror'",$agent)) $browser = 6;
		elseif(preg_match("'spid|bot|craw'",$agent)) $browser = 7;
		else $browser = 9;

		
		$query="select max(total) as total from  ".$visit_mode." where idx='".$idx."'";
		$rs = mysql_query($query);
		$sql_row = mysql_fetch_assoc($rs);
		
		$total = $sql_row[total]+1;
		//echo $sql_row[total];
		//echo "select max(total) from  ".$visit_mode." where idx='".$idx."'";

		$query ="insert into ".$visit_mode." values('','".$idx."','".$y_date."','".$m_date."','".$d_date."','".$h_date."','".$os."','".$browser."','".$ipaddr."','".$view."','".$refer."','".$total."')";
		mysql_query($query);
		//echo $query;
	} // end if

} // end func
ob_end_clean();
?>