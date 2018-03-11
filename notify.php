<?php


include("./base.php");

//异步接收数据

/*


1.获取数据
2.验证签名
3.验证是否是来自支付宝的请求
4.验证交易状态
5.验证订单号和状态
6.更改订单状态
7.返回success






*/



class Notify extends Base{
	
	
	
	 function __construct(){
		 
		 $data=$_POST;//获取支付宝返回的数据
		 !$this->checksign($data)&&exit($this->logs("log.txt","签名错误")); //验证支付宝返回的签名
		 $this->logs("log.txt","签名正确");
		 
		 
		 !$this->isalipay($data)&&exit($this->logs("log.txt","不是来自支付宝的通知"));//验证是否是来自支付宝的请求
		 $this->logs("log.txt","是来自支付宝的通知");
		
		
		 !$this->check_order_statue($data)&&exit($this->logs("log.txt","交易未完成"));//验证交易状态
		 $this->logs("log.txt","交易完成");
		 
		 
		 //获取支付发过来的订单号  在商户订单表中查询对应的订单金额  然后和支付宝发过来的订单金额对比
		 
		  $this->logs("log.txt","订单号：".$data['out_trade_no']."，订单金额：".$data['total_fee']);
		 
		 //输出success给支付宝服务器 让对方停止发送验证，同时更改本地的订单状态
		 echo  "success";
		 
		 
		
     }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}


$notify=new Notify();




?>