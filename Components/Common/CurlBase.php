<?php
/**
 * Your file description.
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 12:56
 */

namespace Components\Common;


class CurlBase
{

	/**
	 * 通过curl发送post数据给到服务器
	 * @param string $url
	 * @param array $data
	 * @return mixed
	 *
	 * @throws \Exception
	 */
	public static function curlPost($url = '', $data = []){
		$ch = curl_init($url);
		curl_setopt_array($ch, [
			CURLOPT_HEADER 			=> 0,
			CURLOPT_RETURNTRANSFER 	=> 1,
			CURLOPT_USERAGENT		=> 'Server requset from wzh.',
			CURLOPT_CONNECTTIMEOUT 	=> 120,
			CURLOPT_TIMEOUT			=> 10,
			CURLOPT_POST            => 1,
			CURLOPT_POSTFIELDS     	=> $data,
			CURLOPT_SSL_VERIFYHOST 	=> 0,            // don't verify ssl
			CURLOPT_SSL_VERIFYPEER 	=> 0
		]);

		if(false == ($result = curl_exec($ch))) {
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

}