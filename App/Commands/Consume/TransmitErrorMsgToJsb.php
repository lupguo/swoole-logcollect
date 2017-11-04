<?php
/**
 * 错误消息
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 14:45
 */

namespace App\Commands\Consume;


use App\Commands\CommandBase;

class TransmitErrorMsgToJsb extends CommandBase
{
	public function execute($params){
		//连到mq，开启指定参数的消费者进程，进行消费
		echo 'transmit.';

	}
}