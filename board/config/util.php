<?
function err_msg($msg,$bool="1")
{
	if ($bool){
	echo "
	<script>
	window.alert('$msg');
	history.go(-1);
	</script>
	";
	exit;
	}
}

function msg($msg) {
	echo("
        <script>
	    window.alert('$msg')
	    </script>
	    ");
 }
function msg_href($msg_str, $fileName){
echo "<script>";
echo "alert('".$msg_str."');";
echo "location.href='".$fileName."';";
echo "</script>";
}


function err_close($msg)
{
echo "
<script>
window.alert('$msg');
self.close();
</script>
";
exit;
}


function err_msg2($msg,$to,$bool="1")
{
	if ($bool)
	{
	echo "
	<script>
	window.alert('$msg');
	window.open('$to','_self');
	</script>
	";
	exit;
	}
}

// 요청하는 페이지로 이동
function redirect($re_url)
{
 echo "<meta http-equiv='Refresh' content='0; URL=$re_url'>";
 exit;
}

function goURL($fileName){
	echo "<script language='javascript'>";
	echo "location.href='".$fileName."'";
	echo "</script>";
}

// MYSQL 연결
function my_connect($host,$id,$pass,$db)
{
	$connect=mysql_connect($host,$id,$pass);
	mysql_select_db($db);
	return $connect;
}

// HTML Tag를 제거하는 함수
function del_html( $str )
{
  $str = str_replace( ">", "&gt;",$str );
  $str = str_replace( "<", "&lt;",$str );
  $str = str_replace( "\"", "&quot;",$str );
  return $str;
}

function loadStr($str){
	$str=stripslashes($str);
	return $str;
}


function save_Str($str){
	addslashes($str);
	del_html($str);
	return $str;
}


// 각종 HTML 태그를 이용한 테러방지
function avoid_crack($str)
{
  $str=eregi_replace("<","&lt;",$str);
  $str=eregi_replace("&lt;div","<div",$str);
  $str=eregi_replace("&lt;p ","<p ",$str);
  $str=eregi_replace("&lt;font","<font",$str);
  $str=eregi_replace("&lt;b","<b",$str);
  $str=eregi_replace("&lt;marquee","<marquee",$str);
  $str=eregi_replace("&lt;img","<img",$str);
  $str=eregi_replace("&lt;a ","<a ",$str);
  $str=eregi_replace("&lt;embed","<embed",$str);
 
  $str=eregi_replace("&lt;/div","</div",$str);
  $str=eregi_replace("&lt;/p ","</p ",$str);
  $str=eregi_replace("&lt;/font","</font",$str);
  $str=eregi_replace("&lt;/b","</b",$str);
  $str=eregi_replace("&lt;/marquee","</marquee",$str);
  $str=eregi_replace("&lt;/img","</img",$str);
  $str=eregi_replace("&lt;/a>","</a>",$str);
  $str=eregi_replace("&lt;/embed","</embed",$str);  
  $str=eregi_replace("&gt;",">",$str);
  return $str;
}
	

function page_avg($totalpage,$cpage,$url){

  	if(!$pagenumber) {	       
     		$pagenumber = 10;
     	}
  
     	$startpage = intval(($cpage - 1) / $pagenumber) * $pagenumber +1  ;
     	$endpage = intVal(((($startpage -1) +  $pagenumber) / $pagenumber) * $pagenumber) ;

    	if ($totalpage <= $endpage)
       		$endpage = $totalpage;

    		if ( $cpage > $pagenumber) {

			$curpage = intval($startpage - 1);
			   $url_page = "<a href='$url"."&page=$curpage'>";
       			echo ("$url_page");
				echo("◀</a> .. ");
       		}
			else{
			  echo("◀</a>  ");
			}

      		$curpage = $startpage;
           
      		while ($curpage <= $endpage):      

       			if ($curpage == $cpage) {
       				echo "<b>$cpage</b>";
       			} else {
       			  $url_page = "<a href='$url"."&page=$curpage'>";
       			  echo ("$url_page");
				  echo("[$curpage]</a>");
       			}
       			$curpage++;
     
 		endwhile ;

       	if ( $totalpage > $endpage) {
      		$curpage = intval($endpage + 1);  
      		$url_page = " .. <a href='$url"."&page=$curpage'>";
       		echo ("$url_page");
			echo("▶</a>");
      	}
		else{
		  echo("  ▶");
		}
  }


// 현재 시간보다 마감일자가 늦을경우 경매완료
function end_exe($connect){
  $now_t = date('YmdH');
  $qry = "update auct_master set end_chk='Y' where auct_end <= $now_t ";
  $res = mysql_query($qry,$connect);
}


/* 날짜데이터 형식 변환 : 20020512 --> 2002-05-12 */
function shortdate($strvalue) {
	$date_str = substr($strvalue, 0, 4) . "-" . substr($strvalue, 4, 2) . "-" . substr($strvalue, 6, 2);
	return $date_str;
}

//=================================
// 문자열 자르기 함수
//=================================


function CurString($str, $len) { 
       if(strlen($str) < $len) return $str;
       $str = substr($str, 0, $len);
       $j = 0;
       for($i = strlen($str) - 1; $i >= 0; $i--) {
              if(ord($str[$i]) <= 127) break;
              $j++;
       } 

       $str = ($j % 2) ? substr($str, 0, strlen($str) - 1) : $str;

       $str .= "...";

       return $str; 
}



/* 한글 문자열 자르기 함수 */
function shortenStr($str, $maxlen) { 

  if ( strlen($str) <= $maxlen ) 
	return $str; 

  $effective_max = $maxlen - 3; 
  $remained_byte = $effective_max; 
  $retStr=""; 

  $hanStart=0; 

  for ( $i=0; $i < $effective_max; $i++ ) { 
	$char=substr($str,$i,1); 

	if ( ord($char) <= 127 ) { 
		$retStr .= $char; 
		$remained_byte--; 
		continue; 
	} 

	if ( !$hanStart && $remained_byte > 1 ) { 
		$hanStart = true; 
		$retStr .= $char; 
		$remained_byte--; 
		continue; 
	} 

	if ( $hanStart ) { 
		$hanStart = false; 
		$retStr .= $char; 
		$remained_byte--; 
	} 
  } 
  return $retStr .= "..."; 
} 

?>