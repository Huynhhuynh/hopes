<?php
/**
 * Global default mail template 
 * 
 */

return [
  [
    'enable' => true,
    'email_action' => 'DONOR_DONATION_SUCCESSFUL',
    'email_subject' => __( 'Donation Receipt', 'hopes' ),
    'email_header' => __( 'Donation Receipt', 'hopes' ),
    'email_message' => '<p>Dear {name},</pre>

    <p>Thank you for your donation. Your generosity is appreciated! Here are the details of your donation:</p>
    
    <p>Donor: {fullname}<br />
    Donation: {donation}<br />
    Donation Date: {date}<br />
    Amount: {amount}<br />
    Payment Method: {payment_method}<br />
    Payment ID: {payment_id}</p>
    
    <p>{receipt_link}</p>
    
    <p>Sincerely,<br />
    {sitename}</p>',
    'email_recipients' => ''
  ],
  [
    'enable' => true,
    'email_action' => 'DONOR_OFFLINE_DONATION_INSTRUCTIONS',
    'email_subject' => __( '{donation} - Offline Donation Instructions', 'hopes' ),
    'email_header' => __( 'Offline Donation Instructions', 'hopes' ),
    'email_message' => '<p>To make an offline donation toward this cause, follow these steps:<p/>

    <p>Write a check payable to "{sitename}"<br />
    On the memo line of the check, indicate that the donation is for "{sitename}"<br />
    Mail your check to:</p>
    
    <p>{offline_mailing_address}</p>
    
    <p>Your tax-deductible donation is greatly appreciated!</p>',
    'email_recipients' => ''
  ],
  [
    'enable' => true,
    'email_action' => 'DONOR_REGISTRATION_INFORMATION',
    'email_subject' => sprintf( __( '[%s] Your username and password', 'hopes' ), get_bloginfo( 'name' ) ),
    'email_header' => __( 'New User Registration', 'hopes' ),
    'email_message' => '<p>Dear {name}</p>

    <p>A user account has been created for you on {site_url}. You may access your account at anytime by using "{username}" to log in.</p>
    
    <p>To reset your password, simply click the link below to create a new password:</p>
    
    <p>{reset_password_link}</p>
    
    <p>You can log in to your account using the link below:</p>
    
    <p><a href="'. wp_login_url() .'">Click Here to Log In »</a></p>
    
    <p>Sincerely<br />
    {sitename}</p>',
    'email_recipients' => ''
  ],
  [
    'enable' => true,
    'email_action' => 'DONOR_CONFIRM_EMAIL',
    'email_subject' => sprintf( __( 'Please confirm your email for %s', 'hopes' ), get_site_url() ),
    'email_header' => __( 'Confirm Email', 'hopes' ),
    'email_message' => '<p>Please click the link to access your donation history on {site_url}. If you did not request this email, please contact {admin_email}.</p>

    <p>{email_access_link}</p>
    
    <p>Sincerely,<br />
    {sitename}</p>',
    'email_recipients' => ''
  ],
  [
    'enable' => true,
    'email_action' => 'ADMIN_NEW_DONATION',
    'email_subject' => __( 'New Donation - #{payment_id}', 'hopes' ),
    'email_header' => __( 'New Donation!', 'hopes' ),
    'email_message' => '<p>Hi there,</p>

    <p>This email is to inform you that a new donation has been made on your website: {site_url}.</p>

    <p>Donor: {name}</b>
    Donation: {donation}</b>
    Amount: {amount}</b>
    Payment Method: {payment_method}</p>

    <p>Thank you,<br />
    {sitename}</p>',
    'email_recipients' => get_option( 'admin_email' )
  ],
  [
    'enable' => true,
    'email_action' => 'ADMIN_NEW_OFFLINE_DONATION',
    'email_subject' => __( 'New Pending Donation', 'hopes' ),
    'email_header' => __( 'New Offline Donation!', 'hopes' ),
    'email_message' => '<p>Hi there,</p>

    <p>This email is to inform you that a new donation has been made on your website: {site_url}.</p>
    
    <p>Donor: {name}<br />
    Donation: {donation}<br />
    Amount: {amount}<br />
    Payment Method: {payment_method}</p>
    
    <p>Thank you,<br />
    {sitename}</p>',
    'email_recipients' => get_option( 'admin_email' )
  ],
  [
    'enable' => true,
    'email_action' => 'ADMIN_NEW_USER_REGISTRATION',
    'email_subject' => sprintf( __( '[%s] New User Registration', 'hopes' ), get_bloginfo( 'name' ) ),
    'email_header' => __( 'New User Registration', 'hopes' ),
    'email_message' => '<p>New user registration on your site {sitename}:</p>

    <p>Username: {username}<br />
    Email: {user_email}</p>',
    'email_recipients' => get_option( 'admin_email' )
  ],
];