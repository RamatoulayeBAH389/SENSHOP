{*
 * package   SP Super Category
 *
 * @version 1.0.2
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}

{if isset($list) && !empty($list)}
    {if isset($list) && !empty($list)}
        {foreach from=$list item=items}
            {$_list = $items->products}
            {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
            {math equation='rand()' assign='rand'}
            {assign var='randid' value="now"|strtotime|cat:$rand}
            {assign var="tag_id" value="sp_super_category_{$items->id_spsupercategory}_{$randid}"}
			
            {assign var="condition" value=($items->params.show_loadmore_slider == 'slider')?true:false}
            {assign var="effect_show" value=($condition == true)?'':$items->params.effect}
            {assign var="class_condition" value=($condition == true)?'show-slider':'show-loadmore'}
			{assign var="language_site" value=($items->language_site == 'true')?'true':'false'}
			
            <div class="moduletable clearfix {$moduleclass_sfx|escape:'html':'UTF-8'} sp_supercategory"
				{foreach from=$items->params item=param key=k} 
					{if $k != "slider"}
					data-{$k} = "{$param}" 
					{/if}
				{/foreach}					
				>
                {if isset($items->title_module[$id_lang]) && $items->params.display_title_module}
                    <div class="title-module-super">
                        {$items->title_module[$id_lang]|escape:'html':'UTF-8'}
                    </div>
                {/if}
                <!--[if lt IE 9]>
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-sp-cat msie lt-ie9 first-load sp-super-preload"><![endif]-->
                <!--[if IE 9]>
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-sp-cat msie first-load sp-super-preload"><![endif]-->
                <!--[if gt IE 9]><!-->
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-sp-cat first-load sp-super-preload"><!--<![endif]-->
                    <div class="sp-super-loading"></div>
                    <div class="spcat-wrap ">
                        {include file="./default_cat.tpl"}

                        <div class="spcat-tabs-container"
							 data-delay="{$items->params.interval|escape:'html':'UTF-8'}"
                             data-duration="{$items->params.duration|escape:'html':'UTF-8'}"
                             data-effect="{$items->params.effect|escape:'html':'UTF-8'}"
                             data-ajaxurl="{$base_dir|escape:'html':'UTF-8'}"
                             data-modid="{$items->id_spsupercategory|escape:'html':'UTF-8'}"
							 data-language_site="{$language_site|escape:'html':'UTF-8'}">							 
                            {include file="./default_tabs.tpl"}
                        </div>
                        {if $items->products.tab != ''}
                            <!--Begin Items-->
                            <div class="spcat-items-container {$class_condition|escape:'html':'UTF-8'}">
                                {foreach from=$items->products.tab item=items2}
                                    {assign var="child_items" value=(isset($items2.child))?$items2.child:''}
                                    {assign var="cls_device" value="spcat01-"|cat:$items->params.nb_column1|cat:' spcat02-'|cat:$items->params.nb_column2|cat:' spcat03-'|cat:$items->params.nb_column3|cat:' spcat04-'|cat:$items->params.nb_column4}
                                    {assign var="cls_animate" value=$items->params.effect}
                                    {assign var="cls1" value=(isset($items2.sel) && $items2.sel == 'sel')?' spcat-items-selected spcat-items-loaded':''}
                                    {assign var="cls2" value=" items-category-{$items2.id}"}
                                    {assign var="csl_animation_show" value=($condition == true)?'':$cls_animate}
                                    {assign var="cls_device_show" value=($condition == true)?'':$cls_device}

                                    <div class="spcat-items {$cls1|escape:'html':'UTF-8'} {$cls2|escape:'html':'UTF-8'}">
                                        <div class="spcat-items-inner {$cls_device_show|escape:'html':'UTF-8'} {$csl_animation_show|escape:'html':'UTF-8'}">
                                            {if !empty($child_items)}
                                                {include file="./default_items.tpl"}
                                            {else}
                                                <div class="spcat-loading"></div>
                                            {/if}
                                        </div>

                                        {if $items->params.show_loadmore_slider == 'loadmore'}
                                            {assign var="classloaded" value=($items->params.count_number >= $items2.count || $items->params.count_number == 0)?' loaded':'' }
                                            {assign var="classloaded_2" value=($classloaded)?'All Ready':'Load More'}
                                            {assign var="id" value=$items2.id}
                                            <div class="load-clear"></div>
                                            <div class="spcat-loadmore"
                                                 data-active-content=".items-category-{$id|escape:'html':'UTF-8'}"
                                                 data-field_order="{$items2.id|escape:'html':'UTF-8'}"
                                                 data-rl_start="{$items->params.count_number|escape:'html':'UTF-8'}"
                                                 data-rl_total="{$items2.count|escape:'html':'UTF-8'}"
                                                 data-rl_allready="All Ready"
                                                 data-ajaxurl="{$base_dir|escape:'html':'UTF-8'}"
                                                 data-modid="{$items->id_spsupercategory|escape:'html':'UTF-8'}"
                                                 data-rl_load="{$items->params.count_number|escape:'html':'UTF-8'}">
                                                <div class="spcat-loadmore-btn {$classloaded|escape:'html':'UTF-8'}"
                                                     data-label="{$classloaded_2|escape:'html':'UTF-8'}">
                                                    <span class="spcat-image-loading"></span>
                                                </div>
                                            </div>
                                        {/if}
                                    </div>
                                {/foreach}
                            </div>
                        {else}
                            {l s='Has no content to show in module Sp Super Category !' mod='spsupercategory'}
                        {/if}
                        <!--End Items-->
                    </div>
                </div>
            </div>
        {/foreach}
    {else}
        {l s='Has no content to show in module Sp Super Category !' mod='spsupercategory'}
    {/if}
{/if}


