<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";

$mode = $site_prefix."category";

$sql = " select ca_name from $mode where ca_id = '$ca_id' ";
    $row = sql_fetch($sql);
    $code = $ca_id;
    $name = $row[ca_name];
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	<? if ($name) { ?>
	    alert("코드 '<?=$code?>' 는 '<?=$name?>' (으)로 이미 등록되어 있으므로\n\n사용하실 수 없습니다.");
	<? } else { ?>
        alert("'<?=$code?>' 은(는) 등록된 코드가 없으므로 사용하실 수 있습니다.");
        parent.document.<?=$frmname?>.codedup.value = '';
	<? } ?>
	window.close();
//-->
</SCRIPT>
?>