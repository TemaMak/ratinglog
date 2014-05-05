<?php

class PluginAdvrating_ModuleRating extends PluginAdvrating_Inherit_ModuleRating
{


 	public function UpdateRatingAndSkill($oUser,$iRatingDelta,$iSkillDelta,$iActionId,$sActionComment){
    	
    	
    	$iRatingNew = $oUser->getRating() + $iRatingDelta;
    	$iSkillNew = $oUser->getSkill() + $iSkillDelta;
    	
    	$oUser->setSkill($iSkillNew);
    	$oUser->setRating($iRatingNew);  
    	
    	$this->User_Update($oUser);
    	$this->PluginAdvrating_Seasonrating_Update($oUser,$iRatingDelta);
    	$this->PluginAdvrating_Ratinglog_SaveLog($oUser,$iRatingDelta,$iSkillDelta,$iActionId,$sActionComment);
    }
    


	public function VoteComment(ModuleUser_EntityUser $oUser, ModuleComment_EntityComment $oComment, $iValue) {
    		/**
    		 * Устанавливаем рейтинг комментария
    		 */
    		$oComment->setRating($oComment->getRating()+$iValue);
    		/**
    		 * Начисляем силу автору коммента, используя логарифмическое распределение
    		 */
    		$skill=$oUser->getSkill();
    		$iMinSize=0.004;
    		$iMaxSize=0.5;
    		$iSizeRange=$iMaxSize-$iMinSize;
    		$iMinCount=log(0+1);
    		$iMaxCount=log(500+1);
    		$iCountRange=$iMaxCount-$iMinCount;
    		if ($iCountRange==0) {
    			$iCountRange=1;
    		}
    		if ($skill>50 and $skill<200) {
    			$skill_new=$skill/70;
    		} elseif ($skill>=200) {
    			$skill_new=$skill/10;
    		} else {
    			$skill_new=$skill/130;
    		}
    		$iDelta=$iMinSize+(log($skill_new+1)-$iMinCount)*($iSizeRange/$iCountRange);
    		/**
    		 * Сохраняем силу
    		 */
    		$oUserComment=$this->User_GetUserById($oComment->getUserId());
    		
    		$iSkillDelta = ($iValue*$iDelta);
    		
    		$sLinkName = $this->Lang_Get('plugin.advrating.action_link_name');
    		$sRatingComment = 
    					$this->Lang_Get('plugin.advrating.action_prefix')
    					.' <a href="'.$oComment->getTarget()->getUrl().'#comment'.$oComment->getId().'">'.$sLinkName['comment'].'</a>';
    		
    		$this->Rating_UpdateRatingAndSkill(
    			$oUserComment,
    			0,
    			$iSkillDelta,
    			'comment',
    			$sRatingComment
    		);    		
    		
    		return $iValue;
    	}

	public function VoteTopic(ModuleUser_EntityUser $oUser, ModuleTopic_EntityTopic $oTopic, $iValue) {
   		$skill=$oUser->getSkill();
    		/**
    		 * Устанавливаем рейтинг топика
    		 */
    		$iDeltaRating=$iValue;
    		if ($skill>=100 and $skill<250) {
    			$iDeltaRating=$iValue*2;
    		} elseif ($skill>=250 and $skill<400) {
    			$iDeltaRating=$iValue*3;
    		} elseif ($skill>=400) {
    			$iDeltaRating=$iValue*4;
    		}
    		$oTopic->setRating($oTopic->getRating()+$iDeltaRating);
    		/**
    		 * Начисляем силу и рейтинг автору топика, используя логарифмическое распределение
    		 */
    		$iMinSize=0.1;
    		$iMaxSize=8;
    		$iSizeRange=$iMaxSize-$iMinSize;
    		$iMinCount=log(0+1);
    		$iMaxCount=log(500+1);
    		$iCountRange=$iMaxCount-$iMinCount;
    		if ($iCountRange==0) {
    			$iCountRange=1;
    		}
    		if ($skill>50 and $skill<200) {
    			$skill_new=$skill/70;
    		} elseif ($skill>=200) {
    			$skill_new=$skill/10;
    		} else {
    			$skill_new=$skill/100;
    		}
    		$iDelta=$iMinSize+(log($skill_new+1)-$iMinCount)*($iSizeRange/$iCountRange);
    		/**
    		 * Сохраняем силу и рейтинг
    		 */
    		$oUserTopic=$this->User_GetUserById($oTopic->getUserId());    		
    		$iSkillDelta = $iValue*$iDelta;
			$iRatingDelta = $iValue*$iDelta/2.73;
    		
    		$sLinkName = $this->Lang_Get('plugin.advrating.action_link_name');
    		$sRatingComment = 
    					$this->Lang_Get('plugin.advrating.action_prefix')
    					.' <a href="'.$oTopic->getUrl().'">'.$sLinkName['topic'].'</a>';
    		
    		$this->Rating_UpdateRatingAndSkill(
    			$oUserTopic,
    			$iRatingDelta,
    			$iSkillDelta,
    			'topic',
    			$sRatingComment
    		);  
    		
    		
    		return $iDeltaRating;
    	}

    	
 
    	public function VoteUser(ModuleUser_EntityUser $oUser, ModuleUser_EntityUser $oUserTarget, $iValue) {
    		/**
    		 * Начисляем силу и рейтинг юзеру, используя логарифмическое распределение
    		 */
    		$skill=$oUser->getSkill();
    		$iMinSize=0.42;
    		$iMaxSize=3.2;
    		$iSizeRange=$iMaxSize-$iMinSize;
    		$iMinCount=log(0+1);
    		$iMaxCount=log(500+1);
    		$iCountRange=$iMaxCount-$iMinCount;
    		if ($iCountRange==0) {
    			$iCountRange=1;
    		}
    		if ($skill>50 and $skill<200) {
    			$skill_new=$skill/40;
    		} elseif ($skill>=200) {
    			$skill_new=$skill/2;
    		} else {
    			$skill_new=$skill/70;
    		}
    		$iDelta=$iMinSize+(log($skill_new+1)-$iMinCount)*($iSizeRange/$iCountRange);
    		/**
    		 * Определяем новый рейтинг
    		 */
    		
			$iRatingDelta = $iValue*$iDelta;
    		
    		$sLinkName = $this->Lang_Get('plugin.advrating.action_link_name');
    		$sRatingComment = 
    					$this->Lang_Get('plugin.advrating.action_prefix')
    					.' <a href="'.Router::GetPath('profile').$oUserTarget->getLogin().'">'.$sLinkName['user'].'</a>';
    		
    		$this->Rating_UpdateRatingAndSkill(
    			$oUserTarget,
    			$iRatingDelta,
    			0,
    			'user',
    			$sRatingComment
    		);     		
    		
    		return $iValue*$iDelta;
    	}

    
    
}
