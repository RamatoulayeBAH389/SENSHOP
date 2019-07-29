<div class="header_v2">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top">
				<div class="container">
					<div class="row">
						<div class="box-left col-md-5 hidden-sm-down">
							{include file="./login_myaccount_header.tpl"}
						</div>
						<div class="box-right clearfix col-md-7 col-xs-12">
							<div class="header-top-right">
								{hook h="displayNav_2"}
								{hook h="displayUserinfo"}
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
						<div id="header-logo" class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
				  			<a href="{$urls.base_url}">
								<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
				  			</a>
						</div>
						<div id="header_search" class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
							{hook h='displaySearchPro'}
						</div>
						{hook h="displayCustomhtml1"}
			  		</div>
				</div>
		  	</div>
		{/block}
		{block name='header_bottom'}
			<div class="{if $SP_keepMenuTop}menu-on-top {/if} header-bottom">
				<div class="container">
					<div class="header-ontop">
						<div class="row">
							<div id="vertical_menu" class="col-lg-3 col-sm-12 col-xs-12">
								{hook h='displayVertical'}
							</div>

							<div class="main-menu col-lg-9 col-xs-12">
								<div id="header_menu">
									{hook h="displayMenu"}
								</div>
								<div id="header-cart">
									{hook h='displayCart'}
									<div id="_mobile_cart" class="pull-xs-right"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		{/block}

		{if {$page.page_name} == 'index'}
			<div class="slider-banner clearfix">
				{assign var='displayHomeSlider2' value={hook h='displayHomeSlider2'}}
				{if $displayHomeSlider2}
					{hook h='displayHomeSlider2'}
				{/if}
			</div>
		{/if}
	{/block}
</div>