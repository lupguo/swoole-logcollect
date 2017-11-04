<?php
/**
 * 命令相关配置文件.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/22
 * @since   2016/11/22 14:18
 */

return [
	'command' => [
		//转发错误数据消息到技术部
		'transmitErrorMsgToJsb' => [
			'className'	=> 'App\\Commands\\Consume\\TransmitErrorMsgToJsb',
			'worker' 	=> 5, //同时开启多少个消费者进程
		],

		//消息接收
		'receiveMsg' => [
			'className' => 'App\\Commands\\Consume\\LogReceiverController',
			'worker' 	=> 5,
		],

		//模拟消息生成
		'createMsg'	=> [
			'className'	=> 'App\\Commands\\Produce\\LogCreaterController',
			'worker'	=> 5,
		],
	]
];