{*
 * @package SP Listing Tabs
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
  	<div class="thumbnail-container product-container">
	    {block name='product_thumbnail'}
	    	<div class="product-image">
		      	<a href="{$product.url}" class="thumbnail product-thumbnail ver5">
					{assign var="src" value=($items_params['image_size'] != 'none') ? {$link->getImageLink($product.link_rewrite, $product.id_image, $items_params['image_size'])|escape:'html':'UTF-8'} :  {$link->getImageLink($product.link_rewrite, $product.id_image)|escape:'html':'UTF-8'}}
					{assign var="imageSize" value=($items_params['image_size'] != 'none') ? $items_params['image_size'] : 'layout5_default'}
		        	<img src = "{$src}" alt = "{$product.cover.legend}" data-full-size-image-url = "{$product.cover.large.url}">
                      {hook h="displaySecondImage" imageSize=$imageSize id_product=$product.id_product link_rewrite=$product.link_rewrite}
		      	</a>
				{if $items_params.display_new || $items_params.display_sale }	
			      {block name='product_flags'}
			        <div class="product-flags">
							{foreach from=$product.flags item=flag key = k}
								{if $k=='new'}	
									{if $items_params.display_new}	
										<span class="sp-label {$flag.type}-label">{$flag.label}</span>
									{/if}
								{/if}
								{if $k=='on-sale'}
									{if $items_params.display_sale}	
										<span class="sp-label {$flag.type}-label">{$flag.label}</span>
									{/if}
								{/if}
							{/foreach}
							{if $product.discount_type === 'percentage'}
							  <span class="sp-label discount-percentage">{$product.discount_percentage}</span>
							{/if}
					</div>
			      {/block}
				{/if}	
				{if $items_params.display_quickview}
					<div class="quick-view-wrapper">	
						<a href="#" class="quick-view" data-link-action="quickview">
				        	<i class="fa fa-eye" aria-hidden="true"></i>
				        	<!--{l s='Quick view' d='Shop.Theme.Global'}-->
				      	</a>
			      	</div>
				{/if}
	      	</div>
	    {/block}

	    <div class="product-description product-info">
			{if $items_params.display_name == 1}
		      {block name='product_name'}
		        <h5 class="product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h5>
		      {/block}
			{/if}  
			{if $items_params.display_description}
		      {block name='product_description_short'}
		        <div class="product-description-short" itemprop="description">{$product.description_short nofilter}</div>
		      {/block}
			{/if}

			{if $items_params.display_availability}
		      {block name='product_availability'}
		        {if $product.show_availability}
		          {* availability may take the values "available" or "unavailable" *}
		          <span class='product-availability {$product.availability}'>{$product.availability_message}</span>
		        {/if}
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


		  	{block name='product_list_actions'}
		   	 	<div class="product-list-actions">
					{if $items_params.display_addtocart}
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
			   	   	{hook h='displayProductListFunctionalButtons' product=$product}
		    	</div>
		  	{/block}

		</div>
		    <!--
		    	<div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
					{if $items_params.display_variant}
				      {block name='product_variants'}
				        {if $product.main_variants}
				          {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
				        {/if}
				      {/block}
					{/if}  
		    	</div>
		    -->

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
