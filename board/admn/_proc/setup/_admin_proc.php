<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "content"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

$upload_max_filesize = ini_get('upload_max_filesize');
$uploaddir = $dir."/upload/category/";

$dir_ck = is_dir($uploaddir);

if($dir_ck != "1"){
	if(!@mkdir("$uploaddir", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$uploaddir", 0707)){ echo "퍼미션변경 실패"; exit;}
}

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
// 가변 파일 업로드
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++){
	// 삭제에 체크가 되어있다면 파일을 삭제합니다.
	if ($_POST[bf_file_del][$i]) 
	{
		$upload[$i][del_check] = true;

		$row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$ca_id' and file_no = '$i' ");
		@unlink("$uploaddir/$row[file_source]");
	}
	else
		$upload[$i][del_check] = false;

	$tmp_file  = $_FILES[bf_file][tmp_name][$i];
	$filename  = $_FILES[bf_file][name][$i];
	$filesize  = $_FILES[bf_file][size][$i];

	// 서버에 설정된 값보다 큰파일을 업로드 한다면
	if ($filename)
	{
		if ($_FILES[bf_file][error][$i] == 1)
		{
			$file_upload_msg .= "\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n";
			continue;
		}
		else if ($_FILES[bf_file][error][$i] != 0)
		{
			$file_upload_msg .= "\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n";
			continue;
		}
	}

	if (is_uploaded_file($tmp_file)) 
	{
		/* 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
		if (!$is_admin && $filesize > $board[bo_upload_size]) 
		{
			$file_upload_msg .= "\'{$filename}\' 파일의 용량(".number_format($filesize)." 바이트)이 게시판에 설정(".number_format($board[bo_upload_size])." 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n";
			continue;
		}
		*/

		//=================================================================\
		// 090714
		// 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
		// 에러메세지는 출력하지 않는다.
		//-----------------------------------------------------------------
		$timg = @getimagesize($tmp_file);
		// image type
		if ( preg_match("/\.(jpg|bmp|gif|png)$/i", $filename) ||
			 preg_match("/\.(swf)$/i", $filename) ) 
		{
			if ($timg[2] < 1 || $timg[2] > 16)
			{
				//$file_upload_msg .= "\'{$filename}\' 파일이 이미지나 플래시 파일이 아닙니다.\\n";
				continue;
			}
		}
		//=================================================================

		$upload[$i][image] = $timg;

		// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
		if ($w == 'u')
		{
			// 존재하는 파일이 있다면 삭제합니다.
			$row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$ca_id' and file_no = '$i' ");
			@unlink("$uploaddir/$row[bf_file]");
		}

		// 프로그램 원래 파일명
		$upload[$i][file_name] = $filename;
		$upload[$i][file_filesize] = $filesize;

		// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
		$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

		// 접미사를 붙인 파일명
		//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.urlencode($filename);
		// 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다. 
		//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 
		shuffle($chars_array);
		$shuffle = implode("", $chars_array);

		// 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
		//$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode($filename)); 
		$upload[$i][file_source] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename))); 

		$dest_file = "$uploaddir/" . $upload[$i][file_source];

		// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
		$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[bf_file][error][$i]);

		// 올라간 파일의 퍼미션을 변경합니다.
		chmod($dest_file, 0606);

		//$upload[$i][image] = @getimagesize($dest_file);

	}
}

if(!$admin_hp) $admin_hp = $admin_hp1."-".$admin_hp2."-".$admin_hp3;

switch($workType){
	case "AD":
	case "AM":
		$sql = " select * from ".$site_prefix."admin where admin_idx = '".$admin_idx."' ";
		$row = sql_fetch($sql);
		if($admin["admin_level"] <= $row["admin_level"] && $admin["admin_id"] != $row["admin_id"]) GetAlert("본인의 등급보다 높은 자료는 수정/삭제 하실 수 없습니다.",$URI);
		if(!$admin_pwd) $admin_pwd = $row["admin_pwd"];
		else $admin_pwd = sql_password($admin_pwd);
		break;
}

switch($workType){
	case "HI":
		$sql = " insert into ".$site_prefix."hollyday set cdate = '".$cdate."', cname = '".$cname."' ";
		$result = sql_query($sql);
		$works = "입력";
		break;
	case "HD":
		$sql = " delete from ".$site_prefix."hollyday where idx = '".$idx."' ";
		$result = sql_query($sql);
		$works = "삭제";
		break;
	case "HM":
		$sql = " update ".$site_prefix."hollyday set cdate = '".$cdate."', cname = '".$cname."' where idx = '".$idx."' ";
		$result = sql_query($sql);
		$works = "수정";
		break;
	case "CI":
		$sql_common = "";
		if(sizeof($mon_time) > 0){
			$mon_time_array = implode("|",$mon_time);
			$sql_common .= " mon_time = '".$mon_time_array."', ";
		}
		if(sizeof($tue_time) > 0){
			$tue_time_array = implode("|",$tue_time);
			$sql_common .= " tue_time = '".$tue_time_array."', ";
		}
		if(sizeof($wed_time) > 0){
			$wed_time_array = implode("|",$wed_time);
			$sql_common .= " wed_time = '".$wed_time_array."', ";
		}
		if(sizeof($thu_time) > 0){
			$thu_time_array = implode("|",$thu_time);
			$sql_common .= " thu_time = '".$thu_time_array."', ";
		}
		if(sizeof($fri_time) > 0){
			$fri_time_array = implode("|",$fri_time);
			$sql_common .= " fri_time = '".$fri_time_array."', ";
		}
		
		if(sizeof($mon_day) > 0){
			$mon_day_array = implode("|",$mon_day);
			$sql_common .= " mon_day = '".$mon_day_array."', ";
		}
		if(sizeof($tue_day) > 0){
			$tue_day_array = implode("|",$tue_day);
			$sql_common .= " tue_day = '".$tue_day_array."', ";
		}
		if(sizeof($wed_day) > 0){
			$wed_day_array = implode("|",$wed_day);
			$sql_common .= " wed_day = '".$wed_day_array."', ";
		}
		if(sizeof($thu_day) > 0){
			$thu_day_array = implode("|",$thu_day);
			$sql_common .= " thu_day = '".$thu_day_array."', ";
		}
		if(sizeof($fri_day) > 0){
			$fri_day_array = implode("|",$fri_day);
			$sql_common .= " fri_day = '".$fri_day_array."', ";
		}

		$mode = $site_prefix."charge";
		$sql = " insert into ".$mode." set part = '".$part."', name = '".$name."', $sql_common etc = '".$etc."' ";
		$result = sql_query($sql);
		$works = "입력";
		$idx = get_max($mode,"idx");
		break;
	case "CD":
		$sql = " delete from ".$site_prefix."charge where idx = '".$idx."' ";
		$result = sql_query($sql);
		$works = "삭제";
		break;
	case "CM":
		$sql_common = "";
		if(sizeof($mon_time) > 0){
			$mon_time_array = implode("|",$mon_time);
			$sql_common .= " mon_time = '".$mon_time_array."', ";
		}
		if(sizeof($tue_time) > 0){
			$tue_time_array = implode("|",$tue_time);
			$sql_common .= " tue_time = '".$tue_time_array."', ";
		}
		if(sizeof($wed_time) > 0){
			$wed_time_array = implode("|",$wed_time);
			$sql_common .= " wed_time = '".$wed_time_array."', ";
		}
		if(sizeof($thu_time) > 0){
			$thu_time_array = implode("|",$thu_time);
			$sql_common .= " thu_time = '".$thu_time_array."', ";
		}
		if(sizeof($fri_time) > 0){
			$fri_time_array = implode("|",$fri_time);
			$sql_common .= " fri_time = '".$fri_time_array."', ";
		}
		
		if(sizeof($mon_day) > 0){
			$mon_day_array = implode("|",$mon_day);
			$sql_common .= " mon_day = '".$mon_day_array."', ";
		}
		if(sizeof($tue_day) > 0){
			$tue_day_array = implode("|",$tue_day);
			$sql_common .= " tue_day = '".$tue_day_array."', ";
		}
		if(sizeof($wed_day) > 0){
			$wed_day_array = implode("|",$wed_day);
			$sql_common .= " wed_day = '".$wed_day_array."', ";
		}
		if(sizeof($thu_day) > 0){
			$thu_day_array = implode("|",$thu_day);
			$sql_common .= " thu_day = '".$thu_day_array."', ";
		}
		if(sizeof($fri_day) > 0){
			$fri_day_array = implode("|",$fri_day);
			$sql_common .= " fri_day = '".$fri_day_array."', ";
		}

		$mode = $site_prefix."charge";
		$sql = " update ".$mode." set part = '".$part."', name = '".$name."', $sql_common etc = '".$etc."' where idx = '".$idx."' ";
		$result = sql_query($sql);
		$works = "수정";
		break;
	case "AD":
		$sql = " delete from ".$site_prefix."admin where admin_idx = '".$admin_idx."' ";
		$result = sql_query($sql);
		$works = "삭제";
		break;
	case "AI":
		if(!$is_super){
			GetAlert("직원은 아이디를 추가하실 수 없습니다.",$URI);
			break;
		}
		$sql = " insert into ".$site_prefix."admin set admin_id = '".$admin_id."', admin_name = '".$admin_name."', admin_pwd = '".$admin_pwd."', admin_email = '".$admin_email."', admin_level = '".$admin_level."', admin_hp = '".$admin_hp."' ";
		$result = sql_query($sql);
		$works = "추가";
		break;
	case "AM":
		$sql = " update ".$site_prefix."admin set admin_name = '".$admin_name."', admin_pwd = '".$admin_pwd."', admin_email = '".$admin_email."', admin_level = '".$admin_level."', admin_hp = '".$admin_hp."', modify = now() where admin_idx = '".$admin_idx."' ";
		$result = sql_query($sql);
		$works = "수정";
		break;
	case "USE":
	case "PERSON":
	case "EMAIL":
		$sql = " update ".$site_prefix."agree set agree1 = '".$agree1."', agree2 = '".$agree2."', agree3 = '".$agree3."' where idx = '".$idx."' ";
		$result = sql_query($sql);
		$works = "수정";
		break;
}

if($workType == "CI" || $workType == "CM"){
	for ($i=0; $i<count($upload); $i++) 
	{
		$row = sql_fetch(" select count(*) as cnt from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ");
		if ($row[cnt]) 
		{
			// 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
			// 그렇지 않다면 내용만 업데이트 합니다.
			if ($upload[$i][del_check] || $upload[$i][file_source]) 
			{
				$sql = " update $fileTable
							set file_source = '{$upload[$i][file_source]}',
								file_name = '{$upload[$i][file_name]}',
								file_filesize = '{$upload[$i][file_filesize]}',
								file_width = '{$upload[$i][image][0]}',
								file_height = '{$upload[$i][image][1]}',
								file_category = '{$upload[$i][image][2]}',
								RegDate = now()
						  where board_table = '$mode'
							and board_idx = '$idx'
							and file_no = '$i' ";
				sql_query($sql);
			}
		} 
		else 
		{
			$sql = " insert into $fileTable
						set board_table = '$mode',
							board_idx = '$idx',
							file_no = '$i',
							file_source = '{$upload[$i][file_source]}',
							file_name = '{$upload[$i][file_name]}',
							file_filesize = '{$upload[$i][file_filesize]}',
							file_width = '{$upload[$i][image][0]}',
							file_height = '{$upload[$i][image][1]}',
							file_category = '{$upload[$i][image][2]}',
							RegDate = now() ";
			sql_query($sql);
		}
	//echo $sql."<br>";
	}
	// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
	// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
	$sql = " select max(file_no) as max_bf_no from $fileTable where board_table = '$mode' and board_idx = '$idx' ";
	$row = sql_fetch($sql);

	for ($i=(int)$row[max_bf_no]; $i>=0; $i--) 
	{
		$sql2 = " select file_source from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ";
		$row2 = sql_fetch($sql2);
		// 정보가 있다면 빠집니다.
		if ($row2[file_source]) break;

		// 그렇지 않다면 정보를 삭제합니다.
		$sql3 = " delete from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ";
		sql_query($sql3);

	//	echo $sql3;
	}
}

GetAlert("정상적으로 ".$works." 되었습니다.",$URI);
?>
