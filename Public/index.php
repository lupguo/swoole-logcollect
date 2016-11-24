<?php
/**
 * 入口文件
 *
 * @author  Terry (http://52explore.com)
 * @date    2016/11/21
 * @since   2016/11/21 17:02
 */

define('ROOT_PATH', dirname(__DIR__));

require ROOT_PATH. '/App/Bootstrap.php';

$bootstrap = new \App\Bootstrap();
$bootstrap->boot();
