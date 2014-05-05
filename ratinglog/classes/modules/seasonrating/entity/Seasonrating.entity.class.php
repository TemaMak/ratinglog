<?php

class PluginAdvrating_ModuleSeasonrating_EntitySeasonrating extends Entity
{
     public function getValue($iPrecision =0 ){
     	if ($iPrecision > 0){
     		return round($this->_aData['value'],$iPrecision);
     	} else {
     		return $this->_aData['value'];
     	}
     	
     }	
  
}

?>