
{if $social_in_footer}
<div class="footer-social col-lg-4 col-sm-12">
	<h3 class="block-title">{l s='Follow us' d='Shop.Theme.Global'}</h3>
	<div class="socials">
		{if $social_facebook }  
				<a href="{$social_facebook}" class="facebook" target="_blank" ><i class="fa fa-facebook"></i>
						<span class="name-social">{l s='Facebook' d='Shop.Theme.Global'}</span>
				</a>
		{/if}
		{if $social_twitter}   
				<a href="{$social_twitter}" class="twitter" target="_blank" >
						<i class="fa fa-twitter"></i>
						<span class="name-social">{l s='Twitter' d='Shop.Theme.Global'}</span>
				</a>
		{/if}
		{if $social_google}
				<a href="{$social_google}" class="google" target="_blank">
						<i class="fa fa-google-plus"></i>
						<span class="name-social">{l s='Google +' d='Shop.Theme.Global'}</span>
				</a>
		{/if}

		{if $social_instagram}
				<a href="{$social_instagram}" class="instagram" target="_blank">
						<i class="fa fa-instagram" aria-hidden="true"></i>
						<span class="name-social">{l s='Instagram' d='Shop.Theme.Global'}</span>
				</a>
		{/if}
		{if $social_dribbble}
				<a href="{$social_dribbble}" class="dribbble" target="_blank"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
		{/if}

		{if $social_flickr}<a href="{$social_flickr}" class="flickr" target="_blank" ><i class="fa fa-flickr"></i></a>{/if}
		{if $social_pinterest}<a href="{$social_pinterest}" class="pinterest" target="_blank" ><i class="fa fa-pinterest"></i></a>{/if}
		{if $social_linkedIn}<a href="{$social_linkedIn}" class="linkedIn" target="_blank" ><i class="fa fa-linkedin"></i></a>{/if}
		
	</div>
</div>
{/if}