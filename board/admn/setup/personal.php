<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t103 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$sql = " select * from ".$site_prefix."agree where 1=1 order by idx desc limit 0, 1 ";
$row = sql_fetch($sql);
?>

<div id="container">
	<div class="content_view">
		<div class="con_title">개인정보 취급방침</div>
		<form name="agree_form" method="post" action="/board/admn/_proc/setup/_admin_proc.php">
		<input type="hidden" name="workType" value="USE">
		<input type="hidden" name="URI" value="<?=$_SERVER['REQUEST_URI']?>">
		<input type="hidden" name="idx" value="<?=$row["idx"]?>">
		<textarea style="display:none;" name="agree1" id="agree1" ><?=$row["agree1"]?></textarea>
		<textarea style="width:100%;height:450px;" name="agree2" id="agree2" ><?=$row["agree2"]?></textarea>
		<textarea style="display:none;" name="agree3" id="agree3" ><?=$row["agree3"]?></textarea>
		<div class="mt5 mr10 btn_group"><button type="button" class="btn_a_b" onclick="javascript:board_check();">저 장</button></div>
		</form>
	</div>
	<div class="mt100"></div>
</div>
<script language="javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "agree2",
	sSkinURI: "/board/se2/SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

function board_check(){
	var f = document.agree_form;
	oEditors.getById["agree2"].exec("UPDATE_CONTENTS_FIELD", []);
	f.submit();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>