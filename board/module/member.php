<? 
//echo $member_code;
//exit;
	switch ($member_code) {
		case "Login":
			include $dir."/module/incmember/memberLogin.php";
			break;
		case "Agree":
			include $dir."/module/incmember/memberAgree.php";
			break;
		case "Agree2":
			include $dir."/module/incmember/memberAgree2.php";
			break;
		case "Join":
			include $dir."/module/incmember/memberJoin.php";			
			break;
		case "JoinEnd":
			include $dir."/module/incmember/memberJoin_end.php";
			break;
		case "Search":
			include $dir."/module/incmember/memberSearch.php";
			break;
		case "Search1":
			include $dir."/module/incmember/memberSearch1.php";
			break;
		case "Search2":
			include $dir."/module/incmember/memberSearch2.php";
			break;
		case "Search3":
			include $dir."/module/incmember/memberSearch3.php";
			break;
		case "Mypage":
			include $dir."/module/incmember/memberMypage.php";			
			break;
		case "Service":
			include $dir."/module/incmember/memberService.php";
			break;
		case "Break":
			include $dir."/module/incmember/memberBreak.php";
			break;
		case "LogOut":
			move_to($loc."/board/module/incmember/logout.php");
			break;
		case "Memo":
			include $dir."/module/incmember/memberMemo.php";
			break;
		default:
			include $dir."/module/incmember/memberLogin.php";

	}
?>