<?
if($mode == "sama_book"){

	  include "../incboard/book_write.php";

}elseif($mode == "sama_online"){

	  include "../incboard/online_write.php";

}else{
	 if($board_code=="board_view"){ include "../incboard/board_view.php";	}
	 if($board_code=="board_write"){ include "../incboard/board_write.php";	}
	 if($board_code=="" || $board_code=="board_list"){ include "../incboard/board_list.php";	}
}
?>