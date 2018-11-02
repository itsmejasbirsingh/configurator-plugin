<?php
/*
	Plugin Name: Configurator
*/
require_once('configurator.php');

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
		global $wpdb;
		echo $args['before_widget'];
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'text_domain' );
			$attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : '';
			if($title && $attribute)
			{
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
				$attribute = 'jsr_'.str_replace('-', '_', $attribute);
							 
				$qry = "SELECT DISTINCT `meta_value` from {$wpdb->prefix}postmeta WHERE meta_key = '".$attribute."' ORDER BY `meta_id` DESC";
				$attrs = $wpdb->get_results($qry);
				?>
					<ul>
				<?php
				foreach($attrs as $attr)
				{
					?>
						<li><input type="checkbox"> <?php echo $attr->meta_value; ?></li>
					<?php
				}
				?>
				</ul>
				<?php
			}
		echo $args['after_widget'];

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		global $wpdb;
		
		// What to show in widget area admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'text_domain' );
		$attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : '';
		
		// get all configurator meta keys
		$qry = "SELECT distinct `meta_key` from {$wpdb->prefix}postmeta WHERE meta_key LIKE 'jsr_%' ORDER BY `meta_id` DESC";
		$meta_keys = $wpdb->get_results($qry);
		?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat _title" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php if (count($meta_keys) > 0) { ?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"><?php esc_attr_e( 'Attribute:', 'text_domain' ); ?></label> 
		
		<select class="widefat _attribute" id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
		<?php
		foreach($meta_keys as $metakey)
		{
			 $metaKeyName = ltrim($metakey->meta_key,'jsr_');
			 $metaKeyName = str_replace('_', '-', $metaKeyName);
			 ?>
			<option <?php if($attribute == $metaKeyName) echo "selected"; ?>><?php echo $metaKeyName; ?></option>
			<?php
		}
		?>
		</select>
		</p>	
		<?php 
		}
		else
		{
			echo "<p>Add one or more configurator attribute in any product!</p>";
		}

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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['attribute'] = ( ! empty( $new_instance['attribute'] ) ) ? sanitize_text_field( $new_instance['attribute'] ) : '';
		
		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Configurator' );
});