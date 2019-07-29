{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Block Newsletter module -->
<div id="newsletter_block_popup">
	
	<div class="block_content clearfix">
		<div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="content-inner">
			<h2 class="title">{l s='join our newsletter' d='Shop.Theme.Global'}</h2>
			<h4>
				{l s='Subscribe now to get' d='Shop.Theme.Global'}
				<span>{l s='40%' d='Shop.Theme.Global'}</span>
				{l s='off on any product!' d='Shop.Theme.Global'}
			</h4>
			<form action="{$link->getPageLink('index')|escape:'html':'UTF-8'}" method="post" id="newsletter-validate-detail-popup">
				<div class="form-group{if isset($msg) && $msg } {if $nw_error}form-error{else}form-ok{/if}{/if}" >
					<input class="inputNew grey newsletter-input" size="80" id="newsletter-inputpopup" type="text" name="email"  placeholder="{if isset($msg) && $msg}{$msg}{elseif isset($value) && $value}{$value}{else}{l s='Sign up for your email ...' d='Shop.Theme.Global'}{/if}" />
					<button type="submit" name="submitNewsletter" class="btn btn-default button button-small">
						<i class="fa fa-paper-plane"></i>
					</button>
					<input type="hidden" name="action" value="0" />
				</div>
			</form>
			
			<div class="msg">
				<input type="checkbox" class="ckmsg"/>
				<label class="check_lable">{l s='Do not show this popup again' d='Shop.Theme.Global'}</label>
			</div>
			
			<div class="sharing-buttons">
                {hook h='displayFooterSocial'}
			</div>
		</div>
	</div>
</div>