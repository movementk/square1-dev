<?
include_once $_SERVER["DOCUMENT_ROOT"]."/board/config/use_db.php";

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content" || $KEY == "Etc1"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}


if(trim($eidx) == ""){
	GetAlert("잘못된접근입니다. 정상적으로 응모해주시기 바랍니다.","BACK");
	exit;
}

if(trim($uname) == ""){
	GetAlert("응모자명이 입력되지 않았습니다.","BACK");
	exit;
}

$phone = $phone1."-".$phone2."-".$phone3;

$sql_common = "er1 = '".$er1."', ";

if($phone == "--"){
	GetAlert("휴대폰번호가 입력되지 않았습니다.","BACK");
	exit;
}

$sql = " select * from ".$site_prefix."event_request where eidx = '".$eidx."' and uname = '".$uname."' and phone = '".$phone."' ";
$row = sql_fetch($sql);

if($row["idx"] > 0){
	GetAlert("","/event/event_identify02.php?idx=".$row["idx"]."&workType=RER");
} else {
	$sql = " insert into ".$site_prefix."event_request set
								eidx = '".$eidx."',
								uname = '".$uname."',
								$sql_common
								phone = '".$phone."',
								RegDate = now() ";
	$result = sql_query($sql);


	$idx = get_max($site_prefix."event_request","idx","");

	if($result){
		GetAlert("","/event/event_identify02.php?idx=".$idx."&workType=RIR");
	}
}
?>