<div class="footer-v5 footer-container footer-v2">
	{block name="footer"}
		<div id="footer-2-main">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						{hook h="displayNewLetter"}
						{hook h='displayFooterSocial'}
					</div>
				</div>
			</div>

			<div class="footer-center">
				<div class="container">
					<div class="row">
						<div class="footer-center-1 clearfix">
							<div class="sp-footer-1stcol col-xs-12 col-sm-6 col-md-6 col-lg-4">
								{hook h="displayCustomhtml19"}
							</div>
							<div class="sp-footer-2ndcol col-xs-12 col-sm-6 col-md-6 col-lg-2">
								{hook h="displayFooterLinks"}
							</div>
							<div class="sp-footer-3rdcol col-xs-12 col-sm-6 col-md-6 col-lg-2">
								{hook h="displayFooterLinks4"}
							</div>
							<div class="sp-footer-4thcol col-xs-12 col-sm-6 col-md-6 col-lg-4">
								{hook h='displayFooterContact'}
							</div>							
						</div>
						<div class="footer-center-2 clearfix">
							{hook h="displayCustomhtml4"}
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
