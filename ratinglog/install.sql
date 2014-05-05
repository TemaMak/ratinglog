--
-- SQL, которые надо выполнить движку при активации плагина админом. Вызывается на исполнение ВРУЧНУЮ в /plugins/PluginAbcplugin.class.php в методе Activate()
-- Например:

CREATE TABLE IF NOT EXISTS prefix_event_params(
  event_id BIGINT(20) NOT NULL,
  date_start DATE DEFAULT NULL,
  date_stop DATE DEFAULT NULL,
  event_avatar TEXT DEFAULT NULL,
  PRIMARY KEY (event_id)
)
ENGINE = INNODB  DEFAULT CHARSET=utf8