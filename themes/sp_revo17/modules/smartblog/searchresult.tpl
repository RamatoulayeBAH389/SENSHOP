{capture name=path}<li class="depth1"><a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' d='Shop.Theme.Global'}</a></li>
     {if $title_category != ''}
    {$title_category}{/if}{/capture}
 
    {if $postcategory == ''}
        {include file="./search-not-found.tpl" postcategory=$postcategory}
    {else}
    <div id="smartblogcat" class="block">
{foreach from=$postcategory item=post}
    {include file="./category_loop.tpl" postcategory=$postcategory}
{/foreach}
    </div>
 {/if}
 {if isset($smartcustomcss)}
    <style>
        {$smartcustomcss}
    </style>
{/if}

