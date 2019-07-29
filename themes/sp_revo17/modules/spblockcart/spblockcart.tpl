<div id="_desktop_cart" class="clearfix">
	{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout}
	<div class="cart_mobilelayout cart-preview{if $cart.products_count > 0} active{else} inactive{/if}" data-refresh-url="{$refresh_url}">
		 <div class="shopping_cart clearfix">
			<a rel="nofollow" href="{$cart_url}">
				<i class="fa fa-shopping-basket" style="font-size: 16px;margin-bottom: 6px;"></i> 
			</a>
			<span class="cart-products-count">{$cart.products_count}</span>
			<span class="button-sticky-bottom-text">{l s='My Cart' d='Shop.Theme.Checkout'}</span>
		</div>
	</div>
	{else}
    <div class="spblockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
        <div class="shopping_cart clearfix">
            {if $cart.products_count > 0}
                <a rel="nofollow" href="{$cart_url}">
            {/if}
	            <div class="cart-icon">
	            	<span class="cart-products-count">{$cart.products_count}</span>
	                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
	            </div>
	            <div class="cart-content">
	                <span class="shopping-cart-title">{l s='Shopping Cart' d='Shop.Theme.Checkout'}</span>
                    <span class="cart-products-total">{$cart.totals.total.value}</span>
	            </div>
            {if $cart.products_count > 0}
                </a>
            {/if}
        </div>
    </div>
	{/if}
</div>
