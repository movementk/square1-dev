<?
include_once $_SERVER[DOCUMENT_ROOT]."/include/header.php"; 
?>
<body>
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
window.onload = function(){
	document.zip.dong.focus();
}

</script>
<div class="zip_wrap">
	<p class="pt10 pb10 bbs_bot_line"><img src="/images/member/zip_t.gif" alt="우편번호검색" class="pl10"/></p>
	<form name="zip" method="get">
	<input type="hidden" name="zipform" value="<?=$zipform?>">
	<div class="zip_box pt20" >
		<p class="center pb5" style="color:#757575;">‘동(읍/면/리)’ 이름을 입력하세요. 예) 역삼동,화도읍,장유면</p>
		<div style="overflow:hidden;margin:0 auto;border:0px solid #fff;width:270px;padding-top:10px;">
		<p>
			지역명
			<input type="text" name="dong" class="wd230 input" value="<?=$_GET["dong"]?>">
			<input type="image" src="/images/member/btn_search.gif" alt="검색"/>
		</p>
		<p class="fleft"></p>
		</div>
	</div>
	</form>
	<div class="zip_result" style="padding-top:20px;text-align:center;">
	
		<table width="380" border="0" align="center" class="tb02">
			<tr>
				<th width="80" height="30" class="bbs_bot_line bbs_end_line">우편번호</th>
				<th class="bbs_bot_line bbs_end_line">주소</th>
			</tr>
			<?
			if(empty($dong)==false){
			//$contents = ZipCodeFinder($dong);
			//$zipList  = simplexml_load_string($contents);

			$result = get_post_code_xml_by_api($dong);
			$zipList = new SimpleXMLElement($result['content']);

			if($zipList->itemlist->item){
				$items = $zipList->itemlist->item;
				for($i=0;$i<sizeOf($items);$i++){
					$zip1 = str_replace("'","`",$items[$i]->address);
					$post1 = substr($items[$i]->postcd,0,3);
					$post2 = substr($items[$i]->postcd,3);
			?>
			<form name="form<?=$i?>">
			<input type="hidden" name="zipform" value="<?=$zipform?>">
			<input type="hidden" name="post1" value="<?=$post1?>">
			<input type="hidden" name="post2" value="<?=$post2?>"> 
			<input type="hidden" name="addr1" value="<?=$zip1?>">
			<tr>
				<td height="25"><?=$post1?>-<?=$post2?></td>
				<td><a href="javascript:getAddr(<?=$i?>);"><?=$zip1?></a></td>
			</tr>
			</form>
			<?
				}
			}
			else{
				echo "<tr height='250'><td align='center' colspan='2'>검색된 주소가 없습니다.</td></tr>";
			}
		}
		else{
			echo "<tr height='250'><td align='center' colspan='2'>검색할 동이름을 입력해주세요.</td></tr>";
		}
		?>
		</table>
	</div>
	<p class="right pt10 mr10 pb10"><a href="javascript:window.close();"><img src="/images/member/btn_close.gif" alt="닫기" /></a></p>
</div>
</body>
</html>
