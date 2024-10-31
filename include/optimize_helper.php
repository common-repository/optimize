<?php
class OptimizeHelper
{


	public function optimize_run_db_optimizer() { 
		echo "<head>";
		echo "<style>";
		echo "tr {";
		echo  "line-height: 25px;";
		echo  "min-height: 25px;";
		echo  " height: 50px;";
		echo "}";
		echo "h3 {";
		echo "padding-bottom: 15px;}";
		echo "#submit {";
		echo "font-size:18px;color:black}";
		echo "#one,#two,#three,#four,#five,#six,#seven,#eight,#nine,#ten,#eleven{";
		echo "display:none;font-size:15px}";
		echo "#backup_delete,#drillStats,#choose_chart{display:none;}";
		echo "#dbsize_detail{";
		echo "padding-left:200px; margin-top:100px; }";
		echo "#show_size label{";
		echo "font-weight:bold}";
		echo "</style>";
		echo "</head>";



		echo "<nav class='navbar navbar-inverse'>";
		echo "<div style='padding-right:15px;'>";
		echo "<ul class='nav navbar-nav'>";
		echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=pieChart >Home</a></li>";
		echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=backup_database > Backup DB </a></li>";
		echo "<li class = 'active'><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=optimizer> Clean-up DB </a></li>";
		echo "<li><a href=". get_admin_url() .'tools.php?page='.WP_CONST_SMACK_WP_OPT_SLUG."&view=include&action=settings > Auto Schedule Settings </a></li>";
		echo "</ul>";
		echo "</div>";

		echo "</nav>";

		echo "<div class='container' id ='topcontainer' style='background-color:white; margin-left:0px; width:98%; '>"; // page with set of checkboxes

		echo "<div class='container' id = 'header' style='margin-left:0px;'>";


		echo "<h3>  Optimize Database </h3>";
		echo "<p style='display:inline'>";
		echo "<a id='checkOpt' href='#' onclick='check_uncheck(this.id);' title='Check All'> Check All </a>";
		echo "/";
		echo "<a id='uncheckOpt' href='#' onclick='check_uncheck(this.id);' title='Check All'> Uncheck All </a>";

		echo "</p>";
		echo "</div>";

		echo "<br><br>";
		echo "<form name='smack' role='form' id='smack' method='post' action=''>";   

		echo "<table class='table table-hover'>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_orphaned_post_page_meta' name='delete_all_orphaned_post_page_meta' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_orphaned_post_page_meta'><strong>Delete all orphaned Post/Page Meta</strong></label>";

		echo "</td>";
		echo  "<td>";
		echo "<input type='checkbox' id='delete_all_unassigned_tags' name='delete_all_unassigned_tags' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_unassigned_tags'><strong>Delete all unassigned tags</strong></label>";

		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo " <td>";
		echo  "<input type='checkbox' id='delete_all_post_page_revisions' name='delete_all_post_page_revisions' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_post_page_revisions'><strong>Delete all Post/Page revisions</strong></label>";

		echo "</td>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_auto_draft_post_page' name='delete_all_auto_drafted_post_page' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_auto_draft_post_page'><strong>Delete all auto drafted Post/Page</strong></label>";

		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_post_page_in_trash' name='delete_all_post_page_in_trash' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_post_page_in_trash'><strong>Delete all Post/Page in trash</strong></label>";
		echo "</td>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_spam_comments' name='delete_all_spam_comments' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_spam_comments'><strong>Delete all Spam Comments</strong></label>";
		echo "<td>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_comments_in_trash' name='delete_all_comments_in_trash' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_comments_in_trash'><strong>Delete all Comments in trash</strong></label>";

		echo "</td>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_unapproved_comments' name='delete_all_unapproved_comments' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_unapproved_comments'><strong>Delete all Unapproved Comments</strong></label>";

		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_pingback_comments' name='delete_all_pingback_comments' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_pingback_comments'><strong>Delete all Pingback Comments</strong></label>";

		echo "</td>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_trackback_comments' name='delete_all_trackback_comments' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_trackback_comments'><strong>Delete all Trackback Comments</strong></label>";

		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='checkbox' id='delete_all_orphaned_images' name='delete_all_orphaned_images' />";
		echo "</td>";
		echo "<td>";
		echo "<label for='delete_all_orphaned_images'><strong>Delete all orphaned Images </strong></label>";

		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo"<td></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td></td>";echo "<td></td>";echo "<td></td>";
		echo "<td>";
		echo "<input type='button' name='submit' value='Run DB Optimizer' id='submit'  class='rundbopt btn-primary'  onclick='databaseoptimization()' />";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "<input type='hidden' id='tmpLoc' name='tmpLoc' value='<?php echo WP_CONST_SMACK_WP_OPT_URL; ?>'  />";
		echo "</form>";
		echo "</div>";

		echo "<div id='all_details' style='display:none; width:98%;'>";	


		echo "<div class='container' id='show_size' style='margin-left:0; background-color:white; height:500px; width:100%;overflow:auto;'>";
		echo "<div class = 'container' id = 'recordsize_details' style='float:left; display:inline; width:650px;  height:500px; padding-top:0px; '>";
		echo "<div id='one'>";
		echo "<label> Space occupied by orphaned Post/Page Meta</label><div id='orphaned'></div><button id='btn1' class='btn btn-primary' onclick='proceed_deletion(1)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='two'>";
		echo "<label>Space occupied by unassigned tags</label><div id='unassignedTags'></div><button id='btn2' class='btn btn-primary' onclick='proceed_deletion(2)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='three'>";
		echo "<label> Space occupied by Post/Page revisions</label><div id='postpagerevisions'></div><button id='btn3' class='btn btn-primary' onclick='proceed_deletion(3)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='four'>";
		echo "<label>Space occupied by auto drafted Post/Page</label><div id='autodraftedpostpage'></div><button id='btn4' class='btn btn-primary' onclick='proceed_deletion(4)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='five'>";
		echo "<label> Space occupied by Post/Page in trash</label><div id='postpagetrash'></div><button id='btn5' class='btn btn-primary' onclick='proceed_deletion(5)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='six'>";
		echo "<label>Space occupied by Spam Comments</label><div id='spamcomments'></div><button id='btn6' class='btn btn-primary' onclick='proceed_deletion(6)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='seven'>";
		echo "<label> Space occupied by Comments in trash</label><div id='trashedcomments'></div><button id='btn7' class='btn btn-primary' onclick='proceed_deletion(7)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='eight'>";
		echo "<label>Space occupied by Unapproved Comments</label><div id='unapprovedcomments'></div><button id='btn8' class='btn btn-primary' onclick='proceed_deletion(8)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='nine'>";
		echo "<label>Space occupied by Pingback Comments</label><div id='pingbackcomments'></div><button id='btn9' class='btn btn-primary' onclick='proceed_deletion(9)'>Delete</button>";
		echo "<br><br>";
		echo "</div>"; 

		echo "<div id='ten'>";
		echo "<label>Space occupied by Trackback Comments</label><div id='trackbackcomments'></div><button id='btn10' class='btn btn-primary' onclick='proceed_deletion(10)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";

		echo "<div id='eleven'>";
		echo "<label>Space occupied by orphaned Images </label><div id='orphanedimages'></div><button id='btn11' class='btn btn-primary' onclick='proceed_deletion(11)'>Delete</button>";
		echo "<br><br>";
		echo "</div>";
		echo "</div>";
		echo "<div id='dbsize_detail' style='float:left; display:inline; width:600px; height:500px; padding-top:0px;'><div class='alert alert-info'><p style='font-weight: bold; font-size:15px; color:red'  >DB Size = ".$this->sm_opt_getCurrentDBSize()."</p></div></div>";
		echo "</div>";


		$uploadDir = wp_upload_dir();
		$dir_logfile = $uploadDir['basedir'] . '/optimize';    
		if(!is_dir($dir_logfile)) {
			wp_mkdir_p($dir_logfile);
		}
		$logfilename =$uploadDir['baseurl'] . '/' . 'optimize/optimizelog'. '.log';
		if(isset($logfilename))  
		{ 
			$filename =$uploadDir['basedir'] . '/' . 'optimize/optimizelog'. '.log';
			file_put_contents("$filename", "");
			echo "<span id='dwnld_log_link' style='display:none;padding-top:10px;'>";
			echo "<a href= $logfilename download id='dwnldlog' name='dwnldlog' style='margin-left:5px;font-size:15px;'> CLICK HERE TO DOWNLOAD LOG</a>";
			echo "</span>";	
		} 



		echo " <div id='optimizelog' class='container'  style='margin-top:35px;display:none; width:100%; margin-left:0px; background:white;'>";
		echo   "<div style='background-color:black; color:white; padding-top:1px;padding-bottom:1px;'>   <h4>Database Optimization Log - ".WP_CONST_SMACK_WP_OPT_SLUG."</h4></div>";
		echo  "<div id='optimizationlog' class='optimizerlog' style=' height:300px;  overflow:auto;'>";
		echo "<div id='log' class='log'>";
		echo " <p style='margin:15px;color:red;' id='align'>NO LOGS YET NOW.-".WP_CONST_SMACK_WP_OPT_SLUG." </p>";
		echo "</div>";
		echo  "</div>";
		echo "</div>";
		echo"</div>";
	}

	public function optimize_show_record_size()
	{

		$size = array();


		if($_POST['orphaned'] == 1) {        
			$size['orphaned']=$this->size_orphaned();	
		}  



		if($_POST['unassignedTags'] == 1) {

			$size['unassignedTags']=$this->size_unassignedTags();	

		}  


		if($_POST['postpagerevisions'] == 1) {
			$size['postpagerevisions']=$this->size_postpagerevisions();	
		}    
		if($_POST['autodraftedpostpage'] == 1) {
			$size['autodraftedpostpage']=$this->size_autodraftedpostpage();	
		}
		if($_POST['postpagetrash'] == 1) {

			$size['postpagetrash']=$this->size_postpagetrash();	
		}
		if($_POST['spamcomments'] == 1) {
			$size['spamcomments']=$this->size_spamcomments();	
		}


		if($_POST['trashedcomments'] == 1) {
			$size['trashedcomments']=$this->size_trashedcomments();	
		}


		if($_POST['unapprovedcomments'] == 1) {
			$size['unapprovedcomments']=$this->size_unapprovedcomments();	
		}

		if($_POST['pingbackcomments'] == 1) {
			$size['pingbackcomments']=$this->size_pingbackcomments();	
		} 


		if($_POST['trackbackcomments'] == 1) {
			$size['trackbackcomments']=$this->size_trackbackcomments();	
		}

		if($_POST['orphanedimages'] == 1) {
			$size['orphanedimages']=$this->size_orphanedimages();	
		}           
		echo json_encode($size);die;

	}




	function size_orphaned()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns1=array();
		$concat1='';
		$array_post_id = '';
		$get_post_id = $wpdb->get_results("select DISTINCT pm.post_id from wp_postmeta pm JOIN wp_posts wp on wp.ID = pm.post_id");
		foreach($get_post_id as $postID) {
			$array_post_id .= $postID->post_id . ',';
		}
		$array_post_id = substr($array_post_id, 0, -1);    
		$columns1 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_postmeta'",ARRAY_A);
		foreach($columns1 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat1 .= "char_length($v),";



			}
		}
		$str1 =  rtrim($concat1 , ',');

		$string1 = str_replace(",","+",$str1);     
		$query1 = $wpdb->get_results("select $string1 from wp_postmeta where post_id not in ($array_post_id)",ARRAY_A);    
		$total1 = 0;
		foreach($query1 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total1 = $total1 + $val;
			}
		}
		return $this->sm_opt_format_size($total1); 
	}

	function size_unassignedTags()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns2a=$columns2b=array();
		$concat2a=$concat2b='';
		$columns2a = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_terms'",ARRAY_A);



		foreach($columns2a as $key => $value)
		{
			foreach($value as $k => $v)
			{
				$concat2a .= "char_length($v),";
			}
		}
		$str2a =  rtrim($concat2a , ',');
		$string2a = str_replace(",","+",$str2a);         
		$r=str_replace("(","(t.",$string2a);    
		$columns2b = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_term_taxonomy'",ARRAY_A);

		foreach($columns2b as $key => $value)
		{
			foreach($value as $k => $v)
			{
				$concat2b .= "char_length($v),";
			}
		}
		$str2b =  rtrim($concat2b , ',');
		$string2b = str_replace(",","+",$str2b);          
		$r1=str_replace("(","(tt.",$string2b);  

		$string2=$r.'+'.$r1; 

		$query2 = $wpdb->get_results("select $string2  FROM  $wpdb->terms t INNER JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE (tt.taxonomy='post_tag') AND (tt.count=0)",ARRAY_A);                                                 

		$total2 = 0;
		foreach($query2 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total2 = $total2 + $val;
			}
		}
		return $this->sm_opt_format_size($total2); 

	}

	function size_postpagerevisions()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns3=array();
		$concat3='';
		$columns3 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_posts'",ARRAY_A);
		foreach($columns3 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat3 .= "char_length($v),";


			}
		}
		$str3 =  rtrim($concat3 , ',');
		$string3 = str_replace(",","+",$str3);   
		$query3 = $wpdb->get_results("select $string3 from wp_posts  WHERE post_type = 'revision'",ARRAY_A);
		$total3 = 0;
		foreach($query3 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total3 = $total3 + $val;
			}
		}


		return $this->sm_opt_format_size($total3); 
	}

	function size_autodraftedpostpage()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns4=array();
		$concat4='';
		$columns4 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_posts'",ARRAY_A);
		foreach($columns4 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat4 .= "char_length($v),";


			}
		}
		$str4 =  rtrim($concat4 , ',');
		$string4 = str_replace(",","+",$str4);   
		$query4 = $wpdb->get_results("select $string4 from wp_posts  WHERE post_status = 'auto-draft'",ARRAY_A);
		$total4 = 0;
		foreach($query4 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total4 = $total4 + $val;
			}
		}


		return $this->sm_opt_format_size($total4); 
	}

	function size_postpagetrash()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns5=array();
		$concat5='';
		$columns5 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_posts'",ARRAY_A);
		foreach($columns5 as $key => $value)
		{
			foreach($value as $k => $v)
			{
				$concat5 .= "char_length($v),";
			}
		}
		$str5 =  rtrim($concat5 , ',');    
		$string5 = str_replace(",","+",$str5);   
		$query5 = $wpdb->get_results("select $string5 from wp_posts  WHERE post_status = 'trash'",ARRAY_A);
		$total5 = 0;
		foreach($query5 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total5 = $total5 + $val;
			}
		}
		return $this->sm_opt_format_size($total5); 
	}

	function size_spamcomments()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns6=array();
		$concat6='';
		$columns6 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_comments'",ARRAY_A);
		foreach($columns6 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat6 .= "char_length($v),";


			}
		}
		$str6 =  rtrim($concat6 , ',');
		$string6 = str_replace(",","+",$str6);   
		$query6 = $wpdb->get_results("select $string6 from wp_comments  WHERE comment_approved = 'spam'",ARRAY_A);
		$total6 = 0;
		foreach($query6 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total6 = $total6 + $val;
			}
		}


		return $this->sm_opt_format_size($total6); 
	}

	function size_trashedcomments()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns7=array();
		$concat7='';
		$columns7 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_comments'",ARRAY_A);
		foreach($columns7 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat7 .= "char_length($v),";


			}
		}
		$str7 =  rtrim($concat7 , ',');
		$string7 = str_replace(",","+",$str7);   
		$query7 = $wpdb->get_results("select $string7 from wp_comments  WHERE comment_approved = 'trash'",ARRAY_A);
		$total7 = 0;
		foreach($query7 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total7 = $total7 + $val;
			}
		}


		return $this->sm_opt_format_size($total7); 
	}

	function size_unapprovedcomments()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns8=array();
		$concat8='';
		$columns8 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_comments'",ARRAY_A);
		foreach($columns8 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat8 .= "char_length($v),";


			}
		}
		$str8 =  rtrim($concat8 , ',');
		$string8 = str_replace(",","+",$str8);   
		$query8 = $wpdb->get_results("select $string8 from wp_comments WHERE comment_approved = '0'",ARRAY_A);
		$total8 = 0;
		foreach($query8 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total8 = $total8 + $val;
			}
		}


		return $this->sm_opt_format_size($total8); 
	}

	function size_pingbackcomments()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns9=array();
		$concat9='';
		$columns9 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_comments'",ARRAY_A);
		foreach($columns9 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat9 .= "char_length($v),";


			}
		}
		$str9 =  rtrim($concat9 , ',');
		$string9 = str_replace(",","+",$str9);   
		$query9 = $wpdb->get_results("select $string9 from wp_comments  WHERE comment_type = 'pingback'",ARRAY_A);
		$total9 = 0;
		foreach($query9 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total9 = $total9 + $val;
			}
		}

		return $this->sm_opt_format_size($total9); 

	}

	function size_trackbackcomments()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns10=array();
		$concat10='';
		$columns10 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_comments'",ARRAY_A);
		foreach($columns10 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat10 .= "char_length($v),";


			}
		}
		$str10 =  rtrim($concat10 , ',');
		$string10 = str_replace(",","+",$str10);   
		$query10 = $wpdb->get_results("select $string10 from wp_comments  WHERE comment_type = 'trackback'",ARRAY_A);
		$total10 = 0;
		foreach($query10 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total10 = $total10 + $val;
			}
		}


		return $this->sm_opt_format_size($total10); 
	}

	function size_orphanedimages()
	{
		global $wpdb;
		$dbname = $wpdb->dbname;
		$columns11=array();
		$concat11='';
		$columns11 = $wpdb->get_results("select column_name from information_schema.columns where table_schema='$dbname' and table_name='wp_posts'",ARRAY_A);
//echo "<pre>"; print_r( $columns11); die;
		foreach($columns11 as $key => $value)
		{
			foreach($value as $k => $v)
			{



				$concat11 .= "char_length($v),";


			}
		}
		$str11 =  rtrim($concat11 , ',');
		$string11 = str_replace(",","+",$str11);   
		$query11 = $wpdb->get_results("select $string11 from wp_posts   WHERE post_parent = 0 AND post_type = 'attachment'",ARRAY_A);
		$total11 = 0;
		foreach($query11 as $index=>$value)	{
			foreach($value as $key=> $val){
				$total11 = $total11 + $val;
			}
		}

		return $this->sm_opt_format_size($total11); 

	}


	function sm_opt_getCurrentDBSize(){
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


		return $this->sm_opt_format_size($total_size);
	}



	function sm_opt_format_size($rawSize) {   
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



	public function optimize_dboptimizer() { 

		global $wpdb;
		$affected_rows = array('orphaned' => 'non_affected', 'unassignedTags' => 'non_affected', 'postpagerevisions' => 'non_affected', 'autodraftedpostpage' => 'non_affected', 'postpagetrash' => 'non_affected', 'spamcomments' => 'non_affected', 'trashedcomments' => 'non_affected', 'unapprovedcomments' => 'non_affected', 'pingbackcomments' => 'non_affected', 'trackbackcomments' => 'non_affected' , 'orphanedimages' => 'non_affected', 'updateddbsize' => '', 'imagecount' => '');
		$orphimg_path = array();

		require_once('optimize_log.php');
		$log = new OptimizeLogging();
		$uploadDir = wp_upload_dir();     

		$filename =$uploadDir['basedir'] . '/' . 'optimize/optimizelog'. '.log';

		$log->lfile("$filename");
		$dt= new DateTime();
		$deleted_on= $dt->format('Y-m-d H:i:s');      
		$year= $dt->format('Y');
		$month= $dt->format('m');     

		if($_POST['orpha'] == 1) {
			$orpha_size=$this->size_orphaned();
			$orpha_type='orphapospagmeta';

			$array_post_id = '';
			$get_post_id = $wpdb->get_results("select DISTINCT pm.post_id from wp_postmeta pm JOIN wp_posts wp on wp.ID = pm.post_id");
			foreach($get_post_id as $postID) {
				$array_post_id .= $postID->post_id . ',';
			}
			$array_post_id = substr($array_post_id, 0, -1);
			$get_post_meta_id = $wpdb->get_results("DELETE FROM wp_postmeta where post_id not in ($array_post_id)");
			$affected_rows['orphaned'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['orphaned'] . ") no of Orphaned Post/Page meta has been removed.");
			$orpha_count= $affected_rows['orphaned'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$orpha_type}','{$deleted_on}','{$orpha_count}','{$orpha_size}')");


		} 
		if($_POST['unasstag'] == 1) {
			$unasstag_size=$this->size_unassignedTags();
			$unasstag_type='unasstag';

			$wpdb->query("DELETE t,tt FROM  $wpdb->terms t INNER JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy='post_tag' AND tt.count=0");
			$affected_rows['unassignedTags'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['unassignedTags'] . ") no of Unassigned tags has been removed.");
			$unasstag_count= $affected_rows['unassignedTags'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$unasstag_type}','{$deleted_on}','{$unasstag_count}','{$unasstag_size}')");



		}
		if($_POST['pospagrev'] == 1) {
			$pospagrev_size=$this->size_postpagerevisions();
			$pospagrev_type='pospagrev';
			$wpdb->query("DELETE FROM $wpdb->posts WHERE post_type = 'revision'");
			$affected_rows['postpagerevisions'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['postpagerevisions'] . ") no of Post/Page revisions has been removed.");
			$pospagrev_count= $affected_rows['postpagerevisions'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$pospagrev_type}','{$deleted_on}','{$pospagrev_count}','{$pospagrev_size}')");


		}
		if($_POST['autopospag'] == 1) {
			$autopospag_size=$this->size_autodraftedpostpage();
			$autopospag_type='autopospag';
			$wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'");
			$affected_rows['autodraftedpostpage'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['autodraftedpostpage'] . ") no of Auto drafted Post/Page has been removed.");
			$autopospag_count= $affected_rows['autodraftedpostpage'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$autopospag_type}','{$deleted_on}','{$autopospag_count}','{$autopospag_size}')");


		}
		if($_POST['pospagtrash'] == 1) {
			$pospagtrash_size=$this->size_postpagetrash(); 
			$pospagtrash_type='pospagtrash';



			$wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'trash'");
			$affected_rows['postpagetrash'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['postpagetrash'] . ") no of Post/Page in trash has been removed.");
			$pospagtrash_count= $affected_rows['postpagetrash'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$pospagtrash_type}','{$deleted_on}','{$pospagtrash_count}','{$pospagtrash_size}')");


		}
		if($_POST['spmcmds'] == 1) {
			$spmcmds_size=$this->size_spamcomments();
			$spmcmds_type='spmcmds';
			$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'spam'");
			$affected_rows['spamcomments'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['spamcomments'] . ") no of Spam comments has been removed.");
			$spmcmds_count= $affected_rows['spamcomments'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$spmcmds_type}','{$deleted_on}','{$spmcmds_count}','{$spmcmds_size}')");


		}
		if($_POST['trashcmds'] == 1) {
			$trashcmds_size=$this->size_trashedcomments();
			$trashcmds_type='trashcmds';
			$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = 'trash'");
			$affected_rows['trashedcomments'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['trashedcomments'] . ") no of Comments in trash has been removed.");
			$trashcmds_count= $affected_rows['trashedcomments'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$trashcmds_type}','{$deleted_on}','{$trashcmds_count}','{$trashcmds_size}')");



		}
		if($_POST['unappcmds'] == 1) {
			$unappcmds_size=$this->size_unapprovedcomments();
			$unappcmds_type='unappcmds';
			$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_approved = '0'");
			$affected_rows['unapprovedcomments'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['unapprovedcomments'] . ") no of  Unapproved comments has been removed.");
			$unappcmds_count= $affected_rows['unapprovedcomments'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$unappcmds_type}','{$deleted_on}','{$unappcmds_count}','{$unappcmds_size}')");


		}
		if($_POST['pingback'] == 1) {
			$pingback_size=$this->size_pingbackcomments();
			$pingback_type='pingcmds';
			$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_type = 'pingback'");
			$affected_rows['pingbackcomments'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['pingbackcomments'] . ") no of Pingback comments has been removed.");
			$pingback_count= $affected_rows['pingbackcomments'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$pingback_type}','{$deleted_on}','{$pingback_count}','{$pingback_size}')");


		}
		if($_POST['trackback'] == 1) {
			$trackback_size=$this->size_trackbackcomments();
			$trackback_type='trackcmds';
			$wpdb->query("DELETE FROM $wpdb->comments WHERE comment_type = 'trackback'");
			$affected_rows['trackbackcomments'] = $wpdb->rows_affected;
			$log->lwrite( "(" . $affected_rows['trackbackcomments'] . ") no of Trackback comments has been removed.");
			$trackback_count= $affected_rows['trackbackcomments'];
			$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$trackback_type}','{$deleted_on}','{$trackback_count}','{$trackback_size}')");


		}
		if($_POST['orphimg'] == 1) {
			$orphimg_size=$this->size_orphanedimages();
			$orphimg_type='orphanedimg';
			$orphimg_url=$wpdb->get_results("select guid FROM $wpdb->posts WHERE post_parent = 0 AND post_type = 'attachment'",ARRAY_A);

			$uploads_path_array = $image_explode = $img_path_array = array();
			foreach($orphimg_url as $url_key=>$url_value)
			{
				foreach($url_value as $u_key => $url)

				{ 					   
					$upload_dir = wp_upload_dir();                    
					$uploaddir_path=$upload_dir['path'];      

					$uploads_path_array=explode("/",$uploaddir_path);             
					$uploads_path_length = count($uploads_path_array);
					unset($uploads_path_array[$uploads_path_length-1]); unset($uploads_path_array[$uploads_path_length-2]);      
					$path_upto_uploads = implode('/',$uploads_path_array); 
					$parse=(parse_url($url));
					$img_path_array = explode("/",$parse['path']); 
					$path_length= count($img_path_array);  
					$image=$img_path_array[$path_length-1];
					$month=$img_path_array[$path_length-2];
					$year=$img_path_array[$path_length-3];
					$img_path_frm_year=$year.'/'.$month.'/'.$image;  



					$orphimg_path= $path_upto_uploads.'/'.$img_path_frm_year;  // echo($img_path_frm_year);   
					$img_mem_size=filesize($orphimg_path); 
					$img_size=$this->sm_opt_format_size($img_mem_size); 
					$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,size,image_name) values('{$month}','{$year}','{$orphimg_type}','{$deleted_on}','{$img_size}','{$filename}')");
					if(file_exists($orphimg_path))
					{ // echo($orphimg_path);
						unlink($orphimg_path);  
					}
					
			}
		}
		$s = $folders_in_uploads = $scan_images = array();
		$id=$wpdb->get_results("select ID FROM $wpdb->posts WHERE post_parent = 0 AND post_type = 'attachment'",ARRAY_A);
		foreach($id as $a => $a1){
			foreach($a1 as $b =>$b1){

				$s=wp_get_attachment_metadata($b1);          //  echo "<pre>"; print_r($s); die("dd");
				$arr1=@$s['sizes']['thumbnail']['file']; 
				$arr2=@$s['sizes']['large']['file'];
				$arr3=@$s['sizes']['medium']['file'];
				$arr4=@$s['sizes']['post-thumbnail']['file'];
				$sizes=array($arr1,$arr2,$arr3,$arr4);        
				foreach($sizes as $index =>  $size1)                    
				{  

					$upload_dir = wp_upload_dir();                    
					$uploaddir_path=$upload_dir['path'];      
					//echo strstr($uploaddir_path, 'uploads');    die("oh");
					$uploads_path_array=explode("/",$uploaddir_path);             
					$uploads_path_length = count($uploads_path_array);
					unset($uploads_path_array[$uploads_path_length-1]); unset($uploads_path_array[$uploads_path_length-2]);      
					$path_upto_uploads = implode('/',$uploads_path_array);              
					$image_url = wp_get_attachment_url($b1);  

					$image_explode = explode("/",$image_url);
					$length = count($image_explode);
					$img_year_month=$image_explode[$length-3].'/'.$image_explode[$length-2];   


					$orphimages_path= $path_upto_uploads.'/'.$img_year_month.'/'.$size1;      //echo($orphimages_path);     

					if($size1 != '') 	{                    
						if(file_exists($orphimages_path))
						{ //  echo($orphimages_path);
							unlink($orphimages_path); 
						}
					}

				}
			}
		}


		$img_arr = array();
		$imgpath = array();
		$get_orphanedimg= $wpdb->get_results("select count(*) as orphanedimg  FROM $wpdb->posts WHERE post_parent = 0 AND post_type = 'attachment'");
		$imgcount =$get_orphanedimg[0]->orphanedimg;    
		$affected_rows['imagecount'] = $orphimg_count = $imgcount;
		$wpdb->query("insert into optimize_status_log(month,year,record_type,deleted_on,no_of_records,size) values('{$month}','{$year}','{$orphimg_type}','{$deleted_on}','{$orphimg_count}','{$orphimg_size}')");

		foreach($id as $id_index => $id_value){   
			foreach($id_value as $id_ind =>$id_val){            

				$img_arr=wp_get_attachment_metadata($id_val);    

				$wpdb->query("DELETE FROM $wpdb->posts WHERE post_parent = 0 AND post_type = 'attachment' AND ID= $id_val");
				$imgpath = explode("/",$img_arr['file']);  

				$affected_rows['orphanedimages'.$id_index] = $imgpath[2];
				$log->lwrite(  $affected_rows['orphanedimages'.$id_index] . " has been removed.");

			}
		}                                     

	}
	$dbsize = $this->sm_opt_getCurrentDBSize();
	$affected_rows['updateddbsize'] = $dbsize;		


	echo json_encode($affected_rows);die;

}


	public function optimize_default_duplicate_chart() {  

#Default values for chart when optimize_status_log table doesn't exists.
# This chart contains duplicate values.

		$pieDefaultValues = $drillDefaultValues = $chartDefaultValues = array();

		$pieDefaultValues[0]['name']='orphaned post page meta';
		$pieDefaultValues[0]['y']=10;
		$pieDefaultValues[0]['drilldown']='orphaned post page meta';
		$pieDefaultValues[1]['name']='unassigned tags';
		$pieDefaultValues[1]['y']=10;
		$pieDefaultValues[1]['drilldown']= 'unassigned tags';
		$pieDefaultValues[2]['name']='post page revision';
		$pieDefaultValues[2]['y']=10;
		$pieDefaultValues[2]['drilldown']= 'post page revision';
		$pieDefaultValues[3]['name']='auto drafted post page';
		$pieDefaultValues[3]['y']=10;
		$pieDefaultValues[3]['drilldown']= 'auto drafted post page';
		$pieDefaultValues[4]['name']='post page in trash';
		$pieDefaultValues[4]['y']=10;
		$pieDefaultValues[4]['drilldown']= 'post page in trash';
		$pieDefaultValues[5]['name']='spam comments';
		$pieDefaultValues[5]['y']=10;
		$pieDefaultValues[5]['drilldown']= 'spam comments';
		$pieDefaultValues[6]['name']='trash comments';
		$pieDefaultValues[6]['y']=10;
		$pieDefaultValues[6]['drilldown']= 'trash comments';
		$pieDefaultValues[7]['name']='unapproved comments';
		$pieDefaultValues[7]['y']=10;
		$pieDefaultValues[7]['drilldown']= 'unapproved comments';
		$pieDefaultValues[8]['name']='pingback comments';
		$pieDefaultValues[8]['y']=10;
		$pieDefaultValues[8]['drilldown']= 'pingback comments';
		$pieDefaultValues[9]['name']='trackback comments';
		$pieDefaultValues[9]['y']=10;
		$pieDefaultValues[9]['drilldown']= 'trackback comments';
		$pieDefaultValues[10]['name']='orphaned images';
		$pieDefaultValues[10]['y']=10;
		$pieDefaultValues[10]['drilldown']= 'orphaned images';                                            

		//$name = $values = array();
		//$value1 =array("day1","day2","day3");
		//$value2 =array(10,10,10);
		$value1= "day"; $value2=10;
		$drillDefaultValues[0]['name']='orphaned post page meta';
		$drillDefaultValues[0]['id']='orphaned post page meta';
		$data[0] = $value1;
		$data[1] = $value2;
		$drillDefaultValues[0]['data'][] = $data; 

		$drillDefaultValues[1]['name']='unassigned tags';
		$drillDefaultValues[1]['id']='unassigned tags';
		$data[0] = $value1;
		$data[1] = $value2;
		$drillDefaultValues[1]['data'][] = $data; 

		$drillDefaultValues[2]['name']='post page revision';
		$drillDefaultValues[2]['id']='post page revision';
		$data[0] = $value1;
		$data[1] = $value2;
		$drillDefaultValues[2]['data'][] = $data; 

		$drillDefaultValues[3]['name']='auto drafted post page';
		$drillDefaultValues[3]['id']='auto drafted post page';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[3]['data'][] = $data; 

		$drillDefaultValues[4]['name']='post page in trash';
		$drillDefaultValues[4]['id']='post page in trash';
		$data[0] = $value1;
		$data[1] = $value2;
		$drillDefaultValues[4]['data'][] = $data; 

		$drillDefaultValues[5]['name']='spam comments';
		$drillDefaultValues[5]['id']='spam comments';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[5]['data'][] = $data; 

		$drillDefaultValues[6]['name']='trash comments';
		$drillDefaultValues[6]['id']='trash comments';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[6]['data'][] = $data; 

		$drillDefaultValues[7]['name']='unapproved comments';
		$drillDefaultValues[7]['id']='unapproved comments';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[7]['data'][] = $data; 

		$drillDefaultValues[8]['name']='pingback comments';
		$drillDefaultValues[8]['id']='pingback comments';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[8]['data'][] = $data; 

		$drillDefaultValues[9]['name']='trackback comments';
		$drillDefaultValues[9]['id']='trackback comments';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[9]['data'][] = $data; 

		$drillDefaultValues[10]['name']='orphaned images';
		$drillDefaultValues[10]['id']='orphaned images';
		$data[0] = $value1; 
		$data[1] = $value2;
		$drillDefaultValues[10]['data'][] = $data; 

		$chartDefaultValues = array( "pieDefaultValues" => $pieDefaultValues, "drillDefaultValues" => $drillDefaultValues);  
		echo json_encode($chartDefaultValues);die;
	}

	function optimize_check_DBEntry()
	{    
		global $wpdb;
		$total = $wpdb->get_results("SELECT count(*) as rows  FROM optimize_status_log");  
		$no_of_entries = $total[0]->rows;                   
		echo json_encode($no_of_entries);die;
	}

	/*
	 *returns the total count of records required to draw piechart 

	 */
	public function optimize_countBased_chart() {  

#TODO: Update phpdoc
		global $wpdb;

		$pieArray = array();

		$j = 0;

		$OverviewDetails = $wpdb->get_results("select * from optimize_status_log where  image_name is null");



		$sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = $sum8 = $sum9 = $sum10 = $sum11 =0;
#TODO: $colors, $noImports not used in this function / overwritten immediately
		foreach ($OverviewDetails as $overview) {     
			if($overview->record_type == 'orphapospagmeta')
			{
				$sum1=$sum1 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'unasstag')
			{
				$sum2=$sum2 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'pospagrev')
			{
				$sum3=$sum3 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'autopospag')
			{
				$sum4=$sum4 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'pospagtrash')
			{
				$sum5=$sum5 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'spmcmds')
			{
				$sum6=$sum6 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'trashcmds')
			{
				$sum7=$sum7 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'unappcmds')
			{
				$sum8=$sum8 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'pingcmds')
			{
				$sum9=$sum9 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'trackcmds')
			{
				$sum10=$sum10 + $overview->no_of_records;  
			} 

			if($overview->record_type == 'orphanedimg')
			{
				$sum11=$sum11 + $overview->no_of_records;  
			} 


			$j++;
		}                                                                                                                                                  

		$pieArray[0]['name']='orphapospagmeta';
		$pieArray[0]['y']=$sum1;
		$pieArray[0]['drilldown']='orphapospagmeta';
		$pieArray[1]['name']='unasstag';
		$pieArray[1]['y']=$sum2;
		$pieArray[1]['drilldown']= 'unasstag';
		$pieArray[2]['name']='pospagrev';
		$pieArray[2]['y']=$sum3;
		$pieArray[2]['drilldown']= 'pospagrev';
		$pieArray[3]['name']='autopospag';
		$pieArray[3]['y']=$sum4;
		$pieArray[3]['drilldown']= 'autopospag';
		$pieArray[4]['name']='pospagtrash';
		$pieArray[4]['y']=$sum5;
		$pieArray[4]['drilldown']= 'pospagtrash';
		$pieArray[5]['name']='spmcmds';
		$pieArray[5]['y']=$sum6;
		$pieArray[5]['drilldown']= 'spmcmds';
		$pieArray[6]['name']='trashcmds';
		$pieArray[6]['y']=$sum7;
		$pieArray[6]['drilldown']= 'trashcmds';
		$pieArray[7]['name']='unappcmds';
		$pieArray[7]['y']=$sum8;
		$pieArray[7]['drilldown']= 'unappcmds';
		$pieArray[8]['name']='pingcmds';
		$pieArray[8]['y']=$sum9;
		$pieArray[8]['drilldown']= 'pingcmds';
		$pieArray[9]['name']='trackcmds';
		$pieArray[9]['y']=$sum10;
		$pieArray[9]['drilldown']= 'trackcmds';
		$pieArray[10]['name']='orphanedimg';
		$pieArray[10]['y']=$sum11;
		$pieArray[10]['drilldown']= 'orphanedimg';



		global $wpdb;
		$drillArray = $drillArray1 =$drillArray2 =$drillArray3 =$drillArray4 =$drillArray5 =$drillArray6 =$drillArray7 =$drillArray8 =$drillArray9 =$drillArray10 =$drillArray11 = array();
		$i = 0;
		$OverviewDetails = $wpdb->get_results("select * from optimize_status_log where  image_name is null");  
		foreach ($OverviewDetails as $overview) {    

			if($overview->record_type == 'orphapospagmeta')
			{
				$drillArray1[$i][0]=$overview->deleted_on;
				$drillArray1[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'unasstag')
			{
				$drillArray2[$i][0]=$overview->deleted_on;
				$drillArray2[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'pospagrev')
			{
				$drillArray3[$i][0]=$overview->deleted_on;
				$drillArray3[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'autopospag')
			{
				$drillArray4[$i][0]=$overview->deleted_on;
				$drillArray4[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'pospagtrash')
			{
				$drillArray5[$i][0]=$overview->deleted_on;
				$drillArray5[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'spmcmds')
			{
				$drillArray6[$i][0]=$overview->deleted_on;
				$drillArray6[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'trashcmds')
			{
				$drillArray7[$i][0]=$overview->deleted_on;
				$drillArray7[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'unappcmds')
			{
				$drillArray8[$i][0]=$overview->deleted_on;
				$drillArray8[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'pingcmds')
			{
				$drillArray9[$i][0]=$overview->deleted_on;
				$drillArray9[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'trackcmds')
			{
				$drillArray10[$i][0]=$overview->deleted_on;
				$drillArray10[$i][1]=$overview->no_of_records;  
			} 

			if($overview->record_type == 'orphanedimg')
			{
				$drillArray11[$i][0]=$overview->deleted_on;
				$drillArray11[$i][1]=$overview->no_of_records;  
			} 
			$i++;
		}



		$drillArray =array($drillArray1,$drillArray2,$drillArray3,$drillArray4,$drillArray5,$drillArray6,$drillArray7,$drillArray8,$drillArray9,$drillArray10,$drillArray11);

		$drillDownArray = $drillDownArray1 =$drillDownArray2 =$drillDownArray3 =$drillDownArray4 =$drillDownArray5 =$drillDownArray6 =$drillDownArray7 =$drillDownArray8 =$drillDownArray9 =$drillDownArray10 =$drillDownArray11 = array();     

		foreach($drillArray as $drillkey => $drillvalue)
		{    
			foreach($drillvalue as $drikey => $drivalue){

				if($drillkey == 0)
				{
					$drillDownArray1['name']='orphapospagmeta';
					$drillDownArray1['id']='orphapospagmeta';
					//$drillDownArray1['data'][][]=$drivalue[0]. ',' .$drivalue[1];
					$data = array();
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray1['data'][] = $data;
				}
				if($drillkey == 1)
				{
					$drillDownArray2['name']='unasstag';
					$drillDownArray2['id']='unasstag';
					$data = array();
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray2['data'][] = $data;
				}
				if($drillkey == 2)
				{
					$drillDownArray3['name']='pospagrev';
					$drillDownArray3['id']='pospagrev';
					//$drillDownArray3['data'][][]=$drivalue[0]. ',' .$drivalue[1];
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray3['data'][] = $data;
				}
				if($drillkey == 3)
				{
					$drillDownArray4['name']='autopospag';
					$drillDownArray4['id']='autopospag';
					//$drillDownArray4['data'][][]=$drivalue[0]. ',' .$drivalue[1];
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray4['data'][] = $data;
				}
				if($drillkey == 4)
				{
					$drillDownArray5['name']='pospagtrash';
					$drillDownArray5['id']='pospagtrash';
					//$drillDownArray5['data'][][]=$drivalue[0]. ',' .$drivalue[1];
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray5['data'][] = $data;
				}
				if($drillkey == 5)
				{
					$drillDownArray6['name']='spmcmds';
					$drillDownArray6['id']='spmcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray6['data'][] = $data;
				}
				if($drillkey == 6)
				{
					$drillDownArray7['name']='trashcmds';
					$drillDownArray7['id']='trashcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray7['data'][] = $data;
				}
				if($drillkey == 7)
				{
					$drillDownArray8['name']='unappcmds';
					$drillDownArray8['id']='unappcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray8['data'][] = $data;
				}
				if($drillkey == 8)
				{
					$drillDownArray9['name']='pingcmds';
					$drillDownArray9['id']='pingcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray9['data'][] = $data;
				}
				if($drillkey == 9)
				{
					$drillDownArray10['name']='trackcmds';
					$drillDownArray10['id']='trackcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray10['data'][] = $data;
				}
				if($drillkey == 10)
				{
					$drillDownArray11['name']='orphanedimg';
					$drillDownArray11['id']='orphanedimg';
					//$drillDownArray11['data'][][]=$drivalue[0]. ',' .$drivalue[1];
					$data[0] = $drivalue[0]; 
					$data[1] = (integer)$drivalue[1];
					$drillDownArray11['data'][] = $data; 
				}

			}}

		$drillDownArray =array($drillDownArray1,$drillDownArray2,$drillDownArray3,$drillDownArray4,$drillDownArray5,$drillDownArray6,$drillDownArray7,$drillDownArray8,$drillDownArray9,$drillDownArray10,$drillDownArray11);           
		$chartArray= array();                                               

		$chartArray = array( "PieArray" =>$pieArray, "drillDownArray" =>$drillDownArray);


		echo json_encode($chartArray);die;
	}





	public function optimize_sizeBased_chart() {  

#TODO: Update phpdoc
		global $wpdb;

		$pieArray = array();

		$j = 0;

		$OverviewDetails = $wpdb->get_results("select * from optimize_status_log where  image_name is null");



		$sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = $sum8 = $sum9 = $sum10 = $sum11 =0;
#TODO: $colors, $noImports not used in this function / overwritten immediately
		foreach ($OverviewDetails as $overview) {     
			if($overview->record_type == 'orphapospagmeta')
			{
				$sum1=$sum1 + $overview->size;  
			} 

			if($overview->record_type == 'unasstag')
			{
				$sum2=$sum2 + $overview->size;  
			} 

			if($overview->record_type == 'pospagrev')
			{
				$sum3=$sum3 + $overview->size;  
			} 

			if($overview->record_type == 'autopospag')
			{
				$sum4=$sum4 + $overview->size;  
			} 

			if($overview->record_type == 'pospagtrash')
			{
				$sum5=$sum5 + $overview->size;  
			} 

			if($overview->record_type == 'spmcmds')
			{
				$sum6=$sum6 + $overview->size;  
			} 

			if($overview->record_type == 'trashcmds')
			{
				$sum7=$sum7 + $overview->size;  
			} 

			if($overview->record_type == 'unappcmds')
			{
				$sum8=$sum8 + $overview->size;  
			} 

			if($overview->record_type == 'pingcmds')
			{
				$sum9=$sum9 + $overview->size;  
			} 

			if($overview->record_type == 'trackcmds')
			{
				$sum10=$sum10 + $overview->size;  
			} 

			if($overview->record_type == 'orphanedimg')
			{
				$sum11=$sum11 + $overview->size;  
			} 


			$j++;
		}                                                                                                                                                  

		$pieArray[0]['name']='orphapospagmeta';
		$pieArray[0]['y']=$sum1;
		$pieArray[0]['drilldown']='orphapospagmeta';
		$pieArray[1]['name']='unasstag';
		$pieArray[1]['y']=$sum2;
		$pieArray[1]['drilldown']= 'unasstag';
		$pieArray[2]['name']='pospagrev';
		$pieArray[2]['y']=$sum3;
		$pieArray[2]['drilldown']= 'pospagrev';
		$pieArray[3]['name']='autopospag';
		$pieArray[3]['y']=$sum4;
		$pieArray[3]['drilldown']= 'autopospag';
		$pieArray[4]['name']='pospagtrash';
		$pieArray[4]['y']=$sum5;
		$pieArray[4]['drilldown']= 'pospagtrash';
		$pieArray[5]['name']='spmcmds';
		$pieArray[5]['y']=$sum6;
		$pieArray[5]['drilldown']= 'spmcmds';
		$pieArray[6]['name']='trashcmds';
		$pieArray[6]['y']=$sum7;
		$pieArray[6]['drilldown']= 'trashcmds';
		$pieArray[7]['name']='unappcmds';
		$pieArray[7]['y']=$sum8;
		$pieArray[7]['drilldown']= 'unappcmds';
		$pieArray[8]['name']='pingcmds';
		$pieArray[8]['y']=$sum9;
		$pieArray[8]['drilldown']= 'pingcmds';
		$pieArray[9]['name']='trackcmds';
		$pieArray[9]['y']=$sum10;
		$pieArray[9]['drilldown']= 'trackcmds';
		$pieArray[10]['name']='orphanedimg';
		$pieArray[10]['y']=$sum11;
		$pieArray[10]['drilldown']= 'orphanedimg';


		global $wpdb;
		$drillArray = $drillArray1 =$drillArray2 =$drillArray3 =$drillArray4 =$drillArray5 =$drillArray6 =$drillArray7 =$drillArray8 =$drillArray9 =$drillArray10 =$drillArray11 = array();
		$i = 0;
		$OverviewDetails = $wpdb->get_results("select * from optimize_status_log where  image_name is null"); 


		foreach ($OverviewDetails as $overview) {    

			if($overview->record_type == 'orphapospagmeta')
			{
				$drillArray1[$i][0]=$overview->deleted_on;
				$drillArray1[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'unasstag')
			{
				$drillArray2[$i][0]=$overview->deleted_on;
				$drillArray2[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'pospagrev')
			{
				$drillArray3[$i][0]=$overview->deleted_on;
				$drillArray3[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'autopospag')
			{
				$drillArray4[$i][0]=$overview->deleted_on;
				$drillArray4[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'pospagtrash')
			{
				$drillArray5[$i][0]=$overview->deleted_on;
				$drillArray5[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'spmcmds')
			{
				$drillArray6[$i][0]=$overview->deleted_on;
				$drillArray6[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'trashcmds')
			{
				$drillArray7[$i][0]=$overview->deleted_on;
				$drillArray7[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'unappcmds')
			{
				$drillArray8[$i][0]=$overview->deleted_on;
				$drillArray8[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'pingcmds')
			{
				$drillArray9[$i][0]=$overview->deleted_on;
				$drillArray9[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'trackcmds')
			{
				$drillArray10[$i][0]=$overview->deleted_on;
				$drillArray10[$i][1]=$overview->size;  
			} 

			if($overview->record_type == 'orphanedimg')
			{
				$drillArray11[$i][0]=$overview->deleted_on;
				$drillArray11[$i][1]=$overview->size;  
			} 
			$i++;
		}



		$drillArray =array($drillArray1,$drillArray2,$drillArray3,$drillArray4,$drillArray5,$drillArray6,$drillArray7,$drillArray8,$drillArray9,$drillArray10,$drillArray11);
		$drillvalue =$drivalue=$drillDownArray= array();

		$drillDownArray = $drillDownArray1 =$drillDownArray2 =$drillDownArray3 =$drillDownArray4 =$drillDownArray5 =$drillDownArray6 =$drillDownArray7 =$drillDownArray8 =$drillDownArray9 =$drillDownArray10 =$drillDownArray11 = array();     

		foreach($drillArray as $drillkey => $drillvalue)
		{    
			foreach($drillvalue as $drikey => $drivalue){

				if($drillkey == 0)
				{
					$drillDownArray1['name']='orphapospagmeta';
					$drillDownArray1['id']='orphapospagmeta';
					$data = array();
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray1['data'][] = $data;
				}
				if($drillkey == 1)
				{
					$drillDownArray2['name']='unasstag';
					$drillDownArray2['id']='unasstag';
					$data = array();
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray2['data'][] = $data;
				}
				if($drillkey == 2)
				{
					$drillDownArray3['name']='pospagrev';
					$drillDownArray3['id']='pospagrev';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray3['data'][] = $data;
				}
				if($drillkey == 3)
				{
					$drillDownArray4['name']='autopospag';
					$drillDownArray4['id']='autopospag';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray4['data'][] = $data;
				}
				if($drillkey == 4)
				{
					$drillDownArray5['name']='pospagtrash';
					$drillDownArray5['id']='pospagtrash';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray5['data'][] = $data;
				}
				if($drillkey == 5)
				{
					$drillDownArray6['name']='spmcmds';
					$drillDownArray6['id']='spmcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray6['data'][] = $data;
				}
				if($drillkey == 6)
				{
					$drillDownArray7['name']='trashcmds';
					$drillDownArray7['id']='trashcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray7['data'][] = $data;
				}
				if($drillkey == 7)
				{
					$drillDownArray8['name']='unappcmds';
					$drillDownArray8['id']='unappcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray8['data'][] = $data;
				}
				if($drillkey == 8)
				{
					$drillDownArray9['name']='pingcmds';
					$drillDownArray9['id']='pingcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray9['data'][] = $data;
				}
				if($drillkey == 9)
				{
					$drillDownArray10['name']='trackcmds';
					$drillDownArray10['id']='trackcmds';
					$data[0] = $drivalue[0];
					$data[1] = (integer)$drivalue[1];
					$drillDownArray10['data'][] = $data;
				}
				if($drillkey == 10)
				{
					$drillDownArray11['name']='orphanedimg';
					$drillDownArray11['id']='orphanedimg';
					$data[0] = $drivalue[0]; 
					$data[1] = (integer)$drivalue[1];
					$drillDownArray11['data'][] = $data; 
				}

			}}

		$drillDownArray =array($drillDownArray1,$drillDownArray2,$drillDownArray3,$drillDownArray4,$drillDownArray5,$drillDownArray6,$drillDownArray7,$drillDownArray8,$drillDownArray9,$drillDownArray10,$drillDownArray11);           
		$chartArray= array();   


		$chartArray = array( "PieArray" =>$pieArray, "drillDownArray" =>$drillDownArray);


		echo json_encode($chartArray);die;


	}




}  // end of class

?>
