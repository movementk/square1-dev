<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/member.css">
<style>
.inquiry-view .view-content .content-view .article-content .comment-list .comment-info {
  padding: 22px 11px;
  border-bottom: 1px solid #dfdfdf; }
  .inquiry-view .view-content .content-view .article-content .comment-list .comment-info h4 {
    display: inline;
    font-size: 12px;
    color: #333; }
    @media (min-width: 768px) {
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info h4 {
        font-size: 13px; } }
  .inquiry-view .view-content .content-view .article-content .comment-list .comment-info .date {
    display: inline;
    margin-left: 8px;
    font-size: 12px;
    color: #666;
    font-family: 'Lato', sans-serif; }
    @media (min-width: 768px) {
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info .date {
        font-size: 13px; } }
  .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul {
    float: right;
    display: inline; }
    .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li {
      display: inline-block; }
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li a {
        font-size: 12xp;
        color: #999; }
        @media (min-width: 768px) {
          .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li a {
            font-size: 13px; } }
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li:after {
        font-size: 10px;
        content: "|";
        color: #d8d8d8;
        margin: 0 8px; }
        @media (min-width: 768px) {
          .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li:after {
            font-size: 13px;
            margin: 0 10px; } }
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info ul li:last-child:after {
        content: '';
        margin: 0; }
  .inquiry-view .view-content .content-view .article-content .comment-list .comment-info p {
    clear: both;
    display: block;
    font-size: 12px;
    color: #999; }
    @media (min-width: 768px) {
      .inquiry-view .view-content .content-view .article-content .comment-list .comment-info p {
        margin-top: 10px;
        font-size: 13px; } }
  .inquiry-view .view-content .content-view .article-content .comment-list .comment-info.reply {
    padding-left: 40px;
    background-image: url(/assets/images/center/reply_img.gif);
    background-repeat: no-repeat;
    background-position: 15px 40px; }
</style>
</head>
<body class="sub member mypage">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>회원전용</small>MEMBERSHIP</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의<br class="visible-xs">
					라이프 스타일 공간입니다.<br class="hidden-xs"> FASHION · F&amp;B · CGV <br class="visible-xs">
					<span class="hidden-xs"> · </span>HOME PLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
				<h2>1:1 문의현황</h2>
				<hr>
				<p>
					고객님께서 Q&amp;A에 올려주신 소중한 의견을 확인 하실 수 있습니다.
				</p>
				<div class="snb">
					<div class="container">
						<button class="btn btn-block" type="button">
							1:1 문의현황
						</button>
						<nav>
							<ul>
								<li><a href="/member/edit_form.php">회원정보 수정</a></li>
								<li><a href="/member/mypoint.php">마이포인트</a></li>
								<li class="active"><a href="/member/inquiry_list.php">1:1 문의</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<?
			$mode = $site_prefix."board_qna";
			$BoardName = "qna";
			$fileURL="../board/upload/".$BoardName."/";

			if(empty($BoardIdx)) $BoardIdx = $_REQUEST["board_idx"];

			$BoardViewSQL = "select * from ".$mode." where BoardIdx=".$BoardIdx;
			$view = sql_fetch($BoardViewSQL);

			$sql1 = "update ".$mode." set ReadNum=ReadNum+1 where BoardIdx=".$BoardIdx;
			mysql_query($sql1);

			$view["files"] = get_file($mode,$BoardIdx);

			if($is_member || $is_admin){
				$modify_link_in_view = "modify_chk(document.view_form);";
				$delete_link_in_view = "delete_chk();";
			} else {
				$modify_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_write');";
				$delete_link_in_view = "pwd_ck('".$view["BoardIdx"]."','board_delete');";
			}
			$fstart = 0;

			$searchVal .= "&list_type=".$list_type."&board_list_num=".$board_list_num."&bd4=".$bd4."&bd5=".$bd5;
			?>
			<div class="container">
				<div class="inquiry-view">
					<div class="view-content">
						<article class="content-view">
							<div class="article-header">
								[<?=$view["Category"]?>] <?=$view["Title"]?>
							</div>
							<div class="article-content">
								<div class="content">
									<?
									for($i=$fstart;$i<$view["files"]["count"];$i++){
										if($view["files"][$i][file_source]){
											if($view["files"][$i][image_type]=="1" || $view["files"][$i][image_type]=="2" || $view["files"][$i][image_type]=="3" || $files[$i][image_type]=="6"){
												$dir2 = $view["files"][$i]["path"]."/".$view["files"][$i][file_source];
												?>
													<img src="<?=$dir2?>"  name='target_resize_image[]' class='img-responsive'><br>
												<?
											 } else if(preg_match("/\.(avi|wmv|asf)$/i",$view["files"][$i][file_source])){
											?>
												<embed src="../board/upload/<?=$BoardName?>/<?=$view["files"][$i][file_source]?>" AutoStart="true" width=600 height=420><br>
											<?
											}
										}
									}
									if($view["HtmlChk"]=="Y"){
										$view["Content"] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' class='img-responsive' \\2 \\3", $view["Content"]);
										echo $view["Content"];
									} else {
										echo nl2br($view["Content"]);
									}
									?>
								</div>
								<div class="user-info">
									<ul>
										<li>
											<dl>
												<dt>등록일</dt>
												<dd><?=substr($view["RegDate"],0,10)?></dd>
											</dl>
										</li>
										<li>
											<dl>
												<dt>작성자</dt>
												<dd><?=$view["UserName"]?></dd>
											</dl>
										</li>
										<li>
											<dl>
												<dt>조회수</dt>
												<dd><?=number_format($view["ReadNum"])?></dd>
											</dl>
										</li>
									</ul>
									<!--div class="hidden-xs">
										<p class="print">
											<a href="#"><i class="icon-print"></i>인쇄하기</a>
										</p>
									</div-->
								</div>
								<div class="attach">
									<dl class="file">
										<dt><i class="icon-attach"></i>첨부파일</dt>
										<?
										for($i=$fstart;$i<$view["files"]["count"];$i++){
										//	if($files[$i][image_type]=="1" || $files[$i][image_type]=="2" || $files[$i][image_type]=="3" || $files[$i][image_type]=="6") continue;
											echo "<dd><a href='".$view["files"][$i][href]."'>".$view["files"][$i][file_name]."</a><dd>";
										}
										?>
									</dl>
								</div>
								<div class="btn-area">
									<? if($view[UserID] == $user[ID] || $is_admin){ ?>
									<p>
										<a href="javascript:;" onclick="<?=$modify_link_in_view?>" class="btn-sm btn-default" role="button">수정하기</a>
										<a href="javascript:;" onclick="<?=$delete_link_in_view?>" class="btn-sm btn-default" role="button">삭제하기</a>
									</p>
									<? } ?>
									<p class="basic-btn">
										<a href="inquiry_list.php?page=<?=$page?>&<?=$searchVal?>" class="btn btn-gray" role="button">목록보기</a>
									</p>
								</div>
								<? if($view["bd1"]){ ?>
								<div class="comment-list">
									<div class="comment-info">
										<h4>스퀘어원</h4>
										<p class="comment-txt"><?=nl2br($view["bd1"])?></p>
									</div>
								</div>
								<? } ?>
							</div>
						</article>
					</div>    
				</div>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	
	<form name="view_form" method="post" action="/board/module/incboard/board_ok.php">
	<input type="hidden" name="board_code" value="board_delete">
	<input type="hidden" name="BoardIdx" value="<?=$view[BoardIdx]?>">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="URI" value="/member/inquiry_list.php">
	<input type="hidden" name="page" value="<?=$page?>">
	<input type="hidden" name="start_page" value="<?=$start_page?>">
	<input type="hidden" name="Category" value="<?=$Category?>">
	<input type="hidden" name="workType" value="<?=$workType?>">
	<input type="hidden" name="sT" value="<?=$sT?>">
	<input type="hidden" name="sF" value="<?=$sF?>">
	<input type="hidden" name="mob" value="">
	<input type="hidden" name="Ref" value="">
	<input type="hidden" name="ReStep" value="">
	<input type="hidden" name="ReLevel" value="">
	<input type="hidden" name="returnpage" value="">
	<input type="hidden" name="pwdck">
	</form>
	<script>
	function delete_chk(){
		var form = document.view_form;
		if(!confirm('정말로 삭제하시겠습니까?')) return;
		form.submit();
	}
	function reply_ck(f){
		f.method = "get";
		f.board_code.value = "board_write";
		f.action = "<?=$_SERVER['PHP_SELF']?>";
		f.Ref.value = "<?=$view['Ref']?>";
		f.ReStep.value = "<?=$view[ReStep]?>";
		f.ReLevel.value = "<?=$view[ReLevel]?>";
		f.mob.value = '1';
		f.submit();
	}
	function modify_chk(f){
		f.method = "get";
		f.board_code.value = "board_write";
		f.action = "/center/qna_list.php";
		f.submit();
	}
	function pwd_ck(idx,code){
		var f = document.view_form;
		f.board_code.value = code;
		f.BoardIdx.value = idx;
		f.pwdck.value = "1";
		if(code == "board_delete"){
			if(!confirm("정말 삭제하시겠습니까?")) return;
			f.returnpage.value = "/board/module/incboard/board_ok.php";
		}
		f.action = "<?=$_SERVER['PHP_SELF']?>";
		f.submit();
	}
	function resizeBoardImage(imageWidth, borderColor) {
		var target = document.getElementsByName('target_resize_image[]');
		var imageHeight = 0;

		if (target) {
			for(i=0; i<target.length; i++) { 
				// 원래 사이즈를 저장해 놓는다
				target[i].tmp_width  = target[i].width;
				target[i].tmp_height = target[i].height;
				// 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
				if(target[i].width > imageWidth) {
					imageHeight = parseFloat(target[i].width / target[i].height)
					target[i].width = imageWidth;
					target[i].height = parseInt(imageWidth / imageHeight);
				//	target[i].style.cursor = 'pointer';

					// 스타일에 적용된 이미지의 폭과 높이를 삭제한다
					target[i].style.width = '';
					target[i].style.height = '';
				}

				if (borderColor) {
					target[i].style.borderWidth = '1px';
					target[i].style.borderStyle = 'solid';
					target[i].style.borderColor = borderColor;
				}
			}
		}
	}

	window.onload = function(){
		resizeBoardImage(970);
	}
	</script>
</body>
</html>