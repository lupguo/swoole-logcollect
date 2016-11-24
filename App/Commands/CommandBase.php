<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 19:13
 */

namespace App\Commands;


use App\App;
use Libs\MQueue\RabbitMQ;
use Libs\Traits\ErrorHandle;

class CommandBase
{
	use ErrorHandle;

	/**
	 * @var RabbitMQ
	 */
	public $rabbitMQ;

	/**
	 * @var App
	 */
	public $app;

	/**
	 * 命令行参数
	 * @var array 命令行参数
	 */
	protected $cmdParams = [];

	/**
	 *
	 * CommandBase constructor.
	 * @param array $cmdParams
	 */
	public function __construct($cmdParams)
	{
		//app
		$this->app = App::Sington();

		//cmd params
		$this->cmdParams = $cmdParams;

		//rabbitmq
		$rbmqConfig = $this->app->config['rabbitmq'];
		$this->rabbitMQ = new RabbitMQ(
			$rbmqConfig['host'],
			$rbmqConfig['port'],
			$rbmqConfig['user'],
			$rbmqConfig['pass'],
			$rbmqConfig['vhost']
		);
	}

}