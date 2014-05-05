<?php

class PluginAdvrating_ActionAdvrating extends ActionPlugin {

	protected $oUserCurrent=null;

	public function Init() {		
		if (!$this->User_IsAuthorization()) {
			return parent::EventNotFound();
		}
		$this->oUserCurrent=$this->User_GetUserCurrent();
		$this->SetDefaultEvent('log');
	}

	protected function RegisterEvent() {
		$this->AddEvent('log','EventLog');
	}

	protected function EventLog() {
		if (!($this->oUserCurrent)){
			return parent::EventNotFound();
		}
		
		$aFilter = array(
			'user_id' => $this->oUserCurrent->getId()
		);
		
		$iPage=$this->_getPage();
		$aResult=$this->PluginAdvrating_Ratinglog_GetRecordByFilter($aFilter,$iPage,Config::Get('rating_log.item_per_page'));
		
		$aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('rating_log.item_per_page'),Config::Get('pagination.pages.count'),Router::GetPath('advrating').$this->sCurrentEvent.'/');
				
		if ($aResult) {
			$this->Viewer_Assign('aPaging',$aPaging);
		}
		
		$this->Viewer_AddHtmlTitle($this->Lang_Get('plugin.advrating.rating_log_title'));
		$this->Viewer_Assign('aLog',$aResult['collection']);
	}

	
    protected function _getPage()
    {
        $iPage = 1;
        foreach ($this->GetParams() as $sParam) {
            if (preg_match('/^page(\d+)?$/i', $sParam, $matches)) {
                if (isset($matches[1])) {
                    $iPage = $matches[1];
                }
            }
        }

        return $iPage;
    }	
	
}
?>
