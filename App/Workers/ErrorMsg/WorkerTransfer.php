<?php
/**
 * 技术部错误消息转发工人类.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 11:04
 */

namespace App\Workers\ErrorMsg;


use App\Workers\Worker;
use Components\Common\CurlBase;

class WorkerTransfer extends Worker
{
	/**
	 * 技术投递接收的URL
	 * @var string
	 */
	private $transUrl = '';

	/**
	 * 技术部监控相关设定
	 * @var array
	 */
	private $jsb_monitor_config = [];

	/**
	 * 技术部监控站点基本设置
	 * @var array
	 */
	private $site_setting = [];

	/**
	 * 技术部站点简码数组,eg. wzh_pc,wzh_m...
	 * @var array
	 */
	private $site_codes = [];

	/**
	 * WorkerTransfer constructor.
	 * @param string $msg
	 */
	public function __construct($msg)
	{
		parent::__construct($msg);

		$this->_init();
	}

	/**
	 * 初始化错误消息传输的基本信息
	 */
	private function _init(){

		$this->jsb_monitor_config = $jsb_monitor_config = $this->config['jsb_monitor'];

		$this->transUrl = $jsb_monitor_config['url'];

		$this->site_setting =  $jsb_monitor_config['site_setting'];

		$this->site_codes = array_keys($this->site_setting);

	}

	/**
	 * 工人开始工作
	 */
	public function work(){
		try{
			if(! is_string($this->workerMsg) || empty($this->workerMsg))
				$this->throwExecption('Worker receive a bad message or message is empty.', 8011);

			$msgData = json_decode($this->workerMsg, 1);
			if(!is_array($msgData))
				$this->throwExecption('Recived message json_decode false.', 8012);

			//站点简码
			$site_code 	= $msgData['site_code'];
			if(! in_array($site_code, $this->site_codes))
				$this->throwExecption('Site code not match : '. $site_code);

			//监控点配置
			$monitor_config = $this->site_setting[$site_code];

			//todo 需要监控点提供的
			$point_code	= $msgData['point_code'];	//检测点
			$error_code = $msgData['error_code'];	//错误简码
			$is_test	= $msgData['is_test'];		//是否自检信息
			$level		= $msgData['level'];		//错误级别
			$error_msg	= $msgData['error_msg'];	//错误消息

			//请求监控数据
			$monitorData = [
				'point_code'  	=> $point_code,
				'error_code'  	=> $error_code,
				'notice_time' 	=> date('Y-m-d H:i:s'),
				'content'     	=> ['info' => $this->truncateErrorMsg($error_msg)],
				'level'       	=> $level,
				'is_test'     	=> $is_test,
			];

			//curl post
			$curlUrl = sprintf('%s?project_code=%s', $this->transUrl, $monitor_config['project_code']);
			$curlPostData = $this->getCurlPostData($monitorData, $monitor_config['encode'], $monitor_config['token']);
			$resp = CurlBase::curlPost($curlUrl, $curlPostData);

			$rs = json_decode($resp, 1);
			if(false == $rs)
				$this->throwExecption(sprintf('jsb response json_decode exception : %s'), $rs);

			if($rs['code'] != 0)
				$this->throwExecption(sprintf('jsb response : %s', $rs['msg']), $rs['code']);

			printf("[*] worker has been finished ! %s \n", $resp);
		}catch (\Exception $e){
			printf("[error:%d] worker can not finished. error: %s", $e->getCode(), $e->getMessage());
		}

	}


	/**
	 * 截取错误信息字符串，
	 * @param string $errorMsg 错误消息
	 * @param int $length 截取长度
	 *
	 * @return string
	 */
	private function truncateErrorMsg($errorMsg, $length = 1000){
		return mb_strcut($errorMsg, 0, $length);
	}

	/**
	 * 基于监控传递数据，需要做相应的加密处理
	 * @param array $monitorData
	 * @param int $encode
	 * @param string $token
	 *
	 * @return array 处理后curl需要的post数组信息
	 */
	private function getCurlPostData($monitorData, $encode, $token = ''){
		$jsonMonitorData = json_encode($monitorData);

		$postData = [
			'token' 	=> md5($token . $jsonMonitorData),
			'encode'	=> $encode,
			'data'		=> $encode == 1 ? base64_encode($jsonMonitorData) : $jsonMonitorData,
		];

		return $postData;
	}
}