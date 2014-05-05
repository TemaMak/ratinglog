<?php

class PluginAdvrating_ModuleRatinglog_MapperRatinglog extends Mapper
{


	public function SaveLog($oUser,$iRatingDelta,$iSkillDelta,$sActionId,$sActionComment) {
		$sql = "INSERT INTO ".Config::Get('db.table.rating_log')." 
			(
			user_id,
			add_date,
			rating_delta_value,	
			skill_delta_value,
			comment,
			action_id
			)
			VALUES(?d,NOW(),?f,?f,?,?)
		";
				
		return ($iId=$this->oDb->query(
				$sql,
				$oUser->getId(),
				$iRatingDelta,
				$iSkillDelta,
				$sActionComment,
				$sActionId
			));
	}

	public function GetRecordByFilter($aFilter,$iCurrPage,$iPerPage,&$iCount){
		$sql = "SELECT
					*
				FROM
					".Config::Get('db.table.rating_log')."
				WHERE
					1 = 1
					{ AND user_id = ? }
				ORDER BY id DESC
				LIMIT ?d, ?d ;
		";
		
		$aResult=array();
		$iCount=0;
		if ($aRows=$this->oDb->selectPage($iCount,$sql,
				isset($aFilter['user_id']) ? $aFilter['user_id'] : DBSIMPLE_SKIP,
				($iCurrPage-1)*$iPerPage, $iPerPage
		)) {
			foreach ($aRows as $aRow) {
				$aResult[]=Engine::GetEntity('PluginAdvrating_Ratinglog_Ratinglog',$aRow);
			}
		}
		return $aResult;		
	}

	
}

?>
