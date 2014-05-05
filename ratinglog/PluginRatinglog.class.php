<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginRatinglog extends Plugin {

    public $aInherits = array(

        'module' => array(
            'ModuleRating' => '_ModuleRating',
        ),
    );

    public function Activate() {  	
    	if (!$this->isTableExists('prefix_rating_log')) {
    		$resutls = $this->ExportSQL(dirname(__FILE__) . '/activate.sql');
    		return $resutls['result'];
    	}    	
        return true;
    }

    public function Deactivate(){

    	return true;
    }


    public function Init() {
		$this->Viewer_AppendStyle(Plugin::GetTemplatePath(__CLASS__)."/css/style.css");
    }
}
?>
