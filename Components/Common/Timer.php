<?php
/**
 * 计时器
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/23
 * @since   2016/11/23 14:34
 */

namespace Components\Common;


class Timer
{

	/**
	 * 精度到秒
	 */
	const PRECISION_SECOND = 0;

	/**
	 * 精度到毫秒
	 */
	const PRECISION_MILLISECOND = 1;

	/**
	 * 精度到微妙
	 */
	const PRECISION_MICROSECOND = 2;

	/**
	 * 计时器开始时间
	 * @var float
	 */
	private $start;

	/**
	 * 计时器结束时间
	 * @var float
	 */
	private $end;

	/**
	 * Timer constructor.
	 */
	public function __construct(){
		$this->start = null;
		$this->end = null;
	}

	/**
	 * 计时器开始计时
	 */
	public function start(){
		$this->start = microtime(true);
		$this->end = null;
	}

	/**
	 * 计时器结束计时
	 */
	public function end(){
		$this->end = microtime(true);
	}

	/**
	 *
	 * @param int $precision	计时精度（0|1|2）
	 * @param int $floatingPrecision 计时精度浮点保留位数(默认0位)
	 * @param bool $showUnit 	是否展示单位
	 * @return float|string
	 */
	public function getExpendTime($precision = self::PRECISION_SECOND, $floatingPrecision = 0, $showUnit = true){

		$test = is_int($precision) && $precision >= self::PRECISION_SECOND && $precision <= self::PRECISION_MICROSECOND &&
			is_float($this->start) && is_float($this->end) && $this->start <= $this->end &&
			is_int($floatingPrecision) && $floatingPrecision >= 0 &&
			is_bool($showUnit);

		if($test){
			$duration = round(($this->end - $this->start) * 10 ** ($precision * 3), $floatingPrecision);

			if($showUnit)
				return $duration.' '.self::getUnit($precision);
			else
				return $duration;
		}else{
			return 'Can\'t return the render time';
		}
	}

	private static function getUnit($precision){
		switch($precision){
			case self::PRECISION_SECOND :
				return 's';
			case self::PRECISION_MILLISECOND :
				return 'ms';
			case self::PRECISION_MICROSECOND :
				return '?s';
			default :
				return '(no unit)';
		}
	}
}