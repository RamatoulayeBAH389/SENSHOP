{*
 * @package SP SuperCategory
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}
{if !isset($items_params)}
    {assign var="items_params" value=$items->params}
{/if}
{if !empty($first_children)}
	<script type="text/javascript">
	//<![CDATA[
		var listsuper = [];
	//]]>
	</script>
  <div class="item-first">
          <div class="ltabs-item new-ltabs-item">
            <article class="product-miniature js-product-miniature" data-id-product="{$first_children.id_product}" data-id-product-attribute="{$first_children.id_product_attribute}" itemscope itemtype="http://schema.org/Product">   
              <div class="product-container">
                    <div class="left-block">
                        <div class="product-image">
                            {block name='product_thumbnail'}  
                              <a href="{$first_children.link}" class="thumbnail product-thumbnail">
                                {assign var="src" value=($items_params['image_size'] != 'none') ? {$link->getImageLink($first_children.link_rewrite, $first_children.id_image, $items_params['image_size'])|escape:'html':'UTF-8'} :  {$link->getImageLink($first_children.link_rewrite, $first_children.id_image)|escape:'html':'UTF-8'}}
                                <img src = "{$src}" alt = "{$first_children.cover.legend}" data-full-size-image-url = "{$first_children.cover.large.url}">
                                {if isset($SP_secondimg)}
                                  {hook h="displaySecondImage" id_product=$first_children.id_product link_rewrite=$first_children.link_rewrite}
                                {/if}
                             </a>
                            {/block}

                            {if $items->params.display_new || $items->params.display_sale } 
                              {block name='product_flags'}
                                  <div class="product-flags">
                                      {foreach from=$first_children.flags item=flag key = j}
                                          {if $j=='new'}  
                                                {if $items->params.display_new} 
                                                    <span class="{$flag.type}-label">{$flag.label}</span>
                                                {/if}
                                          {elseif $j=='sale'}
                                                {if $items->params.display_sale}  
                                                   <span class="{$flag.type}-label">{$flag.label}</span>
                                                {/if}
                                            {else}
                                                <span class="{$flag.type}-label">{$flag.label}</span>
                                          {/if}
                                      {/foreach}

                                      {if $first_children.discount_type === 'percentage'}
                                        <span class="discount-percentage">{$first_children.discount_percentage}</span>
                                      {/if}

                                  </div>
                              {/block}
                            {/if} 

                            {if $items_params.display_quickview}  
                                <div class="quick-view-wrapper">
                                  <a href="#" class="quick-view" data-link-action="quickview" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                  </a>
                                </div>
                            {/if}
                        </div>
						{if isset($first_children.specialPriceToDate)}
						<div class="item-time">	
								<div class="item-timer product_time_{$items->id_spsupercategory}_{$first_children.id_product}"></div>	
								<script type="text/javascript">
								//<![CDATA[
									listsuper.push('product_time_{$items->id_spsupercategory}_{$first_children.id_product}|{$first_children.specialPriceToDate|date_format:"%Y/%m/%d %H:%M:%S"}') ;
								//]]>
								</script>											
							</div>	
						{/if}
                    </div>
                    <div class="product-info right-block">
                        {if $items_params.display_name == 1}
                            {block name='product_name'}
                              <h5 class="product-title" itemprop="name"><a href="{$first_children.link}" >{$first_children.title nofilter}</a></h5>
                            {/block}
                        {/if}  
                        {if $items_params.display_description}
                            {block name='product_description_short'}
                              <div class="item-des" itemprop="description">{$first_children.desc nofilter}</div>
                            {/block}
                        {/if}

                        {if $items_params.display_price}  
                            {block name='product_price_and_shipping'}
                              <div class="product-price-and-shipping">
                                <span itemprop="price" class="price">{$first_children.price}</span>
                                {if $first_children.has_discount}
                                  {hook h='displayProductPriceBlock' product=$first_children type="old_price"}
                                  <span class="regular-price">{$first_children.regular_price}</span>
                                {/if}

                                {hook h='displayProductPriceBlock' product=$first_children type="before_price"}

                                {hook h='displayProductPriceBlock' product=$first_children type='unit_price'}

                                {hook h='displayProductPriceBlock' product=$first_children type='weight'}
                              </div>
                            {/block}
                        {/if}

                        {if $items->params.display_addtocart}
                          <div class="cart_content">
                               <form action="{Context::getContext()->link->getPageLink('cart')}" method="post" class="add-to-cart-or-refresh">
									 <input type="hidden" name="token" value="{Tools::getToken(false)}">
									 <input type="hidden" name="id_product" value="{$first_children.id}" class="product_page_product_id">
									 <input type="hidden" name="qty" value="1">
									 <button class="btn btn-primary add-to-cart" data-button-action="add-to-cart" type="submit" {if $first_children.quantity < 1 || !$first_children.add_to_cart_url}disabled{/if}>
										 <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
									 </button>
							</form>
                          </div>
                        {/if}

                      </div>
                    </div>
            </article>
        </div>
	</div>
{/if}

