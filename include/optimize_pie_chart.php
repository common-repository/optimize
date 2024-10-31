<?php
echo "<div style = 'width:98% !important;height:100%'>";
echo "<nav class='navbar navbar-inverse'>";
  echo "<div style='padding-right:15px;'>";
     echo "<ul class='nav navbar-nav'>";
       echo "<li class='active'><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=pieChart >Home</a></li>";
	  echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=backup_database > Backup DB </a></li>";
        echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=optimizer> Clean-up DB </a></li>";
        echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=settings > Auto Schedule Settings </a></li>";
      echo "</ul>";
    echo "</div>";
  
echo "</nav>";
  
echo "<div id='header' style='width:98%;' >";
echo "<label for='choose_chart' style='font-size:16px;'> Choose Chart Type &nbsp;: </label>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<select class='selectpicker show-tick' data-style='btn-primary' id='choose_chart'  name = 'choose_chart' onchange='choose_chartType(this.value);' style='display:inline;' >";
echo "<option value='select'> Select </option>";
echo "<option value='count_based'> Count based Chart </option>";
echo "<option value='size_based'> Size based Chart </option>";
echo "</select>";
echo "</div>";
echo " <div class='drillStats' id='drillStats' style='float:left;height:500px;width:100%;margin-top:15px;margin-bottom:15px;'></div>";
echo "</div>";
?>

