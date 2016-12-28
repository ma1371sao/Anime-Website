<?php 
/**
 * 格式化时间
 * @param  [type] $time [description]
 * @return [type]       [description]
 */
function time_format($time){
	// 当前时间
	$now = time();
	// 今天计时几分几秒
	$today = strtotime(date('y-m-d',$now));
	// 与现在相差
	$diff = $now - $time;
	$str  = '';
	switch( $time ){
		case $diff < 60:
			$str = $diff.'秒前';
			break;
		case $diff < 3600:
			$str = floor($diff/60).'分钟前';
			break;
		case $diff < (3600*8):
			$str = floor($diff/3600).'小时前';
			break;
		case $time > $today:
			$str = '今天'.date('H:i',$time);
			break;
		default:
			$str = date('Y-m-d H:i:s' , $time);
	}
	return $str;
}
/**
 * 数字转换成周几
 * @param  [type] $int [description]
 * @return [type]      [description]
 */
function int_to_date($int){
	$str = '';
	switch( $int ){
		case 1:
			$str = '周一';
			break;
		case 2:
			$str = '周二';
			break;
		case 3:
			$str = '周三';
			break;
		case 4:
			$str = '周四';
			break;
		case 5:
			$str = '周五';
			break;
		case 6:
			$str = '周六';
			break;
		case 7:
			$str = '周日';
			break;
		default:
			$str = '今天';
	}
	return $str;
}
?>