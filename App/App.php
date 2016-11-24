<?php
/**
 * 应用实例
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 15:09
 */

namespace App;

use Libs\Traits\ErrorHandle;

class App
{
	use ErrorHandle;
	/**
	 * @var App
	 */
	private static $sington;

	/**
	 * 应用相关配置
	 * @var array
	 */
	public $config;

	/**
	 * @var string
	 */
	public $cmdstr;

	/**
	 * 禁止直接new方式实例化app
	 * App constructor.
	 */
	private function __construct(){}

	/**
	 * @return App 单例
	 */
	public static function Sington(){
		if(!self::$sington instanceof self){
			self::$sington = new self();
		}
		return self::$sington;
	}

	/**
	 * 设置App相关配置
	 * @param array $config
	 * @return $this
	 */
	public function setConfig($config = []){
		$this->config = $config;
		return $this;
	}

	/**
	 * 应用点火
	 */
	public function fire(){
		if(php_sapi_name() == 'cli'){
			$this->command();
		}else{
			exit('Bad request mode.');
		}
	}

	/**
	 * do command
	 */
	protected function command(){
		try{
			$argc = $_SERVER['argc'];
			$argv = $_SERVER['argv'];

			//未加命令
			if($argc < 3)
				$this->throwExecption("Usage: php index.php command mq_type [param1 [param2...]]", 1011);

			//依据command做相应的处理
			$this->cmdstr = $cmd = $argv[1];
			$params	= array_slice($argv, 2);
			$configCmds = $this->config['command'];

			//command help
			if(in_array($cmd, ['-h','--help']) || false == array_key_exists($cmd, $configCmds)){
				$cmdExp = join(' | ', array_keys($configCmds));
				$this->throwExecption("Usage php index.php $cmdExp [param1 [param2...]]", 1012);
			}

			//check command class
			if (! isset($configCmds[$cmd]['className']) || ! class_exists($configCmds[$cmd]['className']))
				$this->throwExecption("Related command class can not be found.", 1013);

			//创建对应的cmd实例 & 执行execute命令
			$cmdClass 	= new \ReflectionClass($configCmds[$cmd]['className']);
			$cmdInstance= $cmdClass->newInstanceArgs([$params]);
			$cmdInstance->execute();

		}catch (\Exception $e){
			printf("[X: %d] command execute fail. %s\n", $e->getCode(), $e->getMessage());
		}
	}
}