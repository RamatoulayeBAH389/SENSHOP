{*
 * @package   SP Extra Slider
 * @version   1.0.1
 *
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}
<!-- SP Extra Slider -->
{if isset($list) && !empty($list)}
    {foreach from=$list item=items}
        {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
        <div class="moduletable  {$moduleclass_sfx|escape:'html':'UTF-8'}">
            {if isset($items->title_module[$id_lang]) && $items->params.display_title_module}
                <h3 class="block-title">
                    {$items->title_module[$id_lang]|escape:'html':'UTF-8' nofilter}
                </h3>
            {/if}
            {$_list = $items->products}
            {if isset($_list) && $_list}
                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="tag_id" value="sp_extra_slider_{$items->id_spextraslider}_{$randid}"}
                {assign var="cls_btn_page" value=($items->params.button_page == 'top')?'buttom-type1':'button-type2'}
                {assign var="button_prev" value=($items->params.button_page == 'top')?'&#171;' : '&#139;'}
                {assign var="button_next" value=($items->params.button_page == 'top')?'&#187;' : '&#155;'}
                {assign var="language_site" value=($items->language_site == 'true')?'true':'false'}
                {*//effect*}
                {assign var="margin" value=($items->params.margin >= 0)?$items->params.margin:5}
                {assign var="slideBy" value=($items->params.slideBy >= 0)?$items->params.slideBy:1}
                {assign var="autoplay" value=($items->params.autoplay == 1)?'true':'false'}
                {assign var="autoplay_timeout" value=($items->params.autoplay_timeout > 0)?$items->params.autoplay_timeout:2000}
                {assign var="autoplay_hover_pause" value=($items->params.autoplay_hover_pause == 1)?'true':'false'}
                {assign var="autoplaySpeed" value=($items->params.autoplaySpeed >0)?$items->params.autoplaySpeed:2000}
                {assign var="smartSpeed" value=($items->params.smartSpeed > 0)?$items->params.smartSpeed:2000}
                {assign var="startPosition" value=($items->params.startPosition >= 0)?$items->params.startPosition:0}
                {assign var="mouseDrag" value=($items->params.mouseDrag == 1)?'true':'false'}
                {assign var="touchDrag" value=($items->params.touchDrag == 1)?'true':'false'}
                {assign var="pullDrag" value=($items->params.pullDrag == 1)?'true':'false'}
                {assign var="dots" value=($items->params.dots == 1)?'true':'false'}
                {assign var="dotsSpeed" value=($items->params.dotsSpeed >0)?$items->params.dotsSpeed:100}
                {assign var="nav" value=($items->params.nav == 1)?'true':'false'}
                {assign var="navSpeed" value=($items->params.navspeed >0)?$items->params.navspeed:100}
                {assign var="btn_prev" value=($items->params.button_page == 'top')?'&#171;':'&#139;'}
                {assign var="btn_next" value=($items->params.button_page == 'top')?'&#187;':'&#155;'}
                {assign var="btn_type" value=($items->params.button_page == 'top')?'button-type1':'button-type2'}
                {assign var="class_respl" value="preset01-"|cat:$items->params.nb_column1|cat:' preset02-'|cat:$items->params.nb_column2|cat:' preset03-'|cat:$items->params.nb_column3|cat:' preset04-'|cat:$items->params.nb_column4}
                {$_list = $items->products}
                {if isset($_list) && $_list}
	                <div id="{$tag_id|escape:'html':'UTF-8'}"
	                 	class="sp-extraslider {$cls_btn_page|escape:'html':'UTF-8'} {$class_respl|escape:'html':'UTF-8'}
	                  	{$btn_type|escape:'html':'UTF-8'}"
						{foreach from=$items->params item=param key=k} 
							{if $k != "slider"}
							data-{$k} = "{$param}" 
							{/if}
						{/foreach}>
	                  	<div class="html-image">
							{hook h='displayBanner13'}
						</div>

	                    <div class="extraslider-inner product-listing" 
						 data-delay="{$items->params.delay|escape:'html':'UTF-8'}"
						 data-duration="{$items->params.duration|escape:'html':'UTF-8'}"
						 data-effect="{$items->params.effect|escape:'html':'UTF-8'}">
	                        {assign var="count_item" value=count($_list)}
	                        {assign var="nb_rows" value=$items->params.nb_rows}
	                        {counter start=0 skip=1 print=false name=count assign="count"}
	                        {foreach $_list as $product}
	                            {counter name=count}
	                            {if $count % $nb_rows == 1 || $nb_rows == 1}
	                                <div class="item">
	                            {/if}
								<article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">		
		                            <div class="item-wrap {$items->params.layout|escape:'html':'UTF-8'}">
		                                <div class="product-container">
		                                	<div class="left-block">
												<div class="product-image">
													{block name='product_thumbnail'}
														<a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">
															{assign var="src" value=($items->params.image_size != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items->params.image_size)|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
															<img class="img_1" src="{$src}" alt="{$product.legend|escape:'html':'UTF-8'}"/>
															{assign var="imageSize" value=($items->params.image_size != 'none') ? $items->params.image_size : 'home_default'}
															{if $SP_secondimg}
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
																	{if $product.discount_type === 'percentage' && $items->params.display_sale}
																	  <span class="sp-label discount-percentage">{$product.discount_percentage}</span>
																	{/if}
															</div>
													  	{/block}
													{if $items->params.display_quickview}	
														<div class="quick-view-wrapper">
															<a href="#" class="quick-view" data-link-action="quickview" >
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>
														</div>
													{/if}
												</div>
											</div>
											<div class="right-block">
												<div class="product-info">
													{if $items->params.display_name == 1}
													  	{block name='product_name'}
															<h5 class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h5>
													  	{/block}
													{/if}

													<div class="title_manufacture">{Manufacturer::getNameById($product.id_manufacturer)|escape:'htmlall':'UTF-8'}</div>

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
															<div class="product-description" itemprop="description">{$product.description_short nofilter}</div>
													  	{/block}
													{/if}
													{if $items->params.display_price}	
													  	{block name='product_price_and_shipping'}
															<div class="product-price-and-shipping" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
	                											<link itemprop="availability" href="https://schema.org/InStock"/>
	                											<meta itemprop="priceCurrency" content="{Context::getContext()->currency->iso_code}">
	                											<span itemprop="price" content="{$product.price_amount}" class="price">{$product.price}</span>
															  	{if $product.has_discount}
																	{hook h='displayProductPriceBlock' product=$product type="old_price"}
																	<span class="regular-price">{$product.regular_price}</span>
															  	{/if}
															  	{hook h='displayProductPriceBlock' product=$product type="before_price"}
															  	{hook h='displayProductPriceBlock' product=$product type='unit_price'}
															  	{hook h='displayProductPriceBlock' product=$product type='weight'}
															</div>
													  	{/block}
													{/if}
							                        {if $items->params.display_addtocart}
							                          <div class="cart_content">
							                            <form action="{Context::getContext()->link->getPageLink('cart')}" method="post" class="add-to-cart-or-refresh">
																 <input type="hidden" name="token" value="{Tools::getToken(false)}">
																 <input type="hidden" name="id_product" value="{$product.id}" class="product_page_product_id">
																 <input type="hidden" name="qty" value="1">
																 <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if $product.quantity < 1 || !$product.add_to_cart_url}disabled{/if}>
																	 <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
																 </button>
														</form>
							                          </div>
							                        {/if}
												</div>
											</div>
		                                </div>
		                            </div>
								</article>	
	                            {if $count % $nb_rows == 0 || $count == $count_item}
	                                </div>
	                            {/if}
	                        {/foreach}
	                    </div>
	                </div>
            	{/if}
            {else}
                {l s='Has no content to show!' d='Shop.Theme.Global'}
            {/if}
        </div>
    {/foreach}
{/if}
<!-- /SP Extra Slider -->