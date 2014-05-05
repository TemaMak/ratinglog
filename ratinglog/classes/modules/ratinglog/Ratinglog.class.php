<?php 
class PluginRatinglog_ModuleRatinglog extends Module
{

	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
	}
	
	public function SaveLog($oUser,$iRatingDelta,$iSkillDelta,$sActionId,$sActionComment){
		$this->oMapper->SaveLog($oUser,$iRatingDelta,$iSkillDelta,$sActionId,$sActionComment);
	}
	
	function GetRecordByFilter($aFilter,$iCurrPage,$iPerPage){
		
    	$data = array(
    		'collection' => $this->oMapper->GetRecordByFilter($aFilter,$iCurrPage,$iPerPage,$rCount),
    		'count' => $rCount
    	);
    	
   		return $data; 		
	}	
	
}