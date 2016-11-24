<?php
/**
 * 错误的相关traits
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/14
 * @since   2016/11/14 15:40
 */

namespace Libs\Traits;

trait ErrorHandle
{
	/**
	 * 处理错误
	 * @param $msg
	 */
	public function handleError($msg = ''){
		if (php_sapi_name() == 'cli'){
			exit($msg);
		}else{
			trigger_error($msg, E_USER_ERROR);
		}
	}

	/**
	 * 错误处理 - 抛出异常实例
	 * @param string $errorMsg 	错误消息
	 * @param int $errorCode	错误代码
	 * @throws \Exception		错误实例
	 */
	public function throwExecption($errorMsg, $errorCode = 1){
		$errorMsg = (string)$errorMsg;
		throw new \Exception($errorMsg, $errorCode);
	}
}