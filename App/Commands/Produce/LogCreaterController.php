<?php
/**
 * 模拟创建产生日志消息
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/21
 * @since   2016/11/21 19:21
 */

namespace App\Commands\Produce;

use App\Commands\CommandMessage;

class LogCreaterController extends CommandMessage
{
	/**
	 * @var string 队列名称
	 */
	private $queueName;

	/**
	 * 命令行消息投递
	 */
	public function execute(){
		try{
			$msgStr = join('|', $this->cmdParams);

			switch ($this->msgDeliverType){
				//type1: simple message deliver : hello world direct
				case 'simple' : {
					$this->queueName = 'helloQueue';
					$this->oneToOnePublish($msgStr);
					break;
				}

				//type2: 

				default : {
					$this->throwExecption('Error message deliver type.');
				}
			}
		}catch (\Exception $e){
			throw $e;
		}
	}

	/**
	 * 执行消息创建命令 - 一个生产者 vs 一个消费者
	 * @param string $msgStr
	 */
	private function oneToOnePublish($msgStr){
		try{
			if(empty($msgStr) || !is_string($msgStr))
				$this->throwExecption('Have no cmd string message or rabbitmq message not be string !!', 3521);

			//todo write mq
			$rabbitMQ = $this->rabbitMQ;

			//申明队列
			$rabbitMQ->declareQuque($this->queueName);

			//创建队列消息
			$msg = $rabbitMQ->createMsg($msgStr);

			//发布消息
			$rabbitMQ->publishMsg($msg, '', $this->queueName);

			echo "[x] Create message success. \n";
		}catch (\Exception $e){
			printf("[x:%d] Create message fail. %s\n", $e->getCode(), $e->getMessage());
		}

	}
}