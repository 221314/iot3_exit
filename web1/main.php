<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iot3-EXIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
  <style type="text/css">
 nav {
   list-style-type: none;
   background-color: #ccc;
   width: 25%;
   padding: 0;
   margin:  0;
   position: fixed;
   height: 100%;
   overflow: auto;
 } </style>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://192.168.1.242:8081/main.php">EXIT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
	<a class="nav-link" href="#t1">CCTV</a>
        <a class="nav-link" href="#t2">FLOW</a>
        <a class="nav-link" href="#t3">GUI</a>
        <a class="nav-link" href="#t4">회로도</a>
        <a class="nav-link" href="#t5">ROBOT</a>
      </div>
    </div>
  </div>
</nav>
<div style="VERTICAL-ALIGN:CENTER">
  <h1><a id="t1">CCTV</a></h1>
  <t>4813094801958139589348<br>29305832583205893<br>938509258089532</t>
  <!--<iframe src="http://192.168.1.179:8090/?action=stream" style="width:100%; height:500px;"></iframe>-->
  <iframe src="" style="width:100%; height:500px;"></iframe>
  <div class="col">
    <iframe src="http://localhost:3000/d-solo/DIGA_giVk/cam_data?orgId=1&from=1662372645000&to=1662372776000&panelId=2" width="100%" height="100%" frameborder="0"></iframe> 
  </div>
  <div class="col">
    <iframe src="http://localhost:3000/d-solo/DIGA_giVk/cam_data?orgId=1&panelId=2" width="100%" height="" frameborder="0"allowfullscreen></iframe> 
  </div>
  
  <h1><a id="t2">FLOW</a></h1>
    <t>4813094801958139589348<br>29305832583205893<br>938509258089532<br></t>
    <img class="fit-picture" src="/1.jpg" style="width:80%; height:auto;" ></img>
    <br>
  <h1><a id="t3">GUI</a></h1>
    <t>사용예시 gif...아래 status bar에서 이상감지 data 확인가능...<br>터치스크린을 이용해서 확인하는것도 가능...<br></t>
    <img src = "Peek 2022-09-05 12-31.gif" style="width:80%; height:auto;" alt></img>
    <br>
  <h1><a id="t4">회로도...</a></h1>
    <t>4813094801958139589348<br>29305832583205893<br>938509258089532<br></t>
    <img src = "/1.jpg" style="width:80%; height:auto;" alt></img>
    <br>
  <h1><a id="t5">ROBOT</a></h1>
    <t>4813094801958139589348<br>29305832583205893<br>938509258089532<br></t>
    <img src = "/1.jpg" style="width:80%; height:auto;" alt></img>
    <br>
  <t>설명3958320958592350325</t>
</div>
</body>
</html>
