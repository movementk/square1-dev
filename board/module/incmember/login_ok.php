<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";
include $dir."/config/common_top.php";
if(!$URI || $URI=="/") $URI = $loc.'/index.php';

if(!$user['ID']){
	$UserID = $_REQUEST["UserID"];
	$Password = $_REQUEST["Password1"];
	$URI = urldecode($URI);
	$Fchk = $_REQUEST["Fchk"];
	if(!$URI || $URI=="/") $URI = '/';
	if($pw<>""){
		$Password=$pw;
	}
	if($UID<>""){
		$UserID=$UID;
	}

	$MemberSQL = "select UserID,Password from ".$memberdb." where Flag='Y' AND UserID = '".$UserID."'";
	$MemberResult = sql_query($MemberSQL);
	$MemberRow = sql_fetch($MemberSQL);
	$MemberCount = mysql_num_rows($MemberResult);

	if($MemberCount){
		if(substr($MemberRow[Password],0,1) != "*"){
			err_move("비밀번호 암호화방식의 보안성 강화를 위하여 비밀번호를 찾기를 해주시기 바랍니다.","/member/idpw.php");
			exit;
		}

		$LoginSQL = "select UserID,UserName,Email,idx,LoginDate,UserLevel,memberType,Point from ".$memberdb." where ";
		$LoginSQL.= " UserID='".$UserID."' AND Password = password('".$Password."')";
		$LoginResult = mysql_query($LoginSQL);
		$LoginCount = mysql_num_rows($LoginResult);
		$LoginRow = mysql_fetch_array($LoginResult);

		// echo $LoginSQL;
		if(!$LoginCount){
			err_back("아이디 또는 비밀번호를 정확히 입력하시기 바랍니다.");
			exit;
		} else {
			$DateSQL  = " update ".$memberdb." set ";
			$DateSQL .= " LoginDate=".time().",PrevLoginDate='".$LoginRow["LoginDate"]."'";
			$DateSQL .= " where idx=".$LoginRow["idx"];
			mysql_query($DateSQL);

			setcookie("MemberIdx","", 0, '/');
			setcookie("MemberID","", 0, '/');
			setcookie("MemberName","", 0, '/');
			setcookie("MemberEmail","", 0, '/');
			setcookie("MemberPoint","", 0, '/');
			setcookie("MemberLevel","", 0, '/');

			setcookie("admin_idx2", "",0, "/");
			setcookie("admin_id2", "",0, "/");
			setcookie("admin_email2", "",0, "/");
			setcookie("admin_name2", "",0, "/");
			setcookie("admin_level2", "",0, "/");

			setcookie("MemberIdx",$LoginRow["idx"], 0, '/');
			setcookie("MemberID",$LoginRow["UserID"], 0, '/');
			setcookie("MemberName",$LoginRow["UserName"], 0, '/');
			setcookie("MemberType",$LoginRow["memberType"], 0, '/');
			setcookie("MemberPoint",$LoginRow["Point"], 0, '/');
			setcookie("MemberLevel",$LoginRow["UserLevel"], 0, '/');
			if($saveIdChk == "1") {
				setcookie("saveId",$userid,time()+60*60*24*30,'/');
			} else {
				setcookie("saveId","",0,'/');
			}
			//err_move('로그인되었습니다.',"$URI");
			echo "<script>location.href='".$URI."';</script>";
			exit;
		}
	} else {
		err_back("아이디가 존재하지 않습니다.");
		exit;
	}
}else{
	setcookie("admin_idx2", "",0, "/");
	setcookie("admin_id2", "",0, "/");
	setcookie("admin_email2", "",0, "/");
	setcookie("admin_name2", "",0, "/");
	setcookie("admin_level2", "",0, "/");
	
	setcookie("MemberIdx","", 0, '/');
	setcookie("MemberID","", 0, '/');
	setcookie("MemberName","", 0, '/');
	setcookie("MemberEmail","", 0, '/');
	setcookie("MemberPoint","", 0, '/');
	setcookie("MemberLevel","", 0, '/');
	header("location:".$URI);
}
include $dir."/config/common_bottom.php";
?>