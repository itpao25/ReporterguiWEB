<?php
/**
*  This file is a class of ReporterGUI
*
*  @author itpao25
*  ReporterGUI Web Interface  Copyright (C) 2015
*
*  This program is free software; you can redistribute it and/or
*  modify it under the terms of the GNU General Public License as
*  published by the Free Software Foundation; either version 2 of
*  the License, or (at your option) any later version.
*
*  This program is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  @package ReporterGUI
*/

if (!defined('RG_ROOT')) die();
?>
<!-- </div> container -->
<br />
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65388762-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript" >
  // Notify system for user
  function openNotify(id, server, namereport, reason) {

    <?php if($this->getNotify->isNotifyEnable()): ?>
    var audioNotifica = new Audio('assets/sound/notify.wav');
    audioNotifica.play();
    <?php endif; ?>

    var invioNotifica = noty({
      text: '<b>New Report! #'+ id +'</b><br /><br/><ul><li>Server: '+ server +'</li><li>Player report: '+ namereport +'</li><li>Reason: '+ reason +'</li></ul>',
      layout: 'topRight',
      type: 'success',
      maxVisible: 7,
      timeout: 10000,
      animation: {
          open: {height: 'toggle'},
          close: {height: 'toggle'},
          easing: 'swing',
          speed: 500
      },
      closeWith: ['button'],
    });
  }
  // Funzione principale per controllare se ci sono nuove segnalazioni
  // Il tempo di check potrà essere impostato dal file di configurazione (config.php)
  function getNotify() {
    $.ajax({
      type: "GET",
      dataType: 'json',
      data: "uid=<?= $this->getIDLogged() ?>&action=notify",
      url: "json-read.php",
      success: function(result){

        if(result["result"]["not-found"] == null) {
          // Massimo 5 segnalazioni
          for(i = 1; i < 5; i++) {
            if(result["result"][i]) {
              var id = result["result"][i]["ID"];
              var server = result["result"][i]["server"];
              var player = result["result"][i]["player"];
              var reason = result["result"][i]["reason"];
              openNotify(id, server, player, reason)
            }
          }
        }
      },
      error: function (request, status, error) {
        // alert(request.responseText);
      }
    });
  }
getNotify();
window.setInterval(function(){
  getNotify()
}, <?php $this->getNotify->getRefresh(); ?>);
</script>
<footer>
	<div class="container container-footer">
		<div class="left clear">
		 <!-- Get name server and get current year -->
		 © <?= $this->getUtily->getNameServer(); ?> <?=  $this->getUtily->getCurrentYear();  ?>
		</div>
		<div class="right">
		 ReporterGUI Web <?= $this->getConfig("versions","Dir") ?>
		</div>
	</div>
</footer>
</body>
</html>
