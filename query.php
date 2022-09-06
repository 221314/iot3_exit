<?php
include 'config.php';

//date now
$pdate = date('Y-m-d H:i:s');

//data(sensor)
$ptype = $_POST['type'];
$pval = $_POST['val'];

//cam_data
$plabel = $_POST['label'];
$pper = $_POST['per'];
$pacc = $_POST['acc'];

if($con){
  //query
  $query = "INSERT INTO data VALUES ('$pdate','$ptype',$pval);";
  $cam_query = "INSERT INTO cam_data VALUES ('$pdate','$plabel',$pper,$pacc);";
  $del_query = "DELETE FROM data WHERE date <DATE_ADD(now(), INTERVAL -1 hour);";
  $del_query2 = "DELETE FROM cam_data WHERE date <DATE_ADD(now(), INTERVAL -1 hour);";

  $result = mysqli_query($con, $query);
  $cam_result = mysqli_query($con, $cam_query);
  $del_result = mysqli_query($con, $del_query);
  $del_result2 = mysqli_query($con, $del_query2);
  
  //select
  $select = "SELECT * FROM data;";
  $res_sel = mysqli_query($con, $select);
  
  $cam_select = "SELECT * FROM cam_data;";
  $cam_sel = mysqli_query($con, $cam_select);

  //로봇 명령을 위한 데이터 조회(이상감지) 최근 3초
  //SELECT EXISTS (); = 
  // $sel_acc = "SELECT acc FROM cam_data WHERE acc BETWEEN 0.7 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";
  // $sel_fire = "SELECT * FROM data WHERE type='fire_sensor' AND val=0 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";
  // $sel_sensor = "SELECT * FROM data WHERE type='sensor' AND val=1 AND date BETWEEN DATE_ADD(now(), INTERVAL -3 second) AND now();";

  // $res_acc = mysqli_query($con, $sel_acc);
  // $res_fire = mysqli_query($con, $sel_fire);
  // $res_sensor = mysqli_query($con, $sel_sensor);

  // //이상감지가 됐을 경우
  // if(mysqli_num_rows($res_acc)) $abn_acc='abn_acc'; else $abn_acc=null;
  // if(mysqli_num_rows($res_fire)) $abn_fire='abn_fire'; else $abn_fire=null;
  // if(mysqli_num_rows($res_sensor)) $abn_sensor='abn_sensor'; else $abn_sensor=null;

  // echo json_encode(array($abn_acc, $abn_fire, $abn_sensor));
}
else
	die ("Connection failed: ". mysqli_connect_error());	
mysqli_close($con);
