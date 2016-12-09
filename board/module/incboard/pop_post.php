<?
include "../../config/use_db.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript" src="/js/flash.js"></script>
<script language="javascript" src="/js/link.js"></script>
<style>



TABLE, TD, INPUT, SELECT, TEXTAREA {
	 font-family:Gulim, Verdana, Arial, Helvetica, sans-serif;
	 font-size: 11px;
	 color: #757575;
	 letter-spacing:-0.5px;
	 line-height: 150%;
}



.txt {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color: #9c9a9a;
}


.txt_location {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color: #15a4bb;
}


.txt_green_b {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color: #15a4bb;
	font-weight:bold;
}



.txt_bold {
	font-family: "돋움", "굴림", "바탕";
	font-size: 11px;
	color: ffffff;
	font-weight:bold;
	padding-left:10px;
}


.main_login {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color:#FFFFFF;
	border: 3px solid #327583;
	background-color: #0b0b0b;
}



.textbox {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color:#757575;
	border: 1px solid #202020;
	background-color: #202020;
	height:18px;
}


.textbox_gray {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color:#757575;
	border: 1px solid #f0f0f0;
	background-color: #f0f0f0;
	height:18px;
}



.textbox_nobg {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color:#757575;
	border: 1px solid #e4e4e4;
	background-color: #ffffff;
	height:18px;
}


.textbox_white {
	font-family: "돋움", "굴림";
	font-size: 11px;
	color:#757575;
	border: 1px solid #ffffff;
	background-color: #ffffff;
	height:18px;
}



A:link { text-decoration: none; color:#757575 }
A:visited { text-decoration: none; color:#757575}
A:hover { text-decoration: none; color:#15a4bb}


.png24 {
  tmp:expression(setPng24(this));
}

IMG{border:none}

/* DIV */
#bottom	{ width: 100%; height:40%; margin: 0 auto; padding: 0px; text-align:center; background-color:#161616 }



/* padding */
.pt5 	{ padding-top:5px }

.pt10  { padding-top:10px }
.pt15  { padding-top:15px }
.pt20  { padding-top:20px }
.pr20  { padding-right:20px }

.pb5  {  padding-bottom:5px;}

.pb10  {  padding-bottom:10px;}
.pb20  {  padding-bottom:20px;}
.pb30  {  padding-bottom:30px;}

.pb40  {  padding-bottom:40px;}
.pb50  {  padding-bottom:50px;}
.pb100 {  padding-bottom:100px;}

.pl15  { padding-left:15px }
.pl20  { padding-left:20px }
.pl45  { padding-left:45px }

.ptb1020  { padding-top:10px; padding-bottom:20px;}
.pbl0510  { padding-bottom:5px; padding-left:10px}
.ptb3020  { padding-top:30px; padding-bottom:20px;}


/* table */
table.con1			{ background-color:#ffffff; font-size:11px; color: #757575; font-family: dotum, Verdana, Arial, Helvetica, sans-serif; line-height:140%; }
table.con1 .left	{ background:url(../img/bbs/left_bg.jpg); background-repeat:no-repeat; width:15px; height:31px; text-align:center;}
table.con1 .con		{ height:22px; border-bottom: 1px #ededed solid;}
table.con1 .in		{ background:url(../img/bbs/bg.jpg); height:25px; }
table.con1 .right	{ background:url(../img/bbs/right_bg.jpg); background-repeat:no-repeat; width:15px; }
table.con1 .line	{ border-bottom: 1px #e0e0e0 solid;}


/* table2 */
table.con2			{ background-color:#757575; font-size:11px; color: #4f4f4f; font-family: dotum, Verdana, Arial, Helvetica, sans-serif; line-height:140%; }
table.con2 .con		{ height:22px; border-bottom: 1px #d3cfc4 solid;}
table.con2 .in		{ background:url(../img/bbs/bg.jpg); height:25px; }


/* tab */
table.tab			{ background-color:#757575; font-size:11px; color: #4f4f4f; font-family: dotum, Verdana, Arial, Helvetica, sans-serif; line-height:140%; }
table.tab .on		{ background-image:url(../img/shopping/tab_over.gif); background-repeat:no-repeat; text-align:center; }
table.tab .off		{ background-image:url(../img/shopping/tab_nor.gif); background-repeat:no-repeat; text-align:center; }
</style>
</head>
<?
$zipfile = array();
$fp = fopen("./zip.db", "r");
while(!feof($fp)) {
    $zipfile[] = fgets($fp, 4096);
}
fclose($fp);

$search_count = 0;

if ($addr1)
{
    while ($zipcode = each($zipfile))
    {
        if(strstr(substr($zipcode[1],9,512), $addr1))
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

    if (!$search_count) alert("찾으시는 주소가 없습니다.");
}
?>
<body>
<form name="fzip" method="get" autocomplete="off">
<input type=hidden name=frm_name  value='write_form'>
<input type=hidden name=frm_zip1  value='ZipCode1'>
<input type=hidden name=frm_zip2  value='ZipCode2'>
<input type=hidden name=frm_addr1 value='Address'>
<table width="430" cellpadding="0" cellspacing="0">
	<tr>
		<td class="pl10 pt15"><img src="/franchise/images/contact_img/zipcode_title.gif" width="155" height="40" align="absmiddle"></td>
    </tr>
    <tr>
		<td class="pt15 pl10">찾고자하는 주소의 동(읍/면/리)을 입력하세요.<br />예) 논현, 강남, 압구정(두글자이상)</td>
    </tr>
    <tr>
    	<td height="1" bgcolor="#c04246"></td>
    </tr>
    <tr>
		<td class="pl30 pt15">

        	<table width="100%" cellpadding="0" cellspacing="0">
            	<tr>
                	<td class="font_b" width="15%" align="center">지역명</td>
                    <td width="210"><input name="addr1" type="text" class="input_box w200px" /></td>
                    <td><input type=image src="/franchise/images/contact_img/zipcode_btn2.gif" alt="찾기" align="absmiddle" /></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
    	<td class="font_o pl10 pt10">해당 주소를 입력하시면 자동입력됩니다.</td>
    </tr>
    <tr>
		<td class="pl10">
			<script language='javascript'>
			document.fzip.addr1.focus();
			</script>
        	<table width="100%" cellpadding="0" cellspacing="0">
            	<tr><td height="2" colspan="2" bgcolor="#c04246"></td></tr>
            	<tr>
                    <td width="30%" class="font_b font_g" align="center">우편번호</td>
					<td class="font_b font_g" height="34" align="center">주소</td>
                </tr>
				<? if ($search_count > 0) { ?>
				<?
				for ($i=0; $i<count($list); $i++) {
					echo "<tr><td height=19  align=\"center\" style='cursor:hand;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]}</td><td style='cursor:hand;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][addr]} {$list[$i][bunji]}</a></td></tr>\n";
				}
				?>

				<script language="javascript">
				function find_zip(zip1, zip2, addr1)
				{
					var of = opener.document.write_form;

					of.ZipCode1.value  = zip1;
					of.ZipCode2.value  = zip2;

					of.Address.value = addr1;

					of.Address.focus();
					window.close();
					return false;
				}
				</script>
				<? } ?>
                <tr><td height="2" colspan="2" bgcolor="#e9e9e9"></td></tr>
            </table>
        </td>
    </tr>
</table>

</body>

</html>