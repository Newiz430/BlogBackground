<?php
// /vendor/Page.php

namespace vendor;

//分页处理工具
class Page{
	//生成分页字符串方法
	public static function clickPage(string $url, int $counts, int $pagecount = 5, int $page = 1, array $cond = array()){
		$pages = ceil($counts / $pagecount); //总页数
		$prev = $page > 1 ? $page - 1 : 1; //最小的“第一页”
		$next = $page < $pages ? $page + 1 : $pages; //最大的“最后一页”
		$pathinfo = '';
		foreach ($cond as $key => $value) {
			$pathinfo .= $key . '=' . $value . '&'; //组织分页数字的路径
		}
		$click = "<li><a href='{$url}?{$pathinfo}page={$prev}'>上一页</a></li>"; //最左侧的上一页功能
		if($pages <= 7){ //页码小于等于7页时
			for($i = 1; $i <= $pages; $i++){
				$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
			}
		}else{ //页码大于7页时
			if($page <= 5){ //页码<=5，顺序显示前7页
				for($i = 1; $i <= 7; $i++){
					$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
				}
				$click .= "<li><a href='#'>...</a></li>";
			}else{ //页码>5，显示1、2两页以及中间的“...”
				$click .= "<li><a href='{$url}?{$pathinfo}page=1'>1</a></li>";
				$click .= "<li><a href='{$url}?{$pathinfo}page=2'>2</a></li>";
				$click .= "<li><a href='#'>...</a></li>";
				if($pages - $page <= 3){ //判断是否为最后3页，若是则不需要“...”省略
					for($i = $pages - 4; $i <= $pages; $i++){
						$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
					}
				}else{ //不是最后3页，后面页的也需要省略
					for($i = $pages - 2; $i <= $pages + 2; $i++){
						$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
					}
					$click .= "<li><a href='#'>...</a></li>";
				}
			}
		}
		$click .= "<li><a href='{$url}?{$pathinfo}page={$next}'>下一页</a></li>"; //最右侧的下一页功能
		return $click;
	}
}