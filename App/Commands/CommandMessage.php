<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 10:10
 */

namespace App\Commands;


class CommandMessage extends CommandBase
{
	/**
	 * 命令行下，消息投递和接收的类型，紧跟cmd后的一个参数
	 * @var string
	 */
	protected $msgDeliverType = '';

	/**
	 * 命令行消息初始化
	 * @param array $cmdParams
	 */
	public function __construct($cmdParams)
	{
		parent::__construct($cmdParams);

		//解析命令行相关参数
		$this->messageCmdExplain();
	}

	/**
	 * 命令行下，相关消息命令参数分析
	 */
	private function messageCmdExplain(){
		$this->msgDeliverType = array_shift($this->cmdParams);

		$this->cmdParams = $this->cmdParams;
	}


}