<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 14:03
 */

namespace App;

use Libs\AutoLoader;

require ROOT_PATH. '/vendor/autoload.php';
require ROOT_PATH. '/Libs/Autoloader.php';

class Bootstrap
{
	public function __construct()
	{
		AutoLoader::register();
	}

	/**
	 * boot app
	 */
	public function boot(){
		//应用配置
		$config = require_once ROOT_PATH. '/Config/app.php';

		//启动应用
		App::Sington()->setConfig($config)->fire();
	}
}