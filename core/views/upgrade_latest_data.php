<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

global $AffiliatePress, $wpdb, $affiliatepress_version;

$affiliatepress_old_version = get_option('bookingpress_version', true);

if (version_compare($affiliatepress_old_version, '1.0.2', '<') ) {
    $AffiliatePress->affiliatepress_install_default_creative_data();
    if(!$AffiliatePress->affiliatepress_pro_install()){
        $AffiliatePress->affiliatepress_update_settings('default_commission_status','commissions_settings',2);
        $AffiliatePress->affiliatepress_update_all_auto_load_settings();
    }
}

if (version_compare($affiliatepress_old_version, '1.2', '<') ) 
{
    global $affiliatepress_tbl_ap_affiliate_form_fields,$AffiliatePress;
    $this->affiliatepress_update_record($affiliatepress_tbl_ap_affiliate_form_fields, array('ap_field_edit'=>1), array( 'ap_form_field_name' => 'ap_affiliates_payment_email' ));
    $AffiliatePress->affiliatepress_update_settings('default_url_type','affiliate_settings','affiliate_default_url');
}

if (version_compare($affiliatepress_old_version, '1.3', '<') ) 
{
    global $AffiliatePress;
    $AffiliatePress->affiliatepress_update_settings('visit_all','message_settings',esc_html__('All Visits', 'affiliatepress-affiliate-marketing'));
}

$affiliatepress_new_version = '1.3';
update_option('affiliatepress_new_version_installed', 1);
update_option('affiliatepress_version', $affiliatepress_new_version);
update_option('affiliatepress_updated_date_' . $affiliatepress_new_version, current_time('mysql'));