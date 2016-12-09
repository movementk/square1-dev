<?
include $_SERVER['DOCUMENT_ROOT'].$loc."/board/config/use_db.php"; 
include $dir."/config/common_top.php"; 

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content" || $KEY == "Etc1"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

$file_num = $FileCnt;
$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];

$upload_max_filesize = ini_get('upload_max_filesize');

$Idx = $_REQUEST[BoardIdx];
$UserID = $user[ID];
$UserIP = $_SERVER["REMOTE_ADDR"];
$URI = $_REQUEST["URI"];
if($rp){
	$URI = $rp;
}

if(!$Content){
	$Content = $content;
}

if(empty($UserEmail)) $UserEmail = $Email1."@".$Email2;

if($is_guest){
	$UserPw = sql_password($UserPw);
	$UserEmail = $UserEmail;
} else {
	if($member[UserLevel] > 4){
		$sql = "select admin_pwd from ".$site_prefix."admin where admin_id = '".$member[UserID]."' ";
		$get_pwd = sql_fetch($sql);
		$UserEmail = $get_pwd[admin_mail];
		$UserPw = $get_pwd[admin_pwd];
	} else {
		$get_pwd = get_member($member[UserID],"Password");
		$UserEmail = $get_pwd[Email];
		$UserPw = $get_pwd[Password];
	}
}
if($upw){
	$upw = sql_password($upw);
}

if($password1){
	$upw = sql_password($password1);
}

if($BoardName == "request"){
	$Title = $UserName."님의 대관신청 입니다.";
}

$sql_common = "bd1 = '".$bd1."', bd2 = '".$bd2."', bd3 = '".$bd3."', bd4 = '".$bd4."', bd5 = '".$bd5."', bd6 = '".$bd6."', bd7 = '".$bd7."', bd8 = '".$bd8."', bd9 = '".$bd9."', bd10 = '".$bd10."', border = '".$border."', ";

if(!$HtmlChk) $HtmlChk = 'Y';

$files = array();

$searchVal = "Category=".$Category."&sF=".$sF."&sT=".$sT."&date_idx=".$date_idx."&mode=".$mode."&cat=".urlencode($cat);

$uploaddir = $dir."/upload/".$BoardName."/";

$dir_ck = is_dir($uploaddir);

if($dir_ck != "1"){
	if(!@mkdir("$uploaddir", 0707)){ echo "디렉토리 생성실패"; exit;}
	if(!@chmod("$uploaddir", 0707)){ echo "퍼미션변경 실패"; exit;}
}

// "인터넷옵션 > 보안 > 사용자정의수준 > 스크립팅 > Action 스크립팅 > 사용 안 함" 일 경우의 오류 처리
// 이 옵션을 사용 안 함으로 설정할 경우 어떤 스크립트도 실행 되지 않습니다.
//if (!$_POST[wr_content]) die ("내용을 입력하여 주십시오.");

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
//print_r2($chars_array); exit;

// 가변 파일 업로드
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if ($_POST[bf_file_del][$i]) 
    {
        $upload[$i][del_check] = true;

        $row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$BoardIdx' and file_no = '$i' ");
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
            $row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$BoardIdx' and bf_no = '$i' ");
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

if($_REQUEST["BoardIdx"] != ""){	
	if($board_code=="board_delete"){
		$sql = " select count(*) as cnt from ".$mode." where Ref = '".$Idx."' and ReStep > 0 and ReLevel > 0 ";
		$row = sql_fetch($sql);

		if($row[cnt] > 0){
			GetAlert("답변글이 있으므로 삭제하실 수 없습니다.","BACK");
		}

		$s_sql = "select * from ".$mode." where BoardIdx=".$Idx;
		$s_row = sql_fetch($s_sql);
				
		$UserID=$s_row["UserID"];
		$UserPw = $s_row[UserPw];

		if(empty($s_row["UserID"]) && $is_guest && $upw == $UserPw){
			$f_row = get_file($mode,$Idx);
			for($i=0;$i<$f_row[count];$i++){
				if(!empty($f_row[$i][file_source]) && file_exists($dir."/upload/".$BoardName."/".$f_row[$i]["file_source"])){
					@unlink($dir."/upload/".$BoardName."/".$f_row[$i]["file_source"]);
					$fSQL = "delete from ".$fileTable." where board_table='".$mode."' and board_idx=".$Idx." and file_no=".$i;
					$fResult = sql_query($fSQL);
				}
			}
			
			$SQL = "delete from ".$mode." where BoardIdx=".$Idx;
			$Result = mysql_query($SQL);
		
			if(!$Result){
				GetAlert("Delete Fail","BACK");
			}
		} else if (($user['ID'] && $user['ID']==$UserID) || $is_admin || $upw == $UserPw || (($BoardName != "notice" && $BoardName != "newspaper") && $is_manager)){
			$f_row = get_file($mode,$Idx);
			for($i=0;$i<$f_row[count];$i++){
				if(!empty($f_row[$i][file_source]) && file_exists($dir."/upload/".$BoardName."/".$f_row[$i]["file_source"])){
					@unlink($dir."/upload/".$BoardName."/".$f_row[$i]["file_source"]);
					$fSQL = "delete from ".$fileTable." where board_table='".$mode."' and board_idx=".$Idx." and file_no=".$i;
					$fResult = sql_query($fSQL);
				}
			}
			
			$SQL = "delete from ".$mode." where BoardIdx=".$Idx;
			$Result = mysql_query($SQL);
		
			if(!$Result){
				if($is_member) $URI = "BACK";
				GetAlert("Delete Fail",$URI);
			}
		}else{
			if($is_member) $URI = "BACK";
			GetAlert("Access Denied",$URI);
		}
	}else{
		
		if ($is_guest && !chk_captcha()) {
			GetAlert('자동등록방지 숫자가 틀렸습니다.','BACK');
		}
		if ((!isset($Title) || !trim($Title)) && !$BoardIdx)
			GetAlert("제목을 입력하여 주십시오.","BACK"); 

		$s_sql = "select * from ".$mode." where BoardIdx=".$_REQUEST["BoardIdx"];
		$s_row = sql_fetch($s_sql);
		$upw = $s_row["UserPw"];

		if($is_member){
			if($member["UserID"] == $s_row["UserID"]){ // 본인글이면
				$upw = $UserPw;
				$sql_common .= " UserPw = '".$upw."', ";
			} else {
				if(!$is_admin) GetAlert("본인의 글이 아니면 수정할 수 없습니다.","BACK");
			}
		} else {
			if($s_row["UserID"]) GetAlert("로그인 후 수정하시기 바랍니다.","BACK");
		}
		
		if ($UserPw==$upw || $is_admin){
			$BoardIdx = $_REQUEST["BoardIdx"];

			$SQL = "update ".$mode." set 
							Title='".$Title."', 
							Notice='".$Notice."',
							Content='".$Content."',
							UserName='".$UserName."',
							Secret='".$Secret."',
							$sql_common
							HtmlChk='".$HtmlChk."',
							UserEmail='".$UserEmail."',
							Category='".$Category."',
							Link1='".$Link1."',
							Link2='".$Link2."'
						where
							BoardIdx='".$BoardIdx."'";
		//	echo $SQL;
		//	exit;
			$Result = mysql_query($SQL);
			
			if(!$Result){
				if($is_member) $URI = "BACK";
				GetAlert("Modify Fail",$URI);
			}
			$Idx = $BoardIdx;
		}else{
			if($is_member) $URI = "BACK";
			GetAlert("비밀번호를 확인해 주십시오.",$URI);
		}
	}
	//msg("2");
}else{
	
	if ($is_guest && !chk_captcha()) {
		GetAlert('자동등록방지 숫자가 틀렸습니다.','BACK');
	}
	if ((!isset($Title) || !trim($Title)) && !$BoardIdx)
		GetAlert("제목을 입력하여 주십시오.","BACK"); 

	$SQL = "select max(BoardIdx) from ".$mode;
	$Result = mysql_query($SQL);
	$count  = mysql_num_rows($Result);
	
	if(!$count){
		$board_idx = 1;
	} else {
		$row = mysql_fetch_array($Result);
		$BoardIdx = $row[0] +1;
	}
	if(isset($_REQUEST["Ref"]) && $_REQUEST["Ref"] != ""){
		$Ref      = $_REQUEST["Ref"];
		$ReStep  = $_REQUEST["ReStep"] + 1;
		$ReLevel = $_REQUEST["ReLevel"] + 1;

		$SQL = "update ".$mode." set ReStep = ReStep+1 where Ref=";
		$SQL .= $Ref." AND ReStep > ".$_REQUEST["ReStep"];

		mysql_query($SQL);

		$UserPw = $ppw;
		$is_reply = true;
	} else {
		$Ref      = $BoardIdx;
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
					HtmlChk = '$HtmlChk',
					Link1 = '$Link1',
					Link2 = '$Link2',
					$sql_common
					Ref = '$Ref',
					ReStep = '$ReStep',
					ReLevel = '$ReLevel',
					RegDate = now() ";
	$Result = mysql_query($SQL);
//echo $SQL;
//exit;
	if(!$Result){
		if($is_member) $URI = "BACK";
		GetAlert("Insert Fail",$URI);
		//echo "<script>alert('1');</script>";
	}

	$Idx = get_max($mode,"BoardIdx","");
	
	if($BoardName == "after"){
	//	$add_point = set_point($UserID,"2000","후기게시글 작성");
	}
}

for ($i=0; $i<count($upload); $i++) 
{
    $row = sql_fetch(" select count(*) as cnt from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$i' ");
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
                        and board_idx = '$Idx'
                        and file_no = '$i' ";
            sql_query($sql);
        }
    } 
    else 
    {
        $sql = " insert into $fileTable
                    set board_table = '$mode',
                        board_idx = '$Idx',
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
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$sql = " select max(file_no) as max_bf_no from $fileTable where board_table = '$mode' and board_idx = '$Idx' ";
$row = sql_fetch($sql);

for ($i=(int)$row[max_bf_no]; $i>=0; $i--) 
{
	$sql2 = " select file_source from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$i' ";
    $row2 = sql_fetch($sql2);
    // 정보가 있다면 빠집니다.
    if ($row2[file_source]) break;

    // 그렇지 않다면 정보를 삭제합니다.
	$sql3 = " delete from $fileTable where board_table = '$mode' and board_idx = '$Idx' and file_no = '$i' ";
    sql_query($sql3);
}
//echo "<a href='".$Re_url."?board_code=board_view&board_idx=".$Idx."&workType=".$BoardName."'>고</a>";
//exit;

//err_move("성공하였습니다.",$Re_url."?board_code=board_list&".$searchVal);

if($board_code=="board_delete"){
	GetAlert('삭제되었습니다.',$URI);
	if($URI){
		echo "<script>location.href='".$URI."?".$searchVal."';</script>";
	}
	exit;
} else {
	if($URI){
		if($BoardName == "qna"){
			GetAlert("접수되었습니다. 빠른시간내에 답변해드리겠습니다.",$URI.$Idx);
		} else {
			if(($BoardName == "counsel" || $BoardName == "account") && $is_reply){
				GetAlert("","/board/module/incboard/sms_send.php?mode=".$mode."&Ref=".$Ref."&URI=".urlencode($URI."?board_code=board_view&board_idx=".$Idx));
			} else {
				echo "<script>location.href='".$URI."?board_code=board_view&board_idx=".$Idx."&cat=".urlencode($cat)."';</script>";
			}
		}
	}
	exit;
}
?>