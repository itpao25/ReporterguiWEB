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

require_once("inc/heart.inc.php");
$RGWeb->getHeader("Servers");
?>

<div class="container">
  <h2>Servers
    <span class="right">
      <a href="add-server.php"><button class="button-primario right"><i class="fa fa-plus"></i> Add server</button></a>
    </span>
  </h2>
  <?= $RGWeb->getServerList(); ?>
</div>

<?php
$RGWeb->getFooter();
?>
