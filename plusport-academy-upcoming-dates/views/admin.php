<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_title' ); ?>">Kalendertitel:</label>
	<input type="text" id="<?php echo $this->get_field_id( 'pp_academy_title' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_title' ); ?>" value="<?php echo $instance['pp_academy_title']; ?>" style="width:100%;" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_maxsession' ); ?>">Maximaal aantal uitvoeringen:</label>
	<input type="number" id="<?php echo $this->get_field_id( 'pp_academy_maxsession' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_maxsession' ); ?>" value="<?php echo $instance['pp_academy_maxsession']; ?>" style="width:100%;" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_trainings_id' ); ?>">Trainings ID:</label>
	<input type="number" id="<?php echo $this->get_field_id( 'pp_academy_trainings_id' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_trainings_id' ); ?>" value="<?php echo $instance['pp_academy_trainings_id']; ?>" style="width:100%;" />
</p>

<hr />

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_dateformat' ); ?>">Opmaak datum:</label>
	<input type="text" id="<?php echo $this->get_field_id( 'pp_academy_dateformat' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_dateformat' ); ?>" value="<?php echo $instance['pp_academy_dateformat']; ?>" style="width:100%;" />
	<p class="description">Standaard: <code>DD-MM-YYYY HH:MM</code></p>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_date_from_prefix' ); ?>">Datum start prefix:</label>
	<input type="text" id="<?php echo $this->get_field_id( 'pp_academy_date_from_prefix' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_date_from_prefix' ); ?>" value="<?php echo $instance['pp_academy_date_from_prefix']; ?>" style="width:100%;" />
	<p class="description">Standaard: <code>Van:</code></p>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_date_until_prefix' ); ?>">Datum eind prefix:</label>
	<input type="text" id="<?php echo $this->get_field_id( 'pp_academy_date_until_prefix' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_date_until_prefix' ); ?>" value="<?php echo $instance['pp_academy_date_until_prefix']; ?>" style="width:100%;" />
	<p class="description">Standaard: <code>Tot:</code></p>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_merge_sessiondates' ); ?>">Opleidingsdagen samenvoegen:</label>
	<input type="checkbox" id="<?php echo $this->get_field_id( 'pp_academy_merge_sessiondates' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_merge_sessiondates' ); ?>" value="1" <?php if($instance['pp_academy_merge_sessiondates'] == '1'){ echo "checked"; } ?> />
</p>


<hr />

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_link_to_webshop' ); ?>">Link naar de webshop:</label>
	<input type="checkbox" id="<?php echo $this->get_field_id( 'pp_academy_link_to_webshop' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_link_to_webshop' ); ?>" value="1" <?php if($instance['pp_academy_link_to_webshop'] == '1'){ echo "checked"; } ?> />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'pp_academy_url_to_webshop' ); ?>">Pagina URL:</label>
	<input type="text" id="<?php echo $this->get_field_id( 'pp_academy_url_to_webshop' ); ?>" name="<?php echo $this->get_field_name( 'pp_academy_url_to_webshop' ); ?>" value="<?php echo $instance['pp_academy_url_to_webshop']; ?>" style="width:100%;" />
</p>
