<?
$config_dir = $_SERVER["DOCUMENT_ROOT"]."/board/config";
//val1 값이 있다면 val1 리턴, 없으면 val2 리턴
function DfVal($val1, $val2) {
	if ($val1 == true) return $val1;
	else return $val2;
}
// str1과 str2값이 같다면 val1 리턴, 그렇지 않다면 val2 리턴
function DfVal2($str1, $str2, $val1, $val2) {
	if (strcmp($str1,$str2) == 0) return $val1;
	else return $val2;

}
//str1 값이 있다면 val1리턴, 그렇지 않다면 val2 리턴
function DfVal3($str1, $val1, $val2) {
	if (empty($str1)) return $val2;
	else return $val1;
}
//str1과 str2 값이 같다면 val1 리턴
function DfVal4($str1, $str2, $val1) {
	if (strcmp($str1,$str2) == 0) return $val1;
}
//str1과 str2 값이 같다면 val1을 리턴, 그렇지 않다면 str1 리턴
function DfVal5($str1, $str2, $val1) {
	if (strcmp($str1,$str2) == 0) return $val1;
	else						  return $str1;
}
function GetAlert($msg, $url="", $subUrl="", $option="") {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script>";
	if ($msg == true ) {
		echo "alert(\"".$msg."\");";
	}

	if (empty($url) == false ) {
		switch ($url) {
			case "BACK"     : echo "history.back();"; break;
			case "CLOSE"    : echo "self.close();"; break;
			case "C_PARENT" : echo "if(parent == window) history.back();"; break;
			case "U_PARENT" : echo "parent.document.location.href='".$subUrl."';"; break;
			case "R_PARENT" : echo "parent.document.location.reload();"; break;
			case "RELOAD"   : echo "document.location.reload();"; break;
			case "O_RELOAD" : echo "opener.document.location.reload();"; break;
			case "WINDOW"   : echo "window.open(".$option.");"; break;
			case "WINDOW_C" : echo "window.open(".$option.");self.close();"; break;
			case "STOP"     : echo ""; break;
			case "SCRIPTS"  : echo $subUrl; break;
			default         : echo "document.location.replace(\"$url\");"; break;
		}
	}
	echo "</script>";

	if(empty($url)==false) exit;
}
function msg($msg){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
  echo("
  <script>
    alert('$msg');
  </script>
  ");
  exit;
}
function win_close($msg){
  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>
    alert('$msg');
	self.close();
  </script>
  ");
  exit;
}
// 에러 메시지 후 페이지 뒤로
function err_back($msg){
  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>
    alert('$msg');
    history.back();
  </script>
  ");
  exit;
}
//알럿후 페이지 이동
function err_move($msg,$url){
  echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>alert('$msg');
  location.replace('$url');
  </script>
  ");
  exit;
}
//페이지 이동
function move_to($url){
  echo("
  <script>
    location.replace('$url');
  </script>
  ");
  exit;
}

function msg_top_reload($msg){
  echo("
  <script>alert('$msg');
  top.location.reload();
  </script>
  ");
  exit;
}

function msg_top_move($msg,$url){
  echo("
  <script>alert('$msg');
  top.location.href='$url';
  </script>
  ");
  exit;
}
function msg_top_move_to($url){
  echo("
  <script>
  top.location.href='$url';
  </script>
  ");
  exit;
}

/******************************* confirm - start ****************************************/
function msg_confirm($msg){
	echo("
	<script>alert('$msg');</script>
	");
	exit;
}
/******************************* confirm - end ******************************************/

/*
*************************   stripslashes, addslashes, trim   *************************
*/
function adds_trim($item) {
	return addslashes(trim($item));
}// end func

function strip_trim($item) {
	return stripslashes(trim($item));
}// end func

function strip_tag($item) {	
	return strip_tags(trim($item));
}// end func
function saveStr($str)
{
	//return addslashes($str);
	return $str;
}


//문자열 자르기 
function cut_string($str, $len , $tail="...", $char="UTF-8") { 

    $s = substr($str, 0, $len);
    $cnt = 0;
    for ($i=0; $i<strlen($s); $i++)
        if (ord($s[$i]) > 127)
            $cnt++;
    if (strtoupper($char) == 'UTF-8')
        $s = substr($s, 0, $len - ($cnt % 3));
    else
        $s = substr($s, 0, $len - ($cnt % 2));
    if (strlen($s) >= strlen($str))
        $tail = "";

	return $s.$tail; 
} 

function utf8_strcut( $str, $size, $suffix='...' )
{
        $substr = substr( $str, 0, $size * 2 );
        $multi_size = preg_match_all( '/[\x80-\xff]/', $substr, $multi_chars );

        if ( $multi_size > 0 )
            $size = $size + intval( $multi_size / 3 ) - 1;

        if ( strlen( $str ) > $size ) {
            $str = substr( $str, 0, $size );
            $str = preg_replace( '/(([\x80-\xff]{3})*?)([\x80-\xff]{0,2})$/', '$1', $str );
            $str .= $suffix;
        }

        return $str;
}

function cut_mb_string($str,$len,$tail="..."){
	if($len >= strlen($str)){
		return $str;
	}
	if(strlen($str)>$len){
		for($i=0;$i<$len;$i++) if(ord($str[$i])>127) $i++;
		$str = mb_substr($str,0,$i,"utf8");

	} else {
		$tail = "";
	}
	return $str.$tail;
}
 

function get_post($exception = "",$view = "false"){

  $ex = explode("|",$exception);
  $count = count($ex);

  if($count > 0){
    for($i=0;$i<$count;$i++){
      $ext[$i+1] = $ex[$i];
    }
  }

  foreach($_GET as $a => $b){
    if($count > 0){
      $chk = array_search($a,$ext);
      if(!$chk){
        $info .= "&".$a."=".$b;
        if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
      }    
    }else{
      $info .= "&".$a."=".$b;
      if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
    }
  }

  foreach($_POST as $a => $b){
    if($count > 0){
      $chk = array_search($a,$ext);
      if(!$chk){
        $info .= "&".$a."=".$b;
        if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
      }    
    }else{
      $info .= "&".$a."=".$b;
      if($view == "true"){
          echo $a." => ".$b."<Br>";
        }
    }
  }
  
  return $info;
}
//검색 후 글자색 변환
function find_replace($word,$search,$color= "#FF0000"){
  $info = str_replace($search,"<font color='$color'>$search</font>",$word);
  return $info;
}

// 테이블 유효성 검사---
function istable($str, $dbname='') {
  global $config_dir;
	if(!$dbname) {
	$f=@file($config_dir."config.php") or err_move("config.php파일이 없습니다.<br>DB설정을 먼저 하십시요","setup.php");
	for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
	  $dbname=$f[4];
  }
	$result = mysql_list_tables($dbname) or error(mysql_error(),"");
	$i=0;

  while ($i < mysql_num_rows($result)) {
	  if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}
//--------------------------

function showText($string){
# global $string;
	$c_text = $string;              
	$c_text = stripslashes($c_text);

	if (! eregi("a href", $c_text) && ! eregi("src", $c_text))
	{
		if (eregi("http://", $c_text)):
			$c_text = eregi_replace( "http://([a-z0-9\_\-\./~@?=%&amp;]+)", 
                                   " <a href=\"http://\\1\" TARGET=\"_BLANK\">http://\\1</a> ", 
                                   $c_text);
		endif;
             
		if (eregi("ftp://", $c_text)):
			$c_text = eregi_replace( "ftp://([a-z0-9\_\-\./~@?=%&amp;]+)", 
                                   " <a href=\"ftp://\\1\" TARGET=\"_BLANK\">ftp://\\1</a> ", 
                                   $c_text);
		endif;
             
		if (eregi("telnet://", $c_text)):
			$c_text = eregi_replace( "telnet://([a-z0-9\_\-\./~@?=%&amp;]+)", 
                                   " <a href=\"telnet://\\1\" TARGET=\"_BLANK\">telnet://\\1</a> ", 
                                   $c_text);
		endif;
             
		if (eregi("news://", $c_text)):
			$c_text = eregi_replace( "news://([a-z0-9\_\-\./~@?=%&amp;]+)", 
                                   " <a href=\"news://\\1\" TARGET=\"_BLANK\">news://\\1</a> ", 
                                   $c_text);
		endif;
             
		if (eregi("gopher://", $c_text)):
			$c_text = eregi_replace( "gopher://([a-z0-9\_\-\./~@?=%&amp;]+)", 
                                   " <a href=\"gopher://\\1\" TARGET=\"_BLANK\">gopher://\\1</a> ", 
                                   $c_text);
		endif;
             
			$c_text = eregi_replace( "([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", 
                               " <a href=\"mailto:\\1@\\2\">\\1@\\2</a> ", 
                               $c_text);
		}

         
		if (! eregi("&lt;?table", $c_text) && ! eregi("&lt;?Table", $c_text) && ! eregi("&lt;?TABLE", $c_text) && ! eregi("<table", $c_text) && ! eregi("<Table", $c_text) && ! eregi("<TABLE", $c_text))
		{
              
			$c_text = eregi_replace("\t","        ",$c_text);
			$c_text = eregi_replace("^ ","&nbsp;",$c_text);
			$c_text = eregi_replace("  "," &nbsp;",$c_text);
          
			$c_text = eregi_replace("\r\n","<br>",$c_text);
			$c_text = eregi_replace("\n","<br>",$c_text);
			$c_text = eregi_replace("\r\n\r\n","<p>",$c_text);
		}

	$string = $c_text;  
	return $string;	
}

//이미지 사이즈 조정
function image_re($img,$w=0,$h=0){
  $img_size=@GetImageSize("$img"); 
  
  $width = $img_size[0];
  $height = $img_size[1];
  
  if($img_size[0] > $w){
    $height = ($w * $height)/$width;
    $width = $w;
  }

  if($height > $h){
    $width = ($h * $width)/$height;
    $height = $h;
  }

  $value[0] = $img;
  $value[1] = $width;
  $value[2] = $height;
  return $value;
}



function create_thumbnail($src_file,$save_file, $format='jpg',$max_width = false, $max_height = false) { 
        //max_width 가 정해지지 않았으면 100이 디폴트 
        if(!$max_width) $max_width = 100; 
         
        //src_file을 체크해본다. 
        /* 
            1 : IMAGETYPE_GIF 
            2 : IMAGETYPE_JPEG 
            3 : IMAGETYPE_PNG 
        */ 
        if(file_exists($src_file)) { 
            $img_info = getimagesize($src_file); 
                         
            switch ($img_info[2]) { 
                case 1 : //GIF 이미지 
                    $image = imagecreatefromgif($src_file); 
                    break; 
                case 2 : //JPG 이미지 
                    $image = imagecreatefromjpeg($src_file); 
                    break; 
                case 3 : //PNG 이미지 
                    $image = imagecreatefrompng($src_file); 
                    break; 
            } 

            //실제 이미지의 사이즈 얻기 
            $img_width = $img_info[0]; 
            $img_height = $img_info[1]; 

			if($img_width > $max_width or $img_height > $max_height){
				if(($img_width/$max_width) == ($img_height/$max_height))
				{//원본과 썸네일의 가로세로비율이 같은경우
					$max_width=$max_width;
					$max_height=$max_height;
				}
				elseif(($img_width/$max_width) < ($img_height/$max_height))
				{//세로에 기준을 둔경우
					$max_width=ceil($max_height*($img_width/$img_height));
					$max_height=$max_height;
				}
				else{//가로에 기준을 둔경우
					$max_width=$max_width;
					$max_height=ceil($max_width*($img_height/$img_width));
				}//그림사이즈를 비교해 원하는 썸네일 크기이하로 가로세로 크기를 설정합니다.

			}else{
					$max_width=$img_width;
					$max_height=$img_height;
			}

             
            //새로운 트루타입 이미지 생성 
            if($format=='jpg' || 'png') { 
                $thumb_img = @imagecreatetruecolor($max_width,$max_height); 
                //트루컬러 색상 인덱스 만들기 
                @Imagecolorallocate($thumb_img,255,255,255); 
            } else if($format=='gif') { 
                $thumb_img = imagecreate($max_width,$max_height); 
                //트루컬러 색상 인덱스 만들기 
                @Imagecolorallocate($thumb_img,16,16,16); 
            } 

             
            //thumbnail 이미지 생성 
            @imagecopyresampled($thumb_img,$image,0,0,0,0,$max_width,$max_height,imagesx($image),imagesy($image)); 

            //지정된 포맷으로 이미지 저장 
            if($img_info[2]==1) { 
                //gif로 저장 
                @imageinterlace($thumb_img); 
                @imagegif($thumb_img,$save_file); 
            } else if($img_info[2]==2) { 
                @imageinterlace($thumb_img); 
                @imagejpeg($thumb_img,$save_file); 
            } else if($img_info[2]==3) { 
                @imageinterlace($thumb_img); 
                @imagepng($thumb_img,$save_file); 
            } 
             
            @imagedestroy($thumb_img); 
            @imagedestroy($image); 
            return true; 
        } 
        return false; 
    } 



/************************************* print_r2 - By GOM *********************************************/
// 변수 또는 배열의 이름과 값을 얻어냄. print_r() 함수의 변형
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = preg_replace("/ /", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
}
/*****************************************************************************************************/


/*********************************** latest - By GOM *************************************************/
function latest($board, $rows=10, $subject_len=40, $latest_skin_file, $latest_loc, $options="")
{
	global $site_prefix, $fileTable, $dir;

	$latest_skin_path = $dir."/module/inclatest";
	
    $board_table = $site_prefix."board_".$board; // 게시판 테이블 전체이름

    $sql = " select * from $board_table where 1 and ReLevel = '0' ";

	if($options){
		$sql .= $options;
	}
	
	$sql.= "order by RegDate desc limit 0, $rows ";

    $result = mysql_query($sql);
	$latest_list = array();
    for ($i=0; $row = mysql_fetch_array($result); $i++) {
        $latest_list[$i] = $row;
		$latest_list[$i][subject] = cut_string($latest_list[$i][Title],$subject_len,"..");
	}

    ob_start();
    include "$latest_skin_path/$latest_skin_file.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
} 

/*****************************************************************************************************/
function get_text($str)
{
    /* 3.22 막음 (HTML 체크 줄바꿈시 출력 오류때문)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */
   
    //$source[] = "/</";
    //$target[] = "&lt;";
    //$source[] = "/>/";
    //$target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}


function sql_password($value)
{
    // mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
    // mysql 4.1x 이상 버전에서는 password() 함수의 결과가 41bytes
    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];
}

function get_member($mb_id, $fields='*')
{
	global $memberdb;
    return sql_fetch(" select $fields from $memberdb where UserID = TRIM('$mb_id') ");
}

function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;
}

function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    $row = sql_fetch_array($result);
    return $row;
}

function sql_fetch_array($result)
{
    $row = @mysql_fetch_assoc($result);
    return $row;
}

function get_agree($num,$option=""){
	global $site_prefix;
	$dbTable = $site_prefix."agree";
	$agnum = "agree".$num;
	if($option != ""){
		$sql_common = $option;
	}
	$row = sql_fetch("select $agnum from $dbTable where 1=1 $sql_common order by idx desc limit 0, 1");
	return $row[$agnum];
}

function get_popup(){
	global $site_prefix;
	$today = date("Y-m-d H:i:s",time());
	$sql = " select * from ".$site_prefix."popup where start_date <= '".$today."' and end_date >= '".$today."' and use_ck = 'Y' ";

	$result = sql_query($sql);
	$board = array();
	for($i=0;$row = sql_fetch_array($result);$i++){
		$board[$i] = $row;
		$board[$i][file] = get_file($site_prefix."popup",$board[$i][Idx]);
		$left = $row["pleft"];
		$top = $row["ptop"];
	//	$left = 0;
		$ym = date("ym",strtotime($board[$i][RegDate]));
	//	if($i > 0){
	//		$left = $board[$i-1][file][0][image_width];
	//	}

		if($board[$i][linkURL]){
			if(!preg_match("/http\:\/\//i",$board[$i][linkURL])){
				$board[$i][linkURL] = "http://".$board[$i][linkURL];
			}

			$link = "<a href='".$board[$i][linkURL]."' target='".$board[$i][tar]."'>";
		}
		
		$pop_str .= "
		<div id='pop".$board[$i][Idx]."' class='popbox' style='position:absolute;z-index:9999999999;left:".$left."px;top:".$top."px;background:#251f15;display:none;'>
			".$link."<img src='/board/upload/popup/".$board[$i][file][0][file_source]."' width='".$board[$i][file][0][image_width]."' height='".$board[$i][file][0][image_height]."' title='".$board[$i][Title]."' alt='".$board[$i][Title]."'></a>
			<p style='text-align:right;padding-right:5px;font-size: 11px;color: #ffffff;'><input type='checkbox' id='view_yn".$board[$i][Idx]."' name='view_yn' value='1' onclick=\"javascript:close_pop('".$board[$i][Idx]."');\"> 오늘 하루 이 창을 열지 않습니다. <a href=\"javascript:pop_cl('".$board[$i][Idx]."');\">[Close]</a></p>
		</div>
		<script>
		view_pop('".$board[$i][Idx]."');
		</script>
		\n";
	}

	return $pop_str;
}

function get_popup2(){
	global $site_prefix;
	$today = date("Y-m-d H:i:s",time());
	$sql = " select count(*) as cnt from ".$site_prefix."popup where start_date <= '".$today."' and end_date >= '".$today."' and use_ck = 'Y' ";
	$row = sql_fetch($sql);
	if($row["cnt"] > 0){
		echo "view_pop('".$row["Idx"]."');";
	}
}

function search_font($stx, $str)
{

    // 문자앞에 \ 를 붙입니다.
    $src = array("/", "|");
    $dst = array("\/", "\|");

    if (!trim($stx)) return $str;

    // 검색어 전체를 공란으로 나눈다
    $s = explode(" ", $stx);

    // "/(검색1|검색2)/i" 와 같은 패턴을 만듬
    $pattern = "";
    $bar = "";
    for ($m=0; $m<count($s); $m++) {
        if (trim($s[$m]) == "") continue;
        // 태그는 포함하지 않아야 하는데 잘 안되는군. ㅡㅡa
        //$pattern .= $bar . '([^<])(' . quotemeta($s[$m]) . ')';
        //$pattern .= $bar . quotemeta($s[$m]);
        //$pattern .= $bar . str_replace("/", "\/", quotemeta($s[$m]));
        $tmp_str = quotemeta($s[$m]);
        $tmp_str = str_replace($src, $dst, $tmp_str);
        $pattern .= $bar . $tmp_str . "(?![^<]*>)";
        $bar = "|";
    }
    // 지정된 검색 폰트의 색상, 배경색상으로 대체
    $replace = "<span style='background-color:yellow; color:#e00000;'>\\1</span>";

    return preg_replace("/($pattern)/i", $replace, $str);
}

// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_file($mode, $idx)
{
    global $site_prefix, $fileTable, $dir, $configDir;

	$board_array = explode("_",$mode);
	$board_cnt = count($board_array);
	$BoardName = $board_array[$board_cnt-1];

	$file["count"] = 0;
	$sql = " select * from $fileTable where board_table = '$mode' and board_idx = '$idx' order by file_no ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))
	{
		$no = $row[file_no];
		$file[$no][href] = "/board/config/download.php?fid=".$row[Idx];
		// 4.00.11 - 파일 path 추가
		$file[$no][path] = "/board/upload/{$BoardName}";
		//$file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
		$file[$no][datetime] = $row[RegDate];
		$file[$no][file_source] = addslashes($row[file_source]);
		//$file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
		$file[$no][file_name] = $row[file_name];
		$file[$no][image_width] = $row[file_width] ? $row[file_width] : 640;
		$file[$no][image_height] = $row[file_height] ? $row[file_height] : 480;
		$file[$no][image_type] = $row[file_category];
		$file["count"]++;
	}

	return $file;
}

function get_max($mode,$fld,$sql_common=""){
	global $site_prefix;
	
	$sql = " select max(".$fld.") as max_fld from ".$mode." where 1=1 $sql_common ";
	$row = sql_fetch($sql);

	$max = $row[max_fld];

	return $max;
}

function conv_content($content, $html)
{
    if ($html)
    {
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        if ($html == 2) { // 자동 줄바꿈
            $source[] = "/\n/";
            $target[] = "<br/>";
        }

        // 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace($source, $target, $content);
        $content = bad_tag_convert($content);

        // XSS (Cross Site Script) 막기
        // 완벽한 XSS 방지는 없다.
        // 081022 : CSRF 방지
        //$content = preg_replace("/(on)(abort|blur|change|click|dblclick|dragdrop|error|focus|keydown|keypress|keyup|load|mousedown|mousemove|mouseout|mouseover|mouseup|mouseenter|mouseleave|move|reset|resize|select|submit|unload)/i", "$1<!-- XSS Filter -->$2", $content);
        //$content = preg_replace("/(on)([^\=]+)/i", "&#111;&#110;$2", $content);
        $content = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $content);
        $content = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $content);
        $content = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $content);
        $content = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $content);
        //$content = preg_replace("/(ex)(pression)/i", "&#101&#120;$2", $content);
        $content = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $content);

        // 이런 경우를 방지함 <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        $content = preg_replace("#\/\*.*\*\/#iU", "", $content);

        $pattern = "";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(x|&#(x78|120);?)";
        $pattern .= "(p|&#(x70|112);?)";
        $pattern .= "(r|&#(x72|114);?)";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(i|&#(x6a|105);?)";
        $pattern .= "(o|&#(x6f|111);?)";
        $pattern .= "(n|&#(x6e|110);?)";
        $content = preg_replace("/".$pattern."/i", "__EXPRESSION__", $content);

    }
    else // text 이면
    {
        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $content = html_symbol($content);

        // 공백 처리
		//$content = preg_replace("/  /", "&nbsp; ", $content);
		$content = str_replace("  ", "&nbsp; ", $content);
		$content = str_replace("\n ", "\n&nbsp;", $content);

        $content = get_text($content, 1);

        $content = url_auto_link($content);
    }

	

    return $content;
}

function bad_tag_convert($code)
{
    global $board;
    global $users;

    if ($users[memberLv] > 10 && $users[memberID] != $board[memberID]) {
        //$code = preg_replace_callback("#(\<(embed|object)[^\>]*)\>(\<\/(embed|object)\>)?#i",
        // embed 또는 object 태그를 막지 않는 경우 필터링이 되도록 수정
        $code = preg_replace_callback("#(\<(embed|object)[^\>]*)\>?(\<\/(embed|object)\>)?#i",
                    create_function('$matches', 'return "<div class=\"embedx\">보안문제로 인하여 관리자 아이디로는 embed 또는 object 태그를 볼 수 없습니다. 확인하시려면 관리권한이 없는 다른 아이디로 접속하세요.</div>";'),
                    $code);
    }

    //return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>/i", "&lt;$1$2$3&gt;", $code);
    // script 나 iframe 태그를 막지 않는 경우 필터링이 되도록 수정
    return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>?/i", "&lt;$1$2$3&gt;", $code);
}

function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}

function url_auto_link($str)
{
    // 속도 향상 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'>\\2</A>", $str);
    //$str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    // 100825 : () 추가
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    // 이메일 정규표현식 수정 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}

function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="") 
{
    // 메일발송 사용을 하지 않는다면
	$g4['charset'] = "UTF-8";
    $fname   = "=?$g4[charset]?B?" . base64_encode($fname) . "?=";
    $subject = "=?$g4[charset]?B?" . base64_encode($subject) . "?=";
    //$g4[charset] = ($g4[charset] != "") ? "charset=$g4[charset]" : "";

    $header  = "Return-Path: <$fmail>\n";
    $header .= "From: $fname <$fmail>\n";
    $header .= "Reply-To: <$fmail>\n";
    if ($cc)  $header .= "Cc: $cc\n";
    if ($bcc) $header .= "Bcc: $bcc\n";
    $header .= "MIME-Version: 1.0\n";
    //$header .= "X-Mailer: SIR Mailer 0.91 (sir.co.kr) : $_SERVER[SERVER_ADDR] : $_SERVER[REMOTE_ADDR] : $g4[url] : $_SERVER[PHP_SELF] : $_SERVER[HTTP_REFERER] \n";
    // UTF-8 관련 수정
    $header .= "X-Mailer: Mailer : $_SERVER[SERVER_ADDR] : $_SERVER[REMOTE_ADDR] : $url : $_SERVER[PHP_SELF] : $_SERVER[HTTP_REFERER] \n";

    if ($file != "") {
        $boundary = uniqid("http://".$_SERVER['HTTP_HOST']."/");

        $header .= "Content-type: MULTIPART/MIXED; BOUNDARY=\"$boundary\"\n\n";
        $header .= "--$boundary\n";
    }

    if ($type) {
        $header .= "Content-Type: TEXT/HTML; charset=utf-8\n";
        if ($type == 2)
            $content = nl2br($content);
    } else {
        $header .= "Content-Type: TEXT/PLAIN; charset=utf-8\n";
        $content = stripslashes($content);
    }
    $header .= "Content-Transfer-Encoding: BASE64\n\n";
    $header .= chunk_split(base64_encode($content)) . "\n";

    
    @mail($to, $subject, "", $header);
}

// 파일 첨부시
/*
$fp = fopen(__FILE__, "r");
$file[] = array(
    "name"=>basename(__FILE__),
    "data"=>fread($fp, filesize(__FILE__)));
fclose($fp);
*/

// 파일을 첨부함
function attach_file($filename, $file)
{
    $fp = fopen($file, "r");
    $tmpfile = array(
        "name" => $filename,
        "data" => fread($fp, filesize($file)));
    fclose($fp);
    return $tmpfile;
}

// 메일 유효성 검사
// core PHP Programming 책 참고
// hanmail.net , hotmail.com , kebi.com 등이 정상적이지 않음으로 사용 불가
function verify_email($address, &$error)
{
    global $g4;

    $WAIT_SECOND = 3; // ?초 기다림

    list($user, $domain) = explode("@", $address);

    // 도메인에 메일 교환기가 존재하는지 검사
    if (checkdnsrr($domain, "MX")) {
        // 메일 교환기 레코드들을 얻는다
        if (!getmxrr($domain, $mxhost, $mxweight)) {
            $error = "메일 교환기를 회수할 수 없음";
            return false;
        }
    } else {
        // 메일 교환기가 없으면, 도메인 자체가 편지를 받는 것으로 간주
        $mxhost[] = $domain;
        $mxweight[] = 1;
    }

    // 메일 교환기 호스트의 배열을 만든다.
    for ($i=0; $i<count($mxhost); $i++)
        $weighted_host[($mxweight[$i])] = $mxhost[$i];
    ksort($weighted_host);

    // 각 호스트를 검사
    foreach($weighted_host as $host) {
        // 호스트의 SMTP 포트에 연결
        if (!($fp = @fsockopen($host, 25))) continue;

        // 220 메세지들은 건너뜀
        // 3초가 지나도 응답이 없으면 포기
        socket_set_blocking($fp, false);
        $stoptime = $g4[server_time] + $WAIT_SECOND;
        $gotresponse = false;

        while (true) {
            // 메일서버로부터 한줄 얻음
            $line = fgets($fp, 1024);

            if (substr($line, 0, 3) == "220") {
                // 타이머를 초기화
                $stoptime = $g4[server_time] + $WAIT_SECOND;
                $gotresponse = true;
            } else if ($line == "" && $gotresponse)
                break;
            else if ($g4[server_time] > $stoptime)
                break;
        }

        // 이 호스트는 응답이 없음. 다음 호스트로 넘어간다
        if (!$gotresponse) continue;

        socket_set_blocking($fp, true);

        // SMTP 서버와의 대화를 시작
        fputs($fp, "HELO $_SERVER[SERVER_NAME]\r\n");
        echo "HELO $_SERVER[SERVER_NAME]\r\n";
        fgets($fp, 1024);

        // From을 설정
        fputs($fp, "MAIL FROM: <info@$domain>\r\n");
        echo "MAIL FROM: <info@$domain>\r\n";
        fgets($fp, 1024);

        // 주소를 시도
        fputs($fp, "RCPT TO: <$address>\r\n");
        echo "RCPT TO: <$address>\r\n";
        $line = fgets($fp, 1024);

        // 연결을 닫음
        fputs($fp, "QUIT\r\n");
        fclose($fp);

        if (substr($line, 0, 3) != "250") {
            // SMTP 서버가 이 주소를 인식하지 못하므로 잘못된 주소임
            $error = $line;
            return false;
        } else
            // 주소를 인식했음
            return true;

    }
    
    $error = "메일 교환기에 도달하지 못하였습니다.";
    return false;
}

function get_naver_map_api($address){
	global $naver_map_api_key;
	$snoopy=new snoopy; 
	$snoopy->fetch("http://openapi.map.naver.com/api/geocode.php?key=".$naver_map_api_key."&encoding=utf-8&coord=latlng&query=".trim(urlencode($address))); //외환은행 
	$content = $snoopy->results;

	function GetHTMLContent($strTag , $content){
		$qur =sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is", $strTag,$strTag);
		preg_match($qur,  $content , $match);
		return $match[1];
	}

	function tagListData($strTag, $content){
		$reg =  sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is" , $strTag, $strTag) ;
		preg_match_all($reg , $content, $matches , PREG_PATTERN_ORDER );
		return $matches[1];
	}

	$exlist1 = tagListData('point' , $content);
	$get_x = tagListData('x',$exlist1[0]);
	$get_y = tagListData('y',$exlist1[0]);

	$str[0] = $get_x[0];
	$str[1] = $get_y[0];

	return $str;
}
function get_daum_map_api($address){
	global $naver_map_api_key;
	$snoopy=new snoopy; 
	$snoopy->fetch("http://apis.daum.net/local/geo/addr2coord?apikey=".$daum_map_api_key."&q=".trim(urlencode($address))); //외환은행 
	$content = $snoopy->results;

	function GetHTMLContent($strTag , $content){
		$qur =sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is", $strTag,$strTag);
		preg_match($qur,  $content , $match);
		return $match[1];
	}

	function tagListData($strTag, $content){
		$reg =  sprintf("/\<%s[^>]*\>(.+?)\<\/%s\>/is" , $strTag, $strTag) ;
		preg_match_all($reg , $content, $matches , PREG_PATTERN_ORDER );
		return $matches[1];
	}

	$exlist1 = tagListData('point' , $content);
	$get_x = tagListData('lat',$exlist1[0]);
	$get_y = tagListData('lng',$exlist1[0]);

	$str[0] = $get_x[0];
	$str[1] = $get_y[0];

	return $str;
}

function get_paging_admin($write_pages, $cur_page, $total_page, $url, $add=""){ //보여줄 개수, 현재페이지, 총페이지, 주소, 추가
    $str = "";
    if ($cur_page > 1) {
        $str .= "<li class='page_f'><a href='" . $url . "1{$add}' class='page_a'>처음</a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= "<li class='page_p'><a href='" . $url . ($start_page-1) . "{$add}' class='page_a'>이전</a></li>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li class='page_s'><a href='$url$k{$add}' class='page_a'>$k</a></li>";
            else
                $str .= "<li class='page_s page_o'><a href='javascript:;' class='page_a'>$k</a></li>";
        }
    }

    if ($total_page > $end_page) $str .= "<li class='page_n'><a href='" . $url . ($end_page+1) . "{$add}' class='page_a'>다음</a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= "<li class='page_l'><a href='$url$total_page{$add}' class='page_a'>맨끝</a></li>";
    }
    $str .= "";

    return $str;
}

function get_paging($write_pages, $cur_page, $total_page, $url, $add=""){ //보여줄 개수, 현재페이지, 총페이지, 주소, 추가
    $str = "";
    if ($cur_page > 1) {
        $str .= "<li><a href='" . $url . "1{$add}' aria-label='first-Previous' class='ap'><i aria-hidden='true' class='icon-angle-double-left'></i></a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;
    if ($start_page > 1) $str .= "<li><a href='" . $url . ($start_page-1) . "{$add}' aria-label='Previous' class='ap ap-mr'><i aria-hidden='true' class='icon-angle-left'></i></a></li>";
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li><a href='$url$k{$add}'>$k</a></li>";
            else
                $str .= "<li class='active'><a href='javascript:;'>$k</a></li>";
        }
    }

    if ($total_page > $end_page) $str .= "<li><a href='" . $url . ($end_page+1) . "{$add}' aria-label='Next' class='ap'><i aria-hidden='true' class='icon-angle-right'></i></a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= "<li><a href='$url$total_page{$add}' aria-label='end-Next' class='ap'><i aria-hidden='true' class='icon-angle-double-right'></i></a></li>";
    }
    $str .= "";

    return $str;
}

function get_paging_mobile($write_pages, $cur_page, $total_page, $url, $add=""){ //보여줄 개수, 현재페이지, 총페이지, 주소, 추가
    $str = "";
    if ($cur_page > 1) {
        $str .= "<li class='pt5'><a href='" . $url . "1{$add}'>처음</a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= "<li class='pt5 pl5'><a href='" . $url . ($start_page-1) . "{$add}'>이전</a></li>";
	$str .= "<li class='pl10 pr10'><ul class='page_num'>";
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li class='off'><a href='$url$k{$add}' class='pf'>$k</a></li>";
            else
                $str .= "<li class='on'><a href='javascript:;' class='pn'>$k</a></li>";
        }
    }
	$str .= "</ul></li>";

    if ($total_page > $end_page) $str .= "<li class='pt5'><a href='" . $url . ($end_page+1) . "{$add}'>다음</a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= "<li class='pt5 pl5'><a href='$url$total_page{$add}'>맨끝</a></li>";
    }
    $str .= "";

    return $str;
}

function get_sms_cont($field){
	global $site_prefix;

	$sql = " select * from ".$site_prefix."sms_cont where 1=1 order by RegDate desc limit 0, 1 ";
	$row = sql_fetch($sql);

	return $row[$field];
}

function sms_send($recv_num,$cont){
	global $site_prefix;
	$sms_contents = get_sms_cont($cont);
	$send_number = get_sms_cont("smskey");
	$receive_number = preg_replace("/[^0-9]/", "", $recv_num); // 수신자번호
	$send_number = preg_replace("/[^0-9]/", "", $send_number); // 발신자번호

	$sms_insert = sql_query(" insert into ".$site_prefix."sms set send_num = '".get_sms_cont("smskey")."', recv_num = '".$recv_num."', s_content = '".$sms_contents."', s_type = 'new', RegDate = now()");
	$smsidx = get_max($site_prefix."sms","send_num","");

	$arrCallNo = $receive_number;
	$strCallBack = $send_number;
	$strMsg = $sms_contents;
	$NOWLATER = "NOW";
	$rsvYear = date("Y",time());
	$rsvMonth = date("m",time());
	$rsvDay = date("d",time());
	$rsvHour = date("H",time());
	$rsvMinute = date("i",time());

	$caller = "";						// 송신자 명
	$success = $fail = 0;		// 성공, 실패 초기값

	$strGroup = $arrCallNo;

	$GroupCNT = 1;
	
	$rsvTime = "";

	$SMS = new SMS;
	$result = $SMS->Open();
	$result = $SMS->Add($strGroup,$strCallBack,$caller,iconv("UTF-8","EUC-KR",$strMsg),$rsvTime);
	$result = $SMS->Send();	// 메세지 전송
	if ($result) {
		foreach($SMS->Result as $result) {
			list($phone,$code)=explode(":",$result);
			if ($code=="Error") {
				$fail++;
			} else {
				$success++;
			}
		}
	}

	$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.

	$SMS->Close();	// SMS 서버 연결 종료

	$list[0] = $fail;
	$list[1] = $success;
	$list[2] = $smsidx;

	return $list;
}

function email_func($addr){
	return (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_a-z{|}~]+$', $addr));
}

function set_point($UserID,$point,$cont){
	global $memberdb, $site_prefix;
	$sql = " update ".$memberdb." set Point = Point + '".$point."' where UserID = '".$UserID."' ";
//	echo $sql;
	$result = sql_query($sql);

	$isql = " insert into ".$site_prefix."pointlog set uid = '".$UserID."', pcont = '".$cont."', pdate = now(), point = '".$point."' ";
	$iresult = sql_query($isql);
}


/*
	우편번호 검색 함수 - 우편번호 API 
*/
function get_post_code_xml_by_api($query){
	$query = iconv('utf-8','euc-kr',$query);
	
	$post_data = array(
	    'target' => 'post',
	    'regkey' => 'ba1381a3a3b6e7ca91340965031278',
	    'query' => $query
	);

	$url = 'http://biz.epost.go.kr/KpostPortal/openapi';
	$param = http_build_query($post_data);
	$result = fetch_page($url,$param);
	$result['content'] = remove_none_xml_word($result['content']);
	
	return $result;
}

function fetch_page($url,$param,$cookies=NULL,$referer_url=NULL){ 
    if(strlen(trim($referer_url)) == 0) $referer_url= $url; 
    $curlsession = curl_init (); 
    curl_setopt ($curlsession, CURLOPT_URL, $url); 
    curl_setopt ($curlsession, CURLOPT_POST, 1); 
    curl_setopt ($curlsession, CURLOPT_POSTFIELDS, $param); 
    //curl_setopt ($curlsession, CURLOPT_POSTFIELDSIZE, 0); 
    curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60); 
    if($cookies && $cookies!=""){ 
        curl_setopt ($curlsession, CURLOPT_COOKIE, $cookies); 
    } 
    curl_setopt ($curlsession, CURLOPT_HEADER, 1); //헤더값을 가져오기위해 사용합니다. 쿠키를 가져오기 위함.
    curl_setopt ($curlsession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.01; Windows NT 6.0)"); 
    curl_setopt ($curlsession, CURLOPT_REFERER, "$referer_url"); 

    ob_start(); 
    $res = curl_exec ($curlsession); 
    $buffer = ob_get_contents(); 
    ob_end_clean(); 
    $returnVal = array();
    if (!$buffer) {
    	$returnVal['error'] = true; 
        $returnVal['content'] = "Curl Fetch Error : ".curl_error($curlsession); 
    }else{ 
    	$returnVal['error'] = false;
        $returnVal['content'] = $buffer; 
    } 
    curl_close($curlsession); 
    return $returnVal; 
}

function remove_none_xml_word($content){
	$content_array = explode("\n", $content);
	foreach ($content_array as $key => $value) {
		if(substr(trim($value),0,1)!='<'){
			$content_array[$key]='';
		}
	}
	unset($content_array[0]);
	$content = implode("\n", $content_array);
	return trim($content);
}
/*
	우편번호 검색 함수 - 우편번호 API 
*/
// 도메인 이름 추출
function DomainNameGet($searchDomain){
	$arrChkDomain	= array();
	$domainPattn2	= array();
	$domainPattn1	= array();

	$arrDomain		= array();
	$chkDomain		= string;

	$dotSize		= integer;

	$chkDot			= string;
	$chkDomainTmp	= string;

	$pattIdx		= integer;

	$resDomain		= array();

	$domainPattn2	= array('.no.domain', '.or.kr', '.co.kr', '.pe.kr', '.ne.kr', '.re.kr', '.co.in', '.net.in', '.com.cn', '.co.jp', '.or.jp', '.com.ag', '.net.ag', '.org.ag', '.org.cn', '.net.cn', '.co.nz', '.net.nz', '.org.nz', '.com.tw', '.org.tw', '.idv.tw', '.co.uk', '.me.uk', '.org.uk', '.seoul.kr', '.busan.kr', '.daegu.kr', '.incheon.kr', '.gwangju.kr', '.daejeon.kr', '.ulsan.kr', '.gyeonggi.kr', '.gangwon.kr', '.chungbuk.kr', '.chungnam.kr', '.jeonbuk.kr', '.jeonnam.kr', '.gyeongbuk.kr', '.gyeongnam.kr', '.jeju.kr', '.go.kr', '.mil.kr', '.ac.kr', '.hs.kr', '.ms.kr', '.es.kr', '.kg.kr', '.sc.kr');
	$domainPattn1	= array('.nodomain', '.com', '.net', '.asia', '.org', '.kr', '.in', '.tv', '.cn', '.biz', '.info', '.ac', '.tw', '.eu', '.cc', '.jp', '.mobi', '.name', '.us', '.ws', '.ag', '.at', '.be', '.de', '.fm', '.jobs', '.ms', '.nu', '.tc', '.vg');

	if (substr($searchDomain, 0, 4) == 'http') {
		$arrDomain		= explode('/', $searchDomain);
		$chkDomainTmp	= $arrDomain[2];
	}
	else {
		$arrDomain		= explode('/', $searchDomain);
		$chkDomainTmp	= $arrDomain[0];
	}

	$arrChkDomain	= explode('.', $chkDomainTmp);
	$dotSize	= sizeof($arrChkDomain);

	if ($dotSize > 1) {
		//두개 검사(co.kr, or.kr 등)
		$chkDot		= '.'. $arrChkDomain[$dotSize - 2]. '.'. $arrChkDomain[$dotSize - 1];
		$pattIdx	= array_search($chkDot, $domainPattn2);
		if ($pattIdx != false ) {
			for($i = 0; $i < $dotSize - 3; $i++) {
				if ($dotSize - 4 == $i ) {
					$resDomain['host']	.= $arrChkDomain[$i];
				}
				else {
					$resDomain['host']	.= $arrChkDomain[$i]. '.';
				}
			}
			
			if (empty($resDomain['host']) == true ) {
				$resDomain['host']	= '';
			}
			
			$resDomain['full']	= $chkDomainTmp;			
			$resDomain['domain']	= $arrChkDomain[$dotSize - 3] . $domainPattn2[$pattIdx];	

			return $resDomain;
		}
		else {
			//한개 검사
			$chkDot		= '.'. $arrChkDomain[$dotSize-1];
			$pattIdx	= array_search($chkDot, $domainPattn1);
			if ($pattIdx != false ) {
				for($i = 0; $i < $dotSize - 2; $i++) {
					if ($dotSize - 3 == $i)  {
						$resDomain['host']	.= $arrChkDomain[$i];
					}
					else {
						$resDomain['host']	.= $arrChkDomain[$i]. '.';
					}
				}
				
				if (empty($resDomain['host']) == true ) {
					$resDomain['host']	= '';					
				}

				$resDomain['full']		= $chkDomainTmp;
				$resDomain['domain']	= $arrChkDomain[$dotSize-2]. $domainPattn1[$pattIdx];	

				return $resDomain;
			}
		}
	}
	
	return null;
}

// 브라우저 확인
function GetBrowserAgent($userAgent) {
	// 모바일 에이전트 이름
	$agentName = Array('아이팟','아이폰','안드로이드','블랙베리','윈도우CE','노키아','WebOS','오페라미니','소니에릭슨','오페라모바일','IE모바일','익스플로러','크롬','사파리');
	$agentCode = Array('ipod','iphone','android','blackberry','windows ce','nokia','webos','opera mini','sonyericsson','opera mobi','iemobile','msie','chrome','safari');

	// 모바일 에이전트 분석
	$agent['code'] = "";
	$agent['name'] = "";
	for($i=0;$i<sizeOf($agentCode);$i++){
		if(preg_match("/".$agentCode[$i]."/", strtolower($userAgent))){
			$agent['code'] = $agentCode[$i];
			$agent['name'] = $agentName[$i];
			break;
		}
	}

	if($agent['code'] == ""){
		$agent['code'] = "ETC";
		$agent['name'] = "기타";
	}

	return $agent;
}

function SetCounterInput()
{
	global $conn;
	// 접속자 URL정보 확인
	$userDomain	 = $_SERVER['HTTP_HOST'];
	$userReferer = $_SERVER['HTTP_REFERER'];
	$userPage	 = $_SERVER['REQUEST_URI'];

	// 접속자 시간 확인
	$userTime	= time();
	$userYear	= date('Y',$userTime);
	$userMonth	= date('m',$userTime);
	$userDay	= date('d',$userTime);
	$userHour	= date('H',$userTime);
	$userDate	= mktime(0, 0, 0, $userMonth, $userDay, $userYear);

	// 공통 조건문
	$addWhere = "visitYear = '".$userYear."' and visitMonth = '".$userMonth."' and visitDay = '".$userDay."' and visitHour = '".$userHour."'";

	$domain1 = DomainNameGet($userDomain);
	$domain2 = DomainNameGet($userReferer);

	if(empty($_SESSION['visitCode']) && $domain1['full'] != $domain2['full']){
		// 방문 정보 세션에 넣기
		$_SESSION['visitCode'] = strtoupper(uniqid(""));

		// 접속자 정보 확인
		$userIp		= $_SERVER['REMOTE_ADDR'];
		$userAgent	= $_SERVER['HTTP_USER_AGENT'];
		$agent		= GetBrowserAgent($userAgent);

		// 쿠키 확인(순방문, 재방문)
		if(empty($_COOKIE['visitNo'])){
			$sql = "INSERT INTO VisitUser SET visitIp = '".$userIp."', visitAgent = '".$userAgent."', visitDate = '".$userTime."', visitLastDate = '".$userTime."'";
			$result = sql_query($sql);

			$visitNo  = mysqli_insert_id($conn);
			$userType = 'N';
		}
		else{
			$visitNo  = $_COOKIE['visitNo'];
			$userType = 'R';

			$sql = "UPDATE VisitUser SET visitLastDate = '".$userTime."' WHERE visitNo = '".$visitNo."' ";
			$result = sql_query($sql);
		}

		// 방문시 쿠기 업데이트
		setcookie("visitNo", $visitNo, time()+(86400*30), '/', _cookieName); // 한달동안 쿠키를 유지하고 이후에는 순방문자로 변경

		// 방문자수 카운트
		$sql = "SELECT visitCount FROM VisitCount WHERE ".$addWhere." and visitType = '".$userType."'";
		$result = sql_query($sql);
		for($i=0;$row = sql_fetch_array($result);$i++){
			$dbRtn[$i] = $row;
		}
		if($dbRtn[0]['visitCount'] > 0 && empty($dbRtn[0]['visitCount'])==false){
			unset($dbRtn);
			$sql = "UPDATE VisitCount SET visitCount = visitCount + 1 WHERE ".$addWhere." and visitType = '".$userType."'";
			$result = sql_query($sql);
		}
		else{
			unset($dbRtn);
			$sql = "INSERT INTO VisitCount SET visitType = '".$userType."', visitYear = '".$userYear."', visitMonth = '".$userMonth."', visitDay = '".$userDay."', visitHour = '".$userHour."', visitCount = '1', visitDate = '".$userDate."'";
			$result = sql_query($sql);
		}

		$userReferer = DfVal($userReferer,"INPUT");

		// 유입URL 카운트
		$sql = "SELECT visitCount FROM VisitReferer WHERE ".$addWhere." and visitReferer = '".$userReferer."'";
		$result = sql_query($sql);
		for($i=0;$row = sql_fetch_array($result);$i++){
			$dbRtn[$i] = $row;
		}
		if($dbRtn[0]['visitCount'] > 0 && empty($dbRtn[0]['visitCount'])==false){
			unset($dbRtn);
			$sql = "UPDATE VisitReferer SET visitCount = visitCount + 1 WHERE ".$addWhere." and visitReferer = '".$userReferer."'";
			$result = sql_query($sql);
		}
		else{
			unset($dbRtn);
			$sql = "INSERT INTO VisitReferer SET visitReferer = '".$userReferer."', visitYear = '".$userYear."', visitMonth = '".$userMonth."', visitDay = '".$userDay."', visitHour = '".$userHour."', visitCount = '1', visitDate = '".$userDate."'";
			$result = sql_query($sql);
		}

		// 브라우저 카운트
		$sql = "SELECT visitCount FROM VisitAgent WHERE ".$addWhere." and visitAgentCode = '".$agent['code']."'";
		$result = sql_query($sql);
		for($i=0;$row = sql_fetch_array($result);$i++){
			$dbRtn[$i] = $row;
		}
		if($dbRtn[0]['visitCount'] > 0 && empty($dbRtn[0]['visitCount'])==false){
			unset($dbRtn);
			$sql = "UPDATE VisitAgent SET visitCount = visitCount + 1 WHERE ".$addWhere." and visitAgentCode = '".$agent['code']."'";
			$result = sql_query($sql);
		}
		else{
			unset($dbRtn);
			$sql = "INSERT INTO VisitAgent SET visitAgentCode = '".$agent['code']."', visitAgentName = '".$agent['name']."', visitYear = '".$userYear."', visitMonth = '".$userMonth."', visitDay = '".$userDay."', visitHour = '".$userHour."', visitCount = '1', visitDate = '".$userDate."'";
			$result = sql_query($sql);
		}
	}

	// 페이지뷰 카운트
	$sql = "SELECT visitCount FROM VisitPage WHERE ".$addWhere." and visitPage = '".$userPage."'";
	$result = sql_query($sql);
	for($i=0;$row = sql_fetch_array($result);$i++){
		$dbRtn[$i] = $row;
	}
	if($dbRtn[0]['visitCount'] > 0 && empty($dbRtn[0]['visitCount'])==false){
		unset($dbRtn);
		$sql = "UPDATE VisitPage SET visitCount = visitCount + 1 WHERE ".$addWhere." and visitPage = '".$userPage."'";
			$result = sql_query($sql);
	}
	else{
		unset($dbRtn);
		$sql = "INSERT INTO VisitPage SET visitPage = '".$userPage."', visitYear = '".$userYear."', visitMonth = '".$userMonth."', visitDay = '".$userDay."', visitHour = '".$userHour."', visitCount = '1', visitDate = '".$userDate."'";
		$result = sql_query($sql);
	}
}

function GetCounter($mode, $searchSDate, $searchEDate, $limit=NULL)
{
	$searchSDate = strtotime($searchSDate);
	$searchEDate = strtotime($searchEDate);

	if($searchSDate > $searchEDate){
		GetAlert("시작기간은 종료기간보다 클 수 없습니다.","BACK");
	}

	if(($searchEDate - $searchSDate) > 86400 * 30){
		GetAlert("검색기간은 한달을 넘을 수 없습니다.","BACK");
	}

	switch($mode){
		case "USER" :
			// 전일 카운터를 가져오기 위해 하루를 뒤로 무름.
			$addWhere = " and visitDate >= ".($searchSDate-86400)." and visitDate < ".($searchEDate + 86400);

			if($searchSDate == $searchEDate){
				$addItems = ", visitCount";
				$addGroup = "";
			}
			else{
				$addItems = ", SUM(visitCount) as visitCount";
				$addGroup = "GROUP BY visitDate, visitType";
			}

			$sql = "
				SELECT
					visitDate, visitHour, visitType
					$addItems
				FROM
					VisitCount
				WHERE
					1 = 1
					$addWhere
				$addGroup
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}
			break;
		case "PAGE" :
			// 전일 카운터를 가져오기 위해 하루를 뒤로 무름.
			$addWhere = " and visitDate >= ".($searchSDate-86400)." and visitDate < ".($searchEDate + 86400);

			if($searchSDate == $searchEDate){
				$addItems = ", SUM(visitCount) as visitCount";
				$addGroup = "GROUP BY visitDate, visitHour";
			}
			else{
				$addItems = ", SUM(visitCount) as visitCount";
				$addGroup = "GROUP BY visitDate";
			}

			$sql = "
				SELECT
					visitDate, visitHour
					$addItems
				FROM
					VisitPage
				WHERE
					1 = 1
					$addWhere
				$addGroup
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}
			break;
		case "URL" :
			// 전일 카운터를 가져오기 위해 하루를 뒤로 무름.
			$addWhere = " and visitDate >= ".$searchSDate." and visitDate < ".($searchEDate + 86400);

			$sql = "
				SELECT
					sum(visitCount) as vCnt
				FROM
					VisitPage
				WHERE
					1 = 1
					$addWhere
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$totalCnt = $list[0]['vCnt'];
			unset($list);

			if(empty($limit)==false){
				$limitAdd = "LIMIT ".$limit;
			}

			$sql = "
				SELECT
					visitPage, SUM(visitCount) as vCnt
				FROM
					VisitPage
				WHERE
					1 = 1
					$addWhere
				GROUP BY
					visitPage
				ORDER BY
					vCnt DESC
				$limitAdd
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$values['list']  = $list;
			$values['total'] = $totalCnt;
			unset($list);

			$list = $values;
			break;
		case "REFERER" :
			// 전일 카운터를 가져오기 위해 하루를 뒤로 무름.
			$addWhere = " and visitDate >= ".$searchSDate." and visitDate < ".($searchEDate + 86400);

			$sql = "
				SELECT
					sum(visitCount) as vCnt
				FROM
					VisitReferer
				WHERE
					1 = 1
					$addWhere
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$totalCnt = $list[0]['vCnt'];
			unset($list);

			if(empty($limit)==false){
				$limitAdd = "LIMIT ".$limit;
			}

			$sql = "
				SELECT
					visitReferer, SUM(visitCount) as vCnt
				FROM
					VisitReferer
				WHERE
					1 = 1
					$addWhere
				GROUP BY
					visitReferer
				ORDER BY
					vCnt DESC
				$limitAdd
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$values['list']  = $list;
			$values['total'] = $totalCnt;
			unset($list);

			$list = $values;
			break;
		case "AGENT" :
			// 전일 카운터를 가져오기 위해 하루를 뒤로 무름.
			$addWhere = " and visitDate >= ".$searchSDate." and visitDate < ".($searchEDate + 86400);

			$sql = "
				SELECT
					sum(visitCount) as vCnt
				FROM
					VisitAgent
				WHERE
					1 = 1
					$addWhere
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$totalCnt = $list[0]['vCnt'];
			unset($list);

			if(empty($limit)==false){
				$limitAdd = "LIMIT ".$limit;
			}

			$sql = "
				SELECT
					visitAgentCode, visitAgentName, SUM(visitCount) as vCnt
				FROM
					VisitAgent
				WHERE
					1 = 1
					$addWhere
				GROUP BY
					visitAgentCode
				ORDER BY
					vCnt DESC
				$limitAdd
			";
			$result = sql_query($sql);
			for($i=0;$row = sql_fetch_array($result);$i++){
				$list[$i] = $row;
			}

			$values['list']  = $list;
			$values['total'] = $totalCnt;
			unset($list);

			$list = $values;
			break;
	}

	return $list;
}

// 차트 출력
function GetPrintCharts($type,$data,$width=800,$height=300,$gStr=NULL,$maxCnt=NULL)
{
	switch($type){
		case 'line_multi' :
			$curl = "/board/config/js/chart/FCF_MSLine.swf";

			$head = "<graph decimalPrecision='0' formatNumberScale='0' baseFontSize='12' baseFont='굴림' numberSuffix='".$gStr."' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='efefef' hoverCapSepChar=':'>";
			$foot = "</graph>";
			break;
		case 'line' :
			$curl = "/board/config/js/chart/FCF_Line.swf";

			$head = "<graph decimalPrecision='0' formatNumberScale='0' baseFontSize='12' baseFont='굴림' numberSuffix='".$gStr."' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='efefef' hoverCapSepChar=':'><set name='TAP' value='0' alpha='0' showName='0'/>";
			$foot = "<set name='TAP' value='0' alpha='0' showName='0'/></graph>";
			break;
		case 'column_multi' :
			$curl = "/board/config/js/chart/FCF_MSColumn2D.swf";

			$head = "<graph AlternateHGridColor='efefef' baseFontSize='12' baseFont='굴림' showAlternateHGridColor='1' decimalPrecision='0' formatNumberScale='0' showValues='1' hoverCapSepChar=':' numberSuffix='".$gStr."' yaxismaxvalue='".$maxCnt."'>";
			$foot = "</graph>";
			break;
		case 'column' :
			$curl = "/board/config/js/chart/FCF_Column2D.swf";

			$head = "<graph AlternateHGridColor='efefef' baseFontSize='12' baseFont='굴림' showAlternateHGridColor='1' decimalPrecision='0' formatNumberScale='0' showValues='1' hoverCapSepChar=':' numberSuffix='".$gStr."' yaxismaxvalue='".$maxCnt."'>";
			$foot = "</graph>";
			break;
		case 'pie' :
			$curl = "/board/config/js/chart/FCF_Pie3D.swf";

			$head = "<graph baseFontSize='12' baseFont='굴림' decimalPrecision='0' formatNumberScale='0' showValues='1' hoverCapSepChar=':' showNames='1' pieRadius='150' pieSliceDepth='15' numberSuffix='".$gStr."'>";
			$foot = "</graph>";
			break;
	}

	echo renderChartHTML($curl, "", $head.$data.$foot, $type."graph", $width, $height, false, false, true);
}

// 차트 데이터 작성
function GetCounterCharts($gType,$gData,$gCategory=NULL,$gStr=NULL,$maxCnt=NULL)
{
	$strXML = "";

	switch($gType){
		case 'column_multi' :
			$strXML .= "<categories>";
			for($i=0;$i<sizeOf($gCategory);$i++){
				$strXML .= "<category name='".$gCategory[$i]."'/>";
			}
			$strXML .= "</categories>";

			for($i=0;$i<sizeOf($gData);$i++){
				$strXML .= "<dataset color='".$gData[$i]['color']."' seriesname='".$gData[$i]['title']."'>";

				$data = $gData[$i]['data'];
				for($j=0;$j<sizeof($data);$j++){
					$strXML .= "<set value='".$data[$j]."'/>";
				}
				$strXML .= "</dataset>";
			}
			break;
		case 'column' :
			for($i=0;$i<sizeOf($gData);$i++){
				$strXML .= "<set color='".$gData[$i]['color']."' value='".$gData[$i]['data']."' name='".$gData[$i]['title']."'/>";
			}
			break;
		case 'pie' :
			for($i=0;$i<sizeOf($gData);$i++){
				$strXML .= "<set color='".$gData[$i]['color']."' value='".$gData[$i]['data']."' name='".$gData[$i]['title']."'/>";
			}
			break;
		case 'line_multi' :
			$strXML .= "<categories>";
			$strXML .= "<category name=''/>";
			for($i=0;$i<sizeOf($gCategory);$i++){
				$strXML .= "<category name='".$gCategory[$i]."'/>";
			}
			$strXML .= "<category name=''/>";
			$strXML .= "</categories>";

			for($i=0;$i<sizeOf($gData);$i++){
				$strXML .= "<dataset color='".$gData[$i]['color']."' seriesname='".$gData[$i]['title']."'>";
				$strXML .= "<set name='TAP' value='0' alpha='0' showName='0'/>";

				$data = $gData[$i]['data'];
				for($j=0;$j<sizeof($data);$j++){
					$strXML .= "<set value='".$data[$j]."'/>";
				}

				$strXML .= "<set name='TAP' value='0' alpha='0' showName='0'/>";
				$strXML .= "</dataset>";
			}
			break;
		case 'line' :
			for($i=0;$i<sizeOf($gData);$i++){
				$strXML .= "<set value='".$gData[$i]['data']."' name='".$gData[$i]['title']."'/>";
			}
			break;
	}
	
	GetPrintCharts($gType,$strXML,750,250,$gStr,$maxCnt);
}
function get_auth_list($val){
	global $auth_array_val, $auth_array_tit;
	for($i=0;$i<sizeof($auth_array_val);$i++){
		if($val == $auth_array_val[$i]) $auth_sel = " selected";
		else $auth_sel = "";
		$str .= "<option value='".$auth_array_val[$i]."' ".$auth_sel.">".$auth_array_tit[$i]."</option>\n";
	}

	return $str;
}
function get_board_setting($idx){
	global $site_prefix;
	if(!empty($idx)) $sql_common = " and Idx = '".$idx."' ";

	$sql = " select * from ".$site_prefix."board_setting where 1=1 ".$sql_common." order by Idx desc ";
	$result = sql_query($sql);
	for($i=0;$row = sql_fetch_array($result);$i++){
		$list[$i] = $row;
	}

	return $list;
}
// 세션변수 생성
function set_session($session_name, $value)
{
    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $$session_name = $_SESSION["$session_name"] = $value;
}


// 세션변수값 얻음
function get_session($session_name)
{
    return $_SESSION[$session_name];
}

function GetMainCounter(){
	global $site_prefix;

	$today = date("Y-m-d",time());
	$year = date("Y",time());
	$month = date("m",time());

	$sql = " select sum(visitCount) as svcnt from VisitCount where 1=1 ";
	$row = sql_fetch($sql);

	$total_cnt = $row["svcnt"];

	$list["svcnt"] = $total_cnt;


	$sql = " select sum(visitCount) as visitCount, visitYear, visitMonth from VisitCount where visitDate >= ".strtotime($year."-01-01")." and visitDate < ".strtotime($year."-12-31")." GROUP BY visitMonth having visitYear = ".$year." ";
	$result = sql_query($sql);
	for($i=0;$row = sql_fetch_array($result);$i++){
		$list[intval($row["visitMonth"])] = $row;
	}

	$sql = " select count(*) as bcnt from ".$site_prefix."board_setting ";
	$row = sql_fetch($sql);
	$list["bcnt"] = $row["bcnt"];

	return $list;
}

function get_category($ca_id){
	global $site_prefix;
	$sql = " select * from ".$site_prefix."category where ca_id = '".$ca_id."' ";
	$row = sql_fetch($sql);

	return $row["ca_name"];
}

function get_uniqid()
{
    global $site_prefix;

    sql_query(" LOCK TABLE mk_uniqid WRITE ");
    while (1) {
        // 년월일시분초에 100분의 1초 두자리를 추가함 (1/100 초 앞에 자리가 모자르면 0으로 채움)
        $key = date('YmdHis', time()) . str_pad((int)(microtime()*100), 2, "0", STR_PAD_LEFT);

        $result = sql_query(" insert into mk_uniqid set uq_id = '$key', uq_ip = '{$_SERVER['REMOTE_ADDR']}' ", false);
        if ($result) break; // 쿼리가 정상이면 빠진다.

        // insert 하지 못했으면 일정시간 쉰다음 다시 유일키를 만든다.
        usleep(10000); // 100분의 1초를 쉰다
    }
    sql_query(" UNLOCK TABLES ");

    return $key;
}

function get_naver_api($address){
	global $naver_client_id, $naver_client_secret;
	$url = "http://maps.googleapis.com/maps/api/geocode/json?language=ko&sensor=false&address=".urlencode($address);
	
	$is_post = true;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, $is_post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$headers = array();
	$headers[] = "X-Naver-Client-Id: ".$naver_client_id;
	$headers[] = "X-Naver-Client-Secret: ".$naver_client_secret;
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$response = curl_exec($ch);
	curl_close ($ch);

	return $response;
}

function get_banner($bloc){
	global $site_prefix;

	$sql = " select * from ".$site_prefix."banner where bloc = '".$bloc."' and bstatus = 'Y' order by border desc ";
	$result = sql_query($sql);
	for($i=0;$row = sql_fetch_array($result);$i++){
		$row["files"] = get_file($site_prefix."banner",$row["idx"]);
		$list[$i] = $row;
	}

	return $list;
}
?>