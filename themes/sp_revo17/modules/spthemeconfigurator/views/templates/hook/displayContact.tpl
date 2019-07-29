<div class="contactinfo col-lg-4 col-sm-12">
	<h4 class="title-footer">{l s='Contact Info' d='Shop.Theme.Global'}</h4>
	<div class="content-footer">
		{if isset($contact_text) && $contact_text}
			<div class="contact-text">
				{$contact_text}
			</div>
		{/if}
		{if isset($contact_address) && $contact_address}
			<div class="address">
				<label><i class="fa fa-map-marker" aria-hidden="true"></i></label>
				<span>{l s='Address : ' d='Shop.Theme.Global'}{$contact_address}</span>
			</div>
		{/if}
		
		{if isset($contact_email) && $contact_email}
			<div class="email">
				<label><i class="fa fa-envelope"></i></label>
				<a href="#">{l s='Email: ' d='Shop.Theme.Global'}{$contact_email}</a>
			</div>
		{/if}
		
		{if isset($contact_phone) && $contact_phone}
			<div class="phone">
				<label><i class="fa fa-mobile" aria-hidden="true"></i></label>
				<span>{$contact_phone}</span>
			</div>
		{/if}
	</div>
</div>
