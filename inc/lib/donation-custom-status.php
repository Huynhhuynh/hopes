<?php 
/**
 * Donation custom status 
 * 
 */

return [
  'complete' => [
    'label' => _x( 'Complete', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Completed <span class="count">(%s)</span>', 'Completed <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'refunded' => [
    'label' => _x( 'Refunded', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Refunded <span class="count">(%s)</span>', 'Refunded <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'failed' => [
    'label' => _x( 'Failed', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Failed <span class="count">(%s)</span>', 'Failed <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'cancelled' => [
    'label' => _x( 'Cancelled', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Cancelled <span class="count">(%s)</span>', 'Cancelled <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'abandoned' => [
    'label' => _x( 'Abandoned', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Abandoned <span class="count">(%s)</span>', 'Abandoned <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'pre-approved' => [
    'label' => _x( 'Pre-Approved', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Pre-Approved <span class="count">(%s)</span>', 'Pre-Approved <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'processing' => [
    'label' => _x( 'Processing', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Processing <span class="count">(%s)</span>', 'Processing <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
  'revoked' => [
    'label' => _x( 'Revoked', 'post status label', 'hopes' ),
    'public' => true,
    'label_count' => _n_noop( 'Revoked <span class="count">(%s)</span>', 'Revoked <span class="count">(%s)</span>', 'hopes' ),
    'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
    'show_in_admin_all_list' => true,
    'show_in_admin_status_list' => true,
    'show_in_metabox_dropdown' => true,
    'show_in_inline_dropdown' => true,
  ],
];