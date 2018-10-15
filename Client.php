<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/10/14
 * Time: 13:23
 */

$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
//接收套接流的最大超时时间1秒，后面是微秒单位超时时间，设置为零，表示不管它
socket_set_option($socket,SOL_SOCKET,SO_RCVTIMEO,array("sec" =>1,"usec"=>0));
//发送套接流的最大超时时间为6秒
socket_set_option($socket,SOL_SOCKET,SO_RCVTIMEO,array("sec"=>1,"usec"=>0));

if(socket_connect($socket,'127.0.0.1',8888) == false){
	echo 'connect fail message:' . socket_strerror(socket_last_error());
}else{
	$message = 'I love you  socket';
	//$message = mb_convert_encoding($message,'GBK','UTF-8');
	//向服务端写入字符串
	if(socket_write($socket,$message,strlen($message)) == false){
		echo 'fail to write' . socket_strerror(socket_last_error());
	}else{
		echo 'client write success' . PHP_EOL;
		//读取服务端返回来的套接流信息
		while($callback = socket_read($socket,1024)){
			echo 'server return message is:' . PHP_EOL . $callback;
		}
	}
}

socket_close($socket);


