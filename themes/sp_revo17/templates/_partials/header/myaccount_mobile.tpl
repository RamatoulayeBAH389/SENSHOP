<!-- SP Block user information module NAV mobile -->
<div class="mobile-layout-content">
		{if $customer.is_logged}
			<div class="welcome-text">{l s='Hi' d='Shop.Theme.Actions'}  {$customer.firstname} {$customer.lastname}</div>
			<span class="myaccount"> 
				<a href="{$urls.pages.my_account}" rel="nofollow" title="{l s='My account' d='Shop.Theme.Actions'}">
					{l s='My account' d='Shop.Theme.Actions'} 
				</a>
			</span>
			<span class="logout"> 
				<a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Sign out' d='Shop.Theme.Actions'}">
					{l s='Sign out' d='Shop.Theme.Actions'} 
				</a>
			</span>
		{else}
			<div class="welcome-text">{l s='Default welcome msg!' d='Shop.Theme.Actions'}</div>
			<span class="register">
				<a href="{$urls.pages.register}" rel="nofollow" title="{l s='Log in to your customer account' d='Shop.Theme.Global'}">
					{l s='Register' d='Shop.Theme.Actions'}
				</a>
			</span>

			<span class="login">
				<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Sign in' d='Shop.Theme.Global'}">
					{l s='Sign in' d='Shop.Theme.Actions'}
				</a>
			</span>
		{/if}
		
</div>
<div class="language-currency-mobile">{hook h="displayNav_2"}</div>
