{capture name=path}<a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' d='Shop.Theme.Global'}</a>
     {if $title_category != ''}
    <span class="navigation-pipe">{$navigationPipe}</span>{$title_category}{/if}{/capture}
    {if $postcategory == ''}
             <p class="error">{l s='No Post in Archive' d='Shop.Theme.Global'}</p>
    {else}   
    <div id="smartblogcat" class="block clearfix">
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

