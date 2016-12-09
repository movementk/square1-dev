<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t100 = "top_mon";
$t101 = "navi_mon";
$left = "l1";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."admin";
$searchVal = "page=".$page;

$workType = "AI";

$file_script = "";
$file_length = -1;

if($admin_idx){
	$sql = " select * from ".$mode." where admin_idx = '".$admin_idx."' ";
	$row = sql_fetch($sql);

	$workType = "AM";
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">관리자 설정</div>

		<form name="info_form" method="post" action="/board/admn/_proc/setup/_admin_proc.php">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="admin_idx" value="<?=$row["admin_idx"]?>">
		<input type="hidden" name="URI" value="/board/admn/setup/modify.php">
		<input type="hidden" name="dupe_ck" value="N">
		<table class="write_table">
			<colgroup>
				<col style="width:120px;"></col>
				<col></col>
				<col style="width:120px;"></col>
				<col></col>
			</colgroup>
			<tbody>
			<tr>
				<th><label>아이디</label></th>
				<td colspan="3"><input type="text" class="input" name="admin_id" exp title="아이디" onkeyup="admin_id_ck(this.value);" onblur="admin_id_ck(this.value);" value="<?=$row["admin_id"]?>"><span id="span_id_ck" style="color:red;font-weight:bold;padding-left:10px;">※ 4글자이상 입력하시기 바랍니다.</span></td>
			</tr>
			<tr>
				<th><label>비밀번호</label></th>
				<td><input type="password" class="input" name="admin_pwd" exp title="비밀번호" value=""></td>
				<th><label>비밀번호확인</label></th>
				<td><input type="password" class="input" name="admin_pwd_re" exp title="비밀번호확인" value=""></td>
			</tr>
			<tr>
				<th><label>이름</label></th>
				<td><input type="text" class="input" name="admin_name" exp title="이름" value="<?=$row["admin_name"]?>"></td>
				<th>연락처</th>
				<td><input type="text" class="input" name="admin_hp" exp title="연락처" value="<?=$row["admin_hp"]?>"></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td><input type="text" class="input" name="admin_email" exp title="이메일" value="<?=$row["admin_email"]?>"></td>
				<th>관리자등급</th>
				<td>
					<select name="admin_level">
						<option value=''>선택</option>
						<? if($admin["admin_level"] >= 99){ ?>
						<option value='99' <?=$row["admin_level"]=="99"?"selected":""?>>최고관리자</option>
						<? } ?>
						<? if($admin["admin_level"] >= 80){ ?>
						<option value='80' <?=$row["admin_level"]=="80"?"selected":""?>>봉사자관리자</option>
						<? } ?>
						<? if($admin["admin_level"] >= 70){ ?>
						<option value='70' <?=$row["admin_level"]=="70"?"selected":""?>>게시판관리자</option>
						<? } ?>
					</select>
				</td>
			</tr>
			</tbody>
		</table>
		</form>

		<div class="mt5 btn_group">
			<button type="button" class="btn_a_b" onclick="board_check();"><?=$workType=="AI"?"등 록":"수 정"?></button>&nbsp;
			<button type="button" class="btn_a_n" onclick="location.href='/board/admn/setup/modify.php?<?=$searchVal?>';">취 소</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>
<script language="javascript">
function board_check(){
	var f = document.info_form;

	if($("input[name='admin_pwd']").val() != $("input[name='admin_pwd_re']").val()){
		alert("비밀번호가 일치하지 않습니다.\n비밀번호와 비밀번호 확인란에\n동일한 비밀번호를 입력하시기 바랍니다");
		return;
	}

	if($("input[name='dupe_ck']").val() == "N"){
		alert("관리자 아이디를 정확히 입력하시기 바랍니다.");
		return;
	}

	if(FormCheck(f) == true){
		f.submit();
	} else {
		return;
	}
}

function admin_id_ck(val){
	var id_dupe_ck = "N";
	var id_dupe_str = "";
	jQuery.ajax({
		url: "/board/config/admin_id_check.php",
		type : "POST",
		data: "val="+val+"&old_id=<?=$row['admin_id']?>",

		error: function(xhr,textStatus,errorThrown){
			alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
		},
		beforeSend: function() {
		},
		success: function(data){
			switch(data){
				case "100":
					id_dupe_ck = "Y";
					id_dupe_str = "※ 사용 가능한 아이디 입니다.";
					break;
				case "200":
					id_dupe_ck = "N";
					id_dupe_str = "※ 4글자이상 입력하시기 바랍니다.";
					break;
				case "201":
					id_dupe_ck = "N";
					id_dupe_str = "※ 이미 존재하는 아이디 입니다.";
					break;
				default:
					id_dupe_ck = "N";
					id_dupe_str = data;
					break;
			}
		},
		complete: function(){
			if(id_dupe_ck == "Y") $("#span_id_ck").css({"color":"blue"});
			else $("#span_id_ck").css({"color":"red"});

			$("input[name='dupe_ck']").val(id_dupe_ck);

			$("#span_id_ck").html(id_dupe_str);
		}
	});
}

window.onload = function(){
	admin_id_ck($("input[name='admin_id']").val());
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>