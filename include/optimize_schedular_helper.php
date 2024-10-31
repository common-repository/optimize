<?php
class OptimizeScheduleHelper
{
	public static function optimize_plugin_activate()
	{
		global $wpdb;
		$optimize_table = "CREATE TABLE IF NOT EXISTS `optimize_status_log` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`month` varchar(60) DEFAULT NULL,
			`year` varchar(60) DEFAULT NULL,
			`record_type` varchar(60) DEFAULT NULL,
			`deleted_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`no_of_records` int(11) DEFAULT NULL,
			`size` varchar(60) DEFAULT NULL,
			`image_name` varchar(60) DEFAULT NULL,
			PRIMARY KEY (`id`)
				) ENGINE=InnoDB;";
		$wpdb->query($optimize_table);
		self::optimize_cron_activate();
	}
	public static  function optimize_plugin_deactivate()
	{
		global $wpdb; 
		self::optimize_cron_deactivate();
		$droptable = "DROP TABLE IF EXISTS optimize_status_log;";
		                    $wpdb->query($droptable);

		//require_once('include/optimize_helper.php');
		//$opt = new OptimizeHelper(); 
		self::optimize_removeOptions();
	}





	public static function cron_schedules($param) { 
		return array('optimize_one_minute_cron' => array('interval' => 60, // seconds
					'display' => __('Every 1 minutes',WP_CONST_SMACK_WP_OPT_SLUG)));
	}


	// TODO: Need to find out why the schedule time is not refreshing
	public static function optimize_cron_activate() {                        
		//optimize_debugLog('running optimize_cron_activate()');
		$gmtoffset = (int) (3600 * ((double) get_option('gmt_offset')));

		if ( get_option( SCHEDULE_OPTION ) !== false ) { 
			if ( get_option(SCHEDULE_OPTION) == 'true') {
				if (!wp_next_scheduled('optimize_cron_event2')) { 

					$schedule_type = get_option(SCHEDULE_OPTION_TYPE, 'weekly');    

					/*	switch ($schedule_type) {
						case "daily":
					//
					$this_time = 60*60*24;
					break;

					case "weekly":
					//
					$this_time = 60*60*24*7;
					break;

					case "otherweekly":
					//
					$this_time = 60*60*24*14;
					break;

					case "monthly":
					//
					$this_time = 60*60*24*31;
					break;

					default:
					$this_time = 60*60*24*7;
					break;

					}   */



					switch ($schedule_type) {

						case "daily":
							//
							$this_time = time() + 60*60*24;
							break;

						case "weekly":
							//
							$this_time = time() +  60*60*24*7;
							break;

						case "otherweekly":
							//
							$this_time = time() + 60*60*24*14;
							break;

						case "monthly":
							//
							$this_time = time() + 60*60*24*31;
							break;

						default:
							$this_time = time() + 60*60*24*7;
							break;

					}  
					$initiateCron = time();     
					update_option(LAST_RUN,$initiateCron);
					$nextRun = $this_time;
					update_option(NEXT_RUN,$nextRun);
#self::optimize_cron_action();
					add_filter('cron_schedules', array('OptimizeScheduleHelper', 'cron_schedules'));

					add_action('optimize_cron_event2', array('OptimizeScheduleHelper','optimize_cron_action'));
					wp_schedule_event(time() , 'optimize_one_minute_cron', 'optimize_cron_event2');
					self::optimize_debugLog('running wp_schedule_event()');
				}
			}
		} else  
			self::optimize_PluginOptionsSetDefaults();
	}
	//print_r(_get_cron_array()); die("dil");
	public static function optimize_PluginOptionsSetDefaults() {     

		$deprecated = null;
		$autoload = 'no';
		if ( get_option( SCHEDULE_OPTION ) !== false ) {       
			// The option already exists, so we just update it.

		} else {
			// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			add_option( SCHEDULE_OPTION, 'false', $deprecated, $autoload );
			add_option( LAST_OPT, 'Never', $deprecated, $autoload );
			add_option( SCHEDULE_OPTION_TYPE, 'weekly', $deprecated, $autoload );
			// deactivate cron
			//self::optimize_cron_deactivate();
		}
		if ( get_option( ENABLE_EMAIL ) !== false ) {
			//
		}
		else{
			add_option( ENABLE_EMAIL, 'true', $deprecated, $autoload );
		}    
		// ---------
		if ( get_option( ENABLE_EMAIL_ADDRESS ) !== false ) {
			//
		}
		else{
			add_option( ENABLE_EMAIL_ADDRESS, get_bloginfo ( 'admin_email' ), $deprecated, $autoload );
		}    

		if ( get_option( LAST_RUN ) !== false ) {
			//
		}
		else{
			add_option( LAST_RUN, 0000000000, $deprecated, $autoload );
		}    


		if ( get_option( NEXT_RUN ) !== false ) {
			//
		}
		else{
			add_option( NEXT_RUN, 0000000000, $deprecated, $autoload );
		}    		

		if ( get_option( TOTAL_CLEANED ) !== false ) {
			//
		}
		else{
			add_option( TOTAL_CLEANED, '0', $deprecated, $autoload );
		}
		if ( get_option( 'optimize-auto' ) !== false ) {
			// The option already exists, so we just update it.

		} else {
			// 'revisions', 'drafts', 'spams', 'unapproved', 'transient', 'postmeta', 'tags'
			$new_options = array(

					'postmeta' => 'true',
					'tags' => 'false',
					'revisions' => 'true',
					'drafts' => 'true',
					'PosPagTrash' => 'true',
					'spamCmds' => 'true',
					'trashCmds' => 'false',
					'unapproved' => 'false',
					'pingback' => 'false',
					'trackback' => 'false',
					'orphanedImg' => 'true'
					);

			update_option( 'optimize-auto', $new_options );
		}

		// settings for main screen
		if ( get_option( 'optimize-cleanup-settings' ) !== false ) {
			// The option already exists, so we just update it.

		} else {
			// 'revisions', 'drafts', 'spams', 'unapproved', 'transient', 'postmeta', 'tags'
			$new_options_main = array(
					'user-postmeta' => 'true',
					'user-tags' => 'true',
					'user-revisions' => 'true',
					'user-drafts' => 'true',
					'user-PosPagTrash' => 'true',	
					'user-spamCmds' => 'true',
					'user-trashCmds' => 'true',
					'user-unapproved' => 'true',
					'user-pingback' => 'false',
					'user-trackback' => 'true',
					'user-orphanedImg' => 'true'
					);
			update_option( 'optimize-cleanup-settings', $new_options_main );
		}

	}


	public static function optimize_cron_action() {   

		$scheduledTime = get_option(NEXT_RUN);         
		$current_time = time();                          
		if($current_time >= $scheduledTime)
		{
			global $wpdb;
			//list ($retention_enabled, $retention_period) = wpo_getRetainInfo();

			self::optimize_debugLog('Starting optimize_cron_action()');
			if ( get_option(SCHEDULE_OPTION) == 'true') {

				$this_options = get_option('optimize-auto');
				// post page meta
				if ($this_options['postmeta'] == 'true'){

					$array_post_id = '';
					$get_post_id = $wpdb->get_results("select DISTINCT pm.post_id from wp_postmeta pm JOIN wp_posts wp on wp.ID = pm.post_id");
					foreach($get_post_id as $postID) {
						$array_post_id .= $postID->post_id . ',';
					}
					$array_post_id = substr($array_post_id, 0, -1);
					$wpdb->get_results("DELETE FROM wp_postmeta where post_id not in ($array_post_id)");
				}
				// unassigned tags
				if ($this_options['tags'] == 'true'){
					$wpdb->query("DELETE t,tt FROM  $wpdb->terms t INNER JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy='post_tag' AND tt.count=0");
				}      
				// revisions
				if ($this_options['revisions'] == 'true'){
					$wpdb->query("DELETE FROM $wpdb->posts WHERE post_type = 'revision'");
				}
				// auto drafts
				if ($this_options['drafts'] == 'true'){
					$wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'");
				}
				// trash posts
				if ($this_options['PosPagTrash'] == 'true'){
					$wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'trash'");
				}    
				// spam comments
				if ($this_options['spamCmds'] == 'true'){
					$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'spam'");
				}            
				// trashed comments
				if ($this_options['trashCmds'] == 'true'){

					$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'trash'");
				}    
				//unapproved commands
				if ($this_options['unapproved'] == 'true'){

					$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = '0'");
				}    
				//pingback
				if ($this_options['pingback'] == 'true'){

					$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_type = 'pingback'");
				}    
				//trackback
				if ($this_options['trackback'] == 'true'){

					$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_type = 'trackback'");
				}    
				//orphaned images
				if ($this_options['orphanedImg'] == 'true'){

					$wpdb->query("DELETE FROM $wpdb->posts WHERE post_parent = 0 AND post_type = 'attachment'");
				}    
				//db optimize part - optimize
				$mail_option = get_option(ENABLE_EMAIL);
				if ($mail_option == 'true'){

					$db_tables = $wpdb->get_results('SHOW TABLES',ARRAY_A);
					foreach ($db_tables as $table){
						$t = array_values($table);
						$wpdb->query("OPTIMIZE TABLE `".$t[0]."`");
						self::optimize_debugLog('optimizing .... '.$t[0]);
					}


					ob_start();
					$databaseSize = self::sm_opt_getCurrentDBSize();            
					$thistime = current_time( "timestamp", 0 );
					$thedate = gmdate(get_option('date_format') . ' ' . get_option('time_format'), $thistime );
					update_option( LAST_OPT, $thedate );
					self::optimize_updateTotalCleaned(strval($databaseSize));

					// Sending notification email
					if ( get_option( ENABLE_EMAIL ) !== false ) {
						//#TODO need to fix the problem with variable value not passing through
						if ( get_option( ENABLE_EMAIL_ADDRESS ) !== '' ) {
							self::optimize_sendEmail($thedate, $databaseSize);                     
						}

					}
					else{
						//
					}
					ob_end_flush();
				} // endif $this_options['optimize']  


				 $schedule_type = get_option(SCHEDULE_OPTION_TYPE, 'weekly');
 				 switch ($schedule_type) {

                                                case "daily":
                                                        //
                                                        $this_time = time() + 60*60*24;
                                                        break;

                                                case "weekly":
                                                        //
                                                        $this_time = time() +  60*60*24*7;
                                                        break;

                                                case "otherweekly":
                                                        //
                                                        $this_time = time() + 60*60*24*14;
                                                        break;

                                                case "monthly":
                                                        //
                                                        $this_time = time() + 60*60*24*31;
                                                        break;

                                                default:
                                                        $this_time = time() + 60*60*24*7;
                                                        break;

                                        }
					update_option(NEXT_RUN,$this_time);

			}	// end if ( get_option(OPTION_NAME_SCHEDULE) == 'true')
		}
	}
	public static function optimize_cron_deactivate() {  
		//wp_clear_scheduled_hook('wpo_cron_event');
		//self::optimize_debugLog('running optimize_cron_deactivate()');
		wp_clear_scheduled_hook('optimize_cron_event2');
	}
	// scheduler functions to update schedulers
	/*	public static function optimize_cron_update_sched( $schedules ) {
		$schedules['daily'] = array('interval' => 60*60*24, 'display' => 'Once Daily');
		$schedules['weekly'] = array('interval' => 60*60*24*7, 'display' => 'Once Weekly');
		$schedules['otherweekly'] = array('interval' => 60*60*24*14, 'display' => 'Once Every Other Week');
		$schedules['monthly'] = array('interval' => 60*60*24*31, 'display' => 'Once Every Month');
		return $schedules;
		}  */
	public static function optimize_debugLog($message) {
		if (WP_DEBUG === true) {
			if (is_array($message) || is_object($message)) {
				error_log(print_r($message, true));
			} else {
				error_log($message);
			}
		}
	}
	public static function optimize_removeOptions(){   

		delete_option( 'wp-optimize-weekly-schedule' );
		delete_option( SCHEDULE_OPTION );
		delete_option( LAST_OPT );
		delete_option( SCHEDULE_OPTION_TYPE );
		delete_option( TOTAL_CLEANED );
		delete_option( CURRENT_CLEANED );
		delete_option( ENABLE_EMAIL_ADDRESS );
		delete_option( ENABLE_EMAIL );
		delete_option( 'optimize-auto' );
		delete_option( 'optimize-cleanup-settings' );
		delete_option( 'LAST_RUN' );
		delete_option( 'NEXT_RUN' );

	}


	public static function optimize_updateTotalCleaned($current){
		$previously_saved = get_option(TOTAL_CLEANED,'0');
		$previously_saved = floatval($previously_saved);
		$converted_current = floatval($current);
		$total_now = $previously_saved + $converted_current;
		$total_now = strval($total_now);

		update_option(TOTAL_CLEANED, $total_now);
		update_option(CURRENT_CLEANED, $current);

		return $total_now;

	} // end of function optimize_updateTotalCleaned


	public static function optimize_sendEmail($date, $cleanedup){
		//
		ob_start();
		// #TODO this need to work on - currently not using the parameter values
		$myTime = current_time( "timestamp", 0 );
		$myDate = gmdate(get_option('date_format') . ' ' . get_option('time_format'), $myTime );

		if ( get_option( ENABLE_EMAIL_ADDRESS ) !== false ) {
			$targetMail = get_option( ENABLE_EMAIL_ADDRESS );
			$sendto = $targetMail;
		}
		else{
			$sendto = get_bloginfo ( 'admin_email' );
		}


		$subject = "Automatic Optimization has been Completed on".' ' .$myDate.'.';

		$msg  = "Scheduled optimization was executed on".' '.$myDate;
		//$msg .= __("Recovered space","wp-optimize").": ".$thiscleanup;
		$msg .= "\r\n";
		$msg .= "\r\n";
		$msg .= "Regards"."\r\n";
		$msg .="Optimize Plugin";
		wp_mail( $sendto, $subject, $msg );

		ob_end_flush();
	}
	public static function sm_opt_getCurrentDBSize(){
		global $wpdb;
		$total_size = 0;
		$data_usage = 0;
		$index_usage = 0;
		$tablesstatus = $wpdb->get_results("SHOW TABLE STATUS");


		foreach($tablesstatus as  $tablestatus) {
			$data_usage += $tablestatus->Data_length;
			$index_usage +=  $tablestatus->Index_length;

		}

		$total_size = $data_usage + $index_usage;


		return self::sm_opt_format_size($total_size);
	}



	public static function sm_opt_format_size($rawSize) {
		if($rawSize / 1073741824 > 1)
		{
			return number_format_i18n($rawSize/1073741824, 2) . ' '.__('GB', 'optimize');
		}
		else if ($rawSize / 1048576 > 1)
		{
			return number_format_i18n($rawSize/1048576, 1) . ' '.__('MB', 'optimize');
		}
		else if ($rawSize / 1024 > 1)
		{
			return number_format_i18n($rawSize/1024, 1) . ' '.__('KB', 'optimize');
		}
		else
		{
			return number_format_i18n($rawSize, 0) . ' '.__('bytes', 'optimize');
		}
	}

}
?>
