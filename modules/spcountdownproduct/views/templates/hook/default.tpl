{*
 * package   SP Count Product
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}
 
	<script type="text/javascript">
		var listcountdown = [];
	</script>

	{if isset($list) && $list}
        {foreach from=$list item=items}
            {if !empty($items->products)}
				{$_list = $items->products}
                {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="uniqued" value="sp_countdown_product_{$items->id_spcountdownproduct}_{$randid}"}
				<div class="moduletable clearfix {$moduleclass_sfx|escape:'html':'UTF-8'}">
                    {if $items->params.display_title_module}
                        <h3>
                            {$items->title_module[$id_lang]|escape:'html':'UTF-8'}
                        </h3>
                    {/if}
                    <div id="{$uniqued|escape:'html':'UTF-8'}" class="sp-countdown-sliders"					
						{foreach from=$items->params item=param key=k} 
							data-{$k} = "{$param}" 
						{/foreach}					
					>
                        <div class="pds-items-detail col-xs-12 col-sm-10 col-md-10">
							{foreach from=$_list  item=product key =k}
								<div class="pds-item-detail">
									<article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
									<div class="pds-item-inner-detail">
										<div class="pds-detail product-detail-adv col-xs-12 col-sm-3 col-md-3">			
											{if $items->params.display_description}
												<div class="pds-description">
													{$product.desc nofilter}
												</div>
											{/if}											
											{if isset($product.specialPriceToDate) && $product.specialPriceToDate != 'ulimited'}
												<div class="item-time">
													<div class="item-timer product_time_{$items->id_spcountdownproduct|escape:'html':'UTF-8'}_{$product.id_product|escape:'html':'UTF-8'}"></div>
													<!--<script type="text/javascript">
														//<![CDATA[
														listcountdown.push("product_time_{$items->id_spcountdownproduct|escape:'quotes':'UTF-8'}_{$product.id_product|escape:'quotes':'UTF-8'}|{$product.specialPriceToDate|date_format:"%Y/%m/%d %H:%M:%S"|escape:'quotes':'UTF-8'}");
														//]]>
													</script>-->
												</div>
											{else}
												<label>{l s='Ulimited'}</label>
											{/if}
										</div>		
										<div class="product-content-slider col-xs-12 col-sm-9 col-md-9">
											<div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
												{block name='product_thumbnail'}
												  <a href="{$product.link}" {$product._target nofilter}  class="thumbnail product-thumbnail">
													<img
													  src = "{$product['cover']['bySize'][$items->params.cat_image_size]['url']}"
													  alt = "{$product.cover.legend}"
													  data-full-size-image-url = "{$product.cover.large.url}"
													>
												  </a>
												{/block}
												{if $items->params.display_new || $items->params.display_sale }	
												  {block name='product_flags'}
													<ul class="product-flags">
													  {foreach from=$product.flags item=flag key = j}
														{if $j=='new'}	
															{if $items->params.display_new}	
															<li class="{$flag.type}">{$flag.label}</li>
															{/if}
														{elseif $j=='sale'}
															{if $items->params.display_sale}	
															<li class="{$flag.type}">{$flag.label}</li>
															{/if}
														{/if}
													  {/foreach}
													</ul>
												  {/block}
												{/if}		
												{if $product.has_discount}
												  {if $product.discount_type === 'percentage'}
													<span class="discount-percentage">{$product.discount_percentage}</span>
												  {/if}
												{/if}
												<div class="highlighted-informations{if !$product.main_variants} no-variants{/if} hidden-sm-down">
												  <a
													href="#"
													class="quick-view"
													data-link-action="quickview"
												  >
													<i class="material-icons search">&#xE8B6;</i> {l s='Quick view' d='Shop.Theme.Actions'}
												  </a>
												</div>
											</div>
											<div class="pds-content product-item product-detail col-xs-12 col-sm-12 col-md-7">
												<div class="product-description">												
													{if $items->params.display_name == 1}
													{block name='product_name'}
														<div class="pds-title">
															<a href="{$product.link}" {$product._target nofilter}>{$product.title nofilter}</a>
														</div>
													{/block}
													{/if}  
													{block name='product_list_actions'}
													<div class="button-container">
													{if $items->params.display_addtocart}
													  {if $product.add_to_cart_url}
														  <a
															class = "add-to-cart btn btn-primary"
															href  = "{$product.add_to_cart_url}"
															rel   = "nofollow"
															data-id-product="{$product.id_product}"
															data-id-product-attribute="{$product.id_product_attribute}"
															data-link-action="add-to-cart"
															title = "{l s='Add to cart' d='Shop.Theme.Actions'}"
														  >{l s='Add to cart' d='Shop.Theme.Actions'}</a>
													  {/if}
													{/if}  
													  {hook h='displayProductListFunctionalButtons' product=$product}
													</div>
													{/block}
													{if isset($product.features) && $product.features}
														<div class="pds-products-infor">	
															<div class="additional-attributes-wrapper table-wrapper">
																<table class="data table additional-attributes">
																	<tbody>
																	{foreach from=$product.features  item=feature}
																		<tr>
																			<th class="col label" scope="row">{$feature.name}</th>
																			<td class="col data" data-th="{$feature.name}">{$feature.value}</td>
																		</tr>
																	{/foreach}
																	</tbody>
																</table>
															</div>
														</div>	
													{/if}	
													{if $items->params.display_price}	
														{if $product.show_price}
															<div class="item-price">
															  {if $product.has_discount}
																{hook h='displayProductPriceBlock' product=$product type="old_price"}

																<span class="regular-price">{$product.regular_price}</span>
															  {/if}

															  {hook h='displayProductPriceBlock' product=$product type="before_price"}

															  <span itemprop="price" class="price">{$product.price}</span>

															  {hook h='displayProductPriceBlock' product=$product type='unit_price'}

															  {hook h='displayProductPriceBlock' product=$product type='weight'}
															</div>
														{/if}
													{/if}							
												</div>											

											</div>											
										</div>										
									</div>
									</article>
								</div>	
							{/foreach}
                        </div>
						<div class="thumb-image col-xs-12 col-sm-12 col-md-2">
							<div class="pds-items">
								{foreach from=$_list  item=product key =k}
									<div class="pds-item cf">
										<div class="pds-item-inner">
											<div class="product-content-slider-thumb">
												{assign var="src" value=($items->params.image_size != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items->params.image_size)|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
													<img class = "products-image-thumb"
													  src = "{$product['cover']['bySize'][$items->params.image_size]['url']}"
													  alt = "{$product.cover.legend}"
													  data-full-size-image-url = "{$product.cover.large.url}">
											</div>	
										</div>
									</div>
								{/foreach}
							</div>	
						</div>		
                    </div>
                </div>	
			{else}
				{l s='Has no content to show In Module Sp Countdown Product' mod='spcountdownproduct'}
			{/if}	
        {/foreach}
    {else}
        {l s='Has no content to show In Module Sp Countdown Product' mod='spcountdownproduct'}
    {/if}