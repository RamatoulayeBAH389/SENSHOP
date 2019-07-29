<div class="header_mobile">
	<div class="header-top-content">
		<div class="container">
			<div class="logo-categories clearfix">
				<div class="logo-mobile">
					<a href="{$urls.base_url}">
						<img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
					</a>
				</div>
				<div class="spverticalmenu-mobile">
					{hook h='displayVertical'}
				</div>
			</div>
		</div>
	</div>
	<div class="sticky-bottom">
		<div class="container">
			<div class="content-group-block">
				<div class="group-block">
					<div class="block-bottom">
						<a class="button-sticky-bottom button-home" href="{$urls.base_url}">
						<i class="fa fa-home" style="font-size: 22px;"></i> 
						<span class="button-sticky-bottom-text">{l s='Home' d='Shop.Theme.Checkout'}</span>
						</a>
					</div>
					<div class="search-bottom block-bottom">
						<a class="button-sticky-bottom" href="javascript:void(0)" data-drop="search-drop">
							<i class="fa fa-search" style="font-size: 18px;margin-bottom: 5px;"></i>
							<span class="button-sticky-bottom-text">{l s='Search' d='Shop.Theme.Checkout'}</span>
						</a>
						<div class="box-sticky-bottom">
							{hook h='displaySearchPro'}
							<div class="remove-box-sticky fa fa-remove"></div>
						</div>
					</div>
					<div class="cart-bottom block-bottom">
						{hook h='displayCart'}
						<div id="_mobile_cart"></div>
					</div>
					<div class="myaccount-bottom block-bottom">
						<a class="button-sticky-bottom" href="javascript:void(0)" data-drop="myaccount-drop">
							<i class="fa fa-user" style="font-size: 18px;    margin-bottom: 4px;"></i> 
							<span class="button-sticky-bottom-text">{l s='My Account' d='Shop.Theme.Checkout'}</span>
						</a>
						<div class="box-sticky-bottom">
							{include file="./myaccount_mobile.tpl"}
							<div class="remove-box-sticky fa fa-remove"></div>
						</div>
					</div>
					<div class="megamenu-bottom block-bottom">
						{hook h="displayMenu"}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>