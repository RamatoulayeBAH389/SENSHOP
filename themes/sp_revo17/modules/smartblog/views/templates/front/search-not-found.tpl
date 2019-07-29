<div id="pagenotfound" class="row">
												<div class="center_column col-xs-12 col-sm-12" id="center_column">
	<div class="pagenotfound">
	
	<h1>{l s='Sorry, but nothing matched your search terms.' d='Shop.Theme.Global'}</h1>

	<p>
		{l s='Please try again with some different keywords.' d='Shop.Theme.Global'}
	</p>

	
	<form class="std" method="post" action="{smartblog::GetSmartBlogLink('smartblog_search')}">
		<fieldset>
			<div>
				
				<input type="hidden" value="0" name="smartblogaction">
				<input type="text" class="form-control grey" value="{$smartsearch}" name="smartsearch" id="search_query">
                <button class="btn btn-default button button-small" value="OK" name="smartblogsubmit" type="submit"><span>{l s='Ok' d='Shop.Theme.Global'}</span></button>
			</div>
		</fieldset>
	</form>

	<div class="buttons"><a title="Home" href="{smartblog::GetSmartBlogLink('smartblog')}" class="btn btn-default button button-medium"><span><i class="icon-chevron-left left"></i>{l s='Home page' d='Shop.Theme.Global'}</span></a></div>
</div>
					</div>
										</div>