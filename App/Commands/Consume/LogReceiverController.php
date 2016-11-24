<?php
/**
 * 模拟创建日志消息的接收
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/21
 * @since   2016/11/21 19:19
 */

namespace App\Commands\Consume;


use App\Commands\CommandMessage;
use App\Workers\ErrorMsg\WorkerTransfer;

class LogReceiverController extends CommandMessage
{
	/**
	 * @var string 队列名称
	 */
	private $queueName;

	/**
	 * 命令行消息接收
	 */
	public function execute(){
		try{
			switch ($this->msgDeliverType){
				//hello world direct
				case 'simple' : {
					$this->queueName = 'helloQueue';
					$this->OnoToOneReceive();
					break;
				}

				default : {
					$this->throwExecption('Error message deliver type.');
				}
			}
		}catch (\Exception $e){
			throw $e;
		}
	}

	/**
	 * 1对1单点接收消息
	 *
	 * @return  void;
	 */
	public function OnoToOneReceive(){
		try{
			//获取rabbitmq实例
			$rabbitMQ = $this->rabbitMQ;

			//确保队列存在，申明队列
			$rabbitMQ->declareQuque($this->queueName);

			//提示消息
			printf("[*] Waiting for receive message from queue: %s , To exit press CTRL+C \n", $this->queueName);

			//消费消息
			$channel = $rabbitMQ->channel;
			$channel->basic_consume($this->queueName, '', false, true, false, false, [$this, 'msgCallback']);

			//如果设定了通道回调函数，消费进程阻塞，等待消息进入
			while (count($channel->callbacks) > 0){
				$channel->wait();
			}

		}catch (\Exception $e){
			printf("[x:%d] Message received fail: %s", $e->getCode(), $e->getMessage());
		}
	}

	/**
	 * 消息接收的回调处理
	 * @param string $msg
	 */
	public function msgCallback($msg){
		$message = $msg->body;
		//printf("[x] Received : %s \n", $message);

		//do what you want
		$worker = new WorkerTransfer($message);
		$worker->work();
	}


}