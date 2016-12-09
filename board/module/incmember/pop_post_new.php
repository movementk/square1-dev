<?
include $_SERVER[DOCUMENT_ROOT]."/board/config/use_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::TACET:::</title>

<link href="/css/layout.css" rel="stylesheet" type="text/css" />

</head>
<script language="javascript">

function getAddr(no){
	var form=eval("document.form"+no);
  var zipform = form.zipform.value;

  eval("opener.document."+zipform+".Address1").focus();

  eval("opener.document."+zipform+".ZipCode1").value=form.post1.value;	
  eval("opener.document."+zipform+".ZipCode2").value=form.post2.value;
  eval("opener.document."+zipform+".Address1").value=form.addr1.value;
 
  window.close();
 }


</script>
<body style="background-color:#adadad !important;">
<div class="find_post">	
	<div class="post_title">
		<img src="/images/common/find_post_title.gif" />
	</div>
	<div class="white_back">
		<form name="zip" method="get">
		<input type="hidden" name="zipform" value="<?=$zipform?>">
		<p><img src="/images/common/find_post_01.gif"></p>
		<p>
			<img src="/images/common/find_post_04.gif" style="margin-top:4px;">
			<input style="width:150px; background:none; border:1px solid #999; color:#000;" type="text" name="dong" value="<?=$_GET[dong]?>">
			<input type="image" src="/images/common/btn_post_search.gif" align="absmiddle"/>
		</p>
		<p><img src="/images/common/find_post_02.gif"></p>
		</form>

		<table width="350" border="1" cellpadding="0" cellspacing="0" bordercolor="#E3E3E3">
			<tr>
				<td width="96"><b>우편번호</b></td>
				<td width="258"><b>주소</b></td>
			</tr>
			<? if($dong){
			$zipfile = array();
			$fp = fopen("./zip.db", "r");
			while(!feof($fp)) {
				$zipfile[] = fgets($fp, 4096);
			}
			fclose($fp);

			$search_count = 0;
			while ($zipcode = each($zipfile)) 
			{
				if(strstr(substr($zipcode[1],9,512), $dong))
				{
					$list[$search_count][zip1] = substr($zipcode[1],0,3);
					$list[$search_count][zip2] = substr($zipcode[1],4,3);    
					$addr = explode(" ", substr($zipcode[1],8));

					if ($addr[sizeof($addr)-1]) 
					{
						$list[$search_count][addr] = str_replace($addr[sizeof($addr)-1], "", substr($zipcode[1],8));
						$list[$search_count][bunji] = trim($addr[sizeof($addr)-1]);
					}
					else
						$list[$search_count][addr] = substr($zipcode[1],8);

					$list[$search_count][encode_addr] = urlencode($list[$search_count][addr]);
					$search_count++;
				}    
			}

			if ($search_count==0){
			?>
			<tr>
				<td colspan="2" align="center">검색한 주소를 찾을 수 없습니다. <br>재검색 하세요. </td>
			</tr>
			<?
			} else {
				for ($i=0; $i<count($list); $i++) {
					$zip1 = $list[$i][addr];
					$post1 = $list[$i][zip1];
					$post2 = $list[$i][zip2];
			?>
			<form name="form<?=$i?>">
			<input type="hidden" name="zipform" value="<?=$zipform?>">
			<input type="hidden" name="post1" value="<?=$post1?>">
			<input type="hidden" name="post2" value="<?=$post2?>"> 
			<input type="hidden" name="addr1" value="<?=$zip1?>">							
			<tr>
				<td class="left"><?=$post1?>-<?=$post2?></td>
				<td height="28"><a href="javascript:getAddr(<?=$i?>);"><?=$zip1?></a></td>
			</tr>
			</form>
			<?
				}
			}
			}
			?>
		</table>
		<p>
		<a href="javascript:window.close();"><img src="/images/common/btn_post_close.gif"></a>
	</p>
	</div>
	
</div>
</body>
</html>
