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
    <?php echo "var jrun = '$run';"; ?>
    
    console.log(jrun);
    var ros = new ROSLIB.Ros({ 
    url : 'ws://192.168.137.203:9090'
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
    case 1:
        var moveBaseGoal = new ROSLIB.Message({
            goal: {
                target_pose: {
                    header: {
                        frame_id : "map"
                    },
                    pose: {
                        position: {
                            x : 4.3,
                            y : -0.2,
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
    case 2:
        var moveBaseGoal = new ROSLIB.Message({
            goal: {
                target_pose: {
                    header: {
                        frame_id : "map"
                    },
                    pose: {
                        position: {
                            x : 4.3,
                            y : -0.2,
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
    case 3:
    var moveBaseGoal = new ROSLIB.Message({
        goal: {
            target_pose: {
                header: {
                    frame_id : "map"
                },
                pose: {
                    position: {
                        x : 4.3,
                        y : -0.2,
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

goal.publish(moveBaseGoal)

    </script>
</body> 

</html>