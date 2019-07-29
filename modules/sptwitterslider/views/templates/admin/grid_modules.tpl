<div class="panel">
    <div class="panel-heading">
        {l s='Module Manager' mod='sptwitterslider'}
        <span class="badge">{$modules|count}</span>
        <span class="panel-heading-action">
            <a id="desc-module-new" class="list-toolbar-btn" href="{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&addModule=1">
                <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add New Module" data-html="true" data-placement="top">
                    <i class="process-icon-new"></i>
                </span>
            </a>
            <a class="list-toolbar-btn" href="javascript:location.reload();">
                <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='Refresh list'}" data-html="true" data-placement="top">
                    <i class="process-icon-refresh"></i>
                </span>
            </a>
        </span>
    </div>
    <style>
        @media (max-width: 992px) {
            .table-responsive-row td:nth-of-type(1):before {
                content: "ID";
            }
            .table-responsive-row td:nth-of-type(2):before {
                content: "Position";
            }
            .table-responsive-row td:nth-of-type(3):before {
                content: "Title";
            }
            .table-responsive-row td:nth-of-type(4):before {
                content: "Hook Into";
            }
            .table-responsive-row td:nth-of-type(5):before {
                content: "Status";
            }
        }
    </style>

    <div class="table-responsive-row clearfix">
        <table id="table-sptwitterslider" class="table sptwitterslider" >
            <thead>
                <tr class="nodrag nodrop">
                    <th class="">
                        <span class="title_box">{l s='ID' mod='sptwitterslider'}</span>
                    </th>

                    <th class="">
                        <span class="title_box">{l s='Title' mod='sptwitterslider'}</span>
                    </th>
                    <th class="">
                        <span class="title_box">{l s='Hook Into' mod='sptwitterslider'}</span>
                    </th>
                    <th class="">
                        <span class="title_box ">{l s='Position' mod='sptwitterslider'}</span>
                    </th>
                    <th class="">
                        <span class="title_box">{l s='Status' mod='sptwitterslider'}</span>
                    </th>
                    <th class="text-right">
                        <span class="title_box">{l s='Action' mod='sptwitterslider'}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                {if !count($modules)}
                <tr>
                    <td class="list-empty" colspan="6">
                        <div class="list-empty-msg">
                            <i class="icon-warning-sign list-empty-icon"></i>
                            {l s='No records found' mod='sptwitterslider'}
                        </div>
                    </td>
                </tr>
                {else}
                {foreach $modules AS $index => $tr}
                    <tr id="item_{$tr.id_sptwitterslider}" class="{if $tr@iteration is odd by 1}odd{/if}">
						<td class="pointer" onclick="document.location ='{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&editModule&id_sptwitterslider={$tr.id_sptwitterslider}'">{$tr.id_sptwitterslider}</td>
						<td class="pointer" onclick="document.location ='{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&editModule&id_sptwitterslider={$tr.id_sptwitterslider}'">{$tr.title_module}
						{if $tr.is_shared}
							<span class="label label-success" >
								{l s='Shared Module' mod='sptwitterslider'}
							</span>
						{/if}
						</td>
						<td  class="pointer" onclick="document.location ='{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&editModule&id_sptwitterslider={$tr.id_sptwitterslider}'">{$tr.hook_name}</td>
						<td class="pointer dragHandle"><div class="dragGroup"><div class="positions">{$tr.position}</div></div></td>
						<td class="pointer" onclick="document.location ='{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&editModule&id_sptwitterslider={$tr.id_sptwitterslider}'">
							<a class="list-action-enable action-enabled" href="{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&statusModule&id_sptwitterslider={$tr.id_sptwitterslider}" title="{l s='Status' mod='sptwitterslider'}">
								{if $tr.active}
									<i class="material-icons action-enabled ">check</i>
								{else}
									<i class="material-icons action-disabled">clear</i>
								{/if}
								
							</a>
						</td>
						<td class="text-right">
						   <div class="btn-group-action">
							  <div class="btn-group pull-right">
								 <a href="{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&editModule&id_sptwitterslider={$tr.id_sptwitterslider}" title="Edit" class="edit btn btn-default">
								 <i class="icon-pencil"></i>&nbsp;{l s='Edit' mod='sptwitterslider'}
								 </a>
								 <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								 <i class="icon-caret-down"></i>&nbsp;
								 </button>
								 <ul class="dropdown-menu">
									<li>
									   <a href="{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&duplicateModule&id_sptwitterslider={$tr.id_sptwitterslider}" title="Duplicate" onclick="return confirm('{l s='Are you sure want duplicate this item?' mod='sptwitterslider'}');">
									   <i class="icon-copy"></i>&nbsp;{l s='Duplicate' mod='sptwitterslider'}
									   </a>
									</li>
									<li class="divider">
									</li>
									<li>
									   <a href="{$link->getAdminLink('AdminModules')}&configure=sptwitterslider&deleteModule&id_sptwitterslider={$tr.id_sptwitterslider}" onclick="return confirm('{l s='Are you sure?' mod='sptwitterslider'}');" title="Delete" class="delete">
									   <i class="icon-trash"></i>&nbsp;{l s='Delete' mod='sptwitterslider'}
									   </a>
									</li>
								 </ul>
							  </div>
						   </div>
						</td>
					</tr>
                {/foreach}

                {/if}
            </tbody>

        </table>
    </div>
</div>