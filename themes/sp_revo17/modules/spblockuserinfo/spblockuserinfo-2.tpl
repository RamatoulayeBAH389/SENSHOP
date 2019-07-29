<div class="spuserinfo-block_2">
    <div class="user-info">
        {if $logged}
            <div class="logout">
                <a class="account" href="{$my_account_url}" title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow">
                    {l s='Hi,' d='Shop.Theme.Actions'} {$customerName}
                </a>
                <a class="logout" href="{$logout_url}" rel="nofollow">
                    <span>{l s='Sign out' d='Shop.Theme.Actions'}</span>
                </a>
            </div>
        {else}
            <div class="login">
                <a class="login" href="{$my_account_url}" title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow" >
                    <span class="sign-in">{l s='Login' d='Shop.Theme.Actions'}</span>
                </a>
                <a class="my-account" href="{$urls.pages.register}" title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow" >
                    <span>{l s='My Account' d='Shop.Theme.Actions'}</span>
                </a>
            </div>
        {/if}
    </div>
</div>