<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (! class_exists('affiliatepress_affiliate_register') ) {
    class affiliatepress_affiliate_register Extends AffiliatePress_Core{
                
        function __construct(){
            
            /** Function for affiliate registration page shortcode */
            add_shortcode('affiliatepress_affiliate_registration', array($this,'affiliatepress_affiliate_registration_func'));

            /** Function for add register fields dynamic data */            
            add_filter('affiliatepress_affiliate_registration_dynamic_data_fields',array($this,'affiliatepress_affiliate_registration_dynamic_data_fields_func'),10,2);

            /**Function for dynamic vue method */
            add_filter('affiliatepress_affiliate_registration_dynamic_vue_methods',array($this,'affiliatepress_affiliate_registration_dynamic_vue_methods_func'),10,1);

            /* Register Affiliate User */
            add_action('wp_ajax_affiliatepress_register_affiliate', array( $this, 'affiliatepress_register_affiliate_func' ), 10);    
            add_action('wp_ajax_nopriv_affiliatepress_register_affiliate', array( $this, 'affiliatepress_register_affiliate_func'), 10);

            /**Function For load Hcapcha  */
            add_filter('affiliatepress_affiliate_registration_dynamic_on_load_methods',array($this,'affiliatepress_affiliate_registration_dynamic_on_load_methods_func'),10,1);
            
        }

        
        /**
         * Function For load Hcapcha 
         *
         * @param  mixed $affiliatepress_affiliate_registration_dynamic_method
         * @return void
         */
        function affiliatepress_affiliate_registration_dynamic_on_load_methods_func($affiliatepress_affiliate_registration_dynamic_method){
            $affiliatepress_affiliate_registration_dynamic_method.='
                this.loadHCaptcha();
            ';
            return $affiliatepress_affiliate_registration_dynamic_method;
        }

        
        /**
         * Function for register affiliate 
         *
         * @return void
        */
        function affiliatepress_register_affiliate_func(){      
            
            global $wpdb, $AffiliatePress,$affiliatepress_tbl_ap_affiliate_form_fields,$affiliatepress_tbl_ap_affiliates,$affiliatepress_affiliates;
            $response              = array();
            $affiliatepress_wpnonce               = isset($_POST['_wpnonce']) ? sanitize_text_field(wp_unslash($_POST['_wpnonce'])) : '';// phpcs:ignore 
            $affiliatepress_verify_nonce_flag = wp_verify_nonce($affiliatepress_wpnonce, 'ap_wp_nonce');

            $response['affiliatepress_affiliates_status'] = "";
            $response['variant'] = 'error';
            $response['title']   = esc_html__('Error', 'affiliatepress-affiliate-marketing');
            $response['msg']     = esc_html__('Something wrong...', 'affiliatepress-affiliate-marketing');
            $response['after_register_redirect'] = "";

            if (!$affiliatepress_verify_nonce_flag){
                $response['variant'] = 'error';
                $response['title']   = esc_html__('Error', 'affiliatepress-affiliate-marketing');
                $response['msg']     = esc_html__('Sorry, Your request can not be processed due to security reason.', 'affiliatepress-affiliate-marketing');
                wp_send_json($response);
                exit();
            }
            $affiliatepress_allow_affiliate_registration = $AffiliatePress->affiliatepress_get_settings('allow_affiliate_registration', 'affiliate_settings');
            if($affiliatepress_allow_affiliate_registration != "true"){
                $response['variant'] = 'error';
                $response['title']   = esc_html__('Error', 'affiliatepress-affiliate-marketing');
                $response['msg']     = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('affiliate_registration_disabled', 'message_settings'));  
                wp_send_json($response);
                exit();                             
            }

            do_action('affiliatepress_affiliate_register_extra_validation');

            $affiliatepress_username         = ! empty($_POST['username']) ? sanitize_text_field($_POST['username']) : ''; // phpcs:ignore 

            if (empty($affiliatepress_username) || ! preg_match('/^[a-z0-9._@-]+$/', $affiliatepress_username)) {
                $response['msg'] = esc_html__('Entered username is invalid.', 'affiliatepress-affiliate-marketing');
                wp_send_json($response);
                die();
            }

            $affiliatepress_firstname        = ! empty($_POST['firstname']) ? trim(sanitize_text_field($_POST['firstname'])) : ''; // phpcs:ignore 
            $affiliatepress_lastname         = ! empty($_POST['lastname']) ? trim(sanitize_text_field($_POST['lastname'])) : ''; // phpcs:ignore 
            $affiliatepress_email            = ! empty($_POST['email']) ? sanitize_email($_POST['email']) : ''; // phpcs:ignore 
            $affiliatepress_password = ! empty($_POST['password']) ? sanitize_text_field($_POST['password']) : ''; // phpcs:ignore 
            $affiliatepress_affiliates_payment_email = ! empty($_POST['ap_affiliates_payment_email']) ? trim(sanitize_text_field($_POST['ap_affiliates_payment_email'])) : ''; // phpcs:ignore
            $affiliatepress_affiliates_website = ! empty($_POST['ap_affiliates_website']) ? trim(sanitize_text_field($_POST['ap_affiliates_website'])) : ''; // phpcs:ignore 
            $affiliatepress_affiliates_promote_us = ! empty($_POST['ap_affiliates_promote_us']) ? trim(sanitize_text_field($_POST['ap_affiliates_promote_us'])) : ''; // phpcs:ignore

            $affiliatepress_fields = $this->affiliatepress_select_record( true, '', $affiliatepress_tbl_ap_affiliate_form_fields, '*', 'WHERE ap_show_signup_field = %d ', array(1), '', 'order by ap_field_position ASC', '', false, false,ARRAY_A);           
            $affiliatepress_fields_error_message = array();
            if(!empty($affiliatepress_fields)){                
                foreach($affiliatepress_fields as $affiliatepress_key=>$affiliatepress_field){                   
                    $affiliatepress_field_error_message = (isset($affiliatepress_field['ap_field_error_message']))?$affiliatepress_field['ap_field_error_message']:'';
                    $affiliatepress_form_field_name = (isset($affiliatepress_field['ap_form_field_name']))?$affiliatepress_field['ap_form_field_name']:'';
                    $affiliatepress_field_required = (isset($affiliatepress_field['ap_field_required']))?$affiliatepress_field['ap_field_required']:'';
                    if($affiliatepress_field_required == 1){
                        $affiliatepress_fields_error_message[$affiliatepress_form_field_name] = $affiliatepress_field_error_message;
                    }
                }                
            }            
            $affiliatepress_enable_hcaptcha = $AffiliatePress->affiliatepress_get_settings('enable_hcaptcha', 'affiliate_settings');
            if($affiliatepress_enable_hcaptcha == 'true'){
                $affiliatepress_hcaptcha_secret_key = $AffiliatePress->affiliatepress_get_settings('hcaptcha_secret_key', 'affiliate_settings');
                if(isset($_POST['hcaptcha_response'])){
                    $affiliatepress_secret_key = $affiliatepress_hcaptcha_secret_key; 
                    $affiliatepress_hcaptcha_response = sanitize_text_field($_POST['hcaptcha_response']);// phpcs:ignore 
                    $remoteip = sanitize_text_field($_SERVER['REMOTE_ADDR']); // phpcs:ignore                
                    $verify_response = wp_remote_post('https://hcaptcha.com/siteverify', array(
                        'body' => array(
                            'secret'   => $affiliatepress_secret_key,
                            'response' => $affiliatepress_hcaptcha_response,
                            'remoteip' => $remoteip,
                        ),
                    ));            
                    $response_body = wp_remote_retrieve_body($verify_response);
                    $result = json_decode($response_body, true);            
                    if ($result['success']){

                    } else {
                        $response['variant']   = 'error';
                        $response['title']     = esc_html__('Error','affiliatepress-affiliate-marketing');                        
                        $response['msg']       = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('hcaptcha_verification_failed', 'message_settings'));
                        wp_send_json($response);
                        die();                        
                    }
                }
            }            
            $affiliatepress_enable_google_recaptcha = $AffiliatePress->affiliatepress_get_settings('enable_google_recaptcha', 'affiliate_settings');
            if($affiliatepress_enable_google_recaptcha == 'true' && $affiliatepress_enable_hcaptcha != 'true'){                                                                                                
                $affiliatepress_google_recaptcha_secret_key = $AffiliatePress->affiliatepress_get_settings('google_recaptcha_secret_key', 'affiliate_settings');
                $affiliatepress_google_recaptcha_token = (isset($_POST['google_recaptcha_token']))?sanitize_text_field($_POST['google_recaptcha_token']):'';  // phpcs:ignore                  
                $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
                    'body' => array(
                        'secret'   => $affiliatepress_google_recaptcha_secret_key,
                        'response' => $affiliatepress_google_recaptcha_token,
                    ),
                ));                
                $responseBody = wp_remote_retrieve_body($response);
                $result = json_decode($responseBody, true);
                if(!empty($result) && $result['success'] && $result['score'] >= 0.5){
                    
                }else{
                    $response['variant']   = 'error';
                    $response['title']     = esc_html__('Error','affiliatepress-affiliate-marketing');                        
                    $response['msg']       = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('recaptcha_verification_failed', 'message_settings'));
                    wp_send_json($response);
                    die();                           
                }                
            }
            $affiliatepress_current_user_id = get_current_user_id();
            if(empty(trim($affiliatepress_firstname))) {
                $response['msg'] = (isset($affiliatepress_fields_error_message['firstname']))?$affiliatepress_fields_error_message['firstname']:esc_html__('Please enter firstname', 'affiliatepress-affiliate-marketing');
                wp_send_json($response);
                die();
            }
            if(empty(trim($affiliatepress_lastname))) {
                $response['msg'] = (isset($affiliatepress_fields_error_message['lastname']))?$affiliatepress_fields_error_message['lastname']:esc_html__('Please enter lastname', 'affiliatepress-affiliate-marketing');
                wp_send_json($response);
                die();
            }            
            if($affiliatepress_current_user_id == 0 || $affiliatepress_current_user_id == ''){
                if(empty(trim($affiliatepress_email)) || !filter_var($affiliatepress_email, FILTER_VALIDATE_EMAIL)) {
                    $response['msg'] = (isset($affiliatepress_fields_error_message['email']))?$affiliatepress_fields_error_message['email']:esc_html__('Please enter valid email address.', 'affiliatepress-affiliate-marketing');
                    wp_send_json($response);
                    die();
                }          
                if(empty(trim($affiliatepress_username))) {
                    $response['msg'] = (isset($affiliatepress_fields_error_message['username']))?$affiliatepress_fields_error_message['username']:esc_html__('Please enter username', 'affiliatepress-affiliate-marketing');
                    wp_send_json($response);
                    die();
                }
                if(empty(trim($affiliatepress_password))) {
                    $response['msg'] = (isset($affiliatepress_fields_error_message['password']))?$affiliatepress_fields_error_message['password']:esc_html__('Please enter password', 'affiliatepress-affiliate-marketing');
                    wp_send_json($response);
                    die();
                }
                if(username_exists($affiliatepress_username)) {
                    $response['msg'] = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('username_already_exists', 'message_settings'));
                    wp_send_json($response);
                    die();
                }
                if(email_exists($affiliatepress_email)){
                    $response['msg'] = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('email_already_exists', 'message_settings'));
                    wp_send_json($response);
                    die();                
                }                
            }
            if(empty($affiliatepress_affiliates_payment_email) && isset($affiliatepress_fields_error_message['ap_affiliates_payment_email'])){
                $response['msg'] = $affiliatepress_fields_error_message['ap_affiliates_payment_email'];
                wp_send_json($response);
                die();                
            }
            if(empty($affiliatepress_affiliates_website) && isset($affiliatepress_fields_error_message['ap_affiliates_website'])){
                $response['msg'] = $affiliatepress_fields_error_message['ap_affiliates_website'];
                wp_send_json($response);
                die();                
            }  
            if(empty($affiliatepress_affiliates_promote_us) && isset($affiliatepress_fields_error_message['ap_affiliates_promote_us'])){
                $response['msg'] = $affiliatepress_fields_error_message['ap_affiliates_promote_us'];
                wp_send_json($response);
                die();                
            }   
            $affiliatepress_user_create = "";     
            $ffiliateuser_signin_data = array();    
            if($affiliatepress_current_user_id == 0 || $affiliatepress_current_user_id == ''){

                $affiliatepress_user_create = 1;

                $affiliatepress_affiliates_user_id = wp_create_user($affiliatepress_username, $affiliatepress_password, $affiliatepress_email);
                if (!is_wp_error($affiliatepress_affiliates_user_id)) {                   

                    $affiliate_user_final_data = get_userdata( $affiliatepress_affiliates_user_id );
                    if(!empty($affiliate_user_final_data)){
                        $affiliateuser_signin_data = array(
                            'user_login'    =>  $affiliate_user_final_data->user_login,
                            'user_password' => $affiliatepress_password,
                            'remember'      => true
                        );    
                    }

                    $affiliatepress_display_name = $affiliatepress_firstname.' '.$affiliatepress_lastname;
                    wp_update_user(array(
                        'ID' => $affiliatepress_affiliates_user_id,
                        'display_name' => $affiliatepress_display_name,
                        'first_name' => $affiliatepress_firstname,
                        'last_name' => $affiliatepress_lastname,
                    ));
                } else {
                    $response['msg'] = $affiliatepress_affiliates_user_id->get_error_message();
                    wp_send_json($response);
                    die();                    
                }

            }else{
                $affiliatepress_dashboard_total_affiliate_count = intval($this->affiliatepress_select_record( true, '', $affiliatepress_tbl_ap_affiliates, 'COUNT(ap_affiliates_id)', 'WHERE  ap_affiliates_user_id = %d', array( $affiliatepress_current_user_id ), '', '', '', true, false,ARRAY_A));
                if($affiliatepress_dashboard_total_affiliate_count != 0){                    
                    
                    $affiliatepress_dashboard_affiliate_status = intval($this->affiliatepress_select_record( true, '', $affiliatepress_tbl_ap_affiliates, 'ap_affiliates_status', 'WHERE  ap_affiliates_user_id = %d', array( $affiliatepress_current_user_id ), '', '', '', true, false,ARRAY_A));

                    $response['msg'] = esc_html__('Your account is already registered as an affiliate.', 'affiliatepress-affiliate-marketing');
                    if($affiliatepress_dashboard_affiliate_status == 2){
                        $response['msg'] = esc_html__('Your account is under review. You will be notified by email once it is approved.', 'affiliatepress-affiliate-marketing');
                    }

                    
                    wp_send_json($response);
                    die();                        
                }
                $affiliatepress_affiliates_user_id = $affiliatepress_current_user_id;
            }

            $affiliatepress_affiliate_default_status = $AffiliatePress->affiliatepress_get_settings('affiliate_default_status', 'affiliate_settings');
            if($affiliatepress_affiliate_default_status == "true"){
                $affiliatepress_affiliates_status = 1;
                $response['affiliatepress_affiliates_status'] = 1;
            }else{
                $affiliatepress_affiliates_status = 2;
            }
            $affiliatepress_args = array(     
                'ap_affiliates_first_name'      => $affiliatepress_firstname,
                'ap_affiliates_last_name'       => $affiliatepress_lastname,
                'ap_affiliates_user_id'         => $affiliatepress_affiliates_user_id,           
                'ap_affiliates_payment_email'   => $affiliatepress_affiliates_payment_email,
                'ap_affiliates_website'         => $affiliatepress_affiliates_website,
                'ap_affiliates_promote_us'      => $affiliatepress_affiliates_promote_us,              
                'ap_affiliates_status'          => $affiliatepress_affiliates_status,
                'ap_affiliates_user_name'       => $affiliatepress_username,
                'ap_affiliates_user_email'      => $affiliatepress_email,
            );
            $affiliatepress_affiliates_id = $this->affiliatepress_insert_record($affiliatepress_tbl_ap_affiliates, $affiliatepress_args);
            do_action('affiliatepress_after_signup_affiliate', $affiliatepress_affiliates_id); // phpcs:ignore
            if($affiliatepress_affiliates_id){

                $affiliatepress_affiliates->affiliatepress_add_affiliate_user_role($affiliatepress_affiliates_user_id);
                $affiliatepress_old_ap_affiliates_status = '';
                do_action('affiliatepress_after_affiliate_status_change',$affiliatepress_affiliates_id,$affiliatepress_affiliates_status,$affiliatepress_old_ap_affiliates_status);

                if($affiliatepress_user_create){
                    if($affiliatepress_affiliates_status == 1 && !empty($affiliateuser_signin_data)){
                        $user_signon = wp_signon( $affiliateuser_signin_data, is_ssl() );
                        if ( is_wp_error( $user_signon ) ) {
                            //error_log( 'Login failed: ' . $user_signon->get_error_message() );
                        } else {
                            wp_set_current_user( $user_signon->ID );
                            wp_set_auth_cookie( $user_signon->ID );
                            do_action( 'wp_login', $user_signon->user_login, $user_signon );
                            $affiliatepress_affiliate_account_page_id = $AffiliatePress->affiliatepress_get_settings('affiliate_account_page_id', 'affiliate_settings');
                            $affiliatepress_affiliate_login_page_url  = get_permalink($affiliatepress_affiliate_account_page_id);  
                            $affiliatepress_affiliate_login_page_url = apply_filters('affiliatepress_modify_affiliate_register_redirect_link', $affiliatepress_affiliate_login_page_url);
                            $response['after_register_redirect'] = $affiliatepress_affiliate_login_page_url;
                        }                        
                        
                    }                    
                }

                $response['variant'] = 'success';
                $response['title']   = esc_html__('Success', 'affiliatepress-affiliate-marketing');
                if($affiliatepress_affiliate_default_status == "true"){
                    $response['msg']     = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('affiliate_register_with_auto_approved', 'message_settings'));
                }else{
                    $response['msg']     = stripslashes_deep($AffiliatePress->affiliatepress_get_settings('affiliate_register_with_pending', 'message_settings'));                 
                }

            }
            wp_send_json($response);
            exit();   

        } 
        
        /**
         * Function for dynamic vue method
         *
         * @param  mixed $affiliatepress_affiliate_registration_vue_method
         * @return void
        */
        function affiliatepress_affiliate_registration_dynamic_vue_methods_func($affiliatepress_affiliate_registration_vue_method){

            $affiliatepress_nonce = esc_html(wp_create_nonce('ap_wp_nonce'));

            $affiliatepress_after_affiliate_signup_more_vue_data = '';
            $affiliatepress_after_affiliate_signup_more_vue_data = apply_filters( 'affiliatepress_after_affiliate_signup_more_vue_data', $affiliatepress_after_affiliate_signup_more_vue_data);


            $affiliatepress_affiliate_registration_vue_method.='
                register_terms_and_condition(field_value){
                    var vm = this;
                    if(vm.affiliates[field_value] == false){
                        vm.affiliates[field_value] = "";
                    }
                },
                loadHCaptcha(){
                    var vm = this;
                    if (this.hcaptcha_site_key != ""){                                                 
                        setTimeout(function(){                       
                            const hcaptchaScript = document.createElement("script");
                            hcaptchaScript.src = "https://js.hcaptcha.com/1/api.js";
                            hcaptchaScript.async = true;
                            hcaptchaScript.defer = true;
                            document.head.appendChild(hcaptchaScript);                                                        
                        },1000);                        
                    }
                },            
                affiliatepress_set_error_msg(error_msg,allow_final_scroll = true){
                    const vm = this;
                    let pos = 0;
                    const element = document.getElementById("ap-vue-cont-id");
                    if( null != element ){
                        const rect = element.getBoundingClientRect();
                        pos = rect.top + window.scrollY;
                    }
                    vm.is_display_error = "1";
                    vm.is_error_msg = error_msg;
                    const myVar = Error().stack;                    
                    let allow_scroll = true;
                    if( /mounted/.test( myVar ) ){
                        allow_scroll = false;
                    }
                    if( allow_scroll && allow_final_scroll ){
                        window.scrollTo({
                            top: pos,
                            behavior: "smooth",
                        });
                    }                    
                    setTimeout(function(){
                        vm.affiliatepress_remove_success_error_msg();
                    },6000);
                }, 
                affiliatepress_set_success_msg(success_msg,allow_final_scroll = true){
                    const vm = this;
                    let pos = 0;
                    const element = document.getElementById("ap-vue-cont-id");
                    if( null != element ){
                        const rect = element.getBoundingClientRect();
                        pos = rect.top + window.scrollY;
                    }
                    vm.affiliatepress_remove_success_error_msg();
                    vm.is_display_success = "1";
                    vm.is_success_msg = success_msg;
                    const myVar = Error().stack;  
                    let allow_scroll = true;
                    if( /mounted/.test( myVar ) ){
                        allow_scroll = false;
                    }                    
                    if( allow_scroll && allow_final_scroll ){
                        window.scrollTo({
                            top: pos,
                            behavior: "smooth",
                        });
                    }
                    setTimeout(function(){
                        vm.affiliatepress_remove_success_error_msg();
                    },3000);
                },                     
                affiliatepress_remove_success_error_msg(){
                    const vm = this;
                    vm.is_display_success = "0";
                    vm.is_success_msg = "";
                    vm.is_display_error = "0";
                    vm.is_error_msg = "";                    
                },  
                async getReCaptchaToken(google_recaptcha_site_key) {
                    const vm = this;                                                                              
                    return grecaptcha.execute(vm.google_recaptcha_site_key,{action:"submit"}).then(token=>{                                        
                        return token;                                                                                               
                    });                          
                },                                                    
                async registerAffiliate(){                
                    const vm = this;
                    if(vm.google_recaptcha_site_key != "" && vm.hcaptcha_site_key == ""){                        
                        vm.google_recaptcha_token = await vm.getReCaptchaToken();                                                                                                   
                    }                      
                    var ap_wpnonce_pre = "' . $affiliatepress_nonce . '";
                    var parentDiv = document.getElementById("ap-none-field");
                    var ap_wpnonce_pre_fetch = "";
                    if(parentDiv){
                        var wpdata = parentDiv.querySelector("#_wpnonce");
                        if(wpdata){
                           ap_wpnonce_pre_fetch = wpdata;                            
                        }                         
                    }                
                    if(typeof ap_wpnonce_pre_fetch=="undefined" || ap_wpnonce_pre_fetch==null){
                        ap_wpnonce_pre_fetch = ap_wpnonce_pre;
                    }else{
                        ap_wpnonce_pre_fetch = ap_wpnonce_pre_fetch.value;
                    }
                    var postdata = vm.affiliates;
                    postdata.action = "affiliatepress_register_affiliate";                    
                    postdata._wpnonce = ap_wpnonce_pre_fetch;                    
                    if(vm.google_recaptcha_site_key != ""){                       
                        postdata.google_recaptcha_token = vm.google_recaptcha_token;
                    }
                    if(vm.hcaptcha_site_key != ""){
                        postdata.hcaptcha_response = "";
                        const element_h_captch = document.getElementById("ap-h-captcha-val");
                        if(element_h_captch){
                            postdata.hcaptcha_response = document.getElementById("ap-h-captcha-val").value;
                        }                       
                    }
                    this.$refs["affiliates_reg_form_data"].validate((valid) => {   
                        if(valid){
                            vm.reg_is_disabled = true;
                            vm.is_display_reg_save_loader = "1";                       
                            axios.post( affiliatepress_ajax_obj.ajax_url, Qs.stringify( postdata ) )
                            .then(function(response){                                
                                vm.reg_is_disabled = false;                           
                                vm.is_display_reg_save_loader = "0";                                
                                if (response.data.variant == "success") {    

                                    if(typeof response.data.after_register_redirect != "undefined" && response.data.after_register_redirect != ""){
                                        window.location.href = response.data.after_register_redirect;
                                    }else{

                                    }
                                    
                                    vm.$refs["affiliates_reg_form_data"].resetFields();
                                    vm.affiliates.firstname = "";
                                    vm.affiliates.lastname = "";
                                    vm.affiliates.username = "";
                                    vm.affiliates.email = "";
                                    vm.affiliates.password = "";
                                    vm.reg_is_disabled = true;                                         
                                    vm.affiliatepress_set_success_msg(response.data.msg);
                                    '.$affiliatepress_after_affiliate_signup_more_vue_data.'

                                }else{                                    
                                    vm.affiliatepress_set_error_msg(response.data.msg);
                                }
                            }).catch(function(error){
                                vm.reg_is_disabled = false;                           
                                vm.is_display_reg_save_loader = "0";                                  
                            });
                        }else{
                            
                            const formFields = this.$refs.affiliates_reg_form_data.fields;
                            if(typeof formFields != "undefined"){
                                for (let field in formFields) {
                                    console.log(formFields[field].validateState);
                                    if (formFields[field].$el && formFields[field].validateState == "error") {
                                        const errorElement = formFields[field].$el;
                                        if (errorElement){
                                            const inputEl = errorElement.querySelector("input, textarea, .el-input__inner");
                                            if(inputEl){
                                                inputEl.focus();
                                            }
                                            errorElement.scrollIntoView({ behavior: "smooth", block: "center" });
                                            break;
                                        }
                                    }
                                }
                            }
                            return false;

                        }
                    });
                },
                go_to_login_page(){
                    var vm = this;
                    window.location.href = vm.affiliate_login_page_url;
                },
            ';
            return $affiliatepress_affiliate_registration_vue_method;
        }
                
        /**
         * Function for add register fields dynamic data
         *
         * @return void
        */
        function affiliatepress_affiliate_registration_dynamic_data_fields_func($affiliatepress_dynamic_data_fields, $return_arr_formate = false){
            
            global $AffiliatePress,$wpdb,$affiliatepress_tbl_ap_affiliate_form_fields,$affiliatepress_affiliate_panel;

            $affiliatepress_dynamic_data_fields['reg_is_disabled'] = "0";
            $affiliatepress_dynamic_data_fields['is_display_reg_save_loader'] = "0";
            $affiliatepress_dynamic_data_fields['is_error_msg'] = "";
            $affiliatepress_dynamic_data_fields['is_display_error'] = "0";
            $affiliatepress_dynamic_data_fields['is_success_msg'] = "";
            $affiliatepress_dynamic_data_fields['is_display_success'] = "0";            
            $affiliatepress_current_user_id = get_current_user_id();
                      

            $affiliatepress_affiliate_account_page_id = $AffiliatePress->affiliatepress_get_settings('affiliate_account_page_id', 'affiliate_settings');
            $affiliatepress_affiliate_login_page_url  = get_permalink($affiliatepress_affiliate_account_page_id);            
            $affiliatepress_dynamic_data_fields['affiliate_login_page_url'] = $affiliatepress_affiliate_login_page_url;

            $affiliatepress_dynamic_data_fields['affiliates'] = array(
                'username'                     => "",
                'firstname'                    => "",
                'lastname'                     => "",
                'email'                        => "",
                'password'                     => "",
                "ap_affiliates_user_id"        => "",
                "ap_affiliates_payment_email"  => "",
                "ap_affiliates_website"        => "",
            );

            $affiliatepress_dynamic_data_fields['rules'] = array(
                'password'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please add password', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                ), 
                'lastname'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please add lastname', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                ),                    
                'firstname'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please add firstname', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                ),                     
                'email'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please enter user email', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                    array(
                        'type'    => 'email',
                        'message' => esc_html__( 'Please enter valid user email address', 'affiliatepress-affiliate-marketing'),
                        'trigger' => 'blur',
                    ), 
                ),                     
                'username'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please add username', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                ),                    
                'ap_affiliates_user_id'  => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please add affiliates user', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                ),                    
                'ap_affiliates_payment_email' => array(
                    array(
                        'required' => true,
                        'message'  => esc_html__('Please enter payment email', 'affiliatepress-affiliate-marketing'),
                        'trigger'  => 'blur',
                    ),
                    array(
                        'type'    => 'email',
                        'message' => esc_html__( 'Please enter valid email address', 'affiliatepress-affiliate-marketing'),
                        'trigger' => 'blur',
                    ),                        
                ),                    
            );


            $affiliatepress_fields = $this->affiliatepress_select_record( true, '', $affiliatepress_tbl_ap_affiliate_form_fields, '*', 'WHERE ap_show_signup_field = %d ', array(1), '', 'order by ap_field_position ASC', '', false, false,ARRAY_A);           
            $affiliatepress_dynamic_data_fields['affiliate_fields'] = array();
            if(!empty($affiliatepress_fields)){
                
                foreach($affiliatepress_fields as $affiliatepress_key=>$affiliatepress_field){

                    $affiliatepress_fields[$affiliatepress_key]['ap_field_label'] = stripslashes_deep($affiliatepress_fields[$affiliatepress_key]['ap_field_label']);
                    $affiliatepress_fields[$affiliatepress_key]['ap_field_placeholder'] = stripslashes_deep($affiliatepress_fields[$affiliatepress_key]['ap_field_placeholder']);
                    $affiliatepress_fields[$affiliatepress_key]['ap_field_error_message'] = stripslashes_deep($affiliatepress_fields[$affiliatepress_key]['ap_field_error_message']);

                    $affiliatepress_form_field_name = (isset($affiliatepress_field['ap_form_field_name']))?$affiliatepress_field['ap_form_field_name']:'';
                    $affiliatepress_field_required = (isset($affiliatepress_field['ap_field_required']))?$affiliatepress_field['ap_field_required']:'';
                    $affiliatepress_field_error_message = (isset($affiliatepress_field['ap_field_error_message']))?$affiliatepress_field['ap_field_error_message']:'';
                    $affiliatepress_dynamic_data_fields['affiliates'][$affiliatepress_form_field_name] = '';

                    if($affiliatepress_field_required == 1){
                        if(isset($affiliatepress_dynamic_data_fields['rules'][$affiliatepress_form_field_name][0])){
                            $affiliatepress_dynamic_data_fields['rules'][$affiliatepress_form_field_name][0]['message'] = (!empty($affiliatepress_field_error_message))?stripslashes_deep($affiliatepress_field_error_message):'';
                            if(isset($affiliatepress_dynamic_data_fields['rules'][$affiliatepress_form_field_name][1]['message'])){
                                $affiliatepress_dynamic_data_fields['rules'][$affiliatepress_form_field_name][1]['message'] = (!empty($affiliatepress_field_error_message))?stripslashes_deep($affiliatepress_field_error_message):'';
                            }
                        }else{
                            $affiliatepress_dynamic_data_fields['rules'][$affiliatepress_form_field_name] = array(
                                'required' => true,
                                'message'  => (!empty($affiliatepress_field_error_message))?stripslashes_deep($affiliatepress_field_error_message):'',
                                'trigger'  => 'blur',                                    
                            );                            
                        }
                    }

                }
            }

            $affiliatepress_dynamic_data_fields['is_user_login'] = "0";
            if($affiliatepress_current_user_id != 0 && $affiliatepress_current_user_id){

                $affiliatepress_dynamic_data_fields['is_user_login'] = "1";
                $affiliatepress_user_info = get_userdata($affiliatepress_current_user_id);
                $affiliatepress_user_email = (isset($affiliatepress_user_info->user_email))?$affiliatepress_user_info->user_email:'';
                $affiliatepress_username = (isset($affiliatepress_user_info->user_login))?$affiliatepress_user_info->user_login:'';                
                
                $affiliatepress_first_name = get_user_meta($affiliatepress_current_user_id, 'first_name', true);
                $affiliatepress_last_name = get_user_meta($affiliatepress_current_user_id, 'last_name', true);

                $affiliatepress_dynamic_data_fields['affiliates']['username']  = $affiliatepress_username;
                $affiliatepress_dynamic_data_fields['affiliates']['email']     = $affiliatepress_user_email;
                $affiliatepress_dynamic_data_fields['affiliates']['firstname'] = $affiliatepress_first_name;
                $affiliatepress_dynamic_data_fields['affiliates']['lastname']  = $affiliatepress_last_name;
            }

            $affiliatepress_dynamic_data_fields['hcaptcha_site_key'] = '';            
            $affiliatepress_enable_hcaptcha = $AffiliatePress->affiliatepress_get_settings('enable_hcaptcha', 'affiliate_settings');
            if($affiliatepress_enable_hcaptcha == 'true'){
                $affiliatepress_hcaptcha_site_key = $AffiliatePress->affiliatepress_get_settings('hcaptcha_site_key', 'affiliate_settings');
                $affiliatepress_dynamic_data_fields['hcaptcha_site_key'] = $affiliatepress_hcaptcha_site_key;
            }

            $affiliatepress_dynamic_data_fields['google_recaptcha_token']    = '';
            $affiliatepress_dynamic_data_fields['google_recaptcha_site_key'] = '';
            $affiliatepress_enable_google_recaptcha = $AffiliatePress->affiliatepress_get_settings('enable_google_recaptcha', 'affiliate_settings');
            if($affiliatepress_enable_google_recaptcha == 'true'){
                $affiliatepress_google_recaptcha_site_key = $AffiliatePress->affiliatepress_get_settings('google_recaptcha_site_key', 'affiliate_settings');
                $affiliatepress_dynamic_data_fields['google_recaptcha_site_key'] = $affiliatepress_google_recaptcha_site_key;
            }            

            $affiliatepress_dynamic_data_fields['affiliate_fields'] = $affiliatepress_fields;
            $affiliatepress_dynamic_data_fields['is_affiliate_form_loader'] = 0;

            $affiliatepress_dynamic_data_fields = apply_filters('affiliatepress_affiliate_register_data_fields', $affiliatepress_dynamic_data_fields);

            if($return_arr_formate){
                return $affiliatepress_dynamic_data_fields;
            }

            return wp_json_encode($affiliatepress_dynamic_data_fields);
        }

        /**
         * Function for set front CSS
         *
         * @return void
        */
        function affiliatepress_affiliatepress_set_front_css($affiliatepress_force_enqueue = 0 ){
            
            global $AffiliatePress;

            /* AffiliatePress Front CSS */
            wp_register_style('affiliatepress_front_variables_css', AFFILIATEPRESS_URL . '/css/affiliatepress_front_variables.css', array(), AFFILIATEPRESS_VERSION);
            
            $affiliatepress_custom_css = $AffiliatePress->affiliatepress_front_dynamic_variable_add();
            wp_add_inline_style('affiliatepress_front_variables_css', $affiliatepress_custom_css,'after');   

            wp_register_style('affiliatepress_elements_front_css', AFFILIATEPRESS_URL . '/css/affiliatepress_elements_front.css', array(), AFFILIATEPRESS_VERSION);
            wp_register_style('affiliatepress_component_css', AFFILIATEPRESS_URL . '/css/affiliatepress_component.css', array(), AFFILIATEPRESS_VERSION);            
            wp_register_style('affiliatepress_front_css', AFFILIATEPRESS_URL . '/css/affiliatepress_front.css', array(), AFFILIATEPRESS_VERSION);
            wp_register_style('affiliatepress_front_rtl_css', AFFILIATEPRESS_URL . '/css/affiliatepress_front_rtl.css', array(), AFFILIATEPRESS_VERSION);

            if($affiliatepress_force_enqueue == 1){
                wp_enqueue_style('affiliatepress_front_variables_css');
                wp_enqueue_style('affiliatepress_elements_front_css');             
                wp_enqueue_style('affiliatepress_component_css');
                wp_enqueue_style('affiliatepress_front_css');
                if(is_rtl()){
                    wp_enqueue_style('affiliatepress_front_rtl_css');   
                }
            }
            do_action('affiliatepress_affiliate_panel_front_style',$affiliatepress_force_enqueue);

        }
        
        /**
         * Function for set front js
         *
         * @param  mixed $affiliatepress_force_enqueue
         * @return void
        */
        function affiliatepress_set_front_js($affiliatepress_force_enqueue = 0 ){
            global $AffiliatePress;

            /* Plugin JS File */
            wp_register_script('affiliatepress_front_js', AFFILIATEPRESS_URL . '/js/affiliatepress_vue.min.js', array(), AFFILIATEPRESS_VERSION,false);
            wp_register_script('affiliatepress_axios_js', AFFILIATEPRESS_URL . '/js/affiliatepress_axios.min.js', array(), AFFILIATEPRESS_VERSION,false);
            wp_register_script('affiliatepress_wordpress_vue_qs_js', AFFILIATEPRESS_URL . '/js/affiliatepress_wordpress_vue_qs_helper.js', array(), AFFILIATEPRESS_VERSION,false); 
            wp_register_script('affiliatepress_element_js', AFFILIATEPRESS_URL . '/js/affiliatepress_element.min.js', array(), AFFILIATEPRESS_VERSION,false);            

            if($affiliatepress_force_enqueue == 1){

                $affiliatepress_data = 'var affiliatepress_ajax_obj = '.wp_json_encode( array('ajax_url' => admin_url( 'admin-ajax.php'))).';';
                wp_add_inline_script('affiliatepress_front_js', $affiliatepress_data, 'before');

                wp_enqueue_script('affiliatepress_front_js');
                wp_enqueue_script('affiliatepress_axios_js');                
                wp_enqueue_script('affiliatepress_wordpress_vue_qs_js');
                wp_enqueue_script('affiliatepress_element_js');
                wp_enqueue_script( 'moment' );

                $affiliatepress_enable_google_recaptcha = $AffiliatePress->affiliatepress_get_settings('enable_google_recaptcha', 'affiliate_settings');
                if($affiliatepress_enable_google_recaptcha == 'true'){
                    $affiliatepress_google_recaptcha_site_key = $AffiliatePress->affiliatepress_get_settings('google_recaptcha_site_key', 'affiliate_settings');
                    if(!empty($affiliatepress_google_recaptcha_site_key)){
                        wp_enqueue_script( 'affiliatepress-google-recaptcha', 'https://www.google.com/recaptcha/api.js?render='.$affiliatepress_google_recaptcha_site_key, array(), null, true );// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter,WordPress.WP.EnqueuedResourceParameters.MissingVersion
                    }                    
                }                

            }            

        }        
                
        /**
         * Function for affiliate registration page shortcode 
         *
         * @return void
        */
        function affiliatepress_affiliate_registration_func(){
              
            global $affiliatepress_common_date_format,$affiliatepress_affiliate_panel;
            $affiliatepress_site_current_language = get_locale();

            $affiliatepress_uniq_id = uniqid();
            $this->affiliatepress_affiliatepress_set_front_css(1);
            $this->affiliatepress_set_front_js(1);
            

            $affiliatepress_front_booking_dynamic_helper_vars = '';
            $affiliatepress_front_booking_dynamic_helper_vars = apply_filters('affiliatepress_affiliate_registration_dynamic_helper_vars', $affiliatepress_front_booking_dynamic_helper_vars);

            $affiliatepress_dynamic_directive_data = '';
            $affiliatepress_dynamic_directive_data = apply_filters('affiliatepress_affiliate_registration_dynamic_directives', $affiliatepress_dynamic_directive_data);

            $affiliatepress_dynamic_data_fields = array();            
            $affiliatepress_dynamic_data_fields = apply_filters('affiliatepress_affiliate_registration_dynamic_data_fields', $affiliatepress_dynamic_data_fields, false);
            
            $affiliatepress_dynamic_on_load_methods_data = '';
            $affiliatepress_dynamic_on_load_methods_data = apply_filters('affiliatepress_affiliate_registration_dynamic_on_load_methods', $affiliatepress_dynamic_on_load_methods_data);          

            $affiliatepress_vue_methods_data = '';
            $affiliatepress_vue_methods_data = apply_filters('affiliatepress_affiliate_registration_dynamic_vue_methods', $affiliatepress_vue_methods_data);
            
            $affiliatepress_script_return_data = '';
            if (! empty($affiliatepress_front_booking_dynamic_helper_vars) ) {
                $affiliatepress_script_return_data .= $affiliatepress_front_booking_dynamic_helper_vars;
            }
            
            $affiliatepress_script_return_data .= "var affiliatepress_uniq_id_js_var = '" . $affiliatepress_uniq_id . "';";
            $affiliatepress_nonce = esc_html(wp_create_nonce('ap_wp_nonce'));

            $affiliatepress_script_return_data .= "var affiliatepress_uniq_id_js_var = '" . $affiliatepress_uniq_id . "';";
            $affiliatepress_nonce = esc_html(wp_create_nonce('ap_wp_nonce'));

            $affiliatepress_site_date = date('Y-m-d H:i:s', current_time( 'timestamp') ); // phpcs:ignore
            $affiliatepress_vue_root_element_id = '#affiliatepress_reg_form_' . $affiliatepress_uniq_id;
            $affiliatepress_vue_root_element_id_without_hash = 'affiliatepress_reg_form__' . $affiliatepress_uniq_id;
            $affiliatepress_vue_root_element_id_el = 'method_' . $affiliatepress_uniq_id;
            
            ob_start();
            $affiliatepress_shortcode_file_url = AFFILIATEPRESS_VIEWS_DIR.'/front/affiliate_registration_form.php';
            $affiliatepress_shortcode_file_url = apply_filters('affiliatepress_affiliate_register_view_file', $affiliatepress_shortcode_file_url);
            include $affiliatepress_shortcode_file_url;       
            $affiliatepress_content = ob_get_clean();   

            ob_start();
            $affiliatepress_load_file_name = AFFILIATEPRESS_VIEWS_DIR . '/manage_language.php';                            
            include $affiliatepress_load_file_name;            
            $affiliatepress_localization_data_content = ob_get_clean();    
            
            $affiliatepress_panel_labels = $affiliatepress_affiliate_panel->affiliatepress_get_panel_lables();
        
            $affiliatepress_script_return_data .= $affiliatepress_localization_data_content;
            $affiliatepress_script_return_data .= '

            var app = "";
            const { ref, createApp, reactive} = Vue;  
            const container = ref(null); 
            app = createApp({ 
				el: "' . $affiliatepress_vue_root_element_id . '",
				components:{  },
				data(){
                    var affiliatepress_return_data_reg_form = '.$affiliatepress_dynamic_data_fields.';
                    affiliatepress_return_data_reg_form["ap_common_date_format"] = "'.esc_html($affiliatepress_common_date_format).'";  
                    affiliatepress_return_data_reg_form["affiliate_panel_labels"] = '.json_encode($affiliatepress_panel_labels).';
					return affiliatepress_return_data_reg_form;
				},
				filters: {
					
				},
                beforeCreate(){                       
					this.is_affiliate_form_loader = "0";
				},
				created(){
					this.affiliatepress_load_reg_booking_form();                    
				},
				mounted(){
					'.$affiliatepress_dynamic_on_load_methods_data.'
				},
                computed: {

                },
                methods:{
                    affiliatepress_load_reg_booking_form(){
                        const vm = this;
                        setTimeout(function(){
                            vm.is_affiliate_form_loader = "1";                            
                        }, 400);
                    },                 
					'.$affiliatepress_vue_methods_data.'
				},
			});               
            app.use(ElementPlus, {
                locale: ElementPlusLocaleData,
            });            
            app.mount("'.$affiliatepress_vue_root_element_id.'");            
            ';            

            $affiliatepress_script_data = " var app;  
			var is_script_loaded_$affiliatepress_vue_root_element_id_el = false;
            affiliatepress_beforeload_data = '';
            if( null != document.getElementById('$affiliatepress_vue_root_element_id_without_hash') ){
                affiliatepress_beforeload_data = document.getElementById('$affiliatepress_vue_root_element_id_without_hash').innerHTML;
            }
            window.addEventListener('DOMContentLoaded', function() {
                if( is_script_loaded_$affiliatepress_vue_root_element_id_el == false) {
                    is_script_loaded_$affiliatepress_vue_root_element_id_el = true;
                    ap_load_vue_shortcode_$affiliatepress_vue_root_element_id_el();
                }
            });
            window.addEventListener( 'elementor/popup/show', (event) => {
                let element = event.detail.instance.\$element[0].querySelector('.ap-review-container');
                if( 'undefined' != typeof element ){
                    document.getElementById('$affiliatepress_vue_root_element_id_without_hash').innerHTML = affiliatepress_beforeload_data;
                    ap_load_vue_shortcode_$affiliatepress_vue_root_element_id_el();
                }
            });
            function ap_load_vue_shortcode_$affiliatepress_vue_root_element_id_el(){
                {$affiliatepress_script_return_data}           
            }
            window.onHCaptchaVerify = function(token){
                const element_h_captch = document.getElementById('ap-h-captcha-val');
                if(element_h_captch){
                    document.getElementById('ap-h-captcha-val').value = token;
                }
            }";            
            
            wp_add_inline_script('affiliatepress_element_js', $affiliatepress_script_data, 'after');

            return do_shortcode( $affiliatepress_content );                

        }


    }
}
global $affiliatepress_affiliate_register;
$affiliatepress_affiliate_register = new affiliatepress_affiliate_register();
