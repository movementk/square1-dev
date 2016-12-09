<?
include "../../../board/config/use_db.php";

if($_POST["cat"] == "1"){
	$id = $_POST["id"];
	$sql_comm = " UserID='$id' ";
	$findstr = "UserID";
} else if($_POST["cat"] == "2"){
	$names = $_POST["names"];
	$sql_comm = " UserName='$names' ";
	$findstr = "UserName";
}

$SQL = "select ".$findstr." from ".$memberdb." where ".$sql_comm;

$result = mysql_query($SQL);
$row = mysql_fetch_array($result);
if($row) {
	$idck = $row[0];
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../common/css/sub_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../common/script/flash.js"></script>
<script type="text/javascript" src="../common/script/flash_link.js"></script>
</head>

<body>

<form name="chkForm">
	<input type="hidden" name="idTxt" value="<?=$idck?>">
</form>
<script language="javascript" type="text/javascript">
function idCall() {
	var id = "<?=$id?>";
	var names = "<?=$names?>";
	var f = "<?=$form?>";
	var ids = chkForm.idTxt.value;

	<? if($_POST["cat"] == "1"){ ?>
	if(id == ids) {
		eval("parent.document."+f).idchk.value="No";
		parent.chkIdMsg("Already exist.","<?=$_POST['cat']?>");
		parent.MemberForm.UserID.value = "";
		parent.MemberForm.UserID.value = id;
		parent.MemberForm.UserID.focus();
	} else {		
		eval("parent.document."+f).idchk.value="Yes";
	<? } else { ?>
	if(names == ids) {
		eval("parent.document."+f).namechk.value="No";
		parent.chkIdMsg("Already exist.","<?=$_POST['cat']?>");
		parent.MemberForm.UserName.value = "";
		parent.MemberForm.UserName.value = names;
		parent.MemberForm.UserName.focus();
	} else {		
		eval("parent.document."+f).namechk.value="Yes";
	<? } ?>	
		parent.chkIdMsg("Can Use This.","<?=$_POST['cat']?>");
	}	
	self.close();
}
idCall();
</script>
</body>
</html>
