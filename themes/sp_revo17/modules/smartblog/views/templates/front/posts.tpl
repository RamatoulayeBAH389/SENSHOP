
{extends file=$layout}
{block name='content'}
	<div id="content">
	   	<div id="sdsblogArticle" class="blogArticle" itemscope itemtype="http://schema.org/NewsArticle">


	   		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article" content="mainEntityOfPage" />
	   		<meta itemprop="datePublished" content="{$post.created}"/>
		    <meta itemprop="dateModified" content="{$post.created}"/>
		    <div class="hidden-xs-up" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
		            <img alt="logo" src="{$shop.logo}"/>
		            <meta itemprop="url" content="{$shop.logo}">
		            {if isset($logo_image_width) && $logo_image_width}<meta itemprop="width" content="{$logo_image_width}">{/if}
		            {if isset($logo_image_height) && $logo_image_height}<meta itemprop="height" content="{$logo_image_height}">{/if}
		        </div>
		        <meta itemprop="name" content="{$page.title|escape:'html':'UTF-8'}">
		    </div>


	   		<div class="ariticleImage articleContent">
	   			<div class="articleImageContent" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
	                {assign var="activeimgincat" value='0'}
	                {$activeimgincat = $smartshownoimg}
	               	<img src="{$modules_dir}/smartblog/images/{$post_img}-single-default.jpg" alt="{$meta_title}">
			        <meta itemprop="url" content="{$modules_dir}/smartblog/images/{$post_img}-single-default.jpg">
				</div>
                <div class="date_added">
                	<span class="d" itemprop="dateCreated">{$post.created|date_format:"d"}</span>
                	<span class="m" itemprop="dateCreated">{$post.created|date_format:"M"}</span>
                </div>
	   		</div>

	   		<div class="articleMeta sdsarticle-text">
	   			<h1 class="articleTitle sdstitle_block title" itemprop="headline">{$meta_title}</h1>
			    <div class="metaComment article-info">
				 	{assign var="catOptions" value=null} 

				 	{$catOptions.id_category = $id_category}

					{$catOptions.slug = $cat_link_rewrite}

					<i class="fa fa-user" aria-hidden="true"></i> &nbsp;

					<span>Post By:</span>

					<span class="author">
						{if $smartshowauthorstyle != 0}
							{$firstname} {$lastname}
						{else}
							Admin
						{/if}
					</span>

				 	&nbsp; &nbsp;

			    	<span class="comment" title="{if {$countcomment} < 1 } 0 Comment {else} {$countcomment} Comment(s) {/if}" href="">
			    		<i class="fa fa-comments" aria-hidden="true"></i> &nbsp;
						{if $countcomment != 0}
							{$countcomment} {l s='Comment(s)' d='Shop.Theme.Global'}
						{else}
							0 {l s='Comment' d='Shop.Theme.Global'}
						{/if}
					</span>

					<!--
					<span class="viewed">
						{if $post.viewed > 1}
							{$post.viewed} {l s='Views' d='Shop.Theme.Global'}
						{else}
							{$post.viewed} {l s='View' d='Shop.Theme.Global'}
						{/if}
						<i class="fa fa-eye"></i> 
					</span>
					-->

					&nbsp; &nbsp;
		            {if $tags != ''}
	                    <span class="tags">
	                    	<i class="fa fa-tags" aria-hidden="true"></i> &nbsp;
	                        {foreach from=$tags item=tag}
	                            {assign var="options" value=null}
	                            {$options.tag = $tag.name}
	                            <a title="tag" href="{smartblog::GetSmartBlogLink('smartblog_tag',$options)}">{$tag.name}</a>&nbsp;
	                        {/foreach}
	                    </span>
		            {/if}


			    </div>

	   		</div>

	   		<div class="sdsarticle-des" itemprop="description">
	   			{$content nofilter}
	   		</div>
		</div>

      	<div class="articleBottom">
        	{$HOOK_SMART_BLOG_POST_FOOTER}
      	</div>
	</div>

	{if !empty($smartcustomcss)}
	    <style>
	        {$smartcustomcss}
	    </style>
	{/if}

{/block}