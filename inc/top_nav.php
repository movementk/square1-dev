<div id="top-nav">
	<div class="container">
		<div class="row">
			<div class="col-xs-2 col-lg-3">
				<button class="btn btn-menu hidden-lg" type="button">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="sr-only">메뉴버튼</span>
				</button>
				<ul class="member visible-lg">
					<li><a href="/">HOME</a></li>
					<? if($is_member){ ?>
					<li><a href="/member/logout.php">LOGOUT</a></li>
					<li><a href="/member/edit_form.php">MYPAGE</a></li>
					<? } ?>
					<? if($is_guest){ ?>
					<li><a href="/member/login.php">LOGIN</a></li>
					<li><a href="/member/terms.php">JOIN</a></li>
					<? } ?>
				</ul>
			</div>
			<div class="col-xs-8 col-lg-4 col-lg-offset-1">
				<h1 class="logo"><a href="/"><img src="/assets/images/logo.png" alt="스퀘어원"></a></h1>
			</div>
			<div class="col-xs-2 col-lg-3 col-lg-offset-1">
				<ul class="sns visible-lg">
					<li><a class="facebook" href="https://www.facebook.com/Mall.Square1" target="_blank" aria-label="페이스북"><i class="icon-facebook"></i></a></li>
					<li><a class="instagram" href="https://www.instagram.com/square1_incheon" target="_blank" aria-label="인스타그램"><i class="icon-instagram"></i></a></li>
				</ul>
				<button class="btn btn-toggle-search hidden-lg" type="button">
					<span class="sr-only">검색폼 버튼</span>
				</button>
				<div class="search-area">
					<div class="form-group">
						<label for="global-search-keyword" class="sr-only">검색어</label>
						<input id="global-search-keyword" type="text" class="form-control" name="#" placeholder="BRAND SEARCH" autocomplete="off">
						<button type="button" class="btn btn-global-search" id="global-search-button"><i class="icon-search"></i></button>
					</div>
					<div class="results" id="global-search-result">
						<p class="nothing">검색결과가 없습니다.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
