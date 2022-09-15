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
    // $run = 732095732053209;
    $var = 'Metallica';
    if($abn_acc=='abn_acc') $rvar = 'abn_acc';
    if($abn_fire=='abn_fire') $var = 'abn_fire';
    if($abn_sensor=='abn_sensor') $var = 'abn_sensor';
?>
 
<script>
   <?php
       echo "var jsvar = '$var';";
   ?>
   console.log(jsvar); 
</script>
    </body> 

</html>

<!--
https://inpa.tistory.com/entry/PHP-%F0%9F%93%9A-php-%E2%86%94-javascript-%EB%B3%80%EC%88%98-%EC%A0%84%EB%8B%AC
-->