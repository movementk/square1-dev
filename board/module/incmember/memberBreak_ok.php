<?
include $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";

$mode=$site_prefix."member_break";

$q = "select * from $memberdb where  UserID='".$user['ID']."' AND Password = password('".$Password1."') and Email  = '$Email' ";
$rs = mysql_query($q);

if(!$user['ID']){
	err_back("잘못된 접근입니다.");
}else{
	$q = "update $memberdb set Flag = 'N', UserLevel='0' where UserID ='".$user['ID']."'";
	$set = mysql_query($q);
	//echo $q;
	if($set == "1"){
		$SQL = "insert into $mode (";
		$SQL.= " UserIdx,UserID,UserName,UserEmail,UserIP,Content,note,RegDate) Value('";
		$SQL = $SQL.$UserIdx."','";
		$SQL = $SQL.$user['ID']."','";
		$SQL = $SQL.$UserName."','";
		$SQL = $SQL.$UserEmail."','";
		$SQL = $SQL.$UserIP."','";
		$SQL = $SQL.$Content."','";
		$SQL = $SQL.$reason."',";
		$SQL = $SQL."now())";
		$Result = mysql_query($SQL);

		setcookie("MemberIdx","", time()-60*60*24, '/', $_SERVER['HTTP_HOST'], false);
		setcookie("MemberID","", time()-60*60*24, '/', $_SERVER['HTTP_HOST'], false);
		setcookie("MemberName","", time()-60*60*24, '/', $_SERVER['HTTP_HOST'], false);
		setcookie("MemberEmail","", time()-60*60*24, '/', $_SERVER['HTTP_HOST'], false);
		setcookie("MemberBarCode","", time()-60*60*24, '/', $_SERVER['HTTP_HOST'], false);
		if(!$Result){
		   err_back("회원 탈퇴에 실패했습니다. 오류 1-1");
		}

		echo "<script>alert('회원님의 회원 탈퇴가 성공적으로 처리 되었습니다. 탈퇴 하신후 동일 아이디로  재가입 할 수 없습니다.');location.href='/member/logout.php';</script>";
	}else{
		err_back('회원탈퇴에 실패 하였습니다. 정상적인 접근인지 확인하세요.');
	}
}
?>