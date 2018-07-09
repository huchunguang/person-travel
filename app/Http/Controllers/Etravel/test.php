<?php
declare(ticks=1);
// $pidA=pcntl_fork();
// if ($pidA>0){
	
// }elseif ($pidA==-1){
// 	exit(1);
// }else{
// 	var_dump($pidA);
// }

// if(-1==posix_setsid()){
// 	exit(2);
// }
// echo getmypid();
// while (true){
// 	sleep(1);
// }


// $maxPro=4;
// $curPro=0;
// function signalHandler($signal)
// {
// 	global $curPro;
// 	switch ($signal){
// 		case SIGCHLD:
// 			echo 'SIGCHLD'.PHP_EOL;
// 			$curPro--;
// 			break;
// 	}
// }
declare(ticks=1);
// pcntl_signal(SIGCHLD, 'signalHandler');

// while (true){
// 	$curPro++;
// 	$pid=pcntl_fork();
// 	if ($pid==-1){
// 		exit(2);
// 	}elseif($pid){
// 		echo "Parent Mode".PHP_EOL;
// 		//we are in the parent process
// 		if ($curPro>=$maxPro){
// 			echo 'waiting'.PHP_EOL;
// 			pcntl_wait($status);
// 		}
// 	}else{
// 		$s=rand(2,6);
// 		echo $curPro."child sleep $s second quit".PHP_EOL;
// 		sleep(5);
// 		exit;
// 	}
// }









// $childs = array();

// // Fork10个子进程
// for ($i = 0; $i < 4; $i++) {
// 	$pid = pcntl_fork();
// 	if ($pid == -1)
// 		die('Could not fork');
		
// 		if ($pid) {
// 			echo "parent \n";
// 			$childs[] = $pid;
// 		} else {
// 			// Sleep $i+1 (s). 子进程可以得到$i参数
// 			sleep($i + 1);
			
// 			// 子进程需要exit,防止子进程也进入for循环
// 			exit();
// 		}
// }

// while (count($childs) > 0) {
// 	foreach ($childs as $key => $pid) {
// 		$res = pcntl_waitpid($pid, $status, WNOHANG);
		
// 		//-1代表error, 大于0代表子进程已退出,返回的是子进程的pid,非阻塞时0代表没取到退出子进程
// 		if ($res == -1 || $res > 0)
// 			unset($childs[$key]);
// 	}
	
// 	sleep(1);
// }

// function signalHandler($signal){
// 	switch ($signal){
// 		case SIGTERM:
// 			echo 'received signal SIGTERM'.PHP_EOL;
// 			break;
// 	}
// }
// pcntl_signal(SIGTERM, 'signalHandler');
// $pid= pcntl_fork();
// if (-1==$pid){
// 	exit(2);
// }elseif ($pid>0){
// 	pcntl_wait($status);
// 	exit();
// }elseif ($pid==0){
// 	if (function_exists('posix_kill')){
// 		posix_kill(getmypid(), SIGTERM);
// 		pcntl_signal_dispatch();
// 	}else{
// 		system('kill -9 '.getmypid());
// 	}
// 	exit;
// }


$i = 0;
while($i < 2) {
	$pid = pcntl_fork();
	// 父进程和子进程都会执行以下代码
	if ($pid == -1) { // 创建子进程错误，返回-1
		die('could not fork');
	} else if ($pid) {
		// 父进程会得到子进程号，所以这里是父进程执行的逻辑
		pcntl_wait($status); // 父进程必须等待一个子进程退出后，再创建下一个子进程。
		
		$cid = $pid; // 子进程的ID
		$pid = posix_getpid(); // pid 与mypid一样，是当前进程Id
		$myid = getmypid();
		$ppid = posix_getppid(); // 进程的父级ID
		$time = microtime(true);
		echo "I am parent cid:$cid   myid:$myid pid:$pid ppid:$ppid i:$i $time \n";
	} else {
		// 子进程得到的$pid 为0，所以这里是子进程的逻辑
		$cid = $pid;
		$pid = posix_getpid();
		$ppid = posix_getppid();
		$myid = getmypid();
		$time = microtime(true);
		echo "I am child cid:$cid   myid:$myid pid:$pid ppid:$ppid i:$i  $time \n";
		//exit;
		//sleep(2);
	}
	$i++;
}
