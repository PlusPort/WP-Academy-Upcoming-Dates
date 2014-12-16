<!-- This file is used to markup the public-facing widget. -->
<?php
	echo "<script>";
		echo "var pp_academy_maxsession = '" . $instance['pp_academy_maxsession'] . "';";
		echo "var pp_academy_trainings_id = '" . $instance['pp_academy_trainings_id'] . "';";
		echo "var pp_plugin_path = '" . plugin_dir_url(__FILE__) . "';";
	echo "</script>";
?>

<div class="pp-academy-widget">
	<div class="upcoming-dates">
		Bezig met laden...
	</div>
</div>
