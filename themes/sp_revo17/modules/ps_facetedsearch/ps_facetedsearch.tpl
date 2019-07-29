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
{if isset($listing.rendered_facets)}
<a class="button-sticky-bottom btn-search-filters" href="javascript:void(0)" data-drop="filter-btn"><i class="fa fa-arrow-right" style="font-size: 14px;"></i> </a>
	<div id="search_filters_wrapper" class="box-sticky-bottom">
	  <div id="search_filter_controls">
		  <span id="_mobile_search_filters_clear_all"></span>
		  {*
		  <button class="btn btn-secondary ok">
			<i class="material-icons">&#xE876;</i>
			{l s='OK' d='Shop.Theme.Actions'}
		  </button>
		  *}
	  </div>
	  {$listing.rendered_facets nofilter}
	  <div class="remove-box-sticky fa fa-remove"></div>
	</div>
{/if}
