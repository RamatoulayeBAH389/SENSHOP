{if $spmegamenu != ''}
	<div class="spmegamenu">
		<nav class="navbar">
			<div class="navbar-button{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout} mobile-megamenu{/if}">
				{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout}
				<a id="show-megamenu" data-toggle="collapse" data-target="#sp-megamenu" class="navbar-toggle button-sticky-bottom">
					<i class="fa fa-bars" style="font-size: 18px;"></i>
					<span>{l s='Menu' d='Shop.Theme.Global'}</span>
				</a>
				{else}
					<button type="button" id="show-megamenu" data-toggle="collapse" data-target="#sp-megamenu" class="navbar-toggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				{/if}
			</div>
			<div id="sp-megamenu" class="{$spmegamenu_style} sp-megamenu{if isset($isMobile_n) && $isMobile_n && isset($SP_MobileLayout) && $SP_MobileLayout} box-sticky-bottom{/if} clearfix">
				<span id="remove-megamenu" class="fa fa-remove"></span>
				<span class="label-menu">{l s='Menu' d='Shop.Theme.Global'}</span>
				<div class="sp-megamenu-container clearfix">
					<div class="home css_type">
						<a href="{$urls.base_url}">{l s='Home' d='Shop.Theme.Global'}</a>
					</div>
					{$spmegamenu nofilter}
				</div>
			</div>
		</nav>	
	</div>	
{/if}
<script type="text/javascript">
	{literal}
		$(document).ready(function() {		
			$("#sp-megamenu  li.parent  .grower, #sp-megamenu .home .grower").click(function(){
				if($(this).hasClass('close'))
					$(this).addClass('open').removeClass('close');
				else
					$(this).addClass('close').removeClass('open');				
				$('.dropdown-menu',$(this).parent()).first().toggle(300);			
			});
			
			var wd_width = $(window).width();
			if(wd_width > 992)
				offtogglemegamenu();			
				
			$(window).resize(function() {
				var sp_width = $( window ).width();
				if(sp_width > 992)
					offtogglemegamenu();
			});
			
		});

		$('#show-megamenu').click(function() {
			if($('.sp-megamenu').hasClass('sp-megamenu-active'))
				$('.sp-megamenu').removeClass('sp-megamenu-active');
			else
				$('.sp-megamenu').addClass('sp-megamenu-active');
			return false;
		});
		$('#remove-megamenu').click(function() {
			$('.sp-megamenu').removeClass('sp-megamenu-active');
			return false;
		});
			
		function offtogglemegamenu()
		{
			$('#sp-megamenu li.parent .dropdown-menu').css('display','');	
		$('#sp-megamenu').removeClass('sp-megamenu-active');
		$("#sp-megamenu  li.parent  .grower").removeClass('open').addClass('close');	
		$('#sp-megamenu .home .dropdown-menu').css('display','');	
		$('#sp-megamenu').removeClass('sp-megamenu-active');
		$("#sp-megamenu .home  .grower").removeClass('open').addClass('close');	
		}	
		
	{/literal}
</script>