<div class="footer-container footer-v7">
	{block name="footer"}
		<div id="footer-7-main">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="footer-center-7 clearfix">
							<div class="group-link-7-1 col-lg-3 col-md-6">
								{hook h="displayCustomhtml25"}
								{hook h='displayFooterContact'}
							</div>
							<div class="group-link-7-2 col-lg-3 col-md-6">
								{hook h="displayCustomhtml26"}
							</div>
							<div class="group-link-7-3 col-lg-3 col-md-6">
								{hook h="displayFooterSocial"}
								{hook h="displayCustomhtml27"}
							</div>
							<div class="group-link-7-4 col-lg-3 col-md-6">
								{hook h="displayNewLetter3"}
								{hook h="displayCustomhtml16"}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							{if isset($copyRight_txt)}<div class="copyright">{$copyRight_txt nofilter}</div>{/if}
						</div>
						<div class="col-lg-6">
							{hook h="displayCustomhtml28"}
						</div>
					</div>
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
