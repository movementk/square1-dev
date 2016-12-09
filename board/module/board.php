<?
$today=date("Y-m-d");

$sql = " select * from ".$site_prefix."board_setting where BoardName = '".$workType."' ";
$row = sql_fetch($sql);
$date_idx = $row[Idx];
$levelchk = $member[Level];
if(!$levelchk) $levelchk = 0;

$mode = $site_prefix."board_".$workType;

$searchVal = "Category=".urlencode($Category)."&sF=".$sF."&sT=".$sT."&workType=".$workType."&mode=".$mode;

switch($workType){
	case "notice":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/board_view.php";	}
		}
		break;
	case "press":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/press_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/press_board_view.php";	}
		}
		break;
	case "pr":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/pr_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/pr_board_view.php";	}
		}
		break;
	case "qna":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/qna_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/qna_board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/qna_board_view.php";	}
		}
		break;
	case "brand":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/brand_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/brand_board_view.php";	}
		}
		break;
	case "hall":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/hall_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/hall_board_view.php";	}
		}
		break;
	case "square1":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/square1_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/square1_board_view.php";	}
		}
		break;
	case "prizewinner":
		if($board_code=="" || $board_code=="board_list"){ include $dir."/module/incboard/prize_board_list.php";	}
		if($pwdck){
			include $dir."/module/incboard/password.php";
		} else {
			if($board_code=="board_write"){ include $dir."/module/incboard/board_write.php";	}
			if($board_code=="board_view"){ include $dir."/module/incboard/prize_board_view.php";	}
		}
		break;
}

?>