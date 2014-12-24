<!-- This file is used to markup the public-facing widget. -->
<?php
	echo "<script>";
		echo "var pp_academy_maxsession = '" . $instance['pp_academy_maxsession'] . "';";
		echo "var pp_academy_trainings_id = '" . $instance['pp_academy_trainings_id'] . "';";
		echo "var pp_plugin_path = '" . plugin_dir_url(__FILE__) . "';";
		echo "var pp_academy_widgetdata = {
					'pp_academy_title': '" . $instance['pp_academy_title'] . "',
					'pp_academy_dateformat': '" . $instance['pp_academy_dateformat'] . "',
					'pp_academy_date_from_prefix': '" . $instance['pp_academy_date_from_prefix'] . "',
					'pp_academy_date_until_prefix': '" . $instance['pp_academy_date_until_prefix'] . "'
					};";
	echo "</script>";
?>

<div class="pp-academy-widget">
	<div class="upcoming-dates-title"><?php echo $instance['pp_academy_title']; ?></div>
	<div class="upcoming-dates">
		Bezig met laden...
	</div>
</div>
