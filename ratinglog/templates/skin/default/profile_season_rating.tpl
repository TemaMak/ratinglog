{if $aSeasonsRating}
	<h2 class="header-table">{$aLang.plugin.advrating.rating_by_season}</h2>
	<ul class="profile-dotted-list">
		{foreach from=$aSeasonsRating item=oSeasonsRating}
		<li>
			<span class="season_rating_name">{$oSeasonsRating->getName()}:</span><strong>{$oSeasonsRating->getValue(2)}</strong>
		</li>
		{/foreach}
	</ul>
{/if}