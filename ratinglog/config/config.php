<?php
/**
 * Конфиг
 */

$config = array();
Config::Set('router.page.advrating', 'PluginAdvrating_ActionAdvrating');

Config::Set('db.table.rating_log','___db.table.prefix___rating_log');
Config::Set('db.table.season_rating','___db.table.prefix___seasons_rating');
Config::Set('db.table.seasons','___db.table.prefix___seasons');

Config::Set('rating_log.item_per_page',30);

return $config;