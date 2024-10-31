<?php
/*
	Plugin Name: ourSTATS plugin
	Plugin URI: http://www.pluginswp.com/ourstats-stats-widget/
	Description: Create your different statistics for each section of your website. Enter your ourSTATS.de supplied ID, you can get without registering, visiting ourstats.de. To insert a gallery in your posts, type [ourstats_stats X/], where X is the code of the stats. You can use Widget with this plugin.
	Version: 1.1
	Author: pluginswp.com
	Author URI: http://www.pluginswp.com/
*/	
$contador=0;

$nombrebox="Webpsilon".rand(99, 99999);
function ourstats_stats_widget_head() {
	
	$site_url = get_option( 'siteurl' );

			
}
function ourstats_stats_widget($content){
	$content = preg_replace_callback("/\[ourstats_stats ([^]]*)\/\]/i", "ourstats_stats_widget_render", $content);
	return $content;
	
}

function ourstats_stats_widget_render($tag_string){
$contador=rand(9, 9999999);
	$site_url = get_option( 'siteurl' );
global $wpdb; 	
$table_name = $wpdb->prefix . "ourstats_stats_widget";	


if(isset($tag_string[1])) {
	$auxi1=str_replace(" ", "", $tag_string[1]);
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );
}
if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	$conta=0;
	$id= $myrows[$conta]->id;
	$video = $myrows[$conta]->video;
	$titles = $myrows[$conta]->titles;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$tumb = $myrows[$conta]->tumb;
	$round = $myrows[$conta]->round;
	$controls = $myrows[$conta]->controls;
	$skin = $myrows[$conta]->skin;
	$columns = $myrows[$conta]->columns;
	$row= $myrows[$conta]->row;
	$color1 = $myrows[$conta]->color1;
	$color2 = $myrows[$conta]->color2;
	$autoplay = $myrows[$conta]->autoplay;

	$tags = $myrows[$conta]->tags;
	
	
	
	$table_name = $wpdb->prefix . "ourstats_stats_widget";
	$saludo= $wpdb->get_var("SELECT id FROM $table_name ORDER BY RAND() LIMIT 0, 1; " );
	
	$ourstats_id = $titles;
	$ourstats_color = $skin;
	
	if(current_user_can('level_10') && $autoplay == 1 ) {
			$output="";
		}
	
	else $output='<script src="http://logging.ourstats.de/js.php?ID='.$ourstats_id.'&amp;style='.$ourstats_color.'" type="text/javascript"></script><noscript><a href="http://stats.ourstats.de/?ID='.$ourstats_id.'" target="_blank"><img src="http://logging.ourstats.de/logging.php?ID='.$ourstats_id.'&amp;js=0&amp;style='.$ourstats_color.'" alt="ourSTATS.de - kostenloser Statistik Counter" border="0" /></a></noscript>';

	return $output;
}





function ourstats_stats_widget_instala(){
	global $wpdb; 
	$table_name= $wpdb->prefix . "ourstats_stats_widget";
   $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		video longtext NOT NULL ,
		titles longtext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		tumb tinytext NOT NULL ,
		round tinytext NOT NULL ,
		controls tinytext NOT NULL ,
		skin tinytext NOT NULL ,
		columns tinytext NOT NULL ,
		row tinytext NOT NULL ,
		color1 tinytext NOT NULL ,
		color2 tinytext NOT NULL ,
		autoplay tinytext NOT NULL ,
		tags tinytext NOT NULL ,
		PRIMARY KEY ( `id` )	
	) ;";

   	$id= $myrows[$conta]->id;
	$video = $myrows[$conta]->video;
	$titles = $myrows[$conta]->titles;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$tumb = $myrows[$conta]->tumb;
	$round = $myrows[$conta]->round;
	$controls = $myrows[$conta]->controls;
	$skin = $myrows[$conta]->skin;
	$columns = $myrows[$conta]->columns;
	$row= $myrows[$conta]->row;
	$color1 = $myrows[$conta]->color1;
	$color2 = $myrows[$conta]->color2;
	$autoplay = $myrows[$conta]->autoplay;
   	$tags = $myrows[$conta]->tags;
   
	$wpdb->query($sql);
	$sql = "INSERT INTO $table_name (video, titles, width, height, tumb, round, controls, skin, columns, row, color1, color2, autoplay, tags) VALUES ('Title', '', '100%', '500px', '40', '20', '0',  'random', '2', '2', '000000', 'ffffff', '0', '');";
	$wpdb->query($sql);
}
function ourstats_stats_widget_desinstala(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "ourstats_stats_widget";
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}	
function ourstats_stats_widget_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "ourstats_stats_widget";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
//autos  no existe
if(empty($re))
{
  $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		video longtext NOT NULL ,
		titles longtext NOT NULL ,
		width tinytext NOT NULL ,
		height tinytext NOT NULL ,
		tumb tinytext NOT NULL ,
		round tinytext NOT NULL ,
		controls tinytext NOT NULL ,
		skin tinytext NOT NULL ,
		columns tinytext NOT NULL ,
		row tinytext NOT NULL ,
		color1 tinytext NOT NULL ,
		color2 tinytext NOT NULL ,
		autoplay tinytext NOT NULL ,
		tags tinytext NOT NULL ,
		PRIMARY KEY ( `id` )
	) ;";
	$wpdb->query($sql);

}
		
	$sql = "INSERT INTO $table_name (video, titles, width, height, tumb, round, controls, skin, columns, row, color1, color2, autoplay, tags) VALUES ('Title', '', '100%', '500px', '40', '20', '0',  'random', '2', '2', '000000', 'ffffff', '0', '');";
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	


$sql= "UPDATE $table_name SET `video` = '".$_POST["video".$_POST['id']]."', `titles` = '".$_POST["titles".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `tumb` = '".$_POST["tumb".$_POST['id']]."', `round` = '".$_POST["round".$_POST['id']]."', `controls` = '".$_POST["controls".$_POST['id']]."', `skin` = '".$_POST["skin".$_POST['id']]."', `columns` = '".$_POST["columns".$_POST['id']]."', `row` = '".$_POST["row".$_POST['id']]."', `color1` = '".$_POST["color1".$_POST['id']]."', `color2` = '".$_POST["color2".$_POST['id']]."', `autoplay` = '".$_POST["autoplay".$_POST['id']]."', `tags` = '".$_POST["tags".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;

include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$video = $myrows[$conta]->video;
	$titles = $myrows[$conta]->titles;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$tumb = $myrows[$conta]->tumb;
	$round = $myrows[$conta]->round;
	$controls = $myrows[$conta]->controls;
	$skin = $myrows[$conta]->skin;
	$columns = $myrows[$conta]->columns;
	$row= $myrows[$conta]->row;
	$color1 = $myrows[$conta]->color1;
	$color2 = $myrows[$conta]->color2;
	$autoplay = $myrows[$conta]->autoplay;
	$tags = $myrows[$conta]->tags;
	include('template/panel.html');			
	$conta++;
	}

}


function widget_ourstats_stats_widget($args) {

 
  
    extract($args);
	
	  $options = get_option("widget_ourstats_stats_widget");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'ourSTATS pluginswp.com',
	  'id' => '1'
      );
  }

	$aaux=array();
	$aaux[0]="ourstats_stats_widget";
	
  echo $before_widget;
  echo $before_title;
  echo $options['title'];
  echo $after_title;
  $aaux[1]=$options['id'];
 echo ourstats_stats_widget_render($aaux);
  echo $after_widget;

}



function ourstats_stats_widget_control()
{
  $options = get_option("widget_ourstats_stats_widget");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'ourSTATS pluginswp.com',
	  'id' => '1'
      );
  }
 
  if ($_POST['pera-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['pera-WidgetTitle']);
	 $options['id'] = htmlspecialchars($_POST['pera-WidgetId']);
    update_option("widget_ourstats_stats_widget", $options);
  }
  
  
  global $wpdb; 
	$table_name = $wpdb->prefix . "ourstats_stats_widget";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new gallery of videos, from the administration of pera plugin.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="pera-WidgetId" id="pera-WidgetId">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($options['id']==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';
	
	
 
echo '
  <p>
    <label for="pera-WidgetTitle">Widget Title: </label>
    <input type="text" id="pera-WidgetTitle" name="pera-WidgetTitle" value="'.$options['title'].'" /><br/>
	<label for="pera-WidgetTitle">STATS ID: </label>
   '.$selector.'
    <input type="hidden" id="pera-Submit" name="pera-Submit" value="1" />
  </p>
';
}


}





function ourstats_stats_widget_init(){
	register_sidebar_widget(__('ourSTATS stats'), 'widget_ourstats_stats_widget');
	register_widget_control(   'ourSTATS stats', 'ourstats_stats_widget_control', 300, 300 );
}


function ourstats_stats_widget_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		add_menu_page('ourstats_stats_widget', 'OurSTATS plugin', 8, basename(__FILE__), 'ourstats_stats_widget_panel');
	}
}
if (function_exists('add_action')) {
	add_action('admin_menu', 'ourstats_stats_widget_add_menu'); 
}
add_action('wp_head', 'ourstats_stats_widget_head');
add_filter('the_content', 'ourstats_stats_widget');
add_action('activate_ourstats_stats_widget/ourstats_stats_widget.php','ourstats_stats_widget_instala');
add_action('deactivate_ourstats_stats_widget/ourstats_stats_widget.php', 'ourstats_stats_widget_desinstala');
add_action("plugins_loaded", "ourstats_stats_widget_init");
?>