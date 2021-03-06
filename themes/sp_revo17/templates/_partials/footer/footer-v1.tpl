<div class="footer-v1 footer-container">

	{block name="footer"}

	<div id="footer-1-main">

		<div class="footer-top">
			<div class="container">
				<div class="row">
					{hook h="displayCustomhtml3"}
				</div>
			</div>
		</div>
		<div class="footer-center">
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

					<div class="footer-center-2 clearfix">
						{hook h="displayCustomhtml4"}
						{hook h="displayCustomhtml5"}
					</div>

				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					{hook h="displayNewLetter"}
					{hook h='displayFooterSocial'}
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
