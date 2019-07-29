{*
 * @package SP Custom Html
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author MagenTech http://www.magentech.com
 *}
{if isset($htmllist) && !empty($htmllist)}
    {foreach from=$htmllist item=item}
		{if isset($item.active) && $item.active}
			{assign var="moduleclass_sfx" value=( isset( $item.params.moduleclass_sfx ) ) ?  $item.params.moduleclass_sfx : ''}
			{math equation='rand()' assign='rand'}
			{assign var='randid' value="now"|strtotime|cat:$rand}
			{assign var="uniqued" value="sp_customhtml_{$item.id_spcustomhtml}_{$randid}"}
			<div class="{$uniqued|escape:'html':'UTF-8'}
			{$moduleclass_sfx|escape:'html':'UTF-8'} spcustom_html">
				{if isset($item.params.display_title_module) && $item.params.display_title_module && !empty($item.title_module)}
					<h3 class="title_block">
						{$item.title_module|escape:'html':'UTF-8' nofilter}
					</h3>
				{/if}
				{if isset($item.content) && !empty($item.content)}
					{$item.content nofilter}
				{/if}
			</div>
		{/if}
    {/foreach}
{/if}
