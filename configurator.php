<?php
// Adding a configurator tab in product data
add_filter( 'woocommerce_product_data_tabs', 'woocommerce_custom_product_data_tab' );

function woocommerce_custom_product_data_tab( $original_prodata_tabs) {
    $new_custom_tab['my-custom-tab'] = array(
        'label' => __( 'Configurator', 'woocommerce' ),
        'target' => 'my_custom_product_data_tab',
        'class'     => array( 'show_if_simple', 'show_if_variable'  ),
    );
    $insert_at_position = 7;
    $tabs = array_slice( $original_prodata_tabs, 0, $insert_at_position, true ); 
    $tabs = array_merge( $tabs, $new_custom_tab ); 
    $tabs = array_merge( $tabs, array_slice( $original_prodata_tabs, $insert_at_position, null, true ) );
    return $tabs;
}


// adding panel content in configurator tab
add_action('woocommerce_product_data_panels', 'woocom_custom_product_data_fields');

function woocom_custom_product_data_fields() {
    global $post;
    ?> <div id = 'my_custom_product_data_tab'
    class = 'panel woocommerce_options_panel' > <?php
        ?> <div class = 'options_group' > <?php
              // Text Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_name',
      'label' => __( 'Machine Name', 'woocommerce' ),
      'wrapper_class' => 'show_if_simple', //show_if_simple or show_if_variable
      'placeholder' => 'Name of the machine',
      'desc_tip' => 'true',
      'description' => __( 'Enter the machine name here.', 'woocommerce' )
    )
  );

  // Number Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_height',
      'label' => __( 'Machine Height', 'woocommerce' ),
      'placeholder' => '',
      'description' => __( '(in meters)', 'woocommerce' ),
      'type' => 'number',
      'custom_attributes' => array(
         'step' => 'any',
         'min' => '1'
      )
    )
  );

  // Number Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_quantity',
      'label' => __( 'Machine Quantity', 'woocommerce' ),
      'type' => 'number',
      'custom_attributes' => array(
         'step' => 'any',
         'min' => '1'
      )
    )
  );

  // Number Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_engine_hourse_power',
      'label' => __( 'Enigne Hourse Power', 'woocommerce' ),
      'type' => 'number',
      'custom_attributes' => array(
         'step' => 'any',
         'min' => '1'
      )
    )
  );

  // Number Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_machine_life',
      'label' => __( 'Machine Life', 'woocommerce' ),
      'description' => __( '(in years)', 'woocommerce' ),
      'type' => 'number',
    )
  );

  // Number Field
  woocommerce_wp_text_input(
    array(
      'id' => 'jsr_engine_life',
      'label' => __( 'Engine Life', 'woocommerce' ),
      'description' => __( '(in years)', 'woocommerce' ),
      'type' => 'number',
    )
  );

  // Checkbox
  woocommerce_wp_checkbox(
    array(
      'id' => 'jsr_needs_repair',
      'label' => __('Any repair required', 'woocommerce' ),
      'description' => __( 'Is there any repair needed in the machine', 'woocommerce' ),
    )
  );


// Select
  woocommerce_wp_select(
    array(
      'id' => 'jsr_usage_type',
      'label' => __( 'Inside/Outside/Both', 'woocommerce' ),
      'options' => array(
         'inside' => __( 'Inside', 'woocommerce' ),
         'outside' => __( 'Outside', 'woocommerce' ),
         'both' => __( 'Both', 'woocommerce' )
      )
    )
  );

  // Select
  woocommerce_wp_select(
    array(
      'id' => 'jsr_size',
      'label' => __( 'Size', 'woocommerce' ),
      'options' => array(
         'small' => __( 'Small', 'woocommerce' ),
         'medium' => __( 'Medium', 'woocommerce' ),
         'large' => __( 'Large', 'woocommerce' )
      )
    )
  );

  // Textarea
  woocommerce_wp_textarea_input(
     array(
       'id' => 'jsr_description',
       'label' => __( 'Description', 'woocommerce' ),
       'placeholder' => '',
       'description' => __( 'Enter the description.', 'woocommerce' )
     )
 );
        ?> </div>

    </div><?php
}

/** Hook callback function to save custom fields information */
function woocom_save_proddata_custom_fields($post_id) {

    $field = $_POST['jsr_name'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_name', esc_attr($field));
    }

    $field = $_POST['jsr_height'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_height', esc_attr($field));
    }

    $field = $_POST['jsr_description'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_description', esc_html($field));
    }

    $field = $_POST['jsr_size'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_size', esc_attr($field));
    }

    $field = $_POST['jsr_quantity'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_quantity', esc_attr($field));
    }

    $field = $_POST['jsr_machine_life'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_machine_life', esc_attr($field));
    }
    $field = $_POST['jsr_engine_hourse_power'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_engine_hourse_power', esc_attr($field));
    }

    $field = $_POST['jsr_engine_life'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_engine_life', esc_attr($field));
    }

    $field = $_POST['jsr_usage_type'];
    if (!empty($field)) {
        update_post_meta($post_id, 'jsr_usage_type', esc_attr($field));
    }

    $field = isset($_POST['jsr_needs_repair']) ? 'yes' : 'no';
    update_post_meta($post_id, 'jsr_needs_repair', $field);
}

add_action( 'woocommerce_process_product_meta_simple', 'woocom_save_proddata_custom_fields'  );