<?php
echo "<div class='modal fade' id = 'modal_zip' tabindex='-1' role='dialog' aria-labelledby='mymodallabel' aria-hidden='true'>";
echo  "<div class='modal-dialog'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";

echo "<h4 class='modal-title' id='mymodallabel'> NOTE </h4>";
echo "</div>";
echo "<div class='modal-body' id = 'choose_file'>";
echo "...";
echo  "</div>";
echo "<div class='modal-footer'>";
echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>";
echo  "</div>";
echo " </div>";
echo " </div>";
echo "</div>";

if(isset($_POST['do']))
{	
	$backup = array();
	$backup['date'] = current_time('timestamp');             
	$backup['mysqldumppath'] = "/usr/bin/mysqldump";                                     
	$backup['mysqlpath'] = "/usr/bin/mysql";
	$backup['path'] = WP_CONTENT_DIR."/database_backup";                         
	$backup['charset'] = ' --default-character-set="utf8"';

	$brace = (substr(PHP_OS, 0, 3) == 'WIN') ? '"' : '';
	$backup['host'] = DB_HOST;                                   
	$backup['port'] = '';
	$backup['sock'] = '';
	if(strpos(DB_HOST, ':') !== false) {
		$db_host = explode(':', DB_HOST);
		$backup['host'] = $db_host[0];
		if(intval($db_host[1]) != 0) {
			$backup['port'] = ' --port=' . escapeshellarg( intval( $db_host[1] ) );
		} else {
			$backup['sock'] = ' --socket=' . escapeshellarg( $db_host[1] );
		}
	}




	$gzip = intval($_POST['gzip']);

	if($gzip == 1) {
		$backup['filename'] = $backup['date'].'_-_'.DB_NAME.'.sql.gz';
		$backup['filepath'] = $backup['path'].'/'.$backup['filename'];
		do_action( 'wp_dbmanager_before_escapeshellcmd' );
		$backup['command'] = $brace . escapeshellcmd( $backup['mysqldumppath'] ) . $brace . ' --force --host=' . escapeshellarg( $backup['host'] ) . ' --user=' . escapeshellarg( DB_USER ) . ' --password=' . escapeshellarg( DB_PASSWORD ) . $backup['port'] . $backup['sock'] . $backup['charset'] . ' --add-drop-table --skip-lock-tables ' . DB_NAME . ' | gzip > ' . $brace . escapeshellcmd( $backup['filepath'] ) . $brace;
	} else {
		$backup['filename'] = $backup['date'].'_-_'.DB_NAME.'.sql';
		$backup['filepath'] = $backup['path'].'/'.$backup['filename']; 
		do_action( 'wp_dbmanager_before_escapeshellcmd' );
		$backup['command'] = $brace . escapeshellcmd( $backup['mysqldumppath'] ) . $brace . ' --force --host=' . escapeshellarg( $backup['host'] ) . ' --user=' . escapeshellarg( DB_USER ) . ' --password=' . escapeshellarg( DB_PASSWORD ) . $backup['port'] . $backup['sock'] . $backup['charset'] . ' --add-drop-table --skip-lock-tables ' . DB_NAME . ' > ' . $brace . escapeshellcmd( $backup['filepath'] ) . $brace;
	}


	$error = execute_backup( $backup['command'] );    // print_r($error);


	if(!is_dir($backup['path'])){                                
		$text = '<p style="color: red;">'.'Database Backup Failed &nbsp;.&nbsp;&nbsp;&nbsp;Backup Folder Not Found.'.'</p>';
	}

	elseif(!is_writable( $backup['path'] ) ) {
		$text = '<p style="color: red;">'.'Database Backup Failed Due To Backup Folder Is  Not Writable'.'</p>';
	} elseif( is_file( $backup['filepath'] ) && filesize( $backup['filepath'] ) === 0 ) {
		$text = '<p style="color: red;">'.'Database Backup failed Due To Backup File Size Is 0KB'.'</p>';
	} elseif( ! is_file( $backup['filepath'] ) ) {
		$text = '<p style="color: red;">'.'Database Backup Failed Due To Invalid Backup File Path'.'</p>';
	} else {
		$text = '<p style="color: green;">'.'Database Backed Up Successfully On'.' '. date("d/m/y").' '.'@'.' '.date("h:i:sa").'</p>';
	}



}


function execute_backup($command) {                                 
	$backup = array();
	$backup['mysqldumppath'] = "/usr/bin/mysqldump";
	$backup['mysqlpath'] = "/usr/bin/mysql";
	$backup['path'] =  WP_CONTENT_DIR."/database_backup";


	if( realpath( $backup['path'] ) === false ) { 
		return sprintf( __( '%s is not a valid backup path', 'wp-dbmanager' ), stripslashes( $backup['path'] ) );
	} else if( dbmanager_is_valid_path( $backup['mysqldumppath'] ) === 0 ) {
		return sprintf( __( '%s is not a valid mysqldump path', 'wp-dbmanager' ), stripslashes( $backup['mysqldumppath'] ) );
	} else if( dbmanager_is_valid_path( $backup['mysqlpath'] ) === 0 ) {
		return sprintf( __( '%s is not a valid mysql path', 'wp-dbmanager' ), stripslashes( $backup['mysqlpath'] ) );
	}

	if( substr( PHP_OS, 0, 3 ) === 'WIN' ) { // echo "hai"; 
		$writable_dir = $backup['path'];
		$tmpnam = $writable_dir.'/wp-dbmanager.bat';
		$fp = fopen( $tmpnam, 'w' );
		fwrite ($fp, $command );
		fclose( $fp );
		system( $tmpnam.' > NUL', $error );
		unlink( $tmpnam );
	} else {    
		passthru( $command, $error );   // echo $error; die("din");
	}
	return $error;
}


function dbmanager_is_valid_path( $path ) {
	return preg_match( '/^[^*?"<>|;]*$/', $path );
}


$backup = array();
//$now = new DateTime();
//echo $now->format('Y-m-d H:i:s');
$backup['date'] = current_time('timestamp');             
$backup['mysqldumppath'] = "/usr/bin/mysqldump";                                     
$backup['mysqlpath'] = "/usr/bin/mysql";
$backup['path'] = WP_CONTENT_DIR."/database_backup";
$backup['filename'] = $backup['date'].'_-_'.DB_NAME.'.sql';    




echo "<nav class='navbar navbar-inverse'>";
echo "<div style='padding-right:15px;'>";
echo "<ul class='nav navbar-nav'>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=pieChart >Home</a></li>";

echo "<li class='active'><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=backup_database > Backup DB </a></li>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=optimizer> Clean-up DB </a></li>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=settings > Auto Schedule Settings </a></li>";
echo "</ul>";
echo "</div>";
echo "</nav>";

//<!-- Backup Database -->
echo "<div id='optimize_backup_container' style='width:98%; padding:10px; background-color:white;'>";
echo "<form method='post' action=''>";



echo "<h3> Backup Database </h3>";
echo "<br style='clear' />";
//if( ! empty( $note ) ) { echo '<div id="note" class="updated">'.$note.'</div>'; }

echo "<div class='alert alert-info'>";
echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"; 
echo "<strong style='font-size:16px; color:red;'>Before try to backup the database please ensure that: </strong> <br><br> <p>1. &nbsp;&nbsp; Create a backup folder named     
<strong> 'database_backup' </strong> in wp-content directory</p> <br> <p> 2. &nbsp;&nbsp; Make sure that the backup folder is writable.</p> "; 
echo "</div>";

if( ! empty( $text ) ) { echo '<div id="message" class="updated">'.$text.'</div>'; } 
echo "<br>";
//echo "<div id='backup_form' class='postbox' style='background-color:white;'>";
/*echo "<head>";
echo "<style>";
//echo "tr { line-height: 25px;min-height: 25px;height: 50px;}";
echo "</style>";
echo "</head>";*/

echo "<table class='table'>";
//echo "<thead>";
echo "<tr style='line-height: 25px;'>";
echo "<th><strong>Option</strong> </th>";
echo "<td><strong>Value </strong></td>";
echo "</tr>";
//echo "</thead>";
echo "<tr style='line-height: 25px;'>";
echo "<th> Database Name: </th>";
echo "<td>" .DB_NAME. "</td>";
echo "</tr>";
echo "<tr style='line-height: 25px;'>";
echo "<th> Database Backup Location: </th>";
echo "<td><span dir='ltr'>".$backup['path']. "</span></td>";
echo "</tr>";
echo "<tr style='line-height: 25px;'>";
echo "<th> Backup Date: </th>";
echo "<td>".date("d/m/y").'    '.date("h:i:sa")."</td>";
echo "</tr>";
echo "<tr style='line-height: 25px;'>";
echo "<th> Database Backup File Name: </th>";
echo "<td><span dir='ltr'>".$backup['filename'] ."</span></td>";        
echo "</tr>";

//echo "<tr style='background-color: #eee;'>";
echo "<tr style='line-height: 25px;'>";
echo "<th> GZIP Database Backup File? </th>";
echo "<td><input type='radio' id='gzip-yes' name='gzip' value='1' />&nbsp;&nbsp;<label for='gzip-yes'> Yes </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' id='gzip-no' name='gzip' value='0' checked='checked' />&nbsp;&nbsp;<label for='gzip-no'> No</label></td>";
echo "</tr>";
echo "<tr style='line-height: 25px;'>";  
echo "<td colspan='2' align='center'><input type='submit' name='do' id='do' value='Backup' class='btn btn-success' />&nbsp;&nbsp;<input type='button' name='cancel' value=' Cancel' class='btn btn-warning' onclick='javascript:history.go(-1)' /></td>";
echo "</tr>";                   
echo "</table>";
//echo "</div>";
echo "</form>";
echo "</div>";
//echo "</div>";
?>
