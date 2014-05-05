<?php

class PluginAdvrating_ModuleSeasonrating_MapperSeasonrating extends Mapper
{

	public function Update($oUser,$iRatingDelta,$iSesonId){
				$sql = "INSERT INTO 
							".Config::Get('db.table.season_rating')."
						VALUES (?d,?d,?f)
						ON DUPLICATE KEY UPDATE
							value = value + ?f
				";
				
		return ($iId=$this->oDb->query(
				$sql,
				$iSesonId,
				$oUser->getId(),
				$iRatingDelta,
				$iRatingDelta
			));				
				
	}
	
	public function GetUserRatingList($oUser){
		$sql = "SELECT
					sr.*,
					s.name 
				FROM ".Config::Get('db.table.season_rating')." sr
				JOIN ".Config::Get('db.table.seasons')." s ON sr.season_id = s.id
				WHERE sr.user_id = ?d
		";
				
		$aResult=array();
		$iCount=0;
		$aRows=$this->oDb->select($sql,$oUser->getId());
			
		foreach ($aRows as $aRow) {
			$aResult[]=Engine::GetEntity('PluginAdvrating_Seasonrating_Seasonrating',$aRow);
		}
		
		return $aResult;				
				
	}	
	
}

?>
