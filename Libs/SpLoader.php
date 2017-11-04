<?php
/**
 * 单例载入|获取
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 14:45
 */

namespace Libs;


class SpLoader
{
	/**
	 * 类实例装载池
	 * @var array
	 */
	private $loadedPools = [];

	/**
	 * 以参数、类名来装载一个实例到App应用中
	 * @param string $className 类名
	 * @param mixed $params 实例化的参数
	 */
	public static function loadClass($className, $params=[]){

		$args = func_get_args();

	}

	public static function getClass($className){

	}
}