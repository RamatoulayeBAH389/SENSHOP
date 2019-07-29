<div class="header_v7">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top">
				<div class="container">
					<div class="row">
						<div class="box-left col-lg-3 col-md-6 col-sm-6 col-xs-12">
							{hook h="displayUserinfo2"}
						</div>
						<div class="box-center col-lg-6 hidden-md-down">
							{hook h="displayCustomhtml6"}
						</div>
						<div class="box-right clearfix col-lg-3 col-md-6 col-sm-6 col-xs-12">
							<div class="header-top-right">
								{hook h="displayNav_2"}
							</div>
						</div>
					</div>
				</div>
		  	</nav>
		{/block}
		{block name='header_center'}
			<div class="header-center">
				<div class="container">
					<div class="row">
						<div id="header-logo" class="col-lg-3 col-sm-12 col-xs-12">
							<a href="{$urls.base_url}">
									<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
							</a>
						</div>
						<div id="header_search" class="col-lg-5 col-md-9 col-xs-9">
							{hook h='displaySearchPro'}
						</div>
						
						<div class="html-cart col-lg-4 col-md-3 col-xs-3">
							<div id="header-cart">
								{hook h='displayCart'}
								<div id="_mobile_cart" class="pull-xs-right"></div>
							</div>
							{hook h="displayCustomhtml1"}
						</div>
					</div>
				</div>
			</div>
		{/block}
		{block name='header_bottom'}
			<div class="header-bottom_v7">
				<div class="{if $SP_keepMenuTop}menu-on-top{/if} header-ontop">
					<div class="container">
						<div id="header_menu">
							{hook h="displayMenu"}
						</div>
					</div>
				</div>
			</div>
		{/block}
		{if {$page.page_name} == 'index'}
			<div class="slider-banner-7 clearfix">
				<div class="container">
					<div class="row">
						<div id="vertical_menu" class="col-lg-3 col-sm-12 col-xs-12">
							{hook h='displayVertical'}
						</div>
						<div class="slider-container-7 col-lg-4 col-md-6 col-xs-12">
							{hook h='displayHomeSlider7'}
						</div>
						<div class="banner-layout-7 col-lg-5 col-md-6 col-xs-12">
							<div class="col-md-6 col-xs-6 lol-1">
								{hook h="displayBanner26"}
							</div>
							<div class="col-md-6 col-xs-6 lol-2">
								{hook h="displayBanner27"}
								{hook h="displayBanner28"}
							</div>
						</div>
					</div>
				</div>
			</div>
		{/if}
	{/block}
</div>