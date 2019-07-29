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

{if !empty($child_items)}
    {if !isset($kk)}
        {assign var="kk" value="0"}
    {/if}
    {counter start=$kk skip=1 print=false name=count assign="count"}
    {foreach $child_items as $product}
        {counter name=count}
          <div class="ltabs-item new-ltabs-item">
            <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">   
              <div class="product-container">
                    <div class="left-block">
                        <div class="product-image">
                            {block name='product_thumbnail'}  
                              <a href="{$product.url}" {$product._target nofilter} class="thumbnail product-thumbnail">
                                {assign var="src" value=($items_params['image_size'] != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items_params['image_size'])|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
                                <img src = "{$src}" alt = "{$product.cover.legend}" data-full-size-image-url = "{$product.cover.large.url}">
                                {if isset($SP_secondimg)}
                                  {hook h="displaySecondImage" id_product=$product.id_product link_rewrite=$product.link_rewrite}
                                {/if}
                              </a>
                            {/block}

                            {if $items->params.display_new || $items->params.display_sale } 
                              {block name='product_flags'}
                                  <div class="product-flags">
                                      {foreach from=$product.flags item=flag key = j}
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

                                      {if $product.discount_type === 'percentage'}
                                        <span class="discount-percentage">{$product.discount_percentage}</span>
                                      {/if}

                                  </div>
                              {/block}
                            {/if} 

                            <!--{if $items_params.display_quickview}  
                                <div class="quick-view-wrapper">
                                  <a href="#" class="quick-view" data-link-action="quickview" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                  </a>
                                </div>
                            {/if}-->
                        </div>
                    </div>
                    <div class="product-info right-block">
                        {if $items_params.display_name == 1}
                            {block name='product_name'}
                              <h5 class="product-title" itemprop="name"><a href="{$product.url}" {$product._target nofilter} >{$product.title nofilter}</a></h5>
                            {/block}
                        {/if}  
                        
                        <div class="title_manufacture">{Manufacturer::getNameById($product.id_manufacturer)|escape:'htmlall':'UTF-8'}</div>

                        {if $items_params.display_description}
                            {block name='product_description_short'}
                              <div class="item-des" itemprop="description">{$product.desc nofilter}</div>
                            {/block}
                        {/if}

                        {if $items_params.display_price}  
                            {block name='product_price_and_shipping'}
                              <div class="product-price-and-shipping">
                                <span itemprop="price" class="price">{$product.price}</span>
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

                        <!--{if $items->params.display_addtocart}
                          <div class="cart_content">
                            {if $product.availability == 'available'}
                                <a href="#" class="ajax-add-to-cart product-btn cart-button" data-id-product="{$product.id_product}" data-minimal-quantity="1">
                                  <span class="text">{l s='Add to Cart' d='Shop.Theme.Global'}</span>
                                </a>
                              {elseif $product.availability == 'last_remaining_items'}
                                <a href="#" class="ajax-add-to-cart product-btn cart-button" data-id-product="{$product.id_product}" data-minimal-quantity="1">
                                  <span class="text">{l s='Add to Cart' d='Shop.Theme.Global'}</span>
                                </a>
                              {else}
                                <span class="no-product cart-button" data-id-product="{$product.id_product}" data-minimal-quantity="1">
                                  <span class="text">{l s='Add to Cart' d='Shop.Theme.Global'}</span>
                                </span>
                            {/if}
                          </div>
                        {/if}-->

                        <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
                            {if $items_params.display_variant}
                                {block name='product_variants'}
                                  {if $product.main_variants}
                                    {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
                                  {/if}
                                {/block}
                            {/if}  
                        </div>
                      </div>
                    </div>
            </article>
        </div>
        {assign var="clear" value="clr1"}
        {if ($count %2 == 0)}
            {$clear = $clear|cat:' clr2'}
        {/if}
        {if ($count %3 == 0)}
            {$clear = $clear|cat:' clr3'}
        {/if}
        {if ($count %4 == 0)}
            {$clear = $clear|cat:' clr4'}
        {/if}
        {if ($count %5 == 0)}
            {$clear = $clear|cat:' clr5'}
        {/if}
        {if ($count %6 == 0)}
            {$clear = $clear|cat:' clr6'}
        {/if}
        {if $condition == false}
            <div class="{$clear|escape:'html':'UTF-8'}"></div>
        {/if}
    {/foreach}
{/if}

