<?php
/**
 * 技术部相关监控设定
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 11:34
 */

return [
	'jsb_monitor' => [

		//测试
		'url' => 'http://rms110.com.trunk.s1cg.egomsl.com/api-source',
//		'url' => 'http://www.rms110.com/api-source',

		//相关请求参数
		'site_setting'	=> [

			'wzh_pc' => [
				'project_code' 	=> 'wzhouhui_pc',
				'token'			=> 'KffHxrZyvASCkzqWd6Ra',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
					'WFZ82502',
				],
			],

			'wzh_m' => [
				'project_code' 	=> 'wzhouhui_wap',
				'token'			=> 'RjXJ6b7k1GadqM1Igg4v',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
					'WFZ82502',
				],
			],

			'wzh_app' => [
				'project_code' 	=> 'wzhouhui_app',
				'token'			=> 'zLUxGkiDbYiK2PjhIoPh',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
					'WFZ82502',
					
				],
			],

			'wzc_fx' => [
				'project_code' 	=> 'wzhouchain_pc',
				'token'			=> 'pFwJut9jBavFY7TAU5iG',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
				],
			],

			'wzc_hyb' => [
				'project_code' 	=> 'wzhouchain_app',
				'token'			=> 'QQWpx3lf4zD9Tu2kZrPv',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
				],
			],

			'wzh_oms' => [
				'project_code' 	=> 'htao_oms',
				'token'			=> 'FCxMvtcIST4hQ1wQWwzi',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
					'WFZ82502',
				],
			],

			'wzh_wms' => [
				'project_code' 	=> 'htao_wms',
				'token'			=> 'J8UywXGeZS6vESsW4fan',
				'encode'		=> 1,
				'point_code'	=> [
					'WFZ25228',
					'WFZ24418',
				],
			],
		],

	],
];