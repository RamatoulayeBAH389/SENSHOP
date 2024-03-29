{*
 * package   SP Search Pro
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}

{if isset($list) && !empty($list)}
    {if isset($list) && !empty($list)}
        {foreach from=$list item=items}
            {$_list = $items->products}
            {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
            {assign var="tag_id" value="sp_search_pro_{$items->id_spsearchpro}"}
            <div class="spSearchPro {$moduleclass_sfx|escape:'html':'UTF-8'}">
                {if $items->params.display_title_module}
                    <div class="title-module-search-pro">
                        {$items->title_module[$id_lang]|escape:'html':'UTF-8'}
                    </div>
                {/if}
                {assign var="orderby" value=$items->params.products_ordering}
                {assign var="orderway" value=$items->params.ordering_direction}
                {assign var="ajax_s" value=$items->params.ajax_search}
                {assign var="id_module" value="{$items->id_spsearchpro}"}
                {if isset($search_query)}
                    {assign var="search_query_value" value="{$search_query}"}
                {else}
                    {assign var="search_query_value" value=""}
                {/if}
				{if $items->params.display_box_select}
                    {assign var="display_box_select" value=" show-box"}
                {else}
                    {assign var="display_box_select" value=" hidden-box"}
                {/if}
                {$products = $items->products}
                <!--[if lt IE 9]>
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="spr-container lt-ie9 spr-preload">
                <![endif]-->
                <!--[if IE 9]>
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="spr-container msie9 spr-preload">
                <![endif]-->
                <!--[if gt IE 9]><!-->
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="spr-container spr-preload"
					data-id_lang = "{$id_lang}"
					data-module_link = "{$search_controller_url}"
					data-basedir = "{$baseDir}"
					{foreach from=$items->params item=param key=k} 
						data-{$k} = "{$param}" 
					{/foreach}
				><!--<![endif]-->
                    {*<div class="spr-loading"></div>*}
                    <form class="sprsearch-form {$display_box_select|escape:'html':'UTF-8'}" method="get" action="{$search_controller_url}">
                        {counter start=0 skip=1 print=false name=count assign="count"}
                        {foreach $products as $key => $cat}
                            {counter name=count}
                            {if $count == 1}
                                <input type="hidden" name="cat_id" value="{$cat.id_option|escape:'html':'UTF-8'}">
                            {/if}
                        {/foreach}
						<div class="spr_selector">
                            <label class="fa fa-sort-desc"></label>
							<select class="spr_select">
								{counter start=0 skip=1 print=false name=count2 assign="count2"}
								{foreach $products as $key => $pro}
									{counter name=count2}
									<option value="{$pro.id_option|escape:'html':'UTF-8'}">
										{if $count2 == 1 && $items->params.display_category_all == 1}
											{l s='All Categories' d='Shop.Theme.Global'}
										{else}
											{$pro.name|escape:'html':'UTF-8'}
										{/if}
									</option>
								{/foreach}
							</select>
						</div>
						<div class="content-search">	
							<input type="hidden" name="controller" value="search">
                            <input class="spr-query" type="text" name="s"
                                   value="{$search_query_value|escape:'html':'UTF-8'|stripslashes}"
                                   placeholder="{l s='Search...' d='Shop.Theme.Global'}"/>
						</div>
                        <button value="{l s='Search...' d='Shop.Theme.Global'}" class="spr-search-button" type="submit" name="spr_submit_search">
                            <!--{l s='Search' d='Shop.Theme.Global'}-->
                            <i class="fa fa-search"></i>
                        </button>
                        <input value="{$n|escape:'html':'UTF-8'}" type="hidden" name="n" class="n_product"/>
                    </form>
                </div>
            </div>
        {/foreach}
    {else}
        {l s='Has no content to show! In Module SP Search Pro' d='Shop.Theme.Global'}
    {/if}
{/if}


