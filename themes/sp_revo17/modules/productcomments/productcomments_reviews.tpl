{*
 * package   SP Product Comments
 *
 * @version 1.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2017 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *}
 

<div class="comments_note">	
	<div class="star_content clearfix">
	{section name="i" start=0 loop=5 step=1}
		{if $averageTotal le $smarty.section.i.index}
			<i class="fa fa-star" aria-hidden="true"></i>
		{else}
			<i class="fa fa-star fa-star_on" aria-hidden="true"></i>
		{/if}
	{/section}
	</div>
	<span class="span-review-main">{l s='%s Review(s)'|sprintf:$nbComments d='Shop.Theme.Global'}&nbsp</span>
</div>
