--
-- SQL, которые надо выполнить движку при деактивации плагина админом. Вызывается на исполнение ВРУЧНУЮ в /plugins/PluginXxxxx.class.php в методе Deactivate()
-- Например:

DROP TABLE IF EXISTS event_params;
