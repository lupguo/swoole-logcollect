<?php
/**
 * 应用配置
 * 
 * @author  Terry (http://52explore.com)
 * @date    2016/11/21
 * @since   2016/11/21 17:50
 */

return array_merge(
	require_once 'command.php',
	require_once 'rabbmitmq.php',
	require_once 'swoole.php',
	require_once 'jsb_monitor.php'
);