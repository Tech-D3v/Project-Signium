<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
      <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../socket_server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
    <script type="text/javascript" src="js/cookie.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".button-collapse-locations").sideNav({
          menuWidth: 250,
          edge: 'right',
          closeOnClick: true,
          draggable: true
        });
        $(".button-collapse-nav").sideNav({
          menuWidth: 300,
          edge: 'left',
          closeOnClick: true,
          draggable: false
        });
    });

  	</script>
    <link rel="stylesheet" href="css/appstyle.css">
  </head>
  <body>
    <nav>
  <div class="nav-wrapper">
    <a class="brand-logo">WCSIS</a>
    <a href="#" data-activates="mobile" class="button-collapse-nav button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <li><a class="waves-effect waves-light btn">Logout <i class="material-icons right">lock</i></a></li>
    </ul>
    <ul class="side-nav" id="mobile">
      <li><a class="waves-effect waves-light btn">Logout <i class="material-icons right">lock</i></a></li>
    </ul>
  </div>
</nav>
   <ul id="locations" class="side-nav">
   </ul>
   <div id="main">
     <div class="student-card">
       <p class="name">Name</p>
       <p class="nickname">Nickname</p>
       <p class="yeargroup">Yeargroup</p>
       <p class="location">Location</p>
       <p class="date">Date</p>
       <p class="time">Time</p>
       <p class="house">House</p>
     </div>
     <a data-activates="locations" class="btn-select-locations button-collapse-locations waves-effect waves-light btn">Select Location</a>
   </div>
</body>
</html>
