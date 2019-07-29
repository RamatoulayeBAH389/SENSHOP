{*
 * package   SP Super Category
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}
<div class="category-wrap-cat clearfix">
    {if (!empty($items->products.category_parent))}
        <div class="sp-cat-title-parent"
             data-catids="{$items->products.category_parent.cat_array|escape:'html':'UTF-8'}">
            <a title="{$items->products.category_parent.name|escape:'html':'UTF-8'}"
               href="{$items->products.category_parent.link|escape:'html':'UTF-8'}"
                    {$items->products.category_parent._target|escape:'html':'UTF-8'}>
                {$items->products.category_parent.name|escape:'html':'UTF-8'}
            </a>
        </div>
    {/if}

    {if !empty($items->products.category_tree)}
        <div class="sp-cat-slider">
            <div class="cat_slider_inner">
                {foreach from=$items->products.category_tree item=cat}
                    <div class="item">
                        <div class="item-inner">
                            {if $cat.image}
                                <div class="cat_slider_image">
                                    <a href="{$cat.link|escape:'html':'UTF-8'}"
                                       title="{$cat.name|escape:'html':'UTF-8'}" {$cat._target} >
                                        {assign var="src" value=($items->params.cat_image_size != 'none')?{$link->getCatImageLink($cat.link_rewrite, $cat.id_category, $items->params.cat_image_size)|escape:'html':'UTF-8'}:{$link->getCatImageLink($cat.link_rewrite, $cat.id_category)|escape:'html':'UTF-8'}}
                                      	{if file_exists($src)}
										 <img src="{$src}" alt="{$cat.name|escape:'html':'UTF-8'}"/>
										{else}
										 <img src="{$urls.base_url|escape:'html':'UTF-8'}/modules/spsupercategory/views/img/nophoto.jpg" alt="{$cat.name|escape:'html':'UTF-8'}"  style="width: 150px; height:77px;"/>
										{/if} 
                                    </a>
                                </div>
                            {/if}

                            {if $items->params.cat_sub_name_display == 1}
                                <div class="cat_slider_title">
                                    <a href="{$cat.link|escape:'html':'UTF-8'}"
                                       title="{$cat.name|escape:'html':'UTF-8'}" {$cat._target|escape:'html':'UTF-8'}>
                                        {$cat.name|escape:'html':'UTF-8'}
                                    </a>
                                </div>
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    {/if}

    {if (!empty($items->products.category_parent))}
        <h5 class="more" data-catids="{$items->products.category_parent.cat_array|escape:'html':'UTF-8'}">
            <a title="{$items->products.category_parent.name|escape:'html':'UTF-8'}"
               href="{$items->products.category_parent.link|escape:'html':'UTF-8'}">
               View All
            </a>
        </h5>
    {/if}
    
</div>
