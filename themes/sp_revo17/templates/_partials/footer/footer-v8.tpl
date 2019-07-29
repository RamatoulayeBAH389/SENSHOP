<div class="footer-container footer-v8">
	{block name="footer"}
		<div id="footer-8-main">
			<div class="footer-top">
				<div class="container">
						{hook h="displayNewLetter4"}
				</div>
			</div>
			
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="group-link-1">
							{hook h='displayFooterLinks5'}
							{hook h='displayFooterLinks6'}
						</div>

						<div class="group-link-2">
							{hook h='displayFooterLinks7'}
							{hook h='displayFooterLinks8'}
						</div>
						<div class="group-link-3">
							{hook h='displayFooterContact'}
							{hook h="displayCustomhtml16"}
						</div>
					</div>
				</div>
			</div>

			<div id="copyright">
				<div class="container">
					{if isset($copyRight_txt)}<div class="copyright">{$copyRight_txt nofilter}</div>{/if}
					{hook h="displayFooterPayment"}
				</div>
			</div>
		</div>
	{/block}

	<div class="backtop">
		<a id="sp-totop" class="backtotop" href="#" title="{l s='Back to top' d='Shop.Theme'}">
			<i class="fa fa-angle-double-up"></i>
		</a>
	</div>
</div>
