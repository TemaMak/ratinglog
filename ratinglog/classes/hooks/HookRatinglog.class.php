<?php

class PluginRatinglog_HookRatinglog extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {
		$this->AddHook('template_profile_sidebar_menu_item_first','RatinglogLogProfile');	
    }
    
    public function RatinglogLogProfile($aParams){
    	if (!$this->User_IsAuthorization()) {
    		return;
    	}
    	
    	if ($this->User_GetUserCurrent()->getId() != $aParams['oUserProfile']->getId() ){
    		return;
    	}
    	
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'profile_menu.tpl');
    }    
}
?>
