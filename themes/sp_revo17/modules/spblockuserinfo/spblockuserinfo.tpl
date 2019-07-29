<div class="spuserinfo-block">
    <div class="user-info">
        {if $logged}
           <a class="account" href="{$my_account_url}" title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow">
               <span>{l s='Welcome' d='Shop.Theme.Actions'}</span> <span>{$customerName}</span>
            </a>
            <a class="logout" href="{$logout_url}" rel="nofollow">
                <span> {l s='Sign out' d='Shop.Theme.Actions'}</span>
            </a>
        {else}
            <!-- <div class="welcome-text">{l s='Welcome Customer!' d='Shop.Theme.Actions'}</div> -->
            <a class="login" href="{$my_account_url}" title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow" >
                <span>{l s='Sign in' d='Shop.Theme.Actions'}</span>
            </a>
        {/if}
    </div>
</div>