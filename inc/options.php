<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;
/**
 * Options
 */

/**
 * Register global settings panel
 */
function hopes_global_options() {

  $settings_global_tabs = apply_filters( 'hopes/settings_global_tabs', [] );

  $hopes_settings_object = Container::make( 'theme_options', __( 'Settings', 'hopes' ) )
    ->set_page_file( 'hopes-settings' )
    ->set_page_parent( 'edit.php?post_type=hopes-cause' );

  foreach( $settings_global_tabs as $index => $tab ) {
    $hopes_settings_object->add_tab( $tab[ 'name' ], $tab[ 'fields' ] );
  }

  add_action( 'hopes/settings_global_object', $hopes_settings_object );
}

add_action( 'carbon_fields_register_fields', 'hopes_global_options' );

/**
 * Global general settings tab
 */
function hopes_settings_global_add_general_tab( $tabs = [] ) {
  $page_options = hopes_get_select_option_page();
  $curreny_coptions = hopes_get_select_option_currency();

  $general_settings = [
    'name' => __( 'General', 'hopes' ),
    'fields' => [
      Field::make( 'separator', 'hopes_page_separator', __( 'Page Settings', 'hopes' ) ),
      Field::make( 'select', 'hopes_success_donation_page', __( 'Success Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'The page donors are sent to after completing their donations.', 'hopes' ) ),
      Field::make( 'select', 'hopes_failed_donation_page', __( 'Failed Donation Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'The page donors are sent to if their donation is cancelled or fails.', 'hopes' ) ),
      Field::make( 'select', 'hopes_donor_dashboard_page', __( 'Donor Dashboard Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'This is the page where donors can manage their information, review history and more (all in one place).', 'hopes' ) ),
      Field::make( 'separator', 'hopes_curency_separator', __( 'Curency Settings', 'hopes' ) ),
      Field::make( 'select', 'hopes_currency', __( 'Currency', 'hopes' ) )
        ->set_options( $curreny_coptions )
        ->set_help_text( __( 'The donation currency. Note that some payment gateways have currency restrictions', 'hopes' ) ),
      Field::make( 'select', 'hopes_currency_position', __( 'Currency Position', 'hopes' ) )
        ->set_options( [
          'before' => __( 'Before - $10', 'hopes' ),
          'after' => __( 'After - 10$', 'hopes' ),
        ] )
        ->set_help_text( __( 'The position of the currency symbol.', 'hopes' ) ),
      Field::make( 'text', 'hopes_currency_thousands_separator', __( 'Thousands Separator', 'hopes' ) )
        ->set_default_value( ',' )
        ->set_help_text( __( 'The symbol (typically , or .) to separate thousands.', 'hopes' ) ),
      Field::make( 'text', 'hopes_currency_decimal_separator', __( 'Decimal Separator', 'hopes' ) )
        ->set_default_value( '.' )
        ->set_help_text( __( 'The symbol (usually , or .) to separate decimal points.', 'hopes' ) ),
      Field::make( 'text', 'hopes_currency_number_of_decimals', __( 'Number of Decimals', 'hopes' ) )
        ->set_default_value( 2 )
        ->set_attribute( 'type', 'number' )
        ->set_help_text( __( 'The number of decimal points displayed in amounts.', 'hopes' ) ),
    ]
  ];

  array_push( $tabs, apply_filters( 'hopes/global_general_settings_tab', $general_settings ) );
  return $tabs;
}

add_action( 'hopes/settings_global_tabs', 'hopes_settings_global_add_general_tab', 10 );

function hopes_settings_global_add_payment_geteways_tab( $tabs = [] ) {

  $payment_gateways_settings = [
    'name' => __( 'Payment Gateways', 'hopes' ),
    'fields' => [
      Field::make( 'complex', 'hopes_paypal_method', __( 'Slider' ) )
        ->set_max( 1 )
        ->add_fields( array(
          Field::make( 'text', 'title', __( 'Slide Title' ) ),
          Field::make( 'image', 'photo', __( 'Slide Photo' ) ),
        ) )
        ->set_default_value( [
          [
            'title' => 'title',
          ]
        ] )
    ]
  ];

  array_push( $tabs, apply_filters( 'hopes/global_payment_gateways_settings_tab', $payment_gateways_settings ) );
  return $tabs;
}

add_action( 'hopes/settings_global_tabs', 'hopes_settings_global_add_payment_geteways_tab', 12 );

function hopes_settings_global_email_tab( $tabs = [] ) {

  $email_action_opts = array_merge( [
    '' => __( '--- Select Action ---', 'hopes' ),
  ], hopes_make_options_field( hopes_email_actions_register(), [
    'field_value' => 'action',
    'field_label' => 'label'
  ] ) );

  $email_system_settings = [
    'name' => __( 'Email', 'hopes' ),
    'fields' => [
      Field::make( 'separator', 'hopes_email_donor_separator', __( 'Email Template', 'hopes' ) ),
      Field::make( 'complex', 'hopes_email_template', __( 'Email Template Settings', 'hopes' ) )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( [
          Field::make( 'checkbox', 'enable', __( 'Enable', 'hopes' ) )
            ->set_default_value( true )
            ->set_help_text( __( 'Choose whether you want this email enabled or not.', 'hopes' ) ),
          Field::make( 'select', 'email_action', __( 'Action', 'hopes' ) )
            ->set_options( $email_action_opts )
            ->set_required( true )
            ->set_help_text( __( 'Choose action', 'hopes' ) ),
          Field::make( 'text', 'email_subject', __( 'Email Subject', 'hopes' ) )
            ->set_help_text( __( 'Enter the email subject line.', 'hopes' ) )
            ->set_required( true ),
          Field::make( 'text', 'email_header', __( 'Email Header', 'hopes' ) )
            ->set_help_text( __( 'Enter the email header that appears at the top of the email.', 'hopes' ) ),
          Field::make( 'rich_text', 'email_message', __( 'Email Message', 'hopes' ) ),
          Field::make( 'text', 'email_recipients', __( 'Email Recipients', 'hopes' ) )
            ->set_conditional_logic( [
              [
                'field' => 'email_action',
                'value' => [ 
                  'ADMIN_NEW_DONATION', 
                  'ADMIN_NEW_OFFLINE_DONATION', 
                  'ADMIN_NEW_USER_REGISTRATION' ],
                'compare' => 'IN'
              ]
            ] )
            ->set_help_text( __( 'Enter the email address(es) that should receive a notification. (Exam: admin1@gmail.com, admin2@gmail.com)', 'hopes' ) )
            ->set_default_value( get_option( 'admin_email' ) ),
        ] )
        ->set_default_value( hopes_set_default_email_template_global_settings() )
        ->set_header_template( '
        <% 
<<<<<<< HEAD
          var __email_actions_register = '. wp_json_encode( hopes_email_actions_register() ) .'
=======
          var __email_actions_register = '. wp_json_encode( hopes_email_actions_register() ) .';
>>>>>>> d7d7b0a78b1b81e534e64488c748ab1e7d687453
        %>
        <% if (email_action) { %>
          <% 
            var __email_action_name = __email_actions_register.find( o => { return o.action == email_action } )
          %>
          <%- enable ? `🟢` : `🔴` %> <%- __email_action_name?.label %>
        <% } %>' )
    ]
  ];

  array_push( $tabs, apply_filters( 'hopes/settings_global_email_system_tabs', $email_system_settings ) );
  return $tabs;
}

add_action( 'hopes/settings_global_tabs', 'hopes_settings_global_email_tab', 14 );