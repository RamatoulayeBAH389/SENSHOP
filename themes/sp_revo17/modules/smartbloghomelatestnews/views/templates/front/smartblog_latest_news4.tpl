<div class="block lastestnews moduletable">
	<div class="title_block_lastest">
		<h3>{l s='Latest Blog' d='Shop.Theme.Global'}</h3>
	</div>
    <ul class="lastest_posts_7">
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
               
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <li class="post">
						<div class="post-inner clearfix">
							<div class="post_image col-lg-6">
								 <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg"></a>
							</div>
							
							<div class="post_content col-lg-6">
								<div class="info-info">
									<div class="sdsarticle-info">
										<span class="comment">
											<i class="fa fa-comments" aria-hidden="true"></i> &nbsp;
											{$post.countcomment} 
												{if $post.countcomment != 0}
													{$post.countcomment} {l s='Comments' d='Shop.Theme.Global'}
												{else}
												 	0 {l s='Comment' d='Shop.Theme.Global'} 
											{/if}
										</span>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<i class="fa fa-user" aria-hidden="true"></i> &nbsp;
										<span class="author">
											{if $post.smartshowauthorstyle != 0}
												{$post.firstname}{$post.lastname}
											{/if}
										</span>
										<!--
										<span class="view">
											<i class="fa fa-eye"></i> {$post.viewed} {if $post.viewed > 1} {l s='Views' d='Shop.Theme.Global'} {else} {l s='View' d='Shop.Theme.Global'} {/if}
										</span>-->
									</div>
									<div class="sdsarticleHeader">
										<h5><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a></h5>
									</div>
									<div class="desc">
										{$post.short_description|truncate:100:'...'|escape:'htmlall':'UTF-8'}
									</div>
									<h6 class=readmore>
										<a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">
											<i class="fa fa-caret-right"></i>
											{l s='Read more' d='Shop.Theme.Global'}
										</a>
									</h6>
								</div>
							</div>
						</div>
					</li>
                
                {$i=$i+1}
            {/foreach}
        {/if}
     </ul>
</div>