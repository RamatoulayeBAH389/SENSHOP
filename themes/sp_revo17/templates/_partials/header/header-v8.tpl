<div class="header_v8">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top">
				<div class="container">
					<div class="row">
						{hook h="displayCustomhtml6"}
						<div class="box-right clearfix col-md-6 col-xs-12">
							{hook h="displayUserinfo2"}
							{hook h="displayCustomhtml7"}
						</div>
					</div>
				</div>
		  	</nav>
		{/block}
		{block name='header_center'}
			<div class="header-center">
				<div class="container">
					<div class="row">
						<div class="top-logo hidden-sm-up col-xs-12" id="_mobile_logo">
							<a href="{$urls.base_url}">
									<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
							</a>
						</div>
						
						<div class="nav_2 col-lg-4 col-md-4 col-sm-4 col-xs-8">
							{hook h="displayNav_2"}
						</div>
						
						<div id="header-logo" class="col-lg-4 col-md-4 col-sm-4 hidden-xs-down">
							<a href="{$urls.base_url}">
								<img class="logo img-responsive" src="{$urls.img_ps_url}/logo-8.png" alt="{$shop.name}">
							</a>
						</div>
						
						<div class="html-cart col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div id="header-cart">
								{hook h='displayCart'}
								<div id="_mobile_cart" class="pull-xs-right"></div>
							</div>
							{hook h="displayCustomhtml30"}
						</div>
					</div>
				</div>
			</div>
		{/block}
		{block name='header_bottom'}
			<div class="header-bottom_8">
				<div class="{if $SP_keepMenuTop}menu-on-top{/if} header-ontop">
					<div class="container">
						<div id="header_menu" class="col-md-11 col-xs-10">
							{hook h="displayMenu"}
						</div>
						<div id="search_h5" class="col-md-1 col-xs-2">
							{include file="./button-search.tpl"}
						</div>
					</div>
				</div>
			</div>
		{/block}
		
		<div class="ps-spotlight8-1 clearfix">
			<div class="container">
				<div class="row">
					{hook h="displayCustomhtml29"}
				</div>
			</div>
		</div>
		
		{if {$page.page_name} == 'index'}
			<div class="slider-container-8 clearfix">
				{hook h='displayHomeSlider8'}
			</div>
		{/if}
	{/block}
</div>