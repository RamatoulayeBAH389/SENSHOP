{if isset($categories) AND !empty($categories)}
<div id="category_blog_block_left"  class="block blogModule boxPlain">
      <h3 class='block-title'>{l s='Categories' d='Shop.Theme.Global'}</h3>
       <div class="block_content list-block">
             <ul class="list-link">
    	{foreach from=$categories item="category"}
                {assign var="options" value=null}
                {$options.id_category = $category.id_smart_blog_category}
                {$options.slug = $category.link_rewrite}
                    <li>
                        <a href="{smartblog::GetSmartBlogLink('smartblog_category',$options)}"> {$category.meta_title}</a>
                    </li>
    	{/foreach}
            </ul>
       </div>
</div>
{/if}