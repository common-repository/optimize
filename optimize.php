<?php
/*/******************************
    Plugin Name: Optimize
    Description: A plugin that helps to delete unwanted records in a wordpress site.
    Version:1.1.1 
    Author: smackcoders.com
    Plugin URI: http://www.smackcoders.com/
    Author URI: http://www.smackcoders.com/
   * filename: optimize.php
   */

if(!defined('ABSPATH'))
{
	die;   //Exit if accessed directly
}

function action_smack_opt_admin_menu() {
	add_submenu_page('tools.php',WP_CONST_SMACK_WP_OPT_SLUG,WP_CONST_SMACK_WP_OPT_NAME, '1','optimize','optimize_index');

}
add_action("admin_menu" , "action_smack_opt_admin_menu"); 



function optimize_index()
{


	if((isset($_REQUEST['view'])) && ($_REQUEST['view'] == 'optimizer')) {

		$options = run_db_optimizer();
		echo($options);
	} else if( (isset($_REQUEST['view']) && ($_REQUEST['view'] == 'include')) && (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'backup_database')) ) {
		require_once('include/database-backup.php');
	}else if(isset($_REQUEST['view']) && $_REQUEST['view'] == 'pieChart'){
		require_once('include/optimize_pie_chart.php');
	}else if( (isset($_REQUEST['view']) && ($_REQUEST['view'] == 'include')) && (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'settings')) ) {
		require_once('include/optimize_schedular_settings.php');
	}else {
		require_once('include/optimize_pie_chart.php');
	}
}


require_once('include/optimize_schedular_helper.php');
//add_action('optimize_cron_event2', array('OptimizeScheduleHelper','optimize_cron_action'));
//add_filter('cron_schedules', array('OptimizeScheduleHelper','optimize_cron_update_sched'));


register_activation_hook( __FILE__, array('OptimizeScheduleHelper','optimize_plugin_activate' ));
register_deactivation_hook(__FILE__,array('OptimizeScheduleHelper','optimize_plugin_deactivate'));


$dir = plugin_dir_path( __FILE__ ); 
define('WP_CONST_SMACK_WP_OPT_NAME', 'optimize');
define('WP_CONST_SMACK_WP_OPT_SLUG', 'optimize');
define('WP_CONST_SMACK_WP_OPT_URL', WP_PLUGIN_URL . '/' . WP_CONST_SMACK_WP_OPT_SLUG . '/');
define('WP_CONST_SMACK_WP_OPT_DIR', $dir);

if (! defined('SCHEDULE_OPTION'))
define('SCHEDULE_OPTION', 'optimize-schedule');

if (! defined('SCHEDULE_OPTION_TYPE'))
define('SCHEDULE_OPTION_TYPE', 'optimize-schedule-type');
if (! defined('ENABLE_EMAIL_ADDRESS'))
define('ENABLE_EMAIL_ADDRESS', 'optimize-email-address');

if (! defined('ENABLE_EMAIL'))
define('ENABLE_EMAIL', 'optimize-email');

if (! defined('LAST_OPT'))
define('LAST_OPT', 'optimize-last-optimized');

if (! defined('TOTAL_CLEANED'))
define('TOTAL_CLEANED', 'optimize-total-cleaned');

if (! defined('CURRENT_CLEANED'))
define('CURRENT_CLEANED', 'optimize-current-cleaned');

if (! defined('LAST_RUN'))
define('LAST_RUN', 'optimize-last-run');

if (! defined('NEXT_RUN'))
define('NEXT_RUN', 'optimize-next-run');



function OptimizeScripts() {
	if (isset($_REQUEST['page']) && (sanitize_text_field($_REQUEST['page']) == 'optimize')) {
	wp_register_script('optimize_min_js',plugins_url('JS/jquery.min.js',__FILE__));
	wp_register_script('optimize_my_js',plugins_url('JS/optimize.js',__FILE__));
	wp_register_script('optimize_modal_js',plugins_url('JS/modal.js',__FILE__));
	wp_register_script('optimize_piechart_js',plugins_url('JS/piechart.js',__FILE__));              
	wp_enqueue_style('optimize_bootstrap-select', plugins_url('css/bootstrap-select.css', __FILE__));
	wp_enqueue_style('optimize_bootstrap-switch', plugins_url('css/bootstrap-switch.css', __FILE__));	
	wp_enqueue_style('optimize_bootstrap-dialog', plugins_url('css/bootstrap-dialog.css', __FILE__));
	wp_enqueue_style('optimize_bootstrap-dialog.min', plugins_url('css/bootstrap-dialog.min.css', __FILE__));
	wp_enqueue_style('optimize_bootstrap-css', plugins_url('css/bootstrap.css', __FILE__));
	wp_enqueue_style('optimize_jq_ui_css', plugins_url('css/jquery-ui.css', __FILE__));
	wp_enqueue_style('optimize_bootstrap-checkbox', plugins_url('css/bootstrap-checkbox.css', __FILE__));
	//wp_enqueue_style('sm-core-css', plugins_url('css/sm-core-css.css', __FILE__));	
	//wp_enqueue_style('sm-blue', plugins_url('css/sm-blue.scss', __FILE__));
	//wp_enqueue_style('optimize_bootstrap.min', plugins_url('css/bootstrap.min.css', __FILE__));	
	//wp_enqueue_script('optimize_min_js');
	wp_enqueue_script('optimize_my_js'); 
	wp_enqueue_script('optimize_modal_js');
	wp_enqueue_script('optimize_piechart_js');
	//wp_enqueue_script('jquery.smartmenus', plugins_url('JS/jquery.smartmenus.js', __FILE__));
	wp_enqueue_script('optimize_bootstrap-checkbox', plugins_url('JS/bootstrap-checkbox.js', __FILE__)); //not working
	wp_enqueue_script('optimize_bootstrap.min', plugins_url('JS/bootstrap.min.js', __FILE__));	
	wp_enqueue_script('optimize_bootstrap-select.min', plugins_url('JS/bootstrap-select.min.js', __FILE__));	
	wp_enqueue_script('optimize_bootstrap-select', plugins_url('JS/bootstrap-select.js', __FILE__));
	wp_enqueue_script('optimize_bootstrap-switch', plugins_url('JS/bootstrap-switch.js', __FILE__));
	wp_enqueue_script('optimize_high_chart', plugins_url('JS/highcharts.js', __FILE__));
	wp_enqueue_script('optimize_data', plugins_url('JS/data.js', __FILE__));
	wp_enqueue_script('optimize_drilldown', plugins_url('JS/drilldown.js', __FILE__));
	wp_enqueue_script('optimize_bootstrap-dialog', plugins_url('JS/bootstrap-dialog.js', __FILE__));
	wp_enqueue_script('optimize_bootstrap-dialog.min', plugins_url('JS/bootstrap-dialog.min.js', __FILE__));
	}


}
add_action('admin_init','OptimizeScripts');



require_once('include/optimize_helper.php');

function run_db_optimizer()
{
	$opt = new OptimizeHelper();
	$opt->optimize_run_db_optimizer();
}

function show_record_size()
{ 
	$opt = new OptimizeHelper();
	$opt->optimize_show_record_size();
}
add_action('wp_ajax_show_record_size' , 'show_record_size');

function opt_dboptimizer() {  
	$opt = new OptimizeHelper();
	$opt->optimize_dboptimizer();
}
add_action('wp_ajax_opt_dboptimizer','opt_dboptimizer');

function countBased_chart() { 
	$opt = new OptimizeHelper();
	$opt->optimize_countBased_chart();
}
add_action('wp_ajax_countBased_chart' , 'countBased_chart');

function sizeBased_chart() {
	$opt = new OptimizeHelper();
	$opt->optimize_sizeBased_chart();
}
add_action('wp_ajax_sizeBased_chart' , 'sizeBased_chart');  
function optimize_default_chart() {
	$opt = new OptimizeHelper();
	$opt->optimize_default_duplicate_chart();
}
add_action('wp_ajax_optimize_default_chart' , 'optimize_default_chart'); 

function optimize_check_DB() {   
	$opt = new OptimizeHelper();
	$opt->optimize_check_DBEntry();
}
add_action('wp_ajax_optimize_check_DB' , 'optimize_check_DB'); 
?>
