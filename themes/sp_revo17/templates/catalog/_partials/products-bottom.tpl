{*
 * Classic theme doesn't use this subtemplate, feel free to do whatever you need here.
 * This template is generated at each ajax calls.
 * See ProductListingFrontController::getAjaxProductSearchVariables()
 *}
 
<div id="js-product-list-bottom" class="js-product-list products-selection clearfix">
    <div class="hidden-sm-down total-products">
        {if isset($SP_catProductCounter) && $SP_catProductCounter}
            <div class="catproductcounter">
              {block name='pagination_summary'}
                {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
                '%from%' => $listing.pagination.items_shown_from ,
                '%to%' => $listing.pagination.items_shown_to,
                '%total%' => $listing.pagination.total_items
                ]}
              {/block}
            </div>
        {/if}
    </div>
    {block name='sort_by'}
            {include file='catalog/_partials/sort-orders.tpl' sort_orders=$listing.sort_orders}
    {/block}

    {block name='pagination'}
        {if $listing.pagination.total_items > $listing.products|count}
                {include file='_partials/pagination.tpl' pagination=$listing.pagination}
        {/if}
    {/block}

    <div class="col-sm-12 hidden-md-up text-sm-center showing">
        {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[
        '%from%' => $listing.pagination.items_shown_from ,
        '%to%' => $listing.pagination.items_shown_to,
        '%total%' => $listing.pagination.total_items
        ]}
    </div>
</div>
