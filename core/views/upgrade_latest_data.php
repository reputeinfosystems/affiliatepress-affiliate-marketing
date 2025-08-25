<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

global $AffiliatePress, $wpdb, $affiliatepress_version;

$affiliatepress_new_version = '1.0.1';

update_option('affiliatepress_new_version_installed', 1);
update_option('affiliatepress_version', $affiliatepress_new_version);
update_option('affiliatepress_updated_date_' . $affiliatepress_new_version, current_time('mysql'));