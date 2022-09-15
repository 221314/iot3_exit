<?php
include 'config.php';
#include '/home/dd/바탕화면/python/kakao';

//이상감지 데이터를 select하여 변수로 저장하는 파일
if($con){
  //로봇 명령을 위한 데이터 조회(이상감지) 최근 3초
  //SELECT EXISTS (); =
  $sel_acc = "SELECT acc FROM cam_data WHERE acc BETWEEN 0.8 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";
  $sel_fire = "SELECT * FROM data WHERE type='fire_sensor' AND val=0 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";
  $sel_sensor = "SELECT * FROM data WHERE type='sensor' AND val=1 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";

  $res_acc = mysqli_query($con, $sel_acc);
  $res_fire = mysqli_query($con, $sel_fire);
  $res_sensor = mysqli_query($con, $sel_sensor);

  //이상감지가 됐을 경우
  if(mysqli_num_rows($res_acc)) $abn_acc='abn_acc'; else $abn_acc=null;
  if(mysqli_num_rows($res_fire)) $abn_fire='abn_fire'; else $abn_fire=null;
  if(mysqli_num_rows($res_sensor)) $abn_sensor='abn_sensor'; else $abn_sensor=null;

  // if(mysqli_num_rows($res_sensor))
	//   exec("cd /home/dd/바탕화면/python/ && python3 kakao_run.py"); 

  echo json_encode(array($abn_acc, $abn_fire, $abn_sensor));
}
else
        die ("Connection failed: ". mysqli_connect_error());
mysqli_close($con);

