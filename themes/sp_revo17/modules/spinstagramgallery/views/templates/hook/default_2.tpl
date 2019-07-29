{*
 * @package SP Instagram Gallery
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}

<!-- SP Img Instagram -->
{if isset($list) && !empty($list)}
    {if isset($list) && !empty($list)}
        {foreach from=$list item=items}
			{if isset($items->params.active_owl) && $items->params.active_owl ==1}
			<div class="moduletable  {$items->params.moduleclass_sfx|escape:'html':'UTF-8'}">
				{if isset($items->title_module[$id_lang]) && $items->params.display_title_module}
					<div class="ig-title-module">
						{$items->title_module[$id_lang]|escape:'html':'UTF-8'}
					</div>
				{/if}

				{hook h='displayFooterSocial'}

				{math equation='rand()' assign='rand'}
				{assign var='randid' value="now"|strtotime|cat:$rand}
				{assign var="tag_id" value="sp_img_stagram_{$items->id_spinstagramgallery}_{$randid}"}
				{assign var="class_ig_res" value="ig01-"|cat:$items->params.nb_column1|cat:' ig02-'|cat:$items->params.nb_column2|cat:' ig03-'|cat:$items->params.nb_column3|cat:' ig04-'|cat:$items->params.nb_column4}
				{assign var="user_id" value=$items->params.user_id|escape:'html':'UTF-8'}
				{assign var="access_token" value=$items->params.access_token|escape:'html':'UTF-8'}
				{assign var="limit" value=$items->params.count_number_img|escape:'html':'UTF-8'}
				{assign var="row" value=$items->params.nb_row|escape:'html':'UTF-8'}
				<!--[if lt IE 9]>
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery msie lt-ie9 first-load"><![endif]-->
				<!--[if IE 9]>
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery msie first-load"><![endif]-->
				<!--[if gt IE 9]><!-->
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery first-load"
				{foreach from=$items->params item=param key=k} 
					data-{$k} = "{$param}" 
				{/foreach}	
				
				><!--<![endif]-->
					<div id="spinstagramgallery-slider-{$items->id_spinstagramgallery}" class="instagram-slider">
						<!-- Begin Class ig-items -->
						<!-- End Class ig-items -->
					</div>
				</div>
			</div>	
			{else}
				<div class="moduletable  {$items->params.moduleclass_sfx|escape:'html':'UTF-8'}">
				{if isset($items->title_module[$cookie->id_lang]) && $items->params.display_title_module}
					<div class="ig-title-module">
						{$items->title_module[$cookie->id_lang]|escape:'html':'UTF-8'}
					</div>
				{/if}

				{math equation='rand()' assign='rand'}
				{assign var='randid' value="now"|strtotime|cat:$rand}
				{assign var="tag_id" value="sp_img_stagram_{$items->id_spinstagramgallery}_{$randid}"}
				{assign var="class_ig_res" value="ig01-"|cat:$items->params.nb_column1|cat:' ig02-'|cat:$items->params.nb_column2|cat:' ig03-'|cat:$items->params.nb_column3|cat:' ig04-'|cat:$items->params.nb_column4}
				{assign var="user_id" value=$items->params.user_id|escape:'html':'UTF-8'}
				{assign var="access_token" value=$items->params.access_token|escape:'html':'UTF-8'}
				{assign var="limit" value=$items->params.count_number_img|escape:'html':'UTF-8'}
				<!--[if lt IE 9]>
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery msie lt-ie9 first-load"><![endif]-->
				<!--[if IE 9]>
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery msie first-load"><![endif]-->
				<!--[if gt IE 9]><!-->
				<div id="{$tag_id|escape:'html':'UTF-8'}" class="sp-instagram-gallery first-load"
					{foreach from=$items->params item=param key=k} 
						data-{$k} = "{$param}" 
					{/foreach}	
				><!--<![endif]-->
					<div class="ig-wrap">
						<!-- Begin Class ig-items -->
						<div class="ig-items {$class_ig_res|escape:'html':'UTF-8'}">
							<ul></ul>
						</div>
						<!-- End Class ig-items -->
					</div>
				</div>
			</div>
			{/if}
			<!-- End SP Img Instagram -->
		{/foreach}
    {else}
        {l s='Has no content to show! In Module Sp Instagram Gallery' d='Shop.Theme.Global'}
    {/if}
{/if}





