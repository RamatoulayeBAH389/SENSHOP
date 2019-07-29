{*
 * package   SP Manufacture Slider
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}

<!-- SP Manufacture Slider -->
{if isset($list) && !empty($list)}
    {foreach from=$list item=items}
        {assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
        <div class="moduletable  {$moduleclass_sfx|escape:'html':'UTF-8'}">
            {if $items->params.display_title_module}
                <h3 class="title_block">
                    {$items->title_module[$id_lang]|escape:'html':'UTF-8'}
                </h3>
            {/if}
            {assign var="params" value=$items->params}

            {$_list = $items->products}
            {if isset($_list) && $_list}


                {math equation='rand()' assign='rand'}
                {assign var='randid' value="now"|strtotime|cat:$rand}
                {assign var="tag_id" value="sp_manu_slider_{$items->id_spmanufactureslider}_{$randid}"}
                <div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-manu-slider sp-preload"
				{foreach from=$items->params item=param key=k} 
					{if $k != "slider"}
					data-{$k} = "{$param}" 
					{/if}
				{/foreach}>
                    <div class="sp-loading"></div>

					<div id="spmanufactureslider-{$items->id_spmanufactureslider}" class="spmanufactureslider"
					 data-delay="{$items->params.delay|escape:'html':'UTF-8'}"
					 data-duration="{$items->params.duration|escape:'html':'UTF-8'}"
					 data-effect="{$items->params.effect|escape:'html':'UTF-8'}">
						{foreach from=$_list item=manufacturer name=manufacturer_lists}

							{assign var="myfile" value="img/m/{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}.jpg"}
							{if file_exists($myfile)}
								{if $params.manu_image_size == 'none'}
									{assign var="src" value="{$img_manu_dir}{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}.jpg"}
								{else}
									{assign var="src" value="{$img_manu_dir}{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}-{$params.manu_image_size}.jpg"}
								{/if}
								<div class="item">
									<div class="item-wrap">
										{if $smarty.foreach.manufacturer_lists.iteration <= 20}
											<div class="item-img item-height">
												<div class="item-img-info">
													<a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'html':'UTF-8'}" {$manufacturer._target}
													   title="{$manufacturer.name|escape:'html':'UTF-8'}">
														<img src="{$src|escape:'html':'UTF-8'}"
															 class="logo_manufacturer"
															 title="{$manufacturer.name|escape:'html':'UTF-8'}"
															 alt="{$manufacturer.name|escape:'html':'UTF-8'}"/>
													</a>
												</div>
											</div>
										{/if}
									</div>
								</div>
							{/if}
						{/foreach}
					</div>
                </div>
            {else}
                {l s='Has no content to show!' d='Shop.Theme.Global'}
            {/if}

        </div>
    {/foreach}
{/if}
<!-- /SP Slider -->