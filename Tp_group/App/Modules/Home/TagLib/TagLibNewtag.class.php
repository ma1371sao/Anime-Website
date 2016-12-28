<?php
	/**
	* 自定义标签库
	*/
	class TagLibNewtag extends TagLib{
		
		protected $tags =array(
			'nav' => array('attr' => 'limit,order' ,'close' => 1 )//attr属性 close 是否闭合
 			);
		/**
		 * nav标签方法
		 * @param  string $attr    属性
		 * @param  [type] $content 快标签内容
		 * @return [type]          [description]
		 */
		public function _nav($attr , $content)//函数形式:_新标签名(参数集)
		{
			// 分析标签的标签定义
			$attr  = $this->parseXmlAttr($attr,'nav');
			// 返回数组
			$limit = $attr['limit'];
			$order = $attr['order'];
			// 情尽量避免变量重名
			// $url 地址
			$str = <<<str
			<?php
				\$nav_cate = M('cate')->order("$order")->select();
				import("ExtendClass.Category",APP_PATH);
				\$nav_cate = Category::unlimitedForLayer( \$nav_cate );
				foreach (\$nav_cate as \$nav_v) :
					extract(\$nav_v);
					\$url = U('/l/'.\$id);
			?>
str;
			$str .= $content;
			$str .=	'<?php endforeach; ?>';
			// 返回组合数组
			return $str;
		}
}?>