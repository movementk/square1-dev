<?
if(!isset($_COOKIE["admin_idx2"])){
?>
<script language="javascript">
alert("로그인을 하신후 이용가능합니다.");
location.href="/board/admn/";
</script>
<?
}

switch($admin["admin_level"]){
	case "99":
		$is_super = true;
		break;
	case "10":
		$is_super = false;
		break;
}
?>