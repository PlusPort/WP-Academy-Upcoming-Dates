<!-- This file is used to markup the administration form of the widget. -->
<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_maxsession' ); ?>">Maximaal aantal uitvoeringen:</label>
	<input type="number" id="<?php echo $this->get_field_id( 'pp_academy_maxsession' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_maxsession' ); ?>" value="<?php echo $instance['pp_academy_maxsession']; ?>" style="width:100%;" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_trainings_id' ); ?>">Trainigs ID:</label>
	<input type="number" id="<?php echo $this->get_field_id( 'pp_academy_trainings_id' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_trainings_id' ); ?>" value="<?php echo $instance['pp_academy_trainings_id']; ?>" style="width:100%;" />
</p>
