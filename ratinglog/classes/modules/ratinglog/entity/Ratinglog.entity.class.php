<?php

class PluginRatinglog_ModuleRatinglog_EntityRatinglog extends Entity
{
	
     public function getSkillDeltaValue($iPrecision =0 ){
     	if ($iPrecision > 0){
     		return round($this->_aData['skill_delta_value'],$iPrecision);
     	} else {
     		return $this->_aData['skill_delta_value'];
     	}
     	
     }
     
     public function getSkillDirection(){
     	if ($this->_aData['skill_delta_value'] == 0){
     		return 'zero';
     	}
     	
		if ($this->_aData['skill_delta_value'] > 0){
     		return 'positiv';
     	} 

     	return 'negativ';
     }
    
     public function getRatingDeltaValue($iPrecision =0 ){
     	if ($iPrecision > 0){
     		return round($this->_aData['rating_delta_value'],$iPrecision);
     	} else {
     		return $this->_aData['rating_delta_value'];
     	}
     	
     }
     
     public function getRatingDirection(){
     	if ($this->_aData['rating_delta_value'] == 0){
     		return 'zero';
     	}
     	
		if ($this->_aData['rating_delta_value'] > 0){
     		return 'positiv';
     	} 

     	return 'negativ';
     }     
     
}

?>

