<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="">
    <title>iot3-EXIT</title>
    <link href="./cctv.css?ver=4" rel="stylesheet">
    <script></script>
</head>
<body style="background-color: #7D9FFD; background-size: 200px; position: right;">
<nav>
      <li><a class="cctv" href="http://192.168.1.242:8081/cctv.php">CCTV</a></li> 
      <li><a class="info" href="http://192.168.1.242:8081/info.php">INFO▼</a>
        <ul>
            <li><a href="http://192.168.1.242:8081/info.php#t2">FLOW</a></li>
            <li><a href="http://192.168.1.242:8081/info.php#t3">GUI</a></li>
            <li><a href="http://192.168.1.242:8081/info.php#t4">회로도</a></li>
            <li><a href="http://192.168.1.242:8081/info.php#t5">ROBOT</a></li>
            <!-- https://aboooks.tistory.com/330 -->
        </ul>
      </li>
      <li><a class="team" href="http://192.168.1.242:8081/team.php">TEAM</a><li>
  </nav>

<div style="margin-left:15%;padding:1px 16px;height:auto;">
  <div style="TEXT-ALIGN:CENTER">

  <!-- <article class="main_banner">
		<div class="dark_bg"></div>
		<div class="banner_box">
			<h1>
      <a id="t0">
				TEST<br>
				웹페이지</a>
			</h1>
			<span></span>
			<p>
				111111<br>
				22222222<br>
				33333
			</p>
		</div>
	</article> -->
    <!-- <div style="width:100%; height:100%; background-color: #ffcc33; background-size: cover; position: relative;"> -->
      <h1><a>CCTV</a></h1>
      <iframe src="http://192.168.1.179:8090/?action=stream" style="width:100%; height:max;margin-top:10px;margin-bottom:10px;"></iframe>
      
      <iframe src="http://localhost:3000/d-solo/DIGA_giVk/cam_data?orgId=1&from=1662372645000&to=1662372776000&panelId=2"
            style="width:49%; height:max; float:left;"></iframe> 

      <iframe src="http://localhost:3000/d-solo/DIGA_giVk/cam_data?orgId=1&panelId=2"
            style="width:49%; height:max; float:right;"></iframe> 
      <!-- https://ojji.wayful.com/2013/12/HTML-set-Two-Parallel-DIVs-columns.html -->
      <!-- </div> -->
    </div>
  </div>