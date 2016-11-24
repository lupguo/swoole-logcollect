<?php
/**
 * 工人基类
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 13:00
 */

namespace App\Workers;


use App\App;
use Libs\Traits\ErrorHandle;

class Worker
{
	use ErrorHandle;
	/**
	 * 应用相关配置
	 * @var array
	 */
	protected $config;

	/**
	 * App应用
	 * @var App
	 */
	protected $app;

	/**
	 * 开工的消息
	 * @var string
	 */
	protected $workerMsg;

	/**
	 * Worker constructor.
	 * @param string 消息
	 */
	public function __construct($msg)
	{
		$this->app = App::Sington();

		$this->config = $this->app->config;

		$this->workerMsg = $msg;
	}


	protected function workStartTime(){

	}

	protected function workFinishTime(){

	}
}