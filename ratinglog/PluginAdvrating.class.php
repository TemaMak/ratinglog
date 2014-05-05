<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginAdvrating extends Plugin {

    // Объявление делегирований (нужны для того, чтобы назначить свои экшны и шаблоны)
    public $aDelegates = array(
            /**
             * 'action' => array('ActionIndex'=>'_ActionSomepage'),
             * Замена экшна ActionIndex на ActionSomepage из папки плагина
             *
             * 'template' => array('index.tpl'=>'_my_plugin_index.tpl'),
             * Замена index.tpl из корня скина файлом /plugins/abcplugin/templates/skin/default/my_plugin_index.tpl
             *
             * 'template'=>array('actions/ActionIndex/index.tpl'=>'_actions/ActionTest/index.tpl'),
             * Замена index.tpl из скина из папки actions/ActionIndex/ файлом /plugins/abcplugin/templates/skin/default/actions/ActionTest/index.tpl
             */
		'template' => array(

    	),

    );

    public $aInherits = array(

        'module' => array(
            'ModuleRating' => '_ModuleRating',
        	//'ModuleTopic' => '_ModuleTopic'
        ),
    );

    // Активация плагина
    public function Activate() {
        $this->addEnumType(Config::Get('db.table.topic'),'topic_type','event');    	
        return true;
    }

    // Деактивация плагина
    public function Deactivate(){

    	return true;
    }


    // Инициализация плагина
    public function Init() {
		$this->Viewer_AppendStyle(Plugin::GetTemplatePath(__CLASS__)."/css/style.css");
    }
}
?>
