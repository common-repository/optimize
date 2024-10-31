jQuery(document).ready(function(){

		//jQuery('#main-menu').smartmenus();

		jQuery("#submit").click(function(){ 

			jQuery("#topcontainer").hide();

			jQuery("#all_details").show();

			document.getElementById('optimizelog').style.display = "block";

			if(document.getElementById('delete_all_orphaned_post_page_meta').checked)   
			{
			jQuery("#one").show();
			}

			if(document.getElementById('delete_all_unassigned_tags').checked)
			{
			jQuery("#two").show();
			}
			if(document.getElementById('delete_all_post_page_revisions').checked) 
			{
			jQuery("#three").show();
			}
			if(document.getElementById('delete_all_auto_draft_post_page').checked) 
			{
				jQuery("#four").show();
			}
			if(document.getElementById('delete_all_post_page_in_trash').checked)
			{
				jQuery("#five").show();
			}
			if(document.getElementById('delete_all_spam_comments').checked)
			{
				jQuery("#six").show();
			}
			if(document.getElementById('delete_all_comments_in_trash').checked)
			{
				jQuery("#seven").show();
			}
			if(document.getElementById('delete_all_unapproved_comments').checked) 
			{
				jQuery("#eight").show();
			}
			if(document.getElementById('delete_all_pingback_comments').checked)
			{
				jQuery("#nine").show();
			}
			if(document.getElementById('delete_all_trackback_comments').checked)
			{
				jQuery("#ten").show();
			}
			if(document.getElementById('delete_all_orphaned_images').checked)
			{
				jQuery("#eleven").show();
			}

		});

		jQuery("#btn1").click(function(){

				jQuery("#one").hide();

				});

		jQuery("#btn2").click(function(){

				jQuery("#two").hide();

				});

		jQuery("#btn3").click(function(){

				jQuery("#three").hide();

				});

		jQuery("#btn4").click(function(){

				jQuery("#four").hide();

				});

		jQuery("#btn5").click(function(){

				jQuery("#five").hide();

				});

		jQuery("#btn6").click(function(){

				jQuery("#six").hide();

				});

		jQuery("#btn7").click(function(){

				jQuery("#seven").hide();

				});

		jQuery("#btn8").click(function(){

				jQuery("#eight").hide();

				});

		jQuery("#btn9").click(function(){

				jQuery("#nine").hide();

				});

		jQuery("#btn10").click(function(){

				jQuery("#ten").hide();

				});

		jQuery("#btn11").click(function(){

				jQuery("#eleven").hide();

				});


		//bootstrap checkbox
		//jQuery("#chk1").bootstrapSwitch();




/*		//auto clean up checkbox
		jQuery('enable-schedule').checkbox({
buttonStyle: 'btn-danger',
buttonStyleChecked: 'btn-success',
checkedClass: 'icon-check',
uncheckedClass: 'icon-check-empty'
});    */


jQuery('#schedule_type').selectpicker();
jQuery('#choose_chart').selectpicker();

jQuery("[name='optimize-auto[postmeta]']").bootstrapSwitch();
jQuery("[name='optimize-auto[tags]']").bootstrapSwitch();
jQuery("[name='optimize-auto[revisions]']").bootstrapSwitch();
jQuery("[name='optimize-auto[drafts]']").bootstrapSwitch();
jQuery("[name='optimize-auto[PosPagTrash]']").bootstrapSwitch();
jQuery("[name='optimize-auto[spamCmds]']").bootstrapSwitch();
jQuery("[name='optimize-auto[trashCmds]']").bootstrapSwitch();
jQuery("[name='optimize-auto[unapproved]']").bootstrapSwitch();
jQuery("[name='optimize-auto[pingback]']").bootstrapSwitch();
jQuery("[name='optimize-auto[trackback]']").bootstrapSwitch();
jQuery("[name='optimize-auto[orphanedImg]']").bootstrapSwitch();
jQuery("[name='enable-email']").bootstrapSwitch();

jQuery("#enable-backup-settings").click(function(){  
		BootstrapDialog.show({
title: 'Success',
message: 'All Auto Back-up Settings are enabled !!',
buttons: [{
id: 'btn-ok',   
icon: 'glyphicon glyphicon-check',       
label: 'OK',
cssClass: 'btn-primary', 
autospin: false,
action: function(dialogRef){    
dialogRef.close();
}
}]
});


		});

});
function check_uncheck(id)  {
	var opt = id ;
	if(opt == 'checkOpt') {
		document.getElementById('delete_all_orphaned_post_page_meta').checked = true;
		document.getElementById('delete_all_unassigned_tags').checked = true;
		document.getElementById('delete_all_post_page_revisions').checked = true;
		document.getElementById('delete_all_auto_draft_post_page').checked = true;
		document.getElementById('delete_all_post_page_in_trash').checked = true;
		document.getElementById('delete_all_spam_comments').checked = true;
		document.getElementById('delete_all_comments_in_trash').checked = true;
		document.getElementById('delete_all_unapproved_comments').checked = true;
		document.getElementById('delete_all_pingback_comments').checked = true;
		document.getElementById('delete_all_trackback_comments').checked = true;
		document.getElementById('delete_all_orphaned_images').checked = true;

	}
	else if(opt == 'uncheckOpt') {
		document.getElementById('delete_all_orphaned_post_page_meta').checked = false;
		document.getElementById('delete_all_unassigned_tags').checked = false;
		document.getElementById('delete_all_post_page_revisions').checked = false;
		document.getElementById('delete_all_auto_draft_post_page').checked = false;
		document.getElementById('delete_all_post_page_in_trash').checked = false;
		document.getElementById('delete_all_spam_comments').checked = false;
		document.getElementById('delete_all_comments_in_trash').checked = false;
		document.getElementById('delete_all_unapproved_comments').checked = false;
		document.getElementById('delete_all_pingback_comments').checked = false;
		document.getElementById('delete_all_trackback_comments').checked = false;
		document.getElementById('delete_all_orphaned_images').checked = false;
	}
}


function databaseoptimization() {  
	var orphaned, unassignedTags, postpagerevisions, autodraftedpostpage, postpagetrash, spamcomments, trashedcomments, unapprovedcomments, pingbackcomments, trackbackcomments, orphanedimages;
	var tmpLoc = document.getElementById('tmpLoc').value;
	document.getElementById('log').innerHTML = '';
	if(document.getElementById('delete_all_orphaned_post_page_meta').checked)  {  
		orphaned = 1;
	} else {
		orphaned = 0;
	}
	if(document.getElementById('delete_all_unassigned_tags').checked) {   
		unassignedTags = 1;
	} else {
		unassignedTags = 0;
	}
	if(document.getElementById('delete_all_post_page_revisions').checked) {     
		postpagerevisions = 1;
	} else {
		postpagerevisions = 0;
	}
	if(document.getElementById('delete_all_auto_draft_post_page').checked) {    

		autodraftedpostpage = 1;
	} else {
		autodraftedpostpage = 0;
	}
	if(document.getElementById('delete_all_post_page_in_trash').checked) {  
		postpagetrash = 1;
	} else {
		postpagetrash = 0;
	}
	if(document.getElementById('delete_all_spam_comments').checked) {   
		spamcomments = 1;
	} else {
		spamcomments = 0;
	}
	if(document.getElementById('delete_all_comments_in_trash').checked) {  
		trashedcomments = 1;
	} else {
		trashedcomments = 0;
	}
	if(document.getElementById('delete_all_unapproved_comments').checked) {  
		unapprovedcomments = 1;
	} else {
		unapprovedcomments = 0;
	}
	if(document.getElementById('delete_all_pingback_comments').checked) {   
		pingbackcomments = 1;
	} else {
		pingbackcomments = 0;
	}
	if(document.getElementById('delete_all_trackback_comments').checked) {  
		trackbackcomments = 1;
	} else {
		trackbackcomments = 0;
	}
	if(document.getElementById('delete_all_orphaned_images').checked) {
		orphanedimages = 1;
	} else {
		orphanedimages = 0;
	}

	jQuery.ajax({

url: ajaxurl,
type: 'post',
data: {
'action': 'show_record_size',
'orphaned': orphaned,
'unassignedTags': unassignedTags,
'postpagerevisions': postpagerevisions,
'autodraftedpostpage': autodraftedpostpage,
'postpagetrash': postpagetrash,
'spamcomments': spamcomments,
'trashedcomments': trashedcomments,
'unapprovedcomments': unapprovedcomments,
'pingbackcomments': pingbackcomments,
'trackbackcomments': trackbackcomments,
'orphanedimages' : orphanedimages
},
success: function (response) {  
var data= JSON.parse(response);   
document.getElementById('orphaned').innerHTML =data['orphaned']; 

document.getElementById('unassignedTags').innerHTML = data['unassignedTags'];

document.getElementById('postpagerevisions').innerHTML = data['postpagerevisions'];

document.getElementById('autodraftedpostpage').innerHTML =data['autodraftedpostpage'];

document.getElementById('postpagetrash').innerHTML = data['postpagetrash'];

document.getElementById('spamcomments').innerHTML = data['spamcomments'];

document.getElementById('trashedcomments').innerHTML = data['trashedcomments'];

document.getElementById('unapprovedcomments').innerHTML = data['unapprovedcomments'];

document.getElementById('pingbackcomments').innerHTML = data['pingbackcomments'];

document.getElementById('trackbackcomments').innerHTML = data['trackbackcomments'];

document.getElementById('orphanedimages').innerHTML = data['orphanedimages'];


	 }
}); 
}


function proceed_deletion(btn)
{
	var orpha,unasstag,pospagrev,autopospag,pospagtrash,spmcmds,trashcmds,unappcmds,pingback,trackback,orphimg;

	if(btn == 1)
	{
		orpha = 1;
	}
	else
	{
		orpha = 0;
	}
	if(btn == 2)
	{
		unasstag = 1;
	}
	else
	{
		unasstag = 0;
	}
	if(btn == 3)
	{
		pospagrev = 1;
	}
	else
	{
		pospagrev = 0;
	}
	if(btn == 4)
	{
		autopospag = 1;
	}
	else
	{
		autopospag = 0;
	}
	if(btn == 5)
	{
		pospagtrash = 1;
	}
	else
	{
		pospagtrash = 0;
	}
	if(btn == 6)
	{
		spmcmds = 1;
	}
	else
	{
		spmcmds = 0;
	}
	if(btn == 7)
	{
		trashcmds = 1;
	}
	else
	{
		trashcmds = 0;
	}
	if(btn == 8)
	{
		unappcmds = 1;
	}
	else
	{
		unappcmds = 0;
	}
	if(btn == 9)
	{
		pingback = 1;
	}
	else
	{
		pingback = 0;
	}
	if(btn == 10)
	{
		trackback = 1;
	}
	else
	{
		trackback = 0;
	}
	if(btn == 11)
	{
		orphimg = 1;
	}
	else
	{
		orphimg = 0;
	}


	jQuery.ajax({
url: ajaxurl,
type: 'post',
data: {
'action': 'opt_dboptimizer',
'orpha': orpha,
'unasstag': unasstag,
'pospagrev': pospagrev,
'autopospag': autopospag,
'pospagtrash': pospagtrash,
'spmcmds': spmcmds,
'trashcmds': trashcmds,
'unappcmds': unappcmds,
'pingback': pingback,
'trackback': trackback,
'orphimg' : orphimg
},
success:function (result) {       
var res=JSON.parse(result);  
document.getElementById('dbsize_detail').innerHTML = "";

if(res['orphaned'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['orphaned'] + ' ) '+ "no of Orphaned Post/Page meta has been removed." + '</p>';
if(res['unassignedTags'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['unassignedTags'] + ' ) '+ "no of Unassigned tags has been removed."+ '</p>';
if(res['postpagerevisions'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['postpagerevisions'] + ' ) '+ "no of Post/Page revisions has been removed." + '</p>';
if(res['autodraftedpostpage'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['autodraftedpostpage'] + ' ) ' + 'no of Auto drafted Post/Page has been removed.' + '</p>';
if(res['postpagetrash'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['postpagetrash'] + ' ) '+ "no of Post/Page in trash has been removed." + '</p>';
if(res['spamcomments'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['spamcomments'] + ' ) ' + "no of Spam comments has been removed." + '</p>';
if(res['trashedcomments'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['trashedcomments'] + ' ) ' + 'no of Comments in trash has been removed.' + '</p>';
if(res['unapprovedcomments'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['unapprovedcomments'] + ' ) ' +"no of Unapproved comments has been removed." + '</p>';
if(res['pingbackcomments'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['pingbackcomments'] + ' ) ' + "no of Pingback comments has been removed." + '</p>';
if(res['trackbackcomments'] != 'non_affected')
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;"> ( ' + res['trackbackcomments'] + ' ) '+ "no of Trackback comments has been removed." + '</p>';
if(res['orphanedimages'] != 'non_affected')
	var i;
for(i=0; i<res['imagecount'];i++)
{
	document.getElementById('log').innerHTML += '<p style="margin:15px; margin-left:10px;">  ' + res['orphanedimages'+i] +  " has been removed." + '</p>';
}
document.getElementById('dbsize_detail').innerHTML = "<h3><div class='alert alert-info'><p style='font-weight: bold; font-size:15px; color:red'  > Current Database Size = " + res['updateddbsize'] +"</div></h3>";



jQuery("#dwnld_log_link").show();



}
});

}



