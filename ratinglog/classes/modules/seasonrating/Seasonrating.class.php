<?php 
class PluginAdvrating_ModuleSeasonrating extends Module
{

	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
	}
	
    protected function getCurrentSeasonId(){
    	return 2;
    }
	
	public function Update($oUser,$iRatingDelta){
		$iSesonId = $this->getCurrentSeasonId();
		$this->oMapper->Update($oUser,$iRatingDelta,$iSesonId);
	}    
    
	public function GetUserRatingList($oUser){
		return $this->oMapper->GetUserRatingList($oUser);
	}
}