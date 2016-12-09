<?
include "../../../config/use_db.php";

if(isset($_REQUEST["hope_id"]) && $_REQUEST["hope_id"]){
	$txt = "다시";
	$hope_id = $_REQUEST["hope_id"];
	$SQL = "select * from $memberdb where ";
	$SQL = $SQL."UserID='".$hope_id."'";
	if(isset($userIdx)){
		$SQL = $SQL." and idx <> ".$userIdx;
	}

	$Result= mysql_query($SQL);
	$count = mysql_fetch_array($Result);

    if(!$count) {
		if(strlen($hope_id) >=4){
			$check = "<font color='#FF80C0'>".$hope_id."는 사용<span class='orange'>가능</span>한 <br> 아이디입니다. </font>";
			$use_ok = 1;
		}else{
			$check = "<font color='#FF80C0'>".$hope_id."는 사용불<span class='orange'>가능</span>한 <br> 아이디입니다. </font>";
			$use_ok = 0;
		}
	}else{
		$check = "<font color='#FF80C0'>".$hope_id."는 사용불<span class='orange'>가능</span>한 <br> 아이디입니다. </font>";
		$use_ok = 0;
	}
}else{
	$txt = "";
    $check = "아이디를 입력하세요";
	$use_ok =0;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>아이디 중복확인</title>
<link href="<?=$ShopConfig['css_path']?>" rel="stylesheet" type="text/css">
<script language="javascript">

function noneAllowID( strId ) {
	var returnValue = true;
	switch( strId ) {
		case "filetree" :
		case "manager" : 
		case "sex" :
			returnValue = false;
			break;
		default :
			returnValue = true;
			break;
	}

	return returnValue;
}
function search_check(){
	var id = document.search.hope_id.value;


 	var alphaDigit= "_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"
	if(!id) {
		alert("아이디를 입력하세요!");
		return false;
	}	
	if (id.length < 4 || id.length > 15) {
		alert("아이디는 4~15자 이내여야 합니다.(한글아이디 사용불가)");
		return false;
	}
	
	if (id.indexOf(" ") >= 0) {
		alert("아이디는 공백이 들어가면 안됩니다.");
		return false;
	}
	if( !noneAllowID( id ) ) {
		alert("이용 불가능 아이디 입니다.");
		return false;
	}
	for (i=0; i<id.length; i++)  {
		if (alphaDigit.indexOf(id.substring(i, i+1)) == -1) {
			alert( "아이디는 영문과 숫자의 조합만 사용할 수 있습니다.");
			return false;
		}
	}


}

function idUse(){
  var id = document.search.hope_id.value;
  var hope_id = document.search.hope_id.value;
  var ok = true;
  var alphaDigit= "_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"
	if(!id) {
		alert("아이디를 입력하세요!");
		ok = false;
	}	
	if (id.length < 4 || id.length > 15) {
		alert("아이디는 4~15자 이내여야 합니다.(한글아이디 사용불가)");
		ok = false;
	}
	
	if (id.indexOf(" ") >= 0) {
		alert("아이디는 공백이 들어가면 안됩니다.");
		ok = false;
	}
	if( !noneAllowID( id ) ) {
		alert("이용 불가능 아이디 입니다.");
		ok = false;
	}
	for (i=0; i<id.length; i++)  {
		if (alphaDigit.indexOf(id.substring(i, i+1)) == -1) {
			alert( "아이디는 영문과 숫자의 조합만 사용할 수 있습니다.");
			ok = false;
		}
	} 
	if(ok === true){
	  opener.document.MemberForm.UserID.value = hope_id;

	  window.close();
	} else {
	  document.search.hope_id.value = "";
	}
}
</script>
</head>

<body>
<table width="300" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="40" bgcolor="#26A1CB">&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#26A1CB"><b><font color="#FFFFFF">아이디 중복확인</font></b></td>
    <td width="10" bgcolor="#26A1CB">&nbsp;</td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="box_04">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <form name="search" method="post" action="" onsubmit="return search_check()">
          <tr>
            <td height="50" align="center"><?=$check?></td>
          </tr>
<? if($use_ok == 1){?>
          <tr>
            <td height="30" align="center" valign="middle"><a href="javascript:idUse();"><img src="<?=$ShopConfig['member_img_path']?>bt_use.gif"></td>
          </tr>
<? }?>
          <tr>
            <td height="25" align="center" valign="middle">
			<span class="boder_b">아이디 입력</span>
              <input name="hope_id" maxlength=20 size="15" class=frm2 value="<?=$hope_id?>" align="absmiddle">
			  <input type="image" src="<?=$ShopConfig['member_img_path']?>bt_search.gif"  align="absmiddle">
            </td>
          </tr>
          <tr>
            <td height="10" align="center" valign="middle"></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
          </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
