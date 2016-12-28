<?php
	//????
	function pic_replace($value='')
	 {
	 	# code...
	 } 
	// 打印函数
	function p($array){
		dump($array , 1 , "<pre>" , 0);
	}
	/**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
   	function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
	{
		if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
            if (empty($slice)){    
	            $slice = '';
	        }
        }
	    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	    preg_match_all($re[$charset], $str, $match);
	    $slice = join("",array_slice($match[0], $start, $length));
	    return $suffix ? $slice.'...' : $slice;
	}
	/**
	 * 头像组装函数
	 * @param string $path 存储的一个相对地址'./Uploads/...name.jpg' 原格式
	 * @return array $avatar 绝对地址 包含orign small middle large
	 */
	function Ipic($path , $mode = false , $fix = 0)//默认返回绝对地址
	{
		$avatar = array();//空预置数组
		if($mode == false){
			//分解维数组 以点分割
			$path = explode('.', $path);
			// $path[0] null 
			// $path[1]	操作内容
			// $path[2] 后缀
			$div = ($fix == 0)?__ROOT__:'.';//false为绝对 true为相对
			//$div 为源父路径
			$avatar['orign']  = $div.$path[1].'.'.$path[2];//原图
			$avatar['small']  = $div.$path[1].'_30.'.$path[2];//小缩略图
			$avatar['middle'] = $div.$path[1].'_60.'.$path[2];//中缩略图
			$avatar['large']  = $div.$path[1].'_100.'.$path[2];//打缩略图
		}else{
			//分解维数组 以点分割
			$path = explode('/', $path);
			// $path[1] 父级第一 
			$div = null;//false为绝对 true为相对
			$path[1] = '.';
			$path = implode('/', $path);
			$path = ltrim($path,'/');
			//$div 为源父路径
			$avatar = $path;
		}
		
		//返回
		return $avatar;
	}
	/**
	 * 生成不同规格大小的
	 * @param  string $value [description]
	 * @return array        [处理过后的地址]
	 */
	 function to150X100($path)
	{
		$pic = explode('/',$path);//分割为数组
		$thumb = "Thumb/150x100";
		$pic[2] = $thumb;
		$path = implode('/',$pic);
		//返回
		return $path;
	}
	 function to200X250($path)
	{
		$pic = explode('/',$path);//分割为数组
		$thumb = "Thumb/200x250";
		$pic[2] = $thumb;
		$path = implode('/',$pic);
		//返回
		return $path;
	}
	function to260x260($path)
	{
		$pic = explode('/',$path);
		$thumb = "Thumb/260x260";
		$pic[2] = $thumb;
		$path = implode('/',$pic);
		//返回
		return $path;
	}
?>