<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 16:46
 */

namespace Libs\MQueue;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQ
{
	/**
	 * @var AMQPStreamConnection
	 */
	private $conn;

	/**
	 * 通道
	 * @var AMQPChannel
	 */
	public $channel;

	/**
	 * RabbitMQ 初始化.
	 * @param string $host	主机
	 * @param int $port	rabbitmq 端口
	 * @param string $user	rabbitmq 用户
	 * @param string $pass	rabbitmq 密码
	 * @param string $vhost rabbitmq 虚拟机
	 */
	public function __construct($host, $port, $user, $pass, $vhost='/')
	{
		$this->connect($host, $port, $user, $pass, $vhost);

		//通道
		$this->channel = $this->conn->channel();
	}

	/**
	 * 创建连接
	 *
	 * @param string $host	主机
	 * @param int $port	rabbitmq 端口
	 * @param string $user	rabbitmq 用户
	 * @param string $pass	rabbitmq 密码
	 * @param string $vhost rabbitmq 虚拟机
	 */
	public function connect($host, $port, $user, $pass, $vhost){
		$this->conn = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
	}

	/**
	 * 队列申明
	 * @param string $queue
	 * @param bool $passive
	 * @param bool $durable
	 * @param bool $exclusive
	 * @param bool $auto_delete
	 * @param bool $nowait
	 * @param null $arguments
	 * @param null $ticket
	 *
	 * @return mixed|null
	 */
	public function declareQuque(
		$queue = '',
		$passive = false,
		$durable = false,
		$exclusive = false,
		$auto_delete = true,
		$nowait = false,
		$arguments = null,
		$ticket = null
	){
		return $this->channel->queue_declare(
			$queue,
			$passive,
			$durable,
			$exclusive,
			$auto_delete,
			$nowait,
			$arguments,
			$ticket
		);
	}

	/**
	 * 创建消息
	 * @param $body
	 * @param array $properties
	 *
	 * @return false|AMQPMessage
	 */
	public function createMsg($body, $properties = []){
		if(!is_string($body))
			trigger_error('RabbitMQ message body must be string!');

		return new AMQPMessage($body, $properties);
	}

	/**
	 * 发布消息
	 *
	 * @param $msg AMQPMessage
	 * @param string $exchange
	 * @param string $routing_key
	 * @param bool $mandatory
	 * @param bool $immediate
	 * @param null $ticket
	 */
	public function publishMsg(
		$msg,
		$exchange = '',
		$routing_key = '',
		$mandatory = false,
		$immediate = false,
		$ticket = null
	){

		$this->channel->basic_publish(
			$msg,
			$exchange,
			$routing_key,
			$mandatory,
			$immediate,
			$ticket
		);
	}


	public function __destruct()
	{
		$this->channel->close();
		$this->conn->close();
	}

}