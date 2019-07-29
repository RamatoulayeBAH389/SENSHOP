{*
 * @package Sp One Step Checkout
 * @version 1.0.2
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 YouTech Company. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}

{block name='step_review'}
    {if isset($minimal_purchase)}
        <div class="alert alert-warning">
            {$minimal_purchase}
        </div>
    {/if}
    <div id="order-detail-content" class="cart-detailed-totals cf">
		{block name='cart_detailed_product'}
		  <div class="cart-overview js-cart" data-refresh-url="{url entity='cart' params=['ajax' => true, 'action' => 'refresh']}">
			{if $cart.products}
			<ul class="cart-items">
			  {foreach from=$cart.products item=product}
				<li class="cart-item">
				  {block name='cart_detailed_product_line'}
					{include file='./cart-detailed-product-line.tpl' product=$product}
				  {/block}
				</li>
				{if $product.customizations|count >1}<hr>{/if}
			  {/foreach}
			</ul>
			{else}
			  <span class="no-items">{l s='There are no more items in your cart' d='Shop.Theme.Checkout'}</span>
			{/if}
		  </div>
		{/block}

        <div class="order_total_items">
            {if $cart.vouchers.added}
                {foreach from=$cart.vouchers.added item=voucher}
                    <div class="row middle item_total cart_discount" >
                        <div class="col-xs-8 col-8 col-md-10 text-md-right">
                            <span class="cart_discount_name text-md-right">
                                {$voucher.name}:
                            </span>
                        </div>
                        <div class="col-xs-4 col-4 col-md-2 cart_discount_price">
                            <span class="price-discount price">
                                <i class="material-icons cart_quantity_delete pull-left" data-id-cart-rule="{$voucher.id_cart_rule}">cancel</i>
                                {$voucher.reduction_formatted}
                            </span>
                        </div>
                    </div>
                {/foreach}
            {/if}

            {if $cart.subtotals.products}
                <div class="row middle item_total cart_total_price cart_total_product">
                    <div class="col-xs-8 col-8 col-md-10">
                        <span class="text-md-right">
                            {$cart.subtotals.products.label}:
                        </span>
                    </div>
                    <div class="col-xs-4 col-4 col-md-2">
                        <span class="price" id="total_product">
                            {$cart.subtotals.products.value}
                        </span>
                    </div>
                </div>
            {/if}
            {if $cart.subtotals.discounts}
                <div class="row middle item_total cart_total_voucher">
                    <div class="col-xs-8 col-8 col-md-10">
                        <span class="text-md-right">
                            {$cart.subtotals.discounts.label}:
                        </span>
                    </div>
                    <div class="col-xs-4 col-4 col-md-2">
                        <span class="price-discount price" id="total_discount">
                            {$cart.subtotals.discounts.value}
                        </span>
                    </div>
                </div>
            {/if}
            {if $cart.subtotals.shipping}
                <div class="row middle item_total cart_total_delivery">
                    <div class="col-xs-8 col-8 col-md-10">
                        <span class="text-md-right">
                            {$cart.subtotals.shipping.label}:
                        </span>
                    </div>
                    <div class="col-xs-4 col-4 col-md-2">
                        <span class="price" id="total_shipping">
                            {$cart.subtotals.shipping.value}
                        </span>
                    </div>
                </div>
            {/if}
            {if $cart.subtotals.tax}
                <div class="row middle item_total cart_total_tax">
                    <div class="col-xs-8 col-8 col-md-10">
                        <span class="text-md-right">
                            {$cart.subtotals.tax.label}:
                        </span>
                    </div>
                    <div class="col-xs-4 col-4 col-md-2 text-md-right">
                        <span class="price" id="total_tax">
                            {$cart.subtotals.tax.value}
                        </span>
                    </div>
                </div>
            {/if}
            {if $cart.totals.total}
                <div class="row middle item_total cart_total_price total_price">
                    <div class="col-xs-8 col-8 col-md-10">
                        <span class="text-md-right">
                            {$cart.totals.total.label}:
                        </span>
                    </div>
                    <div class="col-xs-4 col-4 col-md-2">
                        <span class="price" id="total_price">
                            {$total_cart}
                        </span>
                    </div>
                </div>
            {/if}

            <div class="row middle item_total extra_fee_tax cart_total_price end-xs hidden">
                <div class="col-xs-8 col-8 col-md-10 text-right">
                    <span class="bold text-right" id="extra_fee_tax_label"></span>
                </div>
                <div class="col-xs-4 col-4 col-md-2 text-right">
                    <span class="price" id="extra_fee_tax_price"></span>
                </div>
            </div>
            <div class="row middle item_total extra_fee cart_total_price end-xs hidden">
                <div class="col-xs-8 col-8 col-md-10 text-right">
                    <span class="bold text-right" id="extra_fee_label"></span>
                </div>
                <div class="col-xs-4 col-4 col-md-2 text-right">
                    <span class="price" id="extra_fee_price"></span>
                </div>
            </div>
            <div class="row middle item_total cart_total_price total_price extra_fee end-xs hidden">
                <div class="col-xs-8 col-8 col-md-10 text-right">
                    <span class="bold text-right" id="extra_fee_total_price_label"></span>
                </div>
                <div class="col-xs-4 col-4 col-md-2 text-right">
                    <span class="price" id="extra_fee_total_price"></span>
                </div>
            </div>

            {if $cart.vouchers.allowed}
                <div class="cart_total_price" >
                    <div class="row">
                        <div class="col-xs-12 col-12 col-md-6">
                            <a class="collapse-button promo-code-button collapsed" data-toggle="collapse" href="#promo-code" aria-expanded="false" aria-controls="promo-code">
                                {l s='Have a promo code?' mod='spstepcheckout'}
                            </a>
                            <div class="promo-code collapse block-promo " id="promo-code" aria-expanded="true" style="">
                                <input type="text" class="promo-input" id="discount_name" name="discount_name" placeholder="{l s='Promo code' mod='spstepcheckout'}"/>
                                <button id="submitAddDiscount" class="btn btn-primary">
                                    <span>{l s='Add' mod='spstepcheckout'}</span>
                                </button>
                            </div>
							
                        </div>
                        {if $cart.discounts|count > 0}
                            <div class="col-xs-12 col-12 col-md-6">
                                <div id="display_cart_vouchers">
                                    <p>
                                        {l s='Take advantage of our exclusive offers:' mod='spstepcheckout'}
                                    </p>
                                    <ul class="js-discount">
                                        {foreach from=$cart.discounts item=discount}
                                            <li class="cart-summary-line">
                                                <i class="fa fa-caret-right"></i>
                                                <span class="code">{$discount.code}</span>
                                                 - {$discount.name}
                                            </li>
                                        {/foreach}
                                    </ul>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            {/if}
        </div>
    </div>
{/block}