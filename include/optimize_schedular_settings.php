<?php
# --------------------------------------- #
# prevent file from being accessed directly
# --------------------------------------- #
if ( ! defined( 'WPINC' ) ) {
	die;
}
$GLOBALS['optimize_auto_cleanup'] = get_option('optimize-auto');
require_once('optimize_schedular_helper.php');
$classname =  'OptimizeScheduleHelper';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	check_admin_referer( 'optimize_settings' );
	if (isset($_POST["enable-schedule"])) {
		update_option( SCHEDULE_OPTION, 'true' );
		$classname::optimize_cron_deactivate();
		if (isset($_POST["schedule_type"])) {
			$schedule_type = $_POST['schedule_type'];
			update_option( SCHEDULE_OPTION_TYPE, $schedule_type );

		} else {
			update_option( SCHEDULE_OPTION_TYPE, 'weekly' );
		}
		$classname::optimize_cron_activate();
		add_action('optimize_cron_event2', 'optimize_cron_action');
	} else {
		update_option( SCHEDULE_OPTION, 'false' );
		update_option( SCHEDULE_OPTION_TYPE, 'weekly' );
		$classname::optimize_cron_deactivate();

	}
	if (isset($_POST["enable-email"])) {
		update_option( ENABLE_EMAIL, 'true' );
	} else {
		update_option( ENABLE_EMAIL, 'false' );
	}
	if (isset($_POST["enable-email-address"])) {
		update_option( ENABLE_EMAIL_ADDRESS, wp_unslash( $_POST["enable-email-address"] ) );
	} else {
		update_option( ENABLE_EMAIL_ADDRESS, get_bloginfo ( 'admin_email' ) );
	}
	if( isset($_POST['optimize-cleanup-settings']) ) {
		$new_options = $_POST['optimize-auto'];                  //echo "<pre>"; print_r($new_options); die;
		$bool_opts = array( 'postmeta','tags','revisions', 'drafts','PosPagTrash', 'spamCmds','trashCmds', 'unapproved', 'pingback',  'trackback', 'orphanedImg' );
		foreach($bool_opts as $key) {
			$new_options[$key] = !empty( $new_options[$key] ) ? 'true' : 'false';
		}
		update_option( 'optimize-auto', $new_options);
		$optimize_auto_cleanup = get_option('optimize-auto');
	}
	echo '<div id="message" class="updated fade">';
	echo '<strong>'._e('Settings updated','wp-optimize').'</strong></div>';
}
if(isset($_POST['enable-backup-settings']) ) {   ?>
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					<p>One fine body…</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php  }    ?>
<!--<div class="optimize_section optimize_group">-->
<?php $redirect =get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG.'&action=settings';?>
<!-- Begining of Auto back-up form -->
<!--<form action=""   method="post" enctype="multipart/form-data" name="settings_form" id="settings_form">-->
<?php
if(isset($_POST['optimize-auto-backup']))
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
	if( substr( PHP_OS, 0, 3 ) === 'WIN' ) {
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
wp_nonce_field( 'optimize_settings' ); ?>
<?php
echo "<nav class='navbar navbar-inverse'>";
echo "<div style='padding-right:15px;'>";
echo "<ul class='nav navbar-nav'>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=pieChart >Home</a></li>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=backup_database > Backup DB </a></li>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=optimizer> Clean-up DB </a></li>";
echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=settings > Auto Schedule Settings </a></li>";
echo "</ul>";
echo "</div>";
echo "</nav>";
?>
<!-- Begining of Auto clean-up form -->
<div style = 'width:100%;height;100%;'> 
<form action=""   method="post" enctype="multipart/form-data" name="settings_form" id="settings_form" style = "height:400px;">
	<?php wp_nonce_field( 'optimize_settings' ); ?>
	<div class="optimize_col optimize_span_1_of_3" style='width:98%;'>
    <div class="postbox" style='width:100%;height:110%;'>
    <div class="inside">
	<?php $optimize_auto_cleanup = get_option('optimize-auto');?>
	<h3>Auto Clean-up Settings </h3>
	<!--<p>-->
		<input type="checkbox" name="enable-schedule" id="enable-schedule" value ="true" <?php echo get_option(SCHEDULE_OPTION) == 'true' ? 'checked="checked"':''; ?> /> &nbsp;
		<label for="enable-schedule"><strong> Enable Auto Clean-up Option </strong></label>
		<br /><br />
		<label for="schedule_type"><strong>Select schedule type (default is Weekly) </strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
		<select class="selectpicker show-tick" data-style="btn-primary" id="schedule_type" name="schedule_type"  >
			<option value="<?php echo esc_attr( get_option(SCHEDULE_OPTION_TYPE, 'weekly') ); ?>">
				<?php
				$last_schedule = get_option(SCHEDULE_OPTION_TYPE,'weekly');
				switch ($last_schedule) {
					case "daily":
						echo 'Everyday';
						break;

					case "weekly":
						echo 'Every week';
						break;

					case "otherweekly":
						echo 'Every other week (every 14 days)';
						break;

					case "monthly":
						echo 'Every month (every 31 days)';
						break;

					default:
						echo 'Every week';
						break;
				}
				?>
			</option>
			<option value="daily">Everyday</option>
			<option value="weekly">Every week</option>
			<option value="otherweekly">Every other week (every 14 days)</option>
			<option value="monthly">Every month (every 31 days)</option>
		</select>

		<br><br>
	<div class="alert alert-info">
		<strong>Important Note : </strong> These options will  work, only if the <strong>Auto Clean-up Option is enabled</strong>.
	</div>
	<table class='table table-hover'>
		<tr>
			<td>
				<label for='optimize-auto[postmeta]'><strong>Delete all orphaned Post/Page Meta</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[postmeta]" id="optimize-auto[postmeta]" type="checkbox"  value="true" <?php echo $optimize_auto_cleanup['postmeta'] == 'true' ? 'checked="checked"':''; ?>  data-reverse/>
				</div>
			</td>
			<td>
				<label for='optimize-auto[tags]'><strong>Delete all unassigned tags</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[tags]" id="optimize-auto[tags]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['tags'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for='optimize-auto[revisions]'><strong>Delete all Post/Page revisions</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[revisions]" id="optimize-auto[revisions]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['revisions'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
			<td>
				<label for='optimize-auto[drafts]'><strong>Delete all auto drafted Post/Page</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[drafts]" id="optimize-auto[drafts]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['drafts'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for='optimize-auto[PosPagTrash]'><strong>Delete all Post/Page in trash</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[PosPagTrash]" id="optimize-auto[PosPagTrash]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['PosPagTrash'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
			<td>
				<label for='optimize-auto[spamCmds]'><strong>Delete all Spam Comments</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[spamCmds]" id="optimize-auto[spamCmds]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['spamCmds'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			<td>
			</td>
		</tr>
		<tr>
			<td>
				<label for='optimize-auto[trashCmds]'><strong>Delete all Comments in trash</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[trashCmds]" id="optimize-auto[trashCmds]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['trashCmds'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
			<td>
				<label for='optimize-auto[unapproved]'><strong>Delete all Unapproved Comments</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[unapproved]" id="optimize-auto[unapproved]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['unapproved'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for='optimize-auto[pingback]'><strong>Delete all Pingback Comments</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[pingback]" id="optimize-auto[pingback]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['pingback'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
			<td>
				<label for='optimize-auto[trackback]'><strong>Delete all Trackback Comments</strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[trackback]" id="optimize-auto[trackback]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['trackback'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for='optimize-auto[orphanedImg]'><strong>Delete all orphaned Images </strong></label>
			</td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="optimize-auto[orphanedImg]" id="optimize-auto[orphanedImg]" type="checkbox" value="true" <?php echo $optimize_auto_cleanup['orphanedImg'] == 'true' ? 'checked="checked"':''; ?> />
				</div>
			</td>
			<td>
			</td>
			<td></td>
		</tr>
		<tr>
			<td> <label>  Enable email notification </label>  </td>
			<td>
				<input name="enable-email" id="enable-email" type="checkbox" value ="true" <?php echo get_option(ENABLE_EMAIL, 'false') == 'true' ? 'checked="checked"':''; ?> />
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><label for="enable-email-address">  Send email to </label></td>
			<td>
				<div class="make-switch" data-on="success" data-off="warning">
					<input name="enable-email-address" id="enable-email-address" type="text" value ="<?php echo esc_attr( get_option( ENABLE_EMAIL_ADDRESS, get_bloginfo ( 'admin_email' ) ) ); ?>" />
				</div>
			</td>
			<td></td>
			<td></td>
		</tr>
		<br/>
		<tr>
			<td></td><td></td><td></td>
			<td><input class="button-primary" type="submit" name="optimize-cleanup-settings" value="SAVE AUTO CLEAN-UP SETTINGS" /> </td>
		</tr>
	</table>
	</div>
    </div>
    </div>
</form>
</div>
<!-- end of Auto clean-up form -->
