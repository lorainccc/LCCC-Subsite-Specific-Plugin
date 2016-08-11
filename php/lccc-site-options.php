<?php 

 /*
  *
  *  Adds a custom field to the general settings tab.
  *  The field contains the desired path to the subsite.
  *  
  *  Example: "student-resources/academic-resources"
  *
  *  No leading or trailing "/" or else it will throw off the explode.
  *
  */

 $lccc_base_site_path = new new_lccc_base_path_setting();

class new_lccc_base_path_setting {
 function new_lccc_base_path_setting() {
  add_filter( 'admin_init', array( &$this , 'lccc_register_fields' ) );
 }
 
 /**
  *
  * Each field needs to be registered using register_setting and then added via add_settings_field
  *
  */
 function lccc_register_fields() {
  register_setting( 'general', 'lccc_base_path', 'esc_attr' );
  add_settings_section( 'lccc-settings', 'LCCC Settings', '__return_false', 'general' );
  add_settings_field( 'lccc_base_url_path', '<label for="lccc_base_path">'.__('Base URL Path:' , 'lccc_base_path').'</label>', array(&$this, 'lccc_fields_html') , 'general', 'lccc-settings' );
  
  register_setting( 'general', 'lccc_footer_phone', 'esc_attr' );
  register_setting( 'general', 'lccc_footer_email', 'esc_attr' );
  add_settings_section( 'lccc-footer-settings', 'Footer Information', '__return_false', 'general' );  
  add_settings_field( 'lccc_footer_phone', '<label for="lccc_footer_phone">'.__('Phone Number:' , 'lccc_footer_phone').'</label>', array(&$this, 'lccc_footer_phone_field_html') , 'general', 'lccc-footer-settings' );  
  add_settings_field( 'lccc_footer_email', '<label for="lccc_footer_email">'.__('Email Address:' , 'lccc_footer_email').'</label>', array(&$this, 'lccc_footer_email_field_html') , 'general', 'lccc-footer-settings' );
 }
 
 function lccc_fields_html() {
  $value = get_option( 'lccc_base_path', '' );
  echo '<input type="text" id="lccc_base_path" name="lccc_base_path" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path <strong>(without starting or trailing /)</strong> to represent where this site exists in the website.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: student-resources/academic-resources/academic-divisions</strong></p>';
 }


 function lccc_footer_phone_field_html() {
  $value = get_option( 'lccc_footer_phone', '' );
  echo '<input type="text" id="lccc_footer_phone" name="lccc_footer_phone" value="' . $value . '" size="75" />';
 }

 function lccc_footer_email_field_html() {
  $value = get_option( 'lccc_footer_email', '' );
  echo '<input type="text" id="lccc_footer_email" name="lccc_footer_email" value="' . $value . '" size="75" />';
 }
}
?>