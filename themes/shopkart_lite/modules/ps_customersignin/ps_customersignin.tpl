{**
* 2007-2018 PrestaShop
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
* @copyright 2007-2018 PrestaShop SA
* @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
* International Registered Trademark & Property of PrestaShop SA
*}
<div id="_desktop_user_info" class="ht-links-wrapper">
    <div class="user-info">
        <ul>
            {if $logged}
                <li class="user-link">
                    <a
                        class="account"
                        href="{$my_account_url}"
                        title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <span class="hidden-md-up"><img src="{$urls.img_url}/login-icon.png" alt="img"></span>
                        <span class="hidden-sm-down">{$customerName}</span>
                    </a>
                </li>
            {else}
                <li class="user-link">
                    <a
                        href="{$my_account_url}"
                        title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <span class="hidden-md-up"><img src="{$urls.img_url}/login-icon.png" alt="img"></span>
                        <span class="hidden-sm-down">{l s='Sign In' d='Shop.Theme.Actions'}</span>
                    </a>
                </li>
            {/if}
        </ul>
    </div>
</div>
