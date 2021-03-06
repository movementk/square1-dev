<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";
$mode = $site_prefix."banner";
$ym = date("ym",time());
$uploaddir = $dir."/upload/banner/";
$dir_ck = is_dir($uploaddir);
if($dir_ck != "1"){
	if(!@mkdir("$uploaddir", 0707)){ echo "디렉토리 생성실패1"; exit;}
	if(!@chmod("$uploaddir", 0707)){ echo "퍼미션변경 실패1"; exit;}
}

//$sql_common = " ptop = '".$ptop."', pleft ='".$pleft."', ";

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
// 가변 파일 업로드
$file_upload_msg = "";
$upload = array();
for ($i=0; $i<count($_FILES[bf_file][name]); $i++) 
{
    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if ($_POST[bf_file_del][$i]) 
    {
        $upload[$i][del_check] = true;

        $row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$idx' and file_no = '$i' ");
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
            $row = sql_fetch(" select file_source from $fileTable where board_table = '$mode' and board_idx = '$idx' and bf_no = '$i' ");
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

switch($workType){
	case "D":
		$sql = " delete from ".$mode." where idx = '".$idx."' ";
		$result = sql_query($sql);
		$work = "삭제";
		break;
	case "M":
		$sql = " update ".$mode."
						set 
							bloc = '".$bloc."',
							blink = '".$blink."',
							border = '".$border."', 
							btarget = '".$btarget."', 
							$sql_common 
							bstatus = '".$bstatus."'
						where
							idx = '".$idx."' ";
		$result = sql_query($sql);
		if(!$result) err_back('modify error');

		$work = "수정";
		break;
	case "I":
		$sql = " insert into ".$mode."
						set
							bloc = '".$bloc."',
							blink = '".$blink."',
							border = '".$border."',
							btarget = '".$btarget."',
							$sql_common
							bstatus = '".$bstatus."'";

		$result = sql_query($sql);
		if(!$result) err_back('insert error');

		$idx = get_max($mode,"idx");
		
		$work = "입력";
		break;
}

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

if($bloc){
	$URI .= $bloc;
}

GetAlert("정상적으로 ".$work."하였습니다.",$URI);
?>
