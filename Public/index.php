<?php
/**
 * 入口文件
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/21
 * @since   2016/11/21 17:02
 */

define('ROOT_PATH', dirname(__DIR__));

require ROOT_PATH.'/vendor/autoload.php';

Class App {

	public function __construct()
	{

	}

	//应用启动
	public function start(){
		var_dump('$argc:', $_SERVER['argc']);
		var_dump('$argv:', $_SERVER['argv']);
	}
}

$app = new App();
$app->start();
