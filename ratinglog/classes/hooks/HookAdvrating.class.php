<?php

class PluginAdvrating_HookAdvrating extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {
		$this->AddHook('template_profile_sidebar_menu_item_first','AdvratingLogProfile');
		$this->AddHook('template_profile_whois_item_after_privat','AdvratingProfileSeasonRating');		
    }
    
    public function AdvratingLogProfile($aParams){
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'profile_menu.tpl');
    }    
       
    public function AdvratingProfileSeasonRating($aParams){
    	$oUserProfile = $aParams['oUserProfile'];
    	$aSeasonsRating = $this->PluginAdvrating_Seasonrating_GetUserRatingList($oUserProfile);
    	$this->Viewer_Assign('aSeasonsRating',$aSeasonsRating);
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'profile_season_rating.tpl');
    }     
    
}
?>
