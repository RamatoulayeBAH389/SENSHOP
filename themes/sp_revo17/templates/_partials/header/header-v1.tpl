<div class="header_v1">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top">
				<div class="container">
					<div class="row">
						<div class="box-left col-md-5">
							{include file="./login_myaccount_header.tpl"}
						</div>
						<div class="box-right clearfix col-md-7 col-xs-12">
							<div class="header-top-right">
								{hook h="displayNav_2"}
							</div>
						</div>
					</div>
				</div>
		  	</nav>
		{/block}
		{block name='header_center'}
		  	<div class="{if $SP_keepMenuTop}menu-on-top {/if} header-center">
				<div class="container">
					<div class="header-ontop">
				   		<div class="row">
							<div id="header-logo" class="col-lg-2 col-sm-12 col-xs-12">
					  			<a href="{$urls.base_url}">
									<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
					  			</a>
							</div>
							<div id="header_menu" class="col-lg-7 col-sm-12 col-xs-12">
								{hook h="displayMenu"}
							</div>
							{hook h="displayCustomhtml1"}
				  		</div>
					</div>
				</div>
		  	</div>
		{/block}
		{block name='header_bottom'}
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div id="vertical_menu" class="col-lg-3 col-sm-8 col-xs-5">
							{hook h='displayVertical'}
						</div>
						<div id="header_search" class="col-lg-6 col-xs-12">
							{hook h='displaySearchPro'}
						</div>
						<div id="header-cart" class="col-lg-3 col-sm-4 col-xs-7">
							{hook h='displayCart'}
							<div id="_mobile_cart" class="pull-xs-right"></div>
						</div>
					</div>
				</div>
			</div>
		{/block}
		{if {$page.page_name} == 'index'}
			<div class="slider-banner clearfix">
				<div class="container">
					<div class="slider-container col-md-6">
						{hook h='displayHomeSlider'}
					</div>
					<div class="banner-layout-1">
						{hook h="displayBanner"}
						{hook h="displayBanner2"}
						{hook h="displayBanner3"}
					</div>
				</div>
			</div>
		{/if}
	{/block}
</div>