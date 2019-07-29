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
<!doctype html>
<html lang="{$language.iso_code}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}{if isset($SP_MobileLayout) && $SP_MobileLayout && isset($isMobile_n) && $isMobile_n} mobile_layout{/if}{if isset($SP_MobileLayout) && $SP_MobileLayout} sp_mobilelayout{/if}">

    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}

    <header id="header">
        {block name='header'}
			{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout}
				{include file="_partials/header/header-mobile.tpl"}
			{else}
				{if isset($SP_headerStyle)}
					{if $SP_headerStyle == 'header-v1'}
						{include file="_partials/header/header-v1.tpl"}
					{elseif $SP_headerStyle == 'header-v2'}
						{include file="_partials/header/header-v2.tpl"}
					{elseif $SP_headerStyle == 'header-v3'}
						{include file="_partials/header/header-v3.tpl"}
					{elseif $SP_headerStyle == 'header-v4'}
						{include file="_partials/header/header-v4.tpl"}
					{elseif $SP_headerStyle == 'header-v5'}
						{include file="_partials/header/header-v5.tpl"}
					{elseif $SP_headerStyle == 'header-v6'}
						{include file="_partials/header/header-v6.tpl"}
					{elseif $SP_headerStyle == 'header-v7'}
						{include file="_partials/header/header-v7.tpl"}
					{elseif $SP_headerStyle == 'header-v8'}
						{include file="_partials/header/header-v8.tpl"}
					{/if}
				{else}
					{include file="_partials/header/header-v1.tpl"}
				{/if}
			{/if}
        {/block}
    </header>

    {block name='notifications'}
      {include file='_partials/notifications.tpl'}
    {/block}

    <section id="wrapper">
      {hook h="displayWrapperTop"}
      <div class="container">

      {block name='content'}
        <section id="content">
          <div class="row">
            <div class="col-md-8">
              {block name='cart_summary'}
                {render file='checkout/checkout-process.tpl' ui=$checkout_process}
              {/block}
            </div>
            <div class="col-md-4">

              {block name='cart_summary'}
                {include file='checkout/_partials/cart-summary.tpl' cart = $cart}
              {/block}

              {hook h='displayReassurance'}
            </div>
          </div>
        </section>
      {/block}
      </div>
      {hook h="displayWrapperBottom"}
    </section>

    <footer id="footer">
        {block name="footer"}
			{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout}
				{include file="_partials/footer/footer-v1.tpl"}
			{else}
				{if isset($SP_footerStyle)}
					{if $SP_footerStyle == 'footer-v1'}
						{include file="_partials/footer/footer-v1.tpl"}
					{elseif $SP_footerStyle == 'footer-v2'}
						{include file="_partials/footer/footer-v2.tpl"}
					{elseif $SP_footerStyle == 'footer-v3'}
						{include file="_partials/footer/footer-v3.tpl"}
					{elseif $SP_footerStyle == 'footer-v4'}
						{include file="_partials/footer/footer-v4.tpl"}
					{elseif $SP_footerStyle == 'footer-v5'}
						{include file="_partials/footer/footer-v5.tpl"}
					{elseif $SP_footerStyle == 'footer-v6'}
						{include file="_partials/footer/footer-v6.tpl"}
					{elseif $SP_footerStyle == 'footer-v7'}
						{include file="_partials/footer/footer-v7.tpl"}
					{elseif $SP_footerStyle == 'footer-v8'}
						{include file="_partials/footer/footer-v8.tpl"}
					{/if}
				{else}
					{include file="_partials/footer/footer-v1.tpl"}
				{/if}
			{/if}
        {/block}
    </footer>

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}

  </body>

</html>
