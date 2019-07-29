<div class="header_v6 header_v5 header_v3">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top">
				<div class="container">
						<div class="header_text_layout6 col-xs-12">
							{hook h="displayCustomhtml20"}
						</div>
				</div>
		  	</nav>
		{/block}
		{block name='header_center'}
		  	<div class="header-center">
				<div class="container">
			   		<div class="row">
						<div class="nav-2 col-lg-4 col-md-4 col-sm-8 col-xs-8">
							{hook h="displayNav_2"}
						</div>

						<div id="header-logo" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				  			<a href="{$urls.base_url}">
									<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
				  			</a>
						</div>
				
						<div id="header-cart" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="userinfo-header6 clearfix">
									{hook h="displayUserinfo"}
							</div>
							{hook h='displayCart'}
							<div id="_mobile_cart"></div>
						</div>

			  		</div>
				</div>
		  	</div>
		{/block}
		{block name='header_bottom'}
			<div class="header-bottom {if $SP_keepMenuTop}menu-on-top {/if} clearfix">
				<div class="container">
					<div class="header-ontop">
						<div class="row">
							<div class="main-menu col-lg-9 col-md-6 col-xs-3">
								<div id="header_menu">
									{hook h="displayMenu"}
								</div>
							</div>
							<div id="header_search" class="col-lg-3 col-md-6 col-xs-9">
								{hook h='displaySearchPro2'}
							</div>
						</div>
					</div>
				</div>
			</div>
		{/block}

		{if {$page.page_name} == 'index'}
			<div class="slider-banner clearfix">
				{assign var='displayHomeSlider6' value={hook h='displayHomeSlider6'}}
				{if $displayHomeSlider6}
					{hook h='displayHomeSlider6'}
				{/if}
			</div>
		{/if}
	{/block}
</div>