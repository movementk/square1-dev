<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";
/*
$mode = $site_prefix."board_request";
$sql = " select * from EventRequest where 1=1 order by sq_RegDate asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$bd1 = $row["sq_CompanyName"];
	switch($row["sq_EventPart"]){
		case "100000026":
			$Category = "연극";
			break;
		case "100000027":
			$Category = "연주회";
			break;
	}
	$UserName = $row["sq_PersonName"];
	$bd2 = $row["sq_Tel"];
	$bd3 = $row["sq_Hp"];
	$UserEmail = $row["sq_Email"];
	$bd4 = $row["sq_BookingStartDate"];
	$bd5 = $row["sq_BookingEndDate"];
	$bd6 = $row["sq_player"];
	$bd7 = $row["sq_Operator"];
	$RegDate = $row["sq_RegDate"];
	$Content = get_text($row["sq_CareerContents"]);
	$Title = $UserName."님의 대관신청문의글 입니다.";

	$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

	$SQL = "select max(BoardIdx) as midx from ".$mode;
	$Result = sql_query($SQL);
	
	if(!$Result){
	  $BoardIdx = 1;
	}
	else {
		$row = sql_fetch($SQL);
		$idx = $row[midx]+1;
	}
	if(isset($_REQUEST["Ref"]) && $_REQUEST["Ref"] != ""){
	   $Ref      = $_REQUEST["Ref"];
	   $ReStep  = $_REQUEST["ReStep"] + 1;
	   $ReLevel = $_REQUEST["ReLevel"] + 1;

	   $SQL = "update ".$mode." set ReStep = ReStep+1 where Ref=";
	   $SQL .= $Ref." AND ReStep > ".$_REQUEST["ReStep"];

	   sql_query($SQL);

	   $UserPw = $ppw;

	}
	else{
	   
	   $Ref      = $idx;
	   $ReStep  = 0;
	   $ReLevel = 0;
	}

	$SQL  = "insert into ".$mode." 
							set Notice = '$Notice',
								Category = '$Category',
								Title = '$Title',
								Content = '$Content',
								UserIdx = '$UserIdx',
								UserID = '$UserID',
								UserName = '$UserName',
								UserEmail = '$UserEmail',
								UserPw = '$UserPw',
								UserIP = '$UserIP',
								Secret = '$Secret',
								SecretFlag = '$SecretFlag',
								HtmlChk='$HtmlChk',
								Link1 = '$Link1',
								Link2 = '$Link2',
								$sql_common
								Ref = '$Ref',
								ReStep = '$ReStep',
								ReLevel = '$ReLevel',
								RegDate = '$RegDate' ";
	echo $SQL."<bR>";
	$Result = sql_query($SQL);

}
*/
/*
$mode = $site_prefix."board_faq";
$sql = " select * from FAQ where 1=1 order by DATE asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	switch($row["GUBUN"]){
		case "100000024":
			$Category = "매장안내";
			break;
		case "100000025":
			$Category = "누들로드안내";
			break;
		case "100000026":
			$Category = "이벤트";
			break;
		case "100000027":
			$Category = "편의시설";
			break;
		case "100000028":
			$Category = "주차/교통";
			break;
		case "100000029":
			$Category = "멤버쉽카드안내";
			break;
		case "100000030":
			$Category = "기타";
			break;
	}
	$UserID = "admin";
	$UserName = "관리자";
	$UserEmail = "admin@square1.co.kr";
	$RegDate = $row["DATE"];
	$UserPw = sql_password("1234");
	$UserIP = "112.216.114.162";
	$Content = get_text($row["CONT"]);
	$Title = preg_replace("/\"/", "&#034;", get_text($row["TITLE"]));

	$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

	$SQL = "select max(BoardIdx) as midx from ".$mode;
	$Result = sql_query($SQL);
	
	if(!$Result){
	  $BoardIdx = 1;
	}
	else {
		$row = sql_fetch($SQL);
		$idx = $row[midx]+1;
	}
	if(isset($_REQUEST["Ref"]) && $_REQUEST["Ref"] != ""){
	   $Ref      = $_REQUEST["Ref"];
	   $ReStep  = $_REQUEST["ReStep"] + 1;
	   $ReLevel = $_REQUEST["ReLevel"] + 1;

	   $SQL = "update ".$mode." set ReStep = ReStep+1 where Ref=";
	   $SQL .= $Ref." AND ReStep > ".$_REQUEST["ReStep"];

	   sql_query($SQL);

	   $UserPw = $ppw;

	}
	else{
	   
	   $Ref      = $idx;
	   $ReStep  = 0;
	   $ReLevel = 0;
	}

	$SQL  = "insert into ".$mode." 
							set Notice = '$Notice',
								Category = '$Category',
								Title = '$Title',
								Content = '$Content',
								UserIdx = '$UserIdx',
								UserID = '$UserID',
								UserName = '$UserName',
								UserEmail = '$UserEmail',
								UserPw = '$UserPw',
								UserIP = '$UserIP',
								Secret = '$Secret',
								SecretFlag = '$SecretFlag',
								HtmlChk='$HtmlChk',
								Link1 = '$Link1',
								Link2 = '$Link2',
								$sql_common
								Ref = '$Ref',
								ReStep = '$ReStep',
								ReLevel = '$ReLevel',
								RegDate = '$RegDate' ";
	echo $SQL."<bR>";
	$Result = sql_query($SQL);

}
*/
/*
$mode = $site_prefix."board_qna";
$sql = " select * from Qna where 1=1 order by DATE asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	switch($row["GUBUN"]){
		case "100000014":
			$Category = "매장관련";
			break;
		case "100000015":
			$Category = "시설관련";
			break;
		case "100000016":
			$Category = "이벤트";
			break;
		case "100000017":
			$Category = "주차 및 교통관련";
			break;
		case "100000018":
			$Category = "서비스관련";
			break;
		case "100000019":
			$Category = "웹사이트관련";
			break;
		case "100000020":
			$Category = "기타";
			break;
	}
	$UserID = $row["MEN_ID"];
	$UserName = $row["MEN_NAME"];
	$UserEmail = $row["MEN_EMAIL"];
	$RegDate = $row["DATE"];
	$UserPw = sql_password("1234");

	$Content = get_text($row["CONT"]);
	$bd1 = get_text($row["RCONT"]);
	$Title = preg_replace("/\"/", "&#034;", get_text($row["TITLE"]));

	$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

	$SQL = "select max(BoardIdx) as midx from ".$mode;
	$Result = sql_query($SQL);
	
	if(!$Result){
	  $BoardIdx = 1;
	}
	else {
		$row = sql_fetch($SQL);
		$idx = $row[midx]+1;
	}
	if(isset($_REQUEST["Ref"]) && $_REQUEST["Ref"] != ""){
	   $Ref      = $_REQUEST["Ref"];
	   $ReStep  = $_REQUEST["ReStep"] + 1;
	   $ReLevel = $_REQUEST["ReLevel"] + 1;

	   $SQL = "update ".$mode." set ReStep = ReStep+1 where Ref=";
	   $SQL .= $Ref." AND ReStep > ".$_REQUEST["ReStep"];

	   sql_query($SQL);

	   $UserPw = $ppw;

	}
	else{
	   
	   $Ref      = $idx;
	   $ReStep  = 0;
	   $ReLevel = 0;
	}

	$SQL  = "insert into ".$mode." 
							set Notice = '$Notice',
								Category = '$Category',
								Title = '$Title',
								Content = '$Content',
								UserIdx = '$UserIdx',
								UserID = '$UserID',
								UserName = '$UserName',
								UserEmail = '$UserEmail',
								UserPw = '$UserPw',
								UserIP = '$UserIP',
								Secret = '$Secret',
								SecretFlag = '$SecretFlag',
								HtmlChk='$HtmlChk',
								Link1 = '$Link1',
								Link2 = '$Link2',
								$sql_common
								Ref = '$Ref',
								ReStep = '$ReStep',
								ReLevel = '$ReLevel',
								RegDate = '$RegDate' ";
//	echo $SQL."<bR>";
	$Result = sql_query($SQL);

}
*/
/*
$mode = $site_prefix."board_store";
$sql = " select * from Store where 1=1 order by IDX asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	switch($row["CATE"]){
		case "100000001":
			$Category = "패션";
			break;
		case "100000002":
			$Category = "스포츠&아웃도어";
			break;
		case "100000003":
			$Category = "패션잡화";
			break;
		case "100000004":
			$Category = "라이프스타일";
			break;
		case "100000005":
			$Category = "F&B";
			break;
		case "100000006":
			$Category = "서비스";
			break;
		case "100000024":
			$Category = "엔터테인먼트";
			break;
		case "100000025":
			$Category = "브랜드행사";
			break;
		case "100000028":
			$Category = "퇴점";
			break;
	}
	$UserID = "admin";
	$UserName = "관리자";
	$UserEmail = "admin@square1.co.kr";
	$RegDate = date("Y-m-d H:i:s");
	$UserPw = sql_password("1234");

	$Content = get_text($row["INFO"]);
	$bd1 = get_text($row["INFO_E"]);
	$bd2 = $row["CODE"];

	switch($row["NATION"]){
		case "100000007":
			$bd3 = "한국";
			break;
		case "100000008":
			$bd3 = "중국";
			break;
		case "100000009":
			$bd3 = "이탈리아";
			break;
		case "100000010":
			$bd3 = "일본";
			break;
		case "100000011":
			$bd3 = "미국";
			break;
		case "100000012":
			$bd3 = "태국";
			break;
		case "100000013":
			$bd3 = "호주";
			break;
	}

	$bd4 = $row["FLOORS"];

	$Title = preg_replace("/\"/", "&#034;", get_text($row["KNAME"]));

	$bd5 = get_text($row["ENAME"]);

	$bd6 = get_text($row["PHONE"]);

	$bd7 = get_text($row["OCTIME"]);

	$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

	$SQL = "select max(BoardIdx) as midx from ".$mode;
	$Result = sql_query($SQL);
	
	if(!$Result){
	  $BoardIdx = 1;
	}
	else {
		$row = sql_fetch($SQL);
		$idx = $row[midx]+1;
	}
	if(isset($_REQUEST["Ref"]) && $_REQUEST["Ref"] != ""){
	   $Ref      = $_REQUEST["Ref"];
	   $ReStep  = $_REQUEST["ReStep"] + 1;
	   $ReLevel = $_REQUEST["ReLevel"] + 1;

	   $SQL = "update ".$mode." set ReStep = ReStep+1 where Ref=";
	   $SQL .= $Ref." AND ReStep > ".$_REQUEST["ReStep"];

	   sql_query($SQL);

	   $UserPw = $ppw;

	}
	else{
	   
	   $Ref      = $idx;
	   $ReStep  = 0;
	   $ReLevel = 0;
	}

	$SQL  = "insert into ".$mode." 
							set Notice = '$Notice',
								Category = '$Category',
								Title = '$Title',
								Content = '$Content',
								UserIdx = '$UserIdx',
								UserID = '$UserID',
								UserName = '$UserName',
								UserEmail = '$UserEmail',
								UserPw = '$UserPw',
								UserIP = '$UserIP',
								Secret = '$Secret',
								SecretFlag = '$SecretFlag',
								HtmlChk='$HtmlChk',
								Link1 = '$Link1',
								Link2 = '$Link2',
								$sql_common
								Ref = '$Ref',
								ReStep = '$ReStep',
								ReLevel = '$ReLevel',
								RegDate = '$RegDate' ";
//	echo $SQL."<bR>";
	$Result = sql_query($SQL);

}
*/
/*
$sql = " select * from Member where 1=1 order by IDX asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$UserName = $row["SNAME"];
	$UserID = $row["SID"];
	$Password = $row["PWD"];
	$Email = $row["EMAIL"];
	$ZipCode = $row["ZIP"];
	$Address1 = $row["ADDR"];
	$Address2 = $row["ADDR_E"];
	$Phone = $row["PHONE"];
	$Mobile = $row["MOBILE"];
	$Flag = strtoupper($row["USEYN"]);
	$EmailFlag = strtoupper($row["EMAIL_A"]);
	$JoinDate = $row["DATE"];
	$mb_1 = $row["CARDNO"];

		//회원 생성.
	$SQL = " insert into ".$memberdb." set 
									UserID = '".$UserID."',
									UserName = '".$UserName."',
									memberType = '".$memberType."',
									Password = password('".$Password."'),
									NickName = '".$NickName."',
									Sex = '".$Sex."',
									UserIP = '".$UserIP."',
									BirthDay = '".$BirthDay."',
									Phone = '".$Phone."',
									Mobile = '".$Mobile."',
									Email = '".$Email."',
									ZipCode = '".$ZipCode."',
									Address1 = '".$Address1."',
									Address2 = '".$Address2."',
									Address3 = '".$Address3."',
									Content = '".$Content."',
									Flag = '".$Flag."',
									Point = '0',
									UserLevel = '2',
									LoginIP = '',
									LoginDate = '',
									$sql_common
									mb_1 = '".$mb_1."',
									EmailFlag = '$EmailFlag',
									JoinDateTime = '".$JoinDate."',
									JoinDate = '".strtotime($JoinDate)."' ";

	$Result = mysql_query($SQL);
}
*/
?>