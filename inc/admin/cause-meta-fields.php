<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Cause custom meta fields
 * 
 */

function hopes_cause_meta_options() {

  $cause_meta_option_tabs = apply_filters( 'hopes/cause_meta_option_tabs', [] );

  $cause_meta_options = Container::make( 'post_meta', __( 'Cause Settings', 'hopes' ) )
    ->where( 'post_type', '=', 'hopes-cause' );

  if( count( $cause_meta_option_tabs ) > 0 ) {
    foreach( $cause_meta_option_tabs as $tab ) {
      $cause_meta_options->add_tab( $tab[ 'name' ], $tab[ 'fields' ] );
    }
  }

  do_action( 'hopes/cause_meta_options', $cause_meta_options );
}

add_action( 'carbon_fields_register_fields', 'hopes_cause_meta_options' );

/**
 * Register donation options tab
 * 
 */
function hopes_cause_donation_options_tab_register( $tabs = [] ) {
  array_push( $tabs, [
    'name' => __( 'Donation Options', 'hopes' ),
    'fields' => [
      Field::make( 'radio', 'cause_donation_option', __( 'Donation Option', 'hopes' ) )
        ->set_options( [
          'multi-level-donation' => __( 'Multi-level Donation', 'hopes' ),
          'set-donation' => __( 'Set Donation', 'hopes' ),
        ] )
        ->set_default_value( 'multi-level-donation' )
        ->set_help_text( __( 'Do you want this form to have one set donation price or multiple levels (for example, $10, $20, $50)?', 'hopes' ) ),
      Field::make( 'text', 'cause_amount_donation', __( 'Set Amount Donation', 'hopes' ) )
        ->set_default_value( 5 )
        ->set_attribute( 'type', 'number' )
        ->set_help_text( __( 'This is the set donation amount for this cause. If you have a "Custom Amount Minimum" set, make sure it is less than this amount.', 'hopes' ) )
        ->set_conditional_logic( [
          [
            'field' => 'cause_donation_option',
            'value' => 'set-donation'
          ]
        ] ),
      Field::make( 'complex', 'cause_donation_amount_levels', __( 'Donation Amount Levels', 'hopes' ) )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( [
          Field::make( 'text', 'amount', __( 'Amount', 'hopes' ) )
            ->set_attribute( 'type', 'number' )
            ->set_help_text( __( 'Enter amount for this level.' ) )
            ->set_required( true ),
          Field::make( 'text', 'text', __( 'Text', 'hopes' ) )
            ->set_help_text( __( 'Enter label for this level.' ) ),
        ] )
        ->set_default_value( [
          [
            'amount' => 5,
            'text' => __( 'Silver', 'hopes' )
          ],
          [
            'amount' => 10,
            'text' => __( 'Gold', 'hopes' )
          ],
          [
            'amount' => 20,
            'text' => __( 'Diamond', 'hopes' )
          ],
        ] )
        ->set_help_text( __( 'Default the selected is first item.', 'hopes' ) )
        ->set_header_template( '
        <% if ( amount ) { %>
          Donation Level <%- $_index + 1 %>: <%- text %> (<%- amount %>)
        <% } %>' )
        ->set_conditional_logic( [
          [
            'field' => 'cause_donation_option',
            'value' => 'multi-level-donation'
          ]
        ] ),
      Field::make( 'checkbox', 'cause_custom_amount', __( 'Enable Custom Amount', 'hopes' ) )
        ->set_default_value( true )
        ->set_help_text( __( 'Do you want the user to be able to input their own donation amount?' ) )
        ->set_width( 25 ),
      Field::make( 'text', 'cause_min_amount_limit', __( 'Minimum Amount', 'hopes' ) )
        ->set_default_value( 5 )
        ->set_attribute( 'type', 'number' )
        ->set_width( 25 )
        ->set_help_text( __( 'Set the minimum amount for all gateways.', 'hopes' ) )
        ->set_conditional_logic( [
          [
            'field' => 'cause_custom_amount',
            'value' => true
          ]
        ] ),
      Field::make( 'text', 'cause_max_amount_limit', __( 'Maximum Amount', 'hopes' ) )
        ->set_default_value( 100 )
        ->set_attribute( 'type', 'number' )
        ->set_width( 25 )
        ->set_help_text( __( 'Set the maximum amount for all gateways.', 'hopes' ) )
        ->set_conditional_logic( [
          [
            'field' => 'cause_custom_amount',
            'value' => true
          ]
        ] ),
      Field::make( 'text', 'cause_custom_amount_text', __( 'Custom Amount Text', 'hopes' ) )
        ->set_default_value( __( 'Custom Amount', 'hopes' ) )
        ->set_help_text( __( 'This text appears as a label below the custom amount field for set donation cause.', 'hopes' ) )
        ->set_width( 25 )
        ->set_conditional_logic( [
          [
            'field' => 'cause_custom_amount',
            'value' => true
          ]
        ] ),
    ]
  ] );

  return $tabs;
}

add_filter( 'hopes/cause_meta_option_tabs', 'hopes_cause_donation_options_tab_register', 10 );

/**
 * Register cause donation goal tab
 * 
 */
function hopes_cause_donation_goal_tab_register( $tabs ) {

  array_push( $tabs, [
    'name' => __( 'Donation Goal', 'hopes' ),
    'fields' => [
      Field::make( 'checkbox', 'cause_donation_goal', __( 'Enable Donation Goal', 'hopes' ) )
        ->set_default_value( true )
        ->set_help_text( __( 'Enable donation goal for this cause.', 'hopes' ) ),
      Field::make( 'text', 'cause_target_donation_amount', __( 'Target Donation Amount', 'hopes' ) )
        ->set_default_value( 1000 )
        ->set_attribute( 'type', 'number' )
        ->set_help_text( __( 'Set the total number of donations as a goal.', 'hopes' ) )
        ->set_conditional_logic( [
          [
            'field' => 'cause_donation_goal',
            'value' => true
          ]
        ] ),
      Field::make( 'rich_text', 'cause_goal_achieved_message', __( 'Goal Achieved Message', 'hopes' ) )
        ->set_default_value( __( 'Thank you to all our donors, we have met our fundraising goal.', 'hopes' ) )
        ->set_help_text( __( 'Message when the goal is closed', 'hopes' ) )
        ->set_conditional_logic( [
          [
            'field' => 'cause_donation_goal',
            'value' => true
          ]
        ] )
    ] 
  ] );

  return $tabs;
}

add_filter( 'hopes/cause_meta_option_tabs', 'hopes_cause_donation_goal_tab_register', 12 );