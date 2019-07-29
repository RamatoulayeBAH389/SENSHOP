<!-- SP Block user information module NAV  -->

<div class="topleft-content">
		{if $customer.is_logged}
			<a href="{$my_account_url}"><span>{l s='Hi' d='Shop.Theme.Global'}  {$customer.firstname} {$customer.lastname}</span></a>
		{/if}
		{if $customer.is_logged}
			<span> | </span>
			<span class="logout"> 
				<a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Logout' d='Shop.Theme.Global'}">
					{l s='Logout' d='Shop.Theme.Global'} 
				</a>
			</span>
		{else}
		    {l s='Default welcome msg!' d='Shop.Theme.Global'} 
			<span class="register">
			<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' d='Shop.Theme.Global'}">
				{l s='Join Free' d='Shop.Theme.Global'}
			</a>
			</span>
			<span class="or">or</span>
			<span class="login">
				<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' d='Shop.Theme.Global'}">
					{l s='Sign In' d='Shop.Theme.Global'}
				</a>
			</span>
		{/if}
</div>