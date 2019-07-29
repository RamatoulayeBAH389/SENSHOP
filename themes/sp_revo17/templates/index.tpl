{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='page.tpl'}

    {block name='page_content_container'}
		{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout && $page.page_name == 'index'}
			{include file="_partials/content/content-mobile.tpl"}
		{else}
			{if isset($SP_contentStyle)}
				{if $SP_contentStyle == 'content-v1'}
					{include file="_partials/content/content-v1.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v2'}
					{include file="_partials/content/content-v2.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v3'}
					{include file="_partials/content/content-v3.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v4'}
					{include file="_partials/content/content-v4.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v5'}
					{include file="_partials/content/content-v5.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v6'}
					{include file="_partials/content/content-v6.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v7'}
					{include file="_partials/content/content-v7.tpl"}
					<div class="clearfix"></div>
				{elseif $SP_contentStyle == 'content-v8'}
					{include file="_partials/content/content-v8.tpl"}
					<div class="clearfix"></div>
				{/if}
			{else}
				{include file="_partials/content/content-v1.tpl"}
			{/if}
		{/if}
    {/block}
