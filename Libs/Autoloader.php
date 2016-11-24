<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 14:39
 */

namespace Libs;


class AutoLoader
{
	private static function loader($className){
		$className = str_replace('\\','/', $className);
		$classFile = ROOT_PATH. '/'.$className.'.php';
		if(is_file($classFile) && !class_exists($className))
			include $classFile;
	}

	public static function register(){
		spl_autoload_register([self::class, 'loader']);
	}
}