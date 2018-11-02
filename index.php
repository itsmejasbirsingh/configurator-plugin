<?php
/*
	Plugin Name: Configurator
*/
include('configurator.php');
class Configurator extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'my_widget',
			'description' => 'Display machine configuration',
		);
		parent::__construct( 'my_widget', 'Configurator', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

	echo "Machine Life Greater Than";
	echo "<select>";
		echo "<option>1 Year</option>";
		echo "<option>2 Year</option>";
		echo "<option>3 Year</option>";
		echo "<option>4 Year</option>";
		echo "<option>5 Year</option>";
		echo "<option>6 Year</option>";
	echo "</select>";

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Configurator' );
});