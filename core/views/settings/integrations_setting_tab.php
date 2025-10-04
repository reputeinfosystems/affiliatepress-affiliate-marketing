<?php 
global $AffiliatePress;
?>
<el-tab-pane class="ap-tabs--v_ls__tab-item--pane-body" name ="integrations_settings"  data-tab_name="integrations_settings">
    <template #label>
        <span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="ap-setting-fill-stroke-active" d="M20.8889 6.44444H18.4984C17.9457 6.44444 17.5556 5.88612 17.5556 5.33333C17.5556 3.49239 16.0632 2 14.2222 2C12.3812 2 10.8889 3.49239 10.8889 5.33333C10.8889 5.88612 10.4987 6.44444 9.94589 6.44444H7.55556C6.9419 6.44444 6.44444 6.94191 6.44444 7.55556V9.94589C6.44444 10.4987 5.88612 10.8889 5.33333 10.8889C3.49239 10.8889 2 12.3812 2 14.2222C2 16.0632 3.49239 17.5556 5.33333 17.5556C5.88612 17.5556 6.44444 17.9457 6.44444 18.4984V20.8889C6.44444 21.5026 6.9419 22 7.55556 22H20.8889C21.5026 22 22 21.5026 22 20.8889V18.4984C22 17.9457 21.4417 17.5556 20.8889 17.5556C19.0479 17.5556 17.5556 16.0632 17.5556 14.2222C17.5556 12.3812 19.0479 10.8889 20.8889 10.8889C21.4417 10.8889 22 10.4987 22 9.94589V7.55556C22 6.94191 21.5026 6.44444 20.8889 6.44444Z" stroke="#4D5973" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="ap-settings-tab-lbl"><?php esc_html_e('Integrations', 'affiliatepress-affiliate-marketing'); ?></span>
        </span>
    </template>
    <div class="ap-general-settings-tabs--pb__card">
        <div class="ap-settings-tab-content-body-wrapper">
            <div class="ap-back-loader-container" id="ap-page-loading-loader" v-if="ap_settings_content_loaded == '1'">
                <div class="ap-back-loader"></div>
            </div>  
            <div v-else class="ap-gs--tabs-pb__content-body">
                <el-form :rules="rules_integrations" ref="integrations_setting_form" :model="integrations_setting_form" @submit.native.prevent>
                    <div class="ap-gs__cb--item">
                        <div class="ap-gs__cb--item-heading ap-gs__cb--item--main-heading ap-integration-heading">
                            <?php esc_html_e('Integrations', 'affiliatepress-affiliate-marketing'); ?>
                        </div>
                        <div class="ap-gs__cb--item-heading ap-gs__cb--item--main-heading ap-integration-sub-heading" v-if="integrations_setting_form.enable_woocommerce == true || integrations_setting_form.enable_armember == true || integrations_setting_form.enable_easy_digital_downloads == true || integrations_setting_form.enable_bookingpress == true || integrations_setting_form.enable_memberpress == true || integrations_setting_form.enable_surecart == true || integrations_setting_form.enable_restrict_content == true || integrations_setting_form.enable_wp_easycart == true || integrations_setting_form.enable_lifter_lms == true || integrations_setting_form.enable_arforms == true || integrations_setting_form.enable_give_wp == true || integrations_setting_form.enable_simple_membership == true || integrations_setting_form.enable_paid_memberships_pro == true || integrations_setting_form.enable_paid_memberships_subscriptions == true || integrations_setting_form.enable_ultimate_membership_pro == true || integrations_setting_form.enable_ninjaforms == true || integrations_setting_form.enable_wp_forms == true || integrations_setting_form.enable_gravity_forms == true || integrations_setting_form.enable_wp_simple_pay == true || integrations_setting_form.enable_masteriyo_lms == true || integrations_setting_form.enable_getpaid == true || integrations_setting_form.enable_learnpress == true || integrations_setting_form.enable_accept_stripe_payments == true || integrations_setting_form.enable_download_manager == true || integrations_setting_form.enable_learndash == true">
                            <?php esc_html_e('Active Integrations', 'affiliatepress-affiliate-marketing'); ?>
                        </div>
                        <div class="ap-gs__cb--item-body">
                            <div id="ap-enable-integration-woocommerce" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_woocommerce == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_woocommerce == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_woocommerce == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('WooCommerce', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_woocommerce">
                                            <el-switch  v-model="integrations_setting_form.enable_woocommerce"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_woocommerce == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_woocommerce == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Shipping', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">				
                                                    <el-form-item prop="woocommerce_exclude_shipping">
                                                        <el-switch  v-model="integrations_setting_form.woocommerce_exclude_shipping"/>  
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_woocommerce == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">					
                                                    <el-form-item prop="woocommerce_exclude_taxes">
                                                        <el-switch v-model="integrations_setting_form.woocommerce_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row> 
                                            <el-row type="flex" v-if="integrations_setting_form.enable_woocommerce == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Trash or Fail Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="woocommerce_reject_commission_on_refund">
                                                        <el-switch v-model="integrations_setting_form.woocommerce_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_woocommerce_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-armember" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_armember == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_armember == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_armember == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('ARMember', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_armember">
                                            <el-switch   v-model="integrations_setting_form.enable_armember"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_armember == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_armember === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">		
                                                    <el-form-item prop="armember_exclude_taxes">
                                                        <el-switch  v-model="integrations_setting_form.armember_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_armember === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">		
                                                    <el-form-item prop="armember_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.armember_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row> 
                                            <?php do_action('affiliatepress_add_armember_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-easy_digital_downloads" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_easy_digital_downloads == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_easy_digital_downloads == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_easy_digital_downloads == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Easy Digital Downloads', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_easy_digital_downloads">
                                            <el-switch   v-model="integrations_setting_form.enable_easy_digital_downloads"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_easy_digital_downloads == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_easy_digital_downloads === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Shipping', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="easy_digital_downloads_exclude_shipping">
                                                        <el-switch v-model="integrations_setting_form.easy_digital_downloads_exclude_shipping"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_easy_digital_downloads === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="easy_digital_downloads_exclude_taxes">
                                                        <el-switch   v-model="integrations_setting_form.easy_digital_downloads_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_easy_digital_downloads === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Delete, Fail, Abandoned or Revoked Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">		
                                                    <el-form-item prop="easy_digital_downloads_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.easy_digital_downloads_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_easy_digital_downloads_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-bookingpress" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_bookingpress == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_bookingpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_bookingpress == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('BookingPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_bookingpress">
                                            <el-switch  v-model="integrations_setting_form.enable_bookingpress"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_bookingpress == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_bookingpress == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">				
                                                    <el-form-item prop="bookingpress_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.bookingpress_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_bookingpress_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-memberpress" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_memberpress == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_memberpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_memberpress == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('MemberPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_memberpress">
                                            <el-switch   v-model="integrations_setting_form.enable_memberpress"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>    
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_memberpress == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_memberpress === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="memberpress_exclude_taxes">
                                                        <el-switch  v-model="integrations_setting_form.memberpress_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_memberpress === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Fail or Delete Transaction', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">				
                                                    <el-form-item prop="memberpress_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.memberpress_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_memberpress_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-surecart" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_surecart == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_surecart == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_surecart == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('SureCart', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_surecart">
                                            <el-switch   v-model="integrations_setting_form.enable_surecart"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_surecart == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_surecart === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Shipping', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">		
                                                    <el-form-item prop="surecart_exclude_shipping">
                                                        <el-switch  v-model="integrations_setting_form.surecart_exclude_shipping"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_surecart === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="surecart_exclude_taxes">
                                                        <el-switch v-model="integrations_setting_form.surecart_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_surecart === true" class="ap-setting-warning">
                                                <el-col :xs="24" :sm="24" :md="24" :lg="14" :xl="24" class="ap-gs__cb-item-left">
                                                    <div class="ap-toast-notification --ap-warning">
                                                        <div class="ap-front-tn-body">
                                                                <p><?php esc_html_e('Note', 'affiliatepress-affiliate-marketing'); ?>: <?php esc_html_e('SureCart commission is calculated to the total order price, that not calculated based on the product price', 'affiliatepress-affiliate-marketing'); ?>.</p>
                                                            </div>
                                                        </div>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_surecart_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-restrict_content" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_restrict_content == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_restrict_content == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_restrict_content == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Restrict Content Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_restrict_content">
                                            <el-switch   v-model="integrations_setting_form.enable_restrict_content"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_restrict_content == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_restrict_content === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Delete, Fail or Abandoned Payment', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="restrict_content_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.restrict_content_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_restrict_content_pro_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-wp_easycart" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_wp_easycart == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_wp_easycart == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_wp_easycart == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('WP EasyCart', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_wp_easycart">
                                            <el-switch   v-model="integrations_setting_form.enable_wp_easycart"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_wp_easycart == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_wp_easycart === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Shipping', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="wp_easycart_exclude_shipping">
                                                        <el-switch  v-model="integrations_setting_form.wp_easycart_exclude_shipping"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_wp_easycart === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="wp_easycart_exclude_taxes">
                                                        <el-switch  v-model="integrations_setting_form.wp_easycart_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_wp_easycart === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund or Cancel Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">				
                                                    <el-form-item prop="wp_easycart_reject_commission_on_refund">
                                                        <el-switch v-model="integrations_setting_form.wp_easycart_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_wp_easycart_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>     
                                </transition>   
                            </div>    
                            <div id="ap-enable-integration-lifter_lms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_lifter_lms == true">                     
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_lifter_lms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_lifter_lms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('LifterLMS', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_lifter_lms">
                                            <el-switch   v-model="integrations_setting_form.enable_lifter_lms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_lifter_lms == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">    
                                            <el-row type="flex" v-if="integrations_setting_form.enable_lifter_lms === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Cancel, Expire, and Trash Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="lifter_lms_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.lifter_lms_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_lifterlms_integrations_settings'); ?>
                                        </el-col>
                                    </el-row> 
                                </transition> 
                            </div>
                            <div id="ap-enable-integration-arforms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_arforms == true">    
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_arforms == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_arforms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('ARForms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_arforms">
                                            <el-switch  v-model="integrations_setting_form.enable_arforms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_arforms == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_arforms_integrations_settings'); ?>
                                        </el-col>
                                    </el-row> 
                                </transition>
                            </div>
                            <div id="ap-enable-integration-give_wp" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_give_wp == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_give_wp == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_give_wp == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('GiveWP', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_give_wp">
                                            <el-switch   v-model="integrations_setting_form.enable_give_wp"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="(integrations_setting_form.enable_give_wp == true) && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_give_wp_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div id="ap-enable-integration-simple_membership" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_simple_membership == true">    
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_simple_membership == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_simple_membership == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Simple Membership', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_simple_membership">
                                            <el-switch   v-model="integrations_setting_form.enable_simple_membership"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>    
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">  
                                    <el-row v-if="integrations_setting_form.enable_simple_membership == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_simple_membership_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div id="ap-enable-integration-paid_memberships_pro" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_paid_memberships_pro == true">    
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_paid_memberships_pro == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_paid_memberships_pro == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Paid Memberships Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_give_wp">
                                            <el-switch   v-model="integrations_setting_form.enable_paid_memberships_pro"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_paid_memberships_pro == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24"> 
                                        <el-row type="flex" v-if="integrations_setting_form.enable_paid_memberships_pro === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                            <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">   
                                                <h4><?php esc_html_e('Reject Commission on Refund', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                            </el-col>
                                            <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">		
                                                <el-form-item prop="paid_memberships_pro_reject_commission_on_refund">
                                                    <el-switch  v-model="integrations_setting_form.paid_memberships_pro_reject_commission_on_refund"/>          
                                                </el-form-item>
                                            </el-col>   
                                            <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                    <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>
                                        <?php do_action('affiliatepress_add_paid_memberships_pro_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>    
                            </div>
                            <div id="ap-enable-integration-paid_memberships_subscriptions" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_paid_memberships_subscriptions == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_paid_memberships_subscriptions == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_paid_memberships_subscriptions == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Paid Member Subscriptions', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_paid_memberships_subscriptions">
                                            <el-switch  v-model="integrations_setting_form.enable_paid_memberships_subscriptions"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_paid_memberships_subscriptions == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_paid_memberships_subscriptions === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="paid_memberships_subscriptions_exclude_taxes">
                                                        <el-switch v-model="integrations_setting_form.paid_memberships_subscriptions_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_paid_memberships_subscriptions === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Fail or Delete Payment', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="paid_memberships_subscriptions_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.paid_memberships_subscriptions_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_paid_memberships_subscriptions_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-ultimate_membership_pro" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_ultimate_membership_pro == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_ultimate_membership_pro == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_ultimate_membership_pro == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Ultimate Membership Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_ultimate_membership_pro">
                                            <el-switch  v-model="integrations_setting_form.enable_ultimate_membership_pro"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_ultimate_membership_pro == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_ultimate_membership_pro === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">		
                                                    <el-form-item prop="ultimate_membership_pro_exclude_taxes">
                                                        <el-switch  v-model="integrations_setting_form.ultimate_membership_pro_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_ultimate_membership_pro === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund or Fail Payment', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">					
                                                    <el-form-item prop="ultimate_membership_pro_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.ultimate_membership_pro_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_ultimate_membership_pro_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>   
                                </transition>      
                            </div>    
                            <div id="ap-enable-integration-ninjaforms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_ninjaforms == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_ninjaforms == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_ninjaforms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Ninja Forms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_ninjaforms">
                                            <el-switch  v-model="integrations_setting_form.enable_ninjaforms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_ninjaforms == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_ninjaforms_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div id="ap-enable-integration-wp_forms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_wp_forms == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_wp_forms == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_wp_forms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('WPForms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_wp_forms">
                                            <el-switch  v-model="integrations_setting_form.enable_wp_forms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>	
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_wp_forms == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_wp_forms_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div id="ap-enable-integration-gravity_forms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_gravity_forms == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_gravity_forms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_gravity_forms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Gravity Forms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_give_wp">
                                            <el-switch  v-model="integrations_setting_form.enable_gravity_forms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_gravity_forms == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_gravity_forms === true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">					
                                                    <el-form-item prop="gravity_forms_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.gravity_forms_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_gravity_forms_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>     
                                </transition>
                            </div>
                            <div id="ap-enable-integration-wp_simple_pay" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_wp_simple_pay == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="((integrations_setting_form.enable_wp_simple_pay == true)?'ap-integration-enabled':'') + (expand_settings != 1 ? ' ap-integration-main-not-content' : '')" v-if="integrations_setting_form.enable_wp_simple_pay == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('WP Simple Pay (Stripe)', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_wp_simple_pay">
                                            <el-switch  v-model="integrations_setting_form.enable_wp_simple_pay"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_wp_simple_pay == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                            <?php do_action('affiliatepress_add_wp_simple_pay_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div id="ap-enable-integration-masteriyo_lms" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_masteriyo_lms == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_masteriyo_lms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_masteriyo_lms == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Masteriyo LMS', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_masteriyo_lms">
                                            <el-switch  v-model="integrations_setting_form.enable_masteriyo_lms"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row v-if="integrations_setting_form.enable_masteriyo_lms == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row ap-settings-inner-row" type="flex">
                                    <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_masteriyo_lms == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Cancel or Fail Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">					
                                                    <el-form-item prop="masteriyo_lms_reject_commission_on_refund">
                                                        <el-switch v-model="integrations_setting_form.masteriyo_lms_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_masteriyo_lms === true" class="ap-setting-warning">
                                                <el-col :xs="24" :sm="24" :md="24" :lg="14" :xl="24" class="ap-gs__cb-item-left">
                                                <div class="ap-toast-notification --ap-warning">
                                                    <div class="ap-front-tn-body">
                                                            <p><?php esc_html_e('Note', 'affiliatepress-affiliate-marketing'); ?>: <?php esc_html_e('Masteriyo LMS in commission is calculated to the total order price, that not calculated based on the product price.', 'affiliatepress-affiliate-marketing'); ?></p>
                                                        </div>
                                                    </div>
                                            </el-col>
                                        </el-row>
                                        <?php do_action('affiliatepress_add_masteriyo_lms_integrations_settings'); ?>
                                    </el-col>
                                </el-row>
                            </div>
                            <div id="ap-enable-integration-getpaid" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_getpaid == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_getpaid == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_getpaid == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('GetPaid', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_getpaid">
                                            <el-switch  v-model="integrations_setting_form.enable_getpaid"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>   
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_getpaid == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_getpaid == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund, Fail or Cancel Invoice', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">				
                                                    <el-form-item prop="getpaid_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.getpaid_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <?php do_action('affiliatepress_add_getpaid_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>         
                            </div>             
                            <div id="ap-enable-integration-learnpress" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_learnpress == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_learnpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_learnpress == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('LearnPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_learnpress">
                                            <el-switch  v-model="integrations_setting_form.enable_learnpress"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_learnpress == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_learnpress == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Fail or Cancel Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">				
                                                    <el-form-item prop="learnpress_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.learnpress_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <?php do_action('affiliatepress_add_learnpress_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div> 
                            <div id="ap-enable-integration-accept_stripe_payments" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_accept_stripe_payments == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_accept_stripe_payments == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_accept_stripe_payments == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Accept Stripe Payments', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_accept_stripe_payments">
                                            <el-switch  v-model="integrations_setting_form.enable_accept_stripe_payments"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_accept_stripe_payments == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24"> 
                                            <el-row type="flex" v-if="integrations_setting_form.enable_accept_stripe_payments == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Shipping', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">			
                                                    <el-form-item prop="accept_stripe_payments_exclude_shipping">
                                                        <el-switch  v-model="integrations_setting_form.accept_stripe_payments_exclude_shipping"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row type="flex" v-if="integrations_setting_form.enable_accept_stripe_payments == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Exclude Taxes', 'affiliatepress-affiliate-marketing'); ?></h4>
                                                </el-col>
                                                <el-col :xs="12" :sm="12" :md="12" :lg="12" :xl="12" class="ap-gs__cb-item-right">		
                                                    <el-form-item prop="accept_stripe_payments_exclude_taxes">
                                                        <el-switch v-model="integrations_setting_form.accept_stripe_payments_exclude_taxes"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>   
                                            <el-row type="flex" v-if="integrations_setting_form.enable_accept_stripe_payments == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Cancel Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="accept_stripe_payments_reject_commission_on_refund">
                                                        <el-switch v-model="integrations_setting_form.accept_stripe_payments_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_accept_stripe_payments_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-download_manager" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_download_manager == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_download_manager == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_download_manager == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('Download Manager', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_download_manager">
                                            <el-switch  v-model="integrations_setting_form.enable_download_manager"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_download_manager == true" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                            <el-row type="flex" v-if="integrations_setting_form.enable_download_manager == true" class="ap-gs--tabs-pb__cb-item-row-inner">
                                                <el-col :xs="20" :sm="20" :md="20" :lg="20" :xl="20" class="ap-gs__cb-item-left">
                                                    <h4><?php esc_html_e('Reject Commission on Refund or Cancel Order', 'affiliatepress-affiliate-marketing'); ?><span class="ap-premium-integration" v-if="integration_reject_commission_disable == true"><?php echo $AffiliatePress->affiliatepress_get_premium_content(); //phpcs:ignore ?></span></h4>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-if="integration_reject_commission_disable == false">			
                                                    <el-form-item prop="download_manager_reject_commission_on_refund">
                                                        <el-switch  v-model="integrations_setting_form.download_manager_reject_commission_on_refund"/>                                         
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="ap-gs__cb-item-right" v-else>
                                                    <el-form-item prop="affiliate_integration_refund_disabled_switch">
                                                        <el-switch v-model="affiliate_integration_refund_disabled_switch" :disabled="integration_reject_commission_disable"/>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <?php do_action('affiliatepress_add_download_manager_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>
                                </transition>
                            </div>
                            <div id="ap-enable-integration-learndash" class="ap-integration-active-main-row" v-if="integrations_setting_form.enable_learndash == true">
                                <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row ap-integration-main-not-content" :class="(integrations_setting_form.enable_learndash == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_learndash == true">
                                    <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                        <h4><?php esc_html_e('LearnDash', 'affiliatepress-affiliate-marketing'); ?></h4>
                                    </el-col>
                                    <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                        <el-form-item prop="enable_learndash">
                                            <el-switch   v-model="integrations_setting_form.enable_learndash"/>                                         
                                        </el-form-item>
                                    </el-col>
                                </el-row> 
                                <transition @before-enter="affiliatepress_beforeEnter" @enter="affiliatepress_enter" @leave="affiliatepress_leave">
                                    <el-row v-if="integrations_setting_form.enable_arforms == true && (expand_settings == 1)" class="ap-gs--tabs-pb__cb-item-row ap-settings-inner-row ap-integration-no-inner-content" type="flex">
                                        <el-col class="ap-setting-inner-fields" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">   
                                        <?php do_action('affiliatepress_add_learndash_integrations_settings'); ?>
                                        </el-col>
                                    </el-row>  
                                </transition>
                            </div>
                            <div class="ap-gs__cb--item-heading ap-gs__cb--item--main-heading ap-integration-sub-heading ap-inactive-heading" v-if="integrations_setting_form.enable_woocommerce != true || integrations_setting_form.enable_armember != true || integrations_setting_form.enable_easy_digital_downloads != true || integrations_setting_form.enable_bookingpress != true || integrations_setting_form.enable_memberpress != true || integrations_setting_form.enable_surecart != true || integrations_setting_form.enable_restrict_content != true || integrations_setting_form.enable_wp_easycart != true || integrations_setting_form.enable_lifter_lms != true || integrations_setting_form.enable_arforms != true || integrations_setting_form.enable_give_wp != true || integrations_setting_form.enable_simple_membership != true || integrations_setting_form.enable_paid_memberships_pro != true || integrations_setting_form.enable_paid_memberships_subscriptions != true || integrations_setting_form.enable_ultimate_membership_pro != true || integrations_setting_form.enable_ninjaforms != true || integrations_setting_form.enable_wp_forms != true || integrations_setting_form.enable_gravity_forms != true || integrations_setting_form.enable_wp_simple_pay != true || integrations_setting_form.enable_masteriyo_lms != true || integrations_setting_form.enable_getpaid != true || integrations_setting_form.enable_learnpress != true || integrations_setting_form.enable_accept_stripe_payments != true || integrations_setting_form.enable_download_manager != true || integrations_setting_form.enable_learndash != true">
                                <?php esc_html_e('Inactive Integrations', 'affiliatepress-affiliate-marketing'); ?>
                            </div>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_woocommerce == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_woocommerce != true"  @click="ap_active_integration('woocommerce')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('WooCommerce', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_woocommerce">
                                        <el-switch  v-model="integrations_setting_form.enable_woocommerce"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_armember == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_armember != true"  @click="ap_active_integration('armember')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('ARMember', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_armember">
                                        <el-switch   v-model="integrations_setting_form.enable_armember"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_easy_digital_downloads == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_easy_digital_downloads != true"  @click="ap_active_integration('easy_digital_downloads')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Easy Digital Downloads', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_easy_digital_downloads">
                                        <el-switch   v-model="integrations_setting_form.enable_easy_digital_downloads"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_bookingpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_bookingpress != true"  @click="ap_active_integration('bookingpress')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('BookingPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_bookingpress">
                                        <el-switch  v-model="integrations_setting_form.enable_bookingpress"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_memberpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_memberpress != true"  @click="ap_active_integration('memberpress')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('MemberPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_memberpress">
                                        <el-switch   v-model="integrations_setting_form.enable_memberpress"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_surecart == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_surecart != true"  @click="ap_active_integration('surecart')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('SureCart', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_surecart">
                                        <el-switch   v-model="integrations_setting_form.enable_surecart"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>     
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_restrict_content == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_restrict_content != true"  @click="ap_active_integration('restrict_content')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Restrict Content Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_restrict_content">
                                        <el-switch   v-model="integrations_setting_form.enable_restrict_content"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_wp_easycart == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_wp_easycart != true"  @click="ap_active_integration('wp_easycart')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('WP EasyCart', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_wp_easycart">
                                        <el-switch   v-model="integrations_setting_form.enable_wp_easycart"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_lifter_lms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_lifter_lms != true"  @click="ap_active_integration('lifter_lms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('LifterLMS', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_lifter_lms">
                                        <el-switch   v-model="integrations_setting_form.enable_lifter_lms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_arforms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_arforms != true"  @click="ap_active_integration('arforms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('ARForms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_arforms">
                                        <el-switch  v-model="integrations_setting_form.enable_arforms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_give_wp == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_give_wp != true"  @click="ap_active_integration('give_wp')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('GiveWP', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_give_wp">
                                        <el-switch   v-model="integrations_setting_form.enable_give_wp"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_simple_membership == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_simple_membership != true"  @click="ap_active_integration('simple_membership')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Simple Membership', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_simple_membership">
                                        <el-switch   v-model="integrations_setting_form.enable_simple_membership"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>   
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_paid_memberships_pro == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_paid_memberships_pro != true"  @click="ap_active_integration('paid_memberships_pro')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Paid Memberships Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_give_wp">
                                        <el-switch   v-model="integrations_setting_form.enable_paid_memberships_pro"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_paid_memberships_subscriptions == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_paid_memberships_subscriptions != true"  @click="ap_active_integration('paid_memberships_subscriptions')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Paid Member Subscriptions', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_paid_memberships_subscriptions">
                                        <el-switch  v-model="integrations_setting_form.enable_paid_memberships_subscriptions"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_ultimate_membership_pro == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_ultimate_membership_pro != true" @click="ap_active_integration('ultimate_membership_pro')" >
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Ultimate Membership Pro', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_ultimate_membership_pro">
                                        <el-switch  v-model="integrations_setting_form.enable_ultimate_membership_pro"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_ninjaforms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_ninjaforms != true"  @click="ap_active_integration('ninjaforms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Ninja Forms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_ninjaforms">
                                        <el-switch  v-model="integrations_setting_form.enable_ninjaforms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_wp_forms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_wp_forms != true"  @click="ap_active_integration('wp_forms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('WPForms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_wp_forms">
                                        <el-switch  v-model="integrations_setting_form.enable_wp_forms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>	
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_gravity_forms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_gravity_forms != true"  @click="ap_active_integration('gravity_forms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Gravity Forms', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_give_wp">
                                        <el-switch  v-model="integrations_setting_form.enable_gravity_forms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_wp_simple_pay == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_wp_simple_pay != true"  @click="ap_active_integration('wp_simple_pay')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('WP Simple Pay (Stripe)', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_wp_simple_pay">
                                        <el-switch  v-model="integrations_setting_form.enable_wp_simple_pay"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_masteriyo_lms == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_masteriyo_lms != true"  @click="ap_active_integration('masteriyo_lms')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Masteriyo LMS', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_masteriyo_lms">
                                        <el-switch  v-model="integrations_setting_form.enable_masteriyo_lms"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_getpaid == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_getpaid != true"  @click="ap_active_integration('getpaid')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('GetPaid', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_getpaid">
                                        <el-switch  v-model="integrations_setting_form.enable_getpaid"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>   
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_learnpress == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_learnpress != true"  @click="ap_active_integration('learnpress')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('LearnPress', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_learnpress">
                                        <el-switch  v-model="integrations_setting_form.enable_learnpress"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_accept_stripe_payments == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_accept_stripe_payments != true"  @click="ap_active_integration('accept_stripe_payments')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Accept Stripe Payments', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_accept_stripe_payments">
                                        <el-switch  v-model="integrations_setting_form.enable_accept_stripe_payments"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_download_manager == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_download_manager != true"  @click="ap_active_integration('download_manager')">
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('Download Manager', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_download_manager">
                                        <el-switch  v-model="integrations_setting_form.enable_download_manager"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row type="flex" class="ap-gs--tabs-pb__cb-item-row ap-settings-main-row" :class="(integrations_setting_form.enable_learndash == true)?'ap-integration-enabled':''" v-if="integrations_setting_form.enable_learndash != true" @click="ap_active_integration('learndash')" >
                                <el-col :xs="12" :sm="12" :md="12" :lg="14" :xl="14" class="ap-gs__cb-item-left">
                                    <h4><?php esc_html_e('LearnDash', 'affiliatepress-affiliate-marketing'); ?></h4>
                                </el-col>
                                <el-col :xs="12" :sm="12" :md="12" :lg="10" :xl="10" class="ap-gs__cb-item-right">				
                                    <el-form-item prop="enable_learndash">
                                        <el-switch   v-model="integrations_setting_form.enable_learndash"/>                                         
                                    </el-form-item>
                                </el-col>
                            </el-row> 
                        </div>
                    </div>
                    <div class="ap-settings-new-section"></div>   
                </el-form>  
                <el-row type="flex" class="ap-mlc-head-wrap-settings ap-gs-tabs--pb__heading ap-gs-tabs--pb__footer">
                    <el-col :xs="12" :sm="12" :md="12" :lg="8" :xl="12" class="ap-gs-tabs--pb__heading--left"></el-col>
                    <el-col :xs="12" :sm="12" :md="12" :lg="16" :xl="12">
                        <div class="ap-hw-right-btn-group ap-gs-tabs--pb__btn-group">        
                        <el-button @click="(!is_disabled)?saveIntegrationsSettingsData():''" type="primary" :class="(is_display_save_loader == '1') ? 'ap-btn--is-loader' : ''" class="ap-btn--primary ap-btn--big" :disabled="is_display_save_loader == '1' ? true : false">                 
                            <span class="ap-btn__label"><?php esc_html_e('Save', 'affiliatepress-affiliate-marketing'); ?></span>
                            <div class="ap-btn--loader__circles">                    
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>                                                     
                        </el-button>
                        </div>
                    </el-col>
                </el-row>                                        
            </div>
        </div>
    </div>
</el-tab-pane>