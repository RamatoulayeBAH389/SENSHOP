{*
 * package SP Twitter Slider
 *
 * @version 2.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2018 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*}
{if isset($list) && !empty($list)}
	 {foreach from=$list item=items}
		{$params = $items['params']}
		<div class="sp-twitter-slider {$params['SPTS_CLS_SFX']}" id="sp_twitter_slider_{$params['SPTS_IDMODULE']}">
			<div class="spts-wrap"
				{foreach from=$params item=param key=k} 
					{if !is_array($param)}
						data-{$k} = "{$param}" 
					{/if}
				{/foreach}
				>
				{if $params['SPTS_DISPLAY_TITLE']}
					<h2 class="title-module">
						{$params['SPTS_TITLE_MODULE'][$id_lang]}
					</h2>
				{/if}
			
				<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
				
				<div class="spts-wrap spts-slider-wrap " >
					{if $params['SPTS_DISPLAY_FOLLOW_BUTTON']}
						<div class="spts-btn-follow">
							<a href="https://twitter.com/{$params['SPTS_SCREEN_NAME']}" class="twitter-follow-button"
							   data-show-count="false">Follow @{$params['SPTS_SCREEN_NAME']}</a>
							<script>!function (d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (!d.getElementById(id)) {
										js = d.createElement(s);
										js.id = id;
										js.src = "https://platform.twitter.com/widgets.js";
										fjs.parentNode.insertBefore(js, fjs);
									}
								}(document, "script", "twitter-wjs");</script>
						</div>
					
					{/if}
				</div>
			</div>
		</div>
	{/foreach}
{/if}
