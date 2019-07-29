{*
 * @package SP Deal
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}
<script type="text/javascript">
	//<![CDATA[
	var listdeal = [];
	//]]>
</script>
<!-- SP Slider -->
{if isset($list) && !empty($list) && isset($check_n)}
    {foreach from=$list item=items}
        {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
        {assign var="class_hook" value=($items->params.hook == 'displayTop')?' displayTop':''}
        <div class="moduletable {$moduleclass_sfx|escape:'html':'UTF-8'} {$class_hook|escape:'html':'UTF-8'}">
            {if isset($items->title_module[$id_lang]) && $items->params.display_title_module}
                <h3 class="module-tilte">
                    {$items->title_module[$id_lang]|escape:'html':'UTF-8'}
                </h3>
            {/if}
            {$_list = $items->products}
            {if isset($_list) && $_list}
                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="tag_id" value="sp_deal_{$items->id_spdeal}_{$randid}"}
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-deal sp-preload" 
                    {foreach from=$items->params item=param key=k} 
                            {if $k != "slider" && $k !=="title_deal" && $k !=="cat_readmore_text"}
                            data-{$k} = "{$param|escape:'html':'UTF-8'}" 
                            {/if}
                    {/foreach}>
                    <div class="sp-loading"></div>
                    <div id="spdeal-slider-{$items->id_spdeal}" class="spdeal-slider product-listing"
							 data-delay="{$items->params.delay|escape:'html':'UTF-8'}"
                             data-duration="{$items->params.duration|escape:'html':'UTF-8'}"
                             data-effect="{$items->params.effect|escape:'html':'UTF-8'}">
                        {foreach $_list as $product}
                            {if isset($product.specialPriceToDate)}
                                <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">		
                                <div class="product-container">
                                <div class="left-block">
                                        <div class="product-image">
                                                {block name='product_thumbnail'}
                                                        <a href="{$product.url}" class="thumbnail product-thumbnail">
                                                                {assign var="imageSize" value=($items->params.image_size != 'none') ? $items->params.image_size : 'home_default'}
                                                                {if $product.cover.bySize.$imageSize.url}
                                                                        <img src = "{$product.cover.bySize.$imageSize.url}" alt = "{$product.cover.legend}" data-full-size-image-url = "{$product.cover.large.url}">
                                                                {else}
                                                                        {assign var="src" value={$link->getImageLink($product.link_rewrite, $product.id_image, $items->params.image_size)|escape:'html':'UTF-8'}}
                <img src="{$src|escape:'html':'UTF-8'}"
                     alt="{$product.legend|escape:'html':'UTF-8'}"/>
                                                                {/if}
                                                                {if isset($SP_secondimg)}
                                                                        {hook h="displaySecondImage" imageSize=$imageSize id_product=$product.id_product link_rewrite=$product.link_rewrite}
                                                                {/if}
                                                        </a>
                                                {/block}
                                                        {block name='product_flags'}
                                                                <div class="product-flags">
                                                                                {foreach from=$product.flags item=flag key = k}
                                                                                        {if $k=='new'}	
                                                                                                {if $items->params.display_new}	
                                                                                                        <span class="sp-label {$flag.type}-label">{$flag.label}</span>
                                                                                                {/if}
                                                                                        {/if}
                                                                                        {if $k=='on-sale'}
                                                                                                {if $items->params.display_sale}	
                                                                                                        <span class="sp-label {$flag.type}-label">{$flag.label}</span>
                                                                                                {/if}
                                                                                        {/if}
                                                                                {/foreach}
                                                                                {if $product.discount_type === 'percentage'}
                                                                                  <span class="sp-label discount-percentage">{$product.discount_percentage}</span>
                                                                                {/if}
                                                                </div>
                                                        {/block}
                                                {if $items->params.display_quickview}	
                                                        <div class="quick-view-wrapper">
                                                                <a href="#" class="quick-view" data-link-action="quickview">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                        </div>
                                                {/if}
                                                {if $items->params.display_addtocart}
                                                        <div class="cart_content">
                                                                <div class="product-list-actions">
                                                                    <form action="{Context::getContext()->link->getPageLink('cart')}" method="post" class="add-to-cart-or-refresh">
																			 <input type="hidden" name="token" value="{Tools::getToken(false)}">
																			 <input type="hidden" name="id_product" value="{$product.id}" class="product_page_product_id">
																			 <input type="hidden" name="qty" value="1">
																			 <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if $product.quantity < 1 || !$product.add_to_cart_url}disabled{/if}>
																				 <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
																			 </button>
																	</form>
                                                                </div>
                                                        </div>
                                                {/if}
                                        </div>
                                </div>
                                <div class="product-info right-block">
                                                {if $items->params.display_name == 1}
                                                        {block name='product_name'}
                                                                <h5 class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:$items->params.name_maxlength:'...'}</a></h5>
                                                        {/block}
                                                {/if}
                                                {block name='product_reviews'}
                                                        {hook h='displayProductListReviews' product=$product}
                                                {/block}
                                                {if $items->params.display_variant}
                                                        {block name='product_variants'}
                                                                {if $product.main_variants}
                                                                        {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
                                                                {/if}
                                                        {/block}
                                                {/if} 
                                                {if $items->params.display_availability}
                                                        {block name='product_availability'}
                                                                {if $product.show_availability}
                                                                        {* availability may take the values "available" or "unavailable" *}
                                                                        <span class='product-availability {$product.availability}'>{$product.availability_message}</span>
                                                                {/if}
                                                        {/block}
                                                {/if}
                                                {if $items->params.display_description}
                                                        {block name='product_description_short'}
                                                                <div class="product-description" itemprop="description">
                                                                        {$product.description_short|strip_tags:'UTF-8'|truncate:$items->params.description_maxlength:'...'}
                                                                </div>
                                                        {/block}
                                                {/if}
                                                {if $items->params.display_price}	
                                                        {block name='product_price_and_shipping'}
                                                                <div class="product-price-and-shipping" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                                        <link itemprop="availability" href="https://schema.org/InStock"/>
                                                        <meta itemprop="priceCurrency" content="{Context::getContext()->currency->iso_code}">
                                                                        {hook h='displayProductPriceBlock' product=$product type="before_price"}
                                                                        <span itemprop="price" content="{$product.price_amount}" class="price">{$product.price}</span>
                                                                        {if $product.has_discount}
                                                                                {hook h='displayProductPriceBlock' product=$product type="old_price"}
                                                                                <span class="regular-price">{$product.regular_price}</span>
                                                                        {/if}
                                                                        {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                                                                        {hook h='displayProductPriceBlock' product=$product type='weight'}
                                                                </div>
                                                        {/block}
                                                {/if}
                                                {if isset($product.specialPriceToDate)}
                                                        <div class="item-time" data-day="{l s='Day' d='Shop.Theme.Global'}" data-days="{l s='Days' d='Shop.Theme.Global'}" data-hour="{l s='Hour' d='Shop.Theme.Global'}" data-hours="{l s='Hours' d='Shop.Theme.Global'}" data-min="{l s='Min' d='Shop.Theme.Global'}" data-mins="{l s='Mins' d='Shop.Theme.Global'}" data-sec="{l s='Sec' d='Shop.Theme.Global'}" data-secs="{l s='Secs' d='Shop.Theme.Global'}">
                                                                <div class="label-timer">{l s='Hurry Up! Offer ends in:' d='Shop.Theme.Global'}</div>
                                                                <div class="item-timer product_time_{$items->id_spdeal|escape:'html':'UTF-8'}_{$product.id_product|escape:'html':'UTF-8'}"></div>
                                                                <script type="text/javascript">
                                                                        //<![CDATA[
                                                                        listdeal.push("product_time_{$items->id_spdeal|escape:'quotes':'UTF-8'}_{$product.id_product|escape:'quotes':'UTF-8'}|{$product.specialPriceToDate|date_format:"%Y/%m/%d %H:%M:%S"|escape:'quotes':'UTF-8'}");
                                                                        //]]>
                                                                </script>
                                                        </div>
                                                {/if}
                                </div>
                            	</div>
                                </article>	
                            {/if}
                        {/foreach}
                    </div>
                </div>
            {/if}
        </div>
	{/foreach}
{else}
<div class="no_products">
        {l s='Has no content to show in module Sp Deal' d='Shop.Theme.Actions'}
</div>
{/if}
<!-- /SP Slider -->