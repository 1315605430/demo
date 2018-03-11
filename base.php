<?php

date_default_timezone_set("PRC") ;

class Base{
	
	//const id="466437857@qq.com";//支付宝交易账号
	const PID="2088802299619848";//合作id
	const KEY="i3iqcbr5ts3qi1jvtj879tiemtej9p4x";//密钥
	const RETURN_URL="http://149.jnqej.com/return.php";//异步地址
	const NOTIFY_URL="http://149.jnqej.com/notify.php";//同步地址
	const PAYURL="https://mapi.alipay.com/gateway.do";//支付网关
	const CHECKURL="https://mapi.alipay.com/gateway.do?service=notify_verify";//验证验证是否是支付宝发来的通知
	
	
	
	public function getstr($arr=array()){//配置排序    筛选
		
		if(isset($arr['sign'])){unset($arr['sign']);}//删除签名
		
		if(isset($arr['sign_type'])){unset($arr['sign_type']);}//删除前面类型
		
		ksort($arr);//引用类型排序,对数组键值ascii排序
		
		return $this->geturl($arr,true);//
	}
	
	
	public function geturl($arr=array(),$encode=false){  //拼接
		
		if($encode)
		{
		return urldecode(http_build_query($arr));//默认是转义字符串中的中文，但是加密时候不能让中文转义
		}
		else
		{
		return http_build_query($arr);	//直接请求支付宝地址时需要将字符串中的中文转义
		}
	}
	
	
	public function getsign($arr=array()){   //md5生成
		
		
		
        //生成签名 排序传入的参数之后组成参数字符串+秘钥 之后md5加密生成签名


		return md5($this->getstr($arr).self::KEY);
		
		
    }
	
	
	
	public function checksign($arr){
		//验证签名
		
		//将支付宝发过来的全部数据过滤签名和签名方式，用其他的参数组成签名 再和支付宝发过来的签名比较判断
		
		
		return $arr['sign']==$this->getsign($arr)?true:false;
	}
	
	
	
	
	public function logs($file,$data){
		//记录日志    文件名   记录内容
		
		file_put_contents($file,$data.PHP_EOL,FILE_APPEND);//防止覆盖追加内容
		
	}
	public function isalipay($arr){//验证 是否是来自支付宝的数据
		
		return file_get_contents(self::CHECKURL."&partner=".self::PID."&notify_id=".$arr['notify_id'])=="true"?true:false;
	
	}
	public  function check_order_statue($arr){//验证订单状态
		
		/*
		trade_status
		交易状态
		String
		交易目前所处的状态。成功状态的值只有两个：
		TRADE_FINISHED（普通即时到账的交易成功状态）；
		TRADE_SUCCESS（开通了高级即时到账或机票分销产品后的交易成功状态）
		可空
		TRADE_FINISHED
		
		
		*/
		
		if($arr["trade_status"]=="TRADE_SUCCESS"||$arr["trade_status"]=="TRADE_FINISHED")
		{
		return  true;	
		}
		
	}
	
	
	
	
	
	
	
	
	}





?>