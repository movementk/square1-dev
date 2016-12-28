<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";
/*
$mode = $site_prefix."board_notice";
$BoardName = "notice";
$sql = " select * from Notice where 1=1 order by IDX asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
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
		$row2 = sql_fetch($SQL);
		$idx = $row2["midx"]+1;
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
	$Result = sql_query($SQL);

	$Idx = get_max($mode,"BoardIdx","");

	$uploaddir = $dir."/upload/".$BoardName."/";
	$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
	$upload = array();

	if($row["IMG"]){
		$filename  = $row["IMG"];
		$upload[0][file_name] = $filename;
		$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
		shuffle($chars_array);
		$shuffle = implode("", $chars_array);
		$upload[0][file_source] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 
		$dest_file = "$uploaddir/" . $upload[0][file_source];
		$tmp_file  = $_SERVER["DOCUMENT_ROOT"]."/notice/".iconv("UTF-8","EUC-KR",$row["IMG"]);
		$error_code = copy($tmp_file, $dest_file);
		chmod($dest_file, 0606);

		for ($j=0; $j<count($upload); $j++) 
		{
			$row = sql_fetch(" select count(*) as cnt from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$j' ");
			if ($row[cnt]) 
			{
				// 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
				// 그렇지 않다면 내용만 업데이트 합니다.
				if ($upload[$i][del_check] || $upload[$i][file_source]) 
				{
					$sql = " update $fileTable
								set file_source = '{$upload[$j][file_source]}',
									file_name = '{$upload[$j][file_name]}',
									file_filesize = '{$upload[$j][file_filesize]}',
									file_width = '{$upload[$j][image][0]}',
									file_height = '{$upload[$j][image][1]}',
									file_category = '{$upload[$j][image][2]}',
									RegDate = now()
							  where board_table = '$mode'
								and board_idx = '$Idx'
								and file_no = '$j' ";
					sql_query($sql);
				}
			} 
			else 
			{
				$sql = " insert into $fileTable
							set board_table = '$mode',
								board_idx = '$Idx',
								file_no = '$j',
								file_source = '{$upload[$j][file_source]}',
								file_name = '{$upload[$j][file_name]}',
								file_filesize = '{$upload[$j][file_filesize]}',
								file_width = '{$upload[$j][image][0]}',
								file_height = '{$upload[$j][image][1]}',
								file_category = '{$upload[$j][image][2]}',
								RegDate = now() ";
				sql_query($sql);
			}
		}

		// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
		// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
		$sql = " select max(file_no) as max_bf_no from $fileTable where board_table = '$mode' and board_idx = '$Idx' ";
		$row = sql_fetch($sql);

		for ($j=(int)$row[max_bf_no]; $j>=0; $j--) 
		{
			$sql2 = " select file_source from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$j' ";
			$row2 = sql_fetch($sql2);
			// 정보가 있다면 빠집니다.
			if ($row2[file_source]) break;

			// 그렇지 않다면 정보를 삭제합니다.
			$sql3 = " delete from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$j' ";
			sql_query($sql3);
		}
	}
}
*/
/*
$mode = $site_prefix."board_press";
$BoardName = "press";
$sql = " select * from Press where 1=1 order by IDX asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$UserID = "admin";
	$UserName = "관리자";
	$UserEmail = "admin@square1.co.kr";
	$RegDate = $row["DATE"];
	$UserPw = sql_password("1234");
	$UserIP = "112.216.114.162";
	$Content = get_text($row["LINK"]);
	$Title = preg_replace("/\"/", "&#034;", get_text($row["TITLE"]));

	$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

	$SQL = "select max(BoardIdx) as midx from ".$mode;
	$Result = sql_query($SQL);
	
	if(!$Result){
	  $BoardIdx = 1;
	}
	else {
		$row2 = sql_fetch($SQL);
		$idx = $row2["midx"]+1;
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
	$Result = sql_query($SQL);
}
*/
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


/*
insert into mk_board_store set bd1='1', Category='패션', Title='바인드', bd2 = '4160', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='지오다노', bd2 = '4193', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='아메리칸이글', bd2 = '4152', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='풀앤베어', bd2 = '4125', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='자라(ZARA)', bd2 = '4100', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='마시모두띠', bd2 = '4140', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='버쉬카', bd2 = '4184', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='H&M', bd2 = '4400', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='에잇세컨즈', bd2 = '4113', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='망고', bd2 = '4430', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='탑텐', bd2 = '4428', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='미쏘', bd2 = '4117', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='MLB', bd2 = '4177', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='에블린', bd2 = '4148', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='코데즈 이너웨어', bd2 = '4133', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='올젠', bd2 = '4171', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='비이커', bd2 = '4433', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='커스텀멜로우', bd2 = '4121', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='크리스크리스티', bd2 = '070-8810-8525', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='시리즈', bd2 = '4138', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='게스(GUESS)', bd2 = '4224', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='타미비클', bd2 = '4134', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='러브앤쇼', bd2 = '4164', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='엔비플러스', bd2 = '4238', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='탑스타일', bd2 = '4483', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='패션', Title='반짇고리', bd2 = '4150', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='쌤소나이트', bd2 = '4195', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='에스콰이어', bd2 = '4170', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='데땅뜨', bd2 = '4151', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='세라', bd2 = '4180', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='찰스앤키스', bd2 = '4120', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='엘칸토', bd2 = '4149', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='Fellice-teria', bd2 = '4137', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='질바이질스튜어트', bd2 = '4432', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='더바디샵', bd2 = '4124', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='더페이스샵', bd2 = '070-7764-6032', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='이니스프리', bd2 = '4381', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='액센트', bd2 = '4153', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='티르리르', bd2 = '4174', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='리치드림', bd2 = '4179', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='르망안경', bd2 = '4470', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='성현유통', bd2 = '070-7769-3306', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='다빈치패션', bd2 = '4173', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='아웃도어프로덕트', bd2 = '4181', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='루이까라스', bd2 = '070-4473-1005', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='잡&라', Title='패션갤러리', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='F&B', Title='KFC', bd2 = '4490', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='F&B', Title='커피빈', bd2 = '4475', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='F&B', Title='카페베네', bd2 = '4488', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='F&B', Title='스패뉴키친', bd2 = '4460', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='1', Category='F&B', Title='씨유(편의점)', bd2 = '4123', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='유니클로', bd2 = '4260', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='어라운드101', bd2 = '4214', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='어라운드더코너', bd2 = '4200', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='씨', bd2 = '4292', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='비키/베스띠벨리', bd2 = '4277', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='리스트', bd2 = '4298', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='로엠', bd2 = '4282', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='LAP', bd2 = '4219', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='숲갤러리', bd2 = '4290', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='플라스틱아일랜드', bd2 = '4230', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='쉬즈미스', bd2 = '4297', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='트위(TWEE)', bd2 = '4208', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='클라이드앤/GGPX', bd2 = '4366', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='지오지아ACC', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='TNGT', bd2 = '4239', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='지오지아', bd2 = '4217', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='지이크파렌하이트', bd2 = '070-8880-4715', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='로가디스', bd2 = '4273', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='파크랜드', bd2 = '4235', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='버커루/NBA', bd2 = '4259', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='퀵실버/록시', bd2 = '4288', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='캘빈클라인진', bd2 = '4240', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='라코스테', bd2 = '4234', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='DC', bd2 = '4287', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='엄브로', bd2 = '4275', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='데상트골프', bd2 = '4215', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='르꼬끄골프', bd2 = '4279', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='나이키골프', bd2 = '4455', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='나이키', bd2 = '4294', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='아디다스', bd2 = '4263', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='리복', bd2 = '4265', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='뉴발란스', bd2 = '4299', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='데상트', bd2 = '4255', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='르꼬끄스포르티브', bd2 = '4242', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='스케쳐스', bd2 = '4203', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='코오롱스포츠', bd2 = '4270', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='빈폴아웃도어', bd2 = '4266', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='디스커버리', bd2 = '4253', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='러브포맨', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='엘하임', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='패션', Title='씨엔', bd2 = '4251', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='바나바나', bd2 = '4267', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='로이드', bd2 = '4220', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='OST', bd2 = '4221', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='슈펜', bd2 = '4271, 4272', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='ABC마트', bd2 = '4211', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='뉴에라', bd2 = '4228', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='란체티', bd2 = '4250', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='비아모노', bd2 = '070-4201-2822', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='크록스', bd2 = '4233', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='엠플러스', bd2 = '4236', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='아미스코', bd2 = '4360', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='세븐어클락&퍼퓸', bd2 = '4280', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='인코코', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='팀벅2', bd2 = '4269', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='스코노', bd2 = '4205', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='노이', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='잡&라', Title='폴스부띠끄', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='2', Category='F&B', Title='뚜레쥬르', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='원더플레이스', bd2 = '4354', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='마인드브릿지', bd2 = '4335', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='앤듀', bd2 = '4332', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='스타일온에어', bd2 = '4351', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='우먼시크릿', bd2 = '4462', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='비비안', bd2 = '4463', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='원더브라', bd2 = '4461', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='패션', Title='퍼니러브', bd2 = '070-8851-9030', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='아트박스', bd2 = '4318', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='네이처리퍼블릭', bd2 = '4378', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='올리브영', bd2 = '4349', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='아리따움', bd2 = '4380', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='트윈키즈365', bd2 = '4364', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='래핑차일드', bd2 = '4306', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='디자인스킨', bd2 = '4363', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='레스모아', bd2 = '4337', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='스프리스', bd2 = '4320', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='마이리틀타이거', bd2 = '4388', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='리틀그라운드', bd2 = '4321', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='모던하우스', bd2 = '4491 / 4494', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='어바웃하우스', bd2 = '4389', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='하우스웨어', bd2 = '212-0305', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='보웰', bd2 = '4324', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='리얼컴포트', bd2 = '4468', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='블레스홈&네일', bd2 = '070-8621-1117', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='고정현헤어', bd2 = '4256', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='피노키오 키즈카페', bd2 = '4343', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='하라주쿠', bd2 = '4357', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='핑거스톤', bd2 = '070-8883-1900', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='리본팩토리', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='뿌야뿌', bd2 = '4429', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='리틀밥독', bd2 = '070-4156-2915', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='다스게베베', bd2 = '4368', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='LG하우시스', bd2 = '818-9601', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='NH통신', bd2 = '070-4130-1100', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='교보문고', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='스퀘어365약국', bd2 = '4377', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='365꾸러기의원', bd2 = '4375', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='드림피부과', bd2 = '4330', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='스퀘어치과', bd2 = '4311', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='잡&라', Title='늘밝은안과', bd2 = '4370', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='파스쿠찌', bd2 = '4346', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='스트릿츄러스', bd2 = '4345', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='앤티앤스', bd2 = '4327', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='비첸향', bd2 = '4308', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='비비고', bd2 = '4339', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='스쿨스토어', bd2 = '4379', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='가츠라', bd2 = '4466', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='불고기브라더스', bd2 = '4301, 4302', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='빕스(VIPS)', bd2 = '4397, 4398', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='차이나팩토리', bd2 = '4313', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='스시로', bd2 = '4315', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='안동찜닭', bd2 = '4355', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='놀부부대찌개', bd2 = '4300', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='하꼬야', bd2 = '4328', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='스무디킹', bd2 = '4348', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='포베이', bd2 = '4480', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='니뽕내뽕', bd2 = '4356', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='후쿠오카함바그', bd2 = '4323', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='공차', bd2 = '4393', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='단수이 카스테라', bd2 = '4325', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='크리미몰랑', bd2 = '4309', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='오므토토마토', bd2 = '4347', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='레드썬', bd2 = '4367', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='몬스터브레드', bd2 = '4334', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='빨라쪼', bd2 = '4336', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='롤리폴리캔디', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='쿠테스하우스', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='하라도너츠', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='선우어묵고로케', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='오병핫도그앤뽀끼', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='슐탄케밥', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='3', Category='F&B', Title='핵스테이크', bd2 = '-', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='잡&라', Title='펀잇', bd2 = '4452', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='잡&라', Title='미스터힐링', bd2 = '4485', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='잡&라', Title='이야기극장', bd2 = '010--3201-1501', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='계절밥상', bd2 = '4481', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='바르미샤브샤브', bd2 = '4486', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='마시찜', bd2 = '4458', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='셀렉스트릿', bd2 = '4472', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='달콤커피', bd2 = '4477', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='F&B', Title='투썸플레이스', bd2 = '4450', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='4', Category='엔터테인먼트', Title='CGV', bd2 = '4040, 4043', bd3 = '10:30 ~ 22:00';
insert into mk_board_store set bd1='5', Category='F&B', Title='더파티원', bd2 = '4456', bd3 = '10:30 ~ 22:00
*/
/*
$sql = " update ".$site_prefix."board_store set Category = '패션잡화 & 라이프스타일' where Category = '잡&라' ";
$result = sql_query($sql);
*/
/*
$sql = " select * from ".$site_prefix."board_store where char_length(bd2) = 4 order by BoardIdx asc ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$usql = " update ".$site_prefix."board_store set bd2 = '032-456-".$row["bd2"]."' where BoardIdx = '".$row["BoardIdx"]."' ";
	echo $usql."<br>";
	$uresult = sql_query($usql);
}
echo "===========================================================================<br>";
*/

?>