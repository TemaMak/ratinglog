{assign var="sidebarPosition" value='left'}
{include file='header.tpl'}


<h2 class="page-header">{$aLang.plugin.advrating.rating_log_title}</h2>

<table class="table table-users">
	<thead>
		<tr>
			<th class="cell-name cell-tab">
				<div class="cell-tab-inner">{$aLang.plugin.advrating.rating_log_add_date}</div>
			</th>	
			<th class="cell-tab">
				<div class="cell-tab-inner"><span>{$aLang.plugin.advrating.rating_log_rating_delta}</span></div>
			</th>
			<th class="cell-tab">
				<div class="cell-tab-inner"><span>{$aLang.plugin.advrating.rating_log_skill_delta}</span></div>
			</th>
			<th class="cell-rating cell-tab">
				<div class="cell-tab-inner"><span>{$aLang.plugin.advrating.rating_log_action_comment}</span></div>
			</th>			
		</tr>
	</thead>

	<tbody>
		{if $aLog}
			{foreach from=$aLog item=oLog}
				<tr>
					<td class="cell-name">					
						{$oLog->getAddDate()}			
					</td>
					<td>
						<span class="log_delta_{$oLog->getRatingDirection()}">{$oLog->getRatingDeltaValue(2)}</span>
					</td>
					<td>
						<span class="log_delta_{$oLog->getSkillDirection()}">{$oLog->getSkillDeltaValue(2)}</span>
					</td>
					<td>
						{$oLog->getComment()}
					</td>					
				</tr>
			{/foreach}
		{else}
			<tr>
				<td colspan="4">
					{if $sUserListEmpty}
						{$sUserListEmpty}
					{else}
						{$aLang.user_empty}
					{/if}
				</td>
			</tr>
		{/if}
	</tbody>
</table>

{include file='paging.tpl' aPaging=$aPaging}
{include file='footer.tpl'}