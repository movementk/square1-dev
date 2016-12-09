<?
if (!defined("_MKBOARD_")) exit; // 개별 페이지 접근 불가 
//$date_idx = $_REQUEST["date_idx"];
$BoardDateSQL = "select * from $TableConfigDB where Idx=".$date_idx;
$BoardDateRow = sql_fetch($BoardDateSQL);

if(!$is_admin && !empty($BoardDateRow["ViewAuthority"]) && $member["Level"] < $BoardDateRow["ViewAuthority"]) err_back("권한이 없습니다.");

$BoardNameArr = explode("_",$mode);
$BoardNameArrSize = count($BoardNameArr);
$BoardName = $BoardNameArr[$BoardNameArrSize-1];
$fileURL="../board/upload/".$BoardName."/";

if(empty($BoardIdx)) $BoardIdx = $_REQUEST["board_idx"];

$BoardViewSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
$view = sql_fetch($BoardViewSQL);

$sql1 = "update ".$mode." set ReadNum=ReadNum+1 where BoardIdx=".$BoardIdx;
mysql_query($sql1);

$q_next = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and BoardIdx>".$BoardIdx;
if($Category){
   $q_next .= " AND Category='".$Category."' ";
}
$q_next .= " order by BoardIdx  limit 0,1";
$q_next_row = sql_fetch($q_next);

$q_prev = "select BoardIdx, Title, RegDate from ".$mode." where ReLevel = 0 and BoardIdx<".$BoardIdx;
if($Category){
   $q_prev .= " AND Category='".$Category."' ";
}
$q_prev .= "  order by BoardIdx desc limit 0,1";
$q_prev_row = sql_fetch($q_prev);


$files = get_file($mode,$BoardIdx);
$file_num = $files[count];

if($password1){
	$upw = sql_password($password1);

	if($upw != $view[UserPw]){
		err_back('비밀번호가 맞지 않습니다.');
		exit;
	}
}

if($is_member || $is_admin){
	$modify_link_in_view = "modify_chk(document.view_form);";
	$delete_link_in_view = "delete_chk();";
} else {
	$modify_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_write');";
	$delete_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_delete');";
}
?>
<div class="product_lst">
	<div class="product_view">
		<img src="<?=$files[0]["path"]?>/<?=$files[0]["file_source"]?>" id="imgB" width="568" height="310">
		<a href="<?=$_SERVER['PHP_SELF']?>?board_code=board_list&page=<?=$page?>&<?=$searchVal?>" title="목록"><img src="/images/product/back_btn.gif" class="imgB_btn"></a>
	</div>

	<ul class="product_sum">
		<li class="product_tit">
			<img src="/images/product/no.gif">
			<p class="ml10"><?=$view["Title"]?></p>
		</li>
		<?
		for($i=0;$i<$files["count"];$i++){
		?>
		<li><img src="<?=$files[$i]["path"]?>/<?=$files[$i]["file_source"]?>" class="pright" width="176" height="98"></li>
		<? } ?>
	</ul>
</div>
<!--갤러리list view-->
<p class="pt10 pb20"><img src="/images/product/detail_title.gif"></p>
<p>
<?
if($view["HtmlChk"]=="Y"){
	$view["Content"] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' \\2 \\3", $view["Content"]);
	echo $view["Content"];
} else {
	echo nl2br($view["Content"]);
}
?>
</p>
<script>
$(document).ready(function(){
	$(".pright").each(function(i){
		$(this).mouseenter(function(){
			$("#imgB").attr("src", $(this).attr("src"));
		});
	});
});
</script>