<?php
declare(ticks=1);
$pidA=pcntl_fork();
if ($pidA>0){
	
}elseif ($pidA==-1){
	exit(1);
}else{
	var_dump($pidA);
}

if(-1==posix_setsid()){
	exit(2);
}
echo getmypid();
while (true){
	sleep(1);
}