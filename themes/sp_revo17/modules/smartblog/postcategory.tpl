

{capture name=path}<li class="depth1"><a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' d='Shop.Theme.Global'}</a></li>
    {if $title_category != ''}
    {$title_category}{/if}{/capture}
    {if $postcategory == ''}
        {if $title_category != ''}
             <p class="error">{l s='No Post in Category' d='Shop.Theme.Global'}</p>
        {else}
             <p class="error">{l s='No Post in Blog' d='Shop.Theme.Global'}</p>
        {/if}
    {else}
	{if $smartdisablecatimg == '1'}
                  {assign var="activeimgincat" value='0'}
                    {$activeimgincat = $smartshownoimg} 
        {if $title_category != ''}        
           {foreach from=$categoryinfo item=category}
            <div id="sdsblogCategory">
               {if ($cat_image != "no" && $activeimgincat == 0) || $activeimgincat == 1}
                   <img alt="{$category.meta_title}" src="{$modules_dir}/smartblog/images/category/{$cat_image}-home-default.jpg" class="imageFeatured">
               {/if}
                {$category.description}
            </div>
             {/foreach}  
        {/if}
    {/if}

    <div id="smartblogcat">
		<div class="smartblogcat-wrap">
			{assign var="blogstyle" value=""}
			{$blogstyle  = ((isset($smarty.get['SP_blogStyle'])) ? $smarty.get['SP_blogStyle'] : '' )}
			{if !empty($blogstyle)}
				{include file="./$blogstyle.tpl"}
			{elseif isset($SP_blogStyle)}
				{include file="./$SP_blogStyle.tpl"}
			{else}
				{include file="./blog-listing.tpl"}
			{/if}
		
			
		</div>
    </div>
    {if !empty($pagenums)}
    
    <div class="post-page ">
		<ul class="pagination">
			{for $k=0 to $pagenums}
				{if $title_category != ''}
					{assign var="options" value=null}
					{$options.page = $k+1}
					{$options.id_category = $id_category}
					{$options.slug = $cat_link_rewrite}
				{else}
					{assign var="options" value=null}
					{$options.page = $k+1}
				{/if}
				{if ($k+1) == $c}
					<li><span class="page-active">{$k+1}</span></li>
				{else}
						{if $title_category != ''}
							<li><a class="page-link" href="{smartblog::GetSmartBlogLink('smartblog_category_pagination',$options)}">{$k+1}</a></li>
						{else}
							<li><a class="page-link" href="{smartblog::GetSmartBlogLink('smartblog_list_pagination',$options)}">{$k+1}</a></li>
						{/if}
				{/if}
		   {/for}
		</ul>
		
			<!--<div class="results">{l s='Showing' d='Shop.Theme.Global'} {if $limit_start!=0}{$limit_start}{else}1{/if} {l s='to' d='Shop.Theme.Global'} {if $limit_start+$limit >= $total}{$total}{else}{$limit_start+$limit}{/if} {l s='of' d='Shop.Theme.Global'} {$total} ({$c} {l s='Pages' d='Shop.Theme.Global'})</div>-->
            
  </div>
	{/if}
 {/if}
{if isset($smartcustomcss)}
    <style>
        {$smartcustomcss}
    </style>
{/if}
