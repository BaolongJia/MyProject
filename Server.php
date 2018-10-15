<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/10/13
 * Time: 15:03
 */

	$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

	if(socket_bind($socket,'127.0.0.1',8888) == false){
		echo 'server bind fail:' . socket_strerror(socket_last_error());

	}

	//监听套接流,backlog:最大监听套接字个数
	if(socket_listen($socket,4) == false){
		echo 'server listen fail:' . socket_strerror(socket_last_error());
	}

	//让服务器无限获取客户端传过来的信息
	do{
		$accept_source = socket_accept($socket);
		if($accept_source != false){
			//读取客户端传过来的资源，并转换为字符串
			$string = socket_read($accept_source,1024);
			echo 'server recieve is :' . $string.PHP_EOL;

			if($string != false){
				$return_client = 'server recieve is:' . $string . PHP_EOL;
				socket_write($accept_source,$return_client,strlen($return_client));
			}else{
				echo 'socket_read is fail';
			}

			socket_close($accept_source);
		}
	}while(true);
	socket_close($socket);
