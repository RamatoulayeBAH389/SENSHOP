<div class="header_v4">
	{block name='header'}
		{block name='header_top'}
		  	<nav class="header-top {if $SP_keepMenuTop}menu-on-top {/if}">
				<div class="container container-customer">
					<div class="row">
						<div class="menu-nav col-md-5 col-sm-12">
							{hook h="displayMenu"}
							{hook h="displayNav"}
						</div>

						<div id="header-logo" class="col-md-2 col-sm-12">
				  			<a href="{$urls.base_url}">
								<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}" width="120" height="40">
				  			</a>
						</div>

						<div class="search-login-cart col-md-5 col-sm-12">
							{hook h='displayCart'}
							<div id="_mobile_cart" class="pull-xs-right"></div>

							{hook h="displayUserinfo"}

							{include file="./button-search.tpl"}

						</div>
					</div>
				</div>
		  	</nav>
		{/block}

		{if {$page.page_name} == 'index'}
			<div class="ps-spotlight1 clearfix">
				<div class="container container-customer">
					<div class="row">
						{hook h="displayCustomhtml10"}
					</div>
				</div>
			</div>
		{/if}

		{if {$page.page_name} == 'index'}
			<div class="container">
				<div class="slider-banner clearfix">
					{assign var='displayHomeSlider4' value={hook h='displayHomeSlider4'}}
					{if $displayHomeSlider4}
						{hook h='displayHomeSlider4'}
					{/if}
				</div>
			</div>
		{/if}
	{/block}
</div>