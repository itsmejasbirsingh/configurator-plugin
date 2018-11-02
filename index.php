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
			'classname' => 'my_configurator',
			'description' => 'Display machine configuration',
		);
		parent::__construct( 'configurator_filter', 'Configurator', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		//What to show in sidebar frontend
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
		// What to show in widget area admin
		$machine_life_text = ! empty( $instance['machine_life_text'] ) ? $instance['machine_life_text'] : esc_html__( 'Machine Life greater than', 'text_domain' );
		
		$machine_life_year = ! empty( $instance['machine_life_year'] ) ? $instance['machine_life_year'] : esc_html__( '6', 'text_domain' );
		?>


		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'machine_life_text' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="machine-life _text" id="<?php echo esc_attr( $this->get_field_id( 'machine_life_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'machine_life_text' ) ); ?>" type="text" value="<?php echo esc_attr( $machine_life_text ); ?>">
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'machine_life_year' ) ); ?>"><?php esc_attr_e( 'Years:', 'text_domain' ); ?></label> 
		<input class="machine-life _years" id="<?php echo esc_attr( $this->get_field_id( 'machine_life_year' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'machine_life_year' ) ); ?>" type="text" value="<?php echo esc_attr( $machine_life_year ); ?>">
		</p>
		<?php 
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
		// Updating widget options
		$instance = array();
		$instance['machine_life_text'] = ( ! empty( $new_instance['machine_life_text'] ) ) ? sanitize_text_field( $new_instance['machine_life_text'] ) : '';
		$instance['machine_life_year'] = ( ! empty( $new_instance['machine_life_year'] ) ) ? sanitize_text_field( $new_instance['machine_life_year'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Configurator' );
});