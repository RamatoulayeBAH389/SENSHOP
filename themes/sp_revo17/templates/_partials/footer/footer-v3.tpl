<div class="footer-container footer-v3">
	{block name="footer"}
		<div id="footer-3-main">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="footer-center-1 clearfix">
							<div class="group-link-1">
								{hook h='displayFooterLinks'}
								{hook h='displayFooterLinks2'}
							</div>

							<div class="group-link-2">
								{hook h='displayFooterLinks3'}
								{hook h='displayFooterLinks4'}
							</div>

							{hook h='displayFooterContact'}
						</div>
					</div>
				</div>
			</div>
			
			<div class="footer-center">
				<div class="container">
					<div class="row">
						{hook h="displayNewLetter"}
					</div>
				</div>
			</div>


			<div class="footer-bottom clearfix">
				<div class="container">
					<div class="footer-bottom-content">
						{hook h="displayFooterSocial"}
						{hook h="displayCustomhtml4"}
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
