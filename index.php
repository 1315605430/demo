<?php


include("./base.php");

class Alipay extends Base{
	
	
	public function __construct(){
		
		
		//传递给支付宝的数据
		
		
		
		$config=array(
		
		"service"=>"create_direct_pay_by_user",//接口名称。
		"partner"=>self::PID,// 合作者身份ID  签约的支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。
		"_input_charset"=>"UTF-8",// 参数编码字符集 商户网站使用的编码格式，如UTF-8、GBK、GB2312等。
		"sign_type"=>"MD5",//签名方式
		"sign"=>"",//签名 需要根据请求参数生成
		"return_url"=>self::RETURN_URL,//页面跳转同步通知页面路径
		"notify_url"=>self::NOTIFY_URL,//服务器异步通知页面路径
		"out_trade_no"=>date("Ymdhis"),//商户网站唯一订单号
		"subject"=>"测试商品",//商品名称
		"payment_type"=>1,//支付类型 只支持取值为1（商品购买）。
		"total_fee"=>"0.01",//交易金额
		"seller_id"=>self::PID,
		"body"=>"测试商品描述",
		
		
		);
	
	  
	    //生成签名
		$config['sign']=$this->getsign($config);
		
		$url=self::PAYURL."?".$this->geturl($config);
		//echo $url;
		header("Location:".$url);
		
		
		}
	
	
	
	}



$alipay=new alipay();




?>