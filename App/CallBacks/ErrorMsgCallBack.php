<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 14:14
 */

namespace App\CallBack;


use App\Workers\ErrorMsg\WorkerTransfer;

class ErrorMsgCallBack
{
	
	
	public static function callMe($msg){
		$worker = new WorkerTransfer();	
	}
}