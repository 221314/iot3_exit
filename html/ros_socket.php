<html> 
    <html lang="ko">
        <head> 
            <meta charset="utf-8">
            <script type="text/javascript" src="https://static.robotwebtools.org/roslibjs/current/roslib.min.js">
                </script>
</head> 

<body> 
    <h1>ROSDS의 안녕하세요!</h1> 
    
    <p>첫 번째 웹페이지에서 rosbridge와 소통하세요.</p> 
    
<?php
    include 'abn.php';
    $run = 'NULL';  #DB에서 select한 이상감지 데이터가 있을때 js로 변수 전달
    if($abn_acc=='abn_acc') $run = 1;
    if($abn_fire=='abn_fire') $run = 2;
    if($abn_sensor=='abn_sensor') $run = 3;
    ?>

<script type="text/javascript">

    var jrun = <?php echo $run; ?>;
    //웹서버(php)로 부터 변수를 받아옴
    //https://rateye.tistory.com/1158
    
// ROS와 connect 및 확인
    var ros = new ROSLIB.Ros({ 
    url : 'ws://192.168.137.246:9090'
});
ros.on('connection', function() {
    console.log('Connected to websocket server.');
});

ros.on('error', function(error) {
    console.log('Error connecting to websocket server: ', error);
});

ros.on('close', function() {
    console.log('Connection to websocket server closed.');
});

var goal = new ROSLIB.Topic({
    ros : ros,
    name : '/move_base/goal', // /cmd_vel
    messageType : 'move_base_msgs/MoveBaseGoal' // 'geometry_msgs/Twist'
})

switch (jrun) {

    case 1: //사람쓰러졌을때(카메라 앞)
        var moveBaseGoal = new ROSLIB.Message({
            goal: {
                target_pose: {
                    header: {
                        frame_id : "map"
                    },
                    pose: {
                        position: {
                            x : 4.66,
                            y : 0.76,
                            z : 0.0
                        },
                        orientation: {
                            x : 0.0,
                            y : 0.0,
                            z :0.0,
                            w : 1.0
                        }
                    }
                }
            }
        })
        break;

    case 2: //대피로(화재 탈출)
    var moveBaseGoal = new ROSLIB.Message({
        goal: {
            target_pose: {
                header: {
                    frame_id : "map"
                },
                pose: {
                    position: {
                        x : 2.7,
                        y : -3.01,
                        z : 0.0
                    },
                    orientation: {
                        x : 0.0,
                        y : 0.0,
                        z :0.0,
                        w : 1.0
                    }
                }
            }
        }
    })
    break;
    
    case 3: //초기위치
        var moveBaseGoal = new ROSLIB.Message({
            goal: {
                target_pose: {
                    header: {
                        frame_id : "map"
                    },
                    pose: {
                        position: {
                            x : 2.74,
                            y : 0.79,
                            z : 0.0
                        },
                        orientation: {
                            x : 0.0,
                            y : 0.0,
                            z :0.0,
                            w : 1.0
                        }
                    }
                }
            }
        })
        break;
    default:
        break;
}

goal.publish(moveBaseGoal) //선택된 case의 데이터를 ROS에 전달(발행)

    </script>
</body> 

</html>