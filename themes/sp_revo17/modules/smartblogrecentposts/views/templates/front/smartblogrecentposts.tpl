{if isset($posts) AND !empty($posts)}
<div id="recent_article_smart_blog_block_left"  class="block blogModule boxPlain">
   <h3 class='block-title'>{l s='Recent posts' d='Shop.Theme.Global'}</h3>
   <div class="block_content">
      <ul class="recentArticles">
        {foreach from=$posts item="post"}
             {assign var="options" value=null}
             {$options.id_post= $post.id_smart_blog_post}
             {$options.slug= $post.link_rewrite}
             <li>
                 <!--<a class="image" title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">
                     <img alt="{$post.meta_title}" src="{$modules_dir}/smartblog/images/{$post.post_img}-home-small.jpg">
                 </a>-->
                 <a class="title"  title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.meta_title}</a>
        <!--<span class="info">{$post.created|date_format:"%b, %d, %Y"}</span>-->
             </li>
         {/foreach}
            </ul>
   </div>
</div>
{/if}