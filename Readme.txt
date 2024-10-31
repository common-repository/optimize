=== Optimize Plugin ===
Contributors: smackcoders
Donate link: https://www.paypal.me/smackcoders
Tags: automatic, cache, categories, category, combine, comment, comments, content, CSS, feed, feeds, footer, google, head, header, image, image protection, images, images lazy load, javascript, lazy load, link, links, minify, optimize, page, pages, performance, photo, photos, picture, pictures, plugin, plugins, Post, posts, rss, search, seo, speed, Style, stylesheet, tag, tags, text, watermark, watermarking, wordpress
Requires at least: 4.2
Tested up to: 4.5
Stable tag: 1.1.1
Version: 1.1.1
Author: smackcoders
Author URI: http://profiles.wordpress.org/smackcoders/
License: GPLv2 or later

A better Optimizer for removing orphaned records from trash.

== Description ==

Optimize plugin deletes the unwanted records from trash in a wordpress site. For guides and tutorials, visit Smackcoders Documentation under [Optimize](https://www.smackcoders.com/documentation/wp-optimize/optimze). 

This plugin will remove orphaned Post/Page Meta,unassigned tags,Post/Page revisions,auto drafted Post/Page, Post/Page in trash,Spam Comments,Comments in trash,Unapproved Comments,Pingback Comments,Trackback Comments and also orphaned images.

Optimize plugin removes Orphaned images from uploads folder also.

The deleted Records will be displayed in Database Optimization Log. And You can download the log details. 

High Chart shows the deleted records information (based on both size and count of records).

You can take backup of database before optimizing the database.

You can schedule the Database Optimization process Automatically. 


Support and Feature request.
----------------------------
For guides and tutorials, visit Smackcoders Documentation under [Optimize](https://www.smackcoders.com/documentation/wp-optimize/optimze). 

== Installation ==

1.    Unzip the file 'optimize.zip'.
2.    Upload the ' optimize ' directory to '/wp-content/plugins/' directory using ftp client or upload
3.    Or Upload the optimize.zip file through plugin install in wp admin.
4.    Activate the plugin through the 'Plugins' menu in WordPress.


== Screenshots ==

1. Optimize plugin will appear as a submenu under Tools menu in Dashboard.
2. High chart displays the deleted record's information. You can choose either count based chart or size based chart. Count based chart is drawn based on number of deleted records. And Size based chart is drawn based on size of deleted records.  
3. You can take backup of database before optimizing database. To backup database, first you must create a folder in wp-content. And named it as 'database_backup'. Then you should give write permission to the database_backup folder. If you want backup file in zip format, then please check the appropriate check box.
4. UI for database optimization consist of number of checkboxes of orphaned records catagories. Please decide which you want to delete and check it. 
5. List of record details will be displayed that you already choose in the previous page. After deleting each type of records the current database size will be displayed.
6. The deleted number of records will be displayed in the log. You can download the log.
7. Automatic scheduling for database optimization. This sceduling will work only if the Auto clean-up option is enabled.

== Frequently Asked Questions ==

1. How to install the plugin?
Like other plugins optimize is easy to install. Upload the optimize.zip file through plugin install in wp admin. Everything will work fine with it.


== Changelog ==
= 1.1.1 =
* Added: WordPress Compatibility 4.5 was checked.
* Fixed: UI breakage was fixed.

= 1.1.0 =
* Added: Downloadable log.
* Added: Delete option is added for orphaned images.
* Added: orphaned images are also deleted from uploads folder.
* Added: Database backup option is added.
* Added: High chart for deleted records information.
* Added: Scheduling for Automatic database optimization.

= 1.0.0 =	
* Initial release of plugin.

== Upgrade Notice == 
= 1.1.1 =
* Upgrade for WordPress 4.5 compatibility.

= 1.1.0 =
* Upgrade for performance improvement and lot of new features.

= 1.0.0 =	
* Initial release of plugin.
