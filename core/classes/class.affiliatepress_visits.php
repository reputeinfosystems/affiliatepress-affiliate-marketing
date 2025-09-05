<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (! class_exists('affiliatepress_visits') ) {
    class affiliatepress_visits Extends AffiliatePress_Core{
        
        var $affiliatepress_per_page_record;

        function __construct(){
            
            $this->affiliatepress_per_page_record = 10;

            /**Function for affiliate vue data */
            add_action( 'admin_init', array( $this, 'affiliatepress_visits_vue_data_fields') );

            /* Dynamic Constant */
            add_filter('affiliatepress_visits_dynamic_constant_define',array($this,'affiliatepress_visits_dynamic_constant_define_func'),10,1);
            
            /* Dynamic Vue Fields */
            add_filter('affiliatepress_visits_dynamic_data_fields',array($this,'affiliatepress_visits_dynamic_data_fields_func'),10,1);

            /* Vue Load */
            add_action('affiliatepress_visits_dynamic_view_load', array( $this, 'affiliatepress_visits_dynamic_view_load_func' ), 10);

            /* Vue Method */
            add_filter('affiliatepress_visits_dynamic_vue_methods',array($this,'affiliatepress_visits_dynamic_vue_methods_func'),10,1);

            /* Dynamic On Load Method */
            add_filter('affiliatepress_visits_dynamic_on_load_methods', array( $this, 'affiliatepress_visits_dynamic_on_load_methods_func' ), 10, 1);

            /* Get Affiliates */
            add_action('wp_ajax_affiliatepress_get_visits', array( $this, 'affiliatepress_get_visits' ));

        }

                                      
        /**
         * Visists page on load methods
         *
         * @param  string $affiliatepress_visits_dynamic_on_load_methods
         * @return string
         */
        function affiliatepress_visits_dynamic_on_load_methods_func($affiliatepress_visits_dynamic_on_load_methods){

            $affiliatepress_visits_dynamic_on_load_methods.='
                this.loadVisits().catch(error => {
                    console.error(error)
                });            
            ';
            
            return $affiliatepress_visits_dynamic_on_load_methods;

        }        
      

        /**
         * Function for get affiliate data
         *
         * @return void
         */
        function affiliatepress_get_visits(){
            
            global $wpdb, $affiliatepress_tbl_ap_affiliates,$affiliatepress_tbl_ap_affiliate_visits,$AffiliatePress;
            $affiliatepress_ap_check_authorization = $this->affiliatepress_ap_check_authentication( 'retrieve_visits', true, 'ap_wp_nonce' );
            $response = array();
            $response['variant'] = 'error';
            $response['title']   = esc_html__( 'Error', 'affiliatepress-affiliate-marketing');
            $response['msg']     = esc_html__( 'Something Wrong', 'affiliatepress-affiliate-marketing');
            
            if( preg_match( '/error/', $affiliatepress_ap_check_authorization ) ){
                $affiliatepress_auth_error = explode( '^|^', $affiliatepress_ap_check_authorization );
                $affiliatepress_error_msg = !empty( $affiliatepress_auth_error[1] ) ? $affiliatepress_auth_error[1] : esc_html__( 'Sorry. Something went wrong while processing the request', 'affiliatepress-affiliate-marketing');
                $response['variant'] = 'error';
                $response['title'] = esc_html__( 'Error', 'affiliatepress-affiliate-marketing');
                $response['msg'] = $affiliatepress_error_msg;
                wp_send_json( $response );
                die;
            }

            if(!current_user_can('affiliatepress_visits')){
                $affiliatepress_error_msg = esc_html__( 'Sorry, you do not have permission to perform this action.', 'affiliatepress-affiliate-marketing');
                $response['variant'] = 'error';
                $response['title'] = esc_html__( 'Error', 'affiliatepress-affiliate-marketing');
                $response['msg'] = $affiliatepress_error_msg; 
                wp_send_json( $response );
                die;                
            }
            
            $affiliatepress_wpnonce = isset($_POST['_wpnonce']) ? sanitize_text_field(wp_unslash($_POST['_wpnonce'])) : '';// phpcs:ignore
            $affiliatepress_ap_verify_nonce_flag = wp_verify_nonce($affiliatepress_wpnonce, 'ap_wp_nonce');
            if (! $affiliatepress_ap_verify_nonce_flag ) {
                $response['variant']        = 'error';
                $response['title']          = esc_html__('Error', 'affiliatepress-affiliate-marketing');
                $response['msg']            = esc_html__('Sorry, Your request can not be processed due to security reason.', 'affiliatepress-affiliate-marketing');
                echo wp_json_encode($response);
                exit;
            }

            $affiliatepress_perpage     = isset($_POST['perpage']) ? intval($_POST['perpage']) : 10; // phpcs:ignore
            $affiliatepress_currentpage = isset($_POST['currentpage']) ? intval($_POST['currentpage']) : 1; // phpcs:ignore
            $affiliatepress_offset      = (!empty($affiliatepress_currentpage) && $affiliatepress_currentpage > 1 ) ? ( ( $affiliatepress_currentpage - 1 ) * $affiliatepress_perpage ) : 0;
            $affiliatepress_order       = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : ''; // phpcs:ignore 
            $affiliatepress_order_by    = isset($_POST['order_by']) ? sanitize_text_field($_POST['order_by']) : ''; // phpcs:ignore
                                    
            $affiliatepress_search_query = '';

            $affiliatepress_where_clause = " WHERE 1 = 1 ";
            if (! empty($_REQUEST['search_data']) ) {// phpcs:ignore
               
                if(isset($_REQUEST['search_data']['ap_visit_date'])) {// phpcs:ignore

                    $affiliatepress_start_date = (isset($_REQUEST['search_data']['ap_visit_date'][0]))?sanitize_text_field($_REQUEST['search_data']['ap_visit_date'][0]):'';// phpcs:ignore
                    $affiliatepress_end_date   = (isset($_REQUEST['search_data']['ap_visit_date'][1]))?sanitize_text_field($_REQUEST['search_data']['ap_visit_date'][1]):'';// phpcs:ignore

                    if(!empty($affiliatepress_start_date) && !empty($affiliatepress_end_date)){
                        $affiliatepress_start_date = date('Y-m-d',strtotime($affiliatepress_start_date));// phpcs:ignore
                        $affiliatepress_end_date = date('Y-m-d',strtotime($affiliatepress_end_date));// phpcs:ignore

                        $affiliatepress_where_clause.= $wpdb->prepare( " AND (DATE(visits.ap_visit_created_date) >= %s AND DATE(visits.ap_visit_created_date) <= %s) ", $affiliatepress_start_date, $affiliatepress_end_date);
                    }
                }                
                if (isset($_REQUEST['search_data']['ap_affiliates_user']) && !empty($_REQUEST['search_data']['ap_affiliates_user']) ) {// phpcs:ignore
                    $affiliatepress_search_name   = sanitize_text_field($_REQUEST['search_data']['ap_affiliates_user']);// phpcs:ignore

                    $affiliatepress_search_name_last = $affiliatepress_search_name;
                    if(!empty($affiliatepress_search_name)){
                        $name_parts = explode(' ', $affiliatepress_search_name);                                    
                        $affiliatepress_search_name = isset($name_parts[0]) ? $name_parts[0] : '';
                        if(isset($name_parts[1])){
                            $affiliatepress_search_name_last = isset($name_parts[1]) ? $name_parts[1] : '';
                        }                                                
                    }

                    $affiliatepress_where_clause.= $wpdb->prepare( " AND (affiliate.ap_affiliates_first_name LIKE %s OR affiliate.ap_affiliates_last_name LIKE %s) ", '%'.$affiliatepress_search_name.'%', '%'.$affiliatepress_search_name_last.'%');

                }
                if (isset($_REQUEST['search_data']['visit_type']) && !empty($_REQUEST['search_data']['visit_type'])){// phpcs:ignore
                    if(sanitize_text_field($_REQUEST['search_data']['visit_type']) == 'converted'){// phpcs:ignore
                        $affiliatepress_where_clause.= $wpdb->prepare( " AND (visits.ap_commission_id <> %d) ", 0);
                    }else{
                        $affiliatepress_where_clause.= $wpdb->prepare( " AND (visits.ap_commission_id = %d) ", 0);
                    }
                }
            }  

            $affiliatepress_tbl_ap_affiliate_visits_temp = $this->affiliatepress_tablename_prepare($affiliatepress_tbl_ap_affiliate_visits); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized --Reason - $affiliatepress_tbl_ap_affiliate_visits contains table name and it's prepare properly using 'affiliatepress_tablename_prepare' function
            
            $affiliatepress_tbl_ap_affiliates_temp = $this->affiliatepress_tablename_prepare($affiliatepress_tbl_ap_affiliates); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized --Reason - $affiliatepress_tbl_ap_affiliates contains table name and it's prepare properly using 'affiliatepress_tablename_prepare' function                        

            $affiliatepress_get_total_visits = intval($wpdb->get_var("SELECT count(visits.ap_visit_id) FROM {$affiliatepress_tbl_ap_affiliate_visits_temp} as visits INNER JOIN {$affiliatepress_tbl_ap_affiliates_temp} as affiliate  ON visits.ap_affiliates_id = affiliate.ap_affiliates_id  {$affiliatepress_where_clause}")); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared --Reason: $affiliatepress_tbl_ap_affiliates_temp is a table name. false alarm

            if(empty($affiliatepress_order)){
                $affiliatepress_order = 'DESC';
            }
            if(empty($affiliatepress_order_by)){
                $affiliatepress_order_by = 'visits.ap_visit_id';
            }

            if($affiliatepress_order_by == "first_name"){
                $affiliatepress_order_by = 'affiliate.ap_affiliates_first_name';
            }

            $affiliatepress_visits_record    = $wpdb->get_results("SELECT visits.ap_visit_id, visits.ap_commission_id,visits.ap_visit_browser, visits.ap_visit_created_date, visits.ap_visit_ip_address, visits.ap_visit_country, visits.ap_visit_landing_url, visits.ap_referrer_url, visits.ap_affiliates_campaign_name, affiliate.ap_affiliates_first_name, affiliate.ap_affiliates_last_name,visits.ap_affiliates_id,affiliate.ap_affiliates_user_id  FROM {$affiliatepress_tbl_ap_affiliate_visits_temp} as visits INNER JOIN {$affiliatepress_tbl_ap_affiliates_temp} as affiliate  ON visits.ap_affiliates_id = affiliate.ap_affiliates_id {$affiliatepress_where_clause}  order by {$affiliatepress_order_by} {$affiliatepress_order} LIMIT {$affiliatepress_offset} , {$affiliatepress_perpage}", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared --Reason: $affiliatepress_tbl_ap_affiliates_temp is a table name. false alarm 

            $affiliatepress_visits = array();
            if (! empty($affiliatepress_visits_record) ) {
                $affiliatepress_counter = 1;
                foreach ( $affiliatepress_visits_record as $affiliatepress_key=>$affiliatepress_single_affiliate ) {

                    $affiliatepress_visit = $affiliatepress_single_affiliate;

                    $affiliatepress_visit['ap_visit_ip_address'] = esc_html($affiliatepress_single_affiliate['ap_visit_ip_address']);
                    $affiliatepress_visit['ap_affiliates_campaign_name'] = esc_html($affiliatepress_single_affiliate['ap_affiliates_campaign_name']);
                    $affiliatepress_visit['ap_visit_landing_url'] = esc_url($affiliatepress_single_affiliate['ap_visit_landing_url']);
                    $affiliatepress_visit['ap_referrer_url'] = esc_url($affiliatepress_single_affiliate['ap_referrer_url']);
                    $affiliatepress_visit['ap_visit_browser'] = esc_html($affiliatepress_single_affiliate['ap_visit_browser']);

                    $affiliatepress_user_first_name =  esc_html($affiliatepress_single_affiliate['ap_affiliates_first_name']);
                    $affiliatepress_user_last_name  =  esc_html($affiliatepress_single_affiliate['ap_affiliates_last_name']);

                    $affiliatepress_full_name = $affiliatepress_user_first_name." ".$affiliatepress_user_last_name;
                                      
                    $affiliatepress_visit['visit_created_date_formated'] = $AffiliatePress->affiliatepress_formated_date_display(esc_html($affiliatepress_single_affiliate['ap_visit_created_date']));

                    $affiliatepress_visit['full_name']             = esc_html($affiliatepress_full_name);
                    $affiliatepress_visit['change_status_loader']  = '';

                    $affiliatepress_visit['affiliatepress_affiliate_id'] = esc_html($affiliatepress_single_affiliate['ap_affiliates_id']);
                    $affiliatepress_visit['affiliatepress_affiliate_user_id'] = esc_html($affiliatepress_single_affiliate['ap_affiliates_user_id']);
                    
                    $affiliatepress_visits[] = $affiliatepress_visit;
                }
            }

            $affiliatepress_pagination_count = ceil(intval($affiliatepress_get_total_visits) / $affiliatepress_perpage);
            
            $response['variant'] = 'success';
            $response['title']   = esc_html__( 'success', 'affiliatepress-affiliate-marketing');
            $response['msg']     = esc_html__( 'Something Wrong', 'affiliatepress-affiliate-marketing');            
            $response['items'] = $affiliatepress_visits;
            $response['total'] = $affiliatepress_get_total_visits;
            $response['pagination_count'] = $affiliatepress_pagination_count;
            
            wp_send_json($response);
            exit;            
        }



        
        /**
         * Function for dynamic const add in vue
         *
         * @return string
         */
        function affiliatepress_visits_dynamic_constant_define_func($affiliatepress_visits_dynamic_constant_define){

            return $affiliatepress_visits_dynamic_constant_define;
        }

        /**
         * Function for affiliate vue data
         *
         * @return json
        */
        function affiliatepress_visits_dynamic_data_fields_func($affiliatepress_visits_vue_data_fields){            
            
            global $AffiliatePress,$affiliatepress_visits_vue_data_fields;
                        
            $affiliatepress_visits_vue_data_fields['all_status'] = array();
            $affiliatepress_visits_vue_data_fields['affiliates']['affiliate_user_name'] = '';

            $affiliatepress_affiliate_vue_data_fields = apply_filters('affiliatepress_backend_modify_visits_data_fields', $affiliatepress_visits_vue_data_fields);

            return wp_json_encode($affiliatepress_visits_vue_data_fields);

        }
        
        /**
         * Function for vue method
         *
         * @param  string $affiliatepress_visits_dynamic_vue_methods
         * @return void
         */
        function affiliatepress_visits_dynamic_vue_methods_func($affiliatepress_visits_dynamic_vue_methods){
            global $affiliatepress_notification_duration;

            $affiliatepress_response_add_user_details = "";
            $affiliatepress_response_add_user_details = apply_filters('affiliatepress_response_add_user_details', $affiliatepress_response_add_user_details);  

            $affiliatepress_visits_dynamic_vue_methods.='
            handleSizeChange(val) {
                this.perPage = val;
                this.loadVisits();
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadVisits();
            },
            applyFilter(){
                const vm = this;
                vm.currentPage = 1;
                vm.loadVisits();
            },            
            resetFilter(){
                const vm = this;
                const formValues = Object.values(this.visits_search);
                const hasValue = formValues.some(value => {
                    if (typeof value === "string") {
                        return value.trim() !== "";
                    }
                    if (Array.isArray(value)) {
                        return value.length > 0;
                    }
                    return false;
                });                
                vm.visits_search.ap_visit_date = [];
                vm.visits_search.ap_affiliates_user = "";
                vm.visits_search.visit_type = "";
                if (hasValue) {
                    vm.currentPage = 1;
                    vm.loadVisits();
                }                
                vm.is_multiple_checked = false;
                vm.multipleSelection = [];
            },  
            async loadVisits(flag = true) {
                const vm = this;
                if(flag){
                    vm.is_display_loader = "1";
                }                
                vm.enabled = true;
                vm.is_apply_disabled = true; 
                affiliatespress_search_data = vm.visits_search;
                var postData = { action:"affiliatepress_get_visits", perpage:this.perPage, order_by:this.order_by, order:this.order, currentpage:this.currentPage, search_data: affiliatespress_search_data,_wpnonce:"'.esc_html(wp_create_nonce('ap_wp_nonce')).'" };
                axios.post( affiliatepress_ajax_obj.ajax_url, Qs.stringify( postData ) )
                .then( function(response){
                    vm.ap_first_page_loaded = "0";
                    vm.is_display_loader = "0";
                     vm.is_apply_disabled = false; 
                    if(response.data.variant == "success"){
                        vm.items = response.data.items;
                        vm.totalItems = response.data.total;
                        vm.pagination_count = response.data.pagination_count;
                    }else{
                        vm.$notify({
                            title: response.data.title,
                            message: response.data.msg,
                            type: response.data.variant,
                            customClass: response.data.variant+"_notification",
                            duration:'.intval($affiliatepress_notification_duration).',
                        });
                    }                    
                }.bind(this) )
                .catch( function (error) {
                    vm.ap_first_page_loaded = "0";
                    vm.is_display_loader = "0";
                    console.log(error);
                    vm.$notify({
                        title: "'.esc_html__('Error', 'affiliatepress-affiliate-marketing').'",
                        message: "'.esc_html__('Something went wrong..', 'affiliatepress-affiliate-marketing').'",
                        type: "error",
                        customClass: "error_notification",
                        duration:'.intval($affiliatepress_notification_duration).',    
                    });
                });

            },  
            resetModal(form_ref){
                vm = this;
                if(form_ref){
                    this.$refs[form_ref].resetFields();
                }                
                vm.affiliates = JSON.parse(JSON.stringify(vm.affiliates_org));
                var div = document.getElementById("ap-drawer-body");
                if(div){
                    div.scrollTop = 0;
                }                
            },
            closeModal(form_ref){
                vm = this;
                var div = document.getElementById("ap-drawer-body");
                if(div){
                    div.scrollTop = 0;
                }                
                vm.open_modal = false;
                if(form_ref){
                    this.$refs[form_ref].resetFields();
                }                
                vm.affiliates = JSON.parse(JSON.stringify(vm.affiliates_org));
            },
            handleSortChange({ column, prop, order }){                
                var vm = this;
                if(prop == "full_name"){
                    vm.order_by = "first_name"; 
                }                
                if(prop == "full_name"){
                    vm.order_by = "first_name"; 
                }else if(prop == "ap_visit_created_date"){
                    vm.order_by = "ap_visit_created_date"; 
                }else if(prop == "ap_commission_id"){
                    vm.order_by = "ap_commission_id"; 
                }
                if(vm.order_by){
                    if(order == "descending"){
                        vm.order = "DESC";
                    }else if(order == "ascending"){
                        vm.order = "ASC";
                    }else{
                        vm.order = "";
                        vm.order_by = "";
                    }
                }
                this.loadVisits(false);                
            },
            affiliatepress_full_row_clickable(row){
                const vm = this
                vm.$refs.multipleTable.toggleRowExpansion(row);
            },      
           affiliatepress_get_affiliate_user_details(affiliate_id,user_id){
                const vm = this;
                vm.userPopoverVisible = "true";
                vm.is_get_user_data_loader = "1";
                var postData = [];
                postData.affiliat_id = affiliate_id;
                postData.affiliate_user_id = user_id;
                postData.action = "affiliatepress_get_affiliate_user_details";
                postData._wpnonce = "'.esc_html(wp_create_nonce("ap_wp_nonce")).'"
                axios.post( affiliatepress_ajax_obj.ajax_url, Qs.stringify( postData ) )
                .then( function (response) {
                    if(response.data.variant == "success" && response.data.affiliate_data != ""){
                        vm.is_get_user_data_loader = "0";
                        vm.affiliate_user_details.affiliate_user_name = response.data.affiliate_data.affiliate_user_name;
                        vm.affiliate_user_details.affiliate_user_email = response.data.affiliate_data.affiliate_user_email;
                        vm.affiliate_user_details.affiliate_user_full_name = response.data.affiliate_data.affiliate_user_full_name;
                        vm.affiliate_user_details.affiliate_user_edit_link = response.data.affiliate_data.affiliate_user_edit_link;
                        vm.show_user_details = "1";
                        '.$affiliatepress_response_add_user_details.'
                    }else if(response.data.variant == "success" && response.data.affiliatepress_wordpress_user_delete != ""){
                        vm.is_get_user_data_loader = "0";
                        vm.affiliatepress_wordpress_user_delete = response.data.affiliatepress_wordpress_user_delete;
                        vm.show_user_details = "0";
                    }
                    else{
                        vm.is_get_user_data_loader = "0";     
                        vm.$notify({
                            title: response.data.title,
                            message: response.data.msg,
                            type: response.data.variant,
                            customClass: response.data.variant+"_notification",                                
                            duration:'.intval($affiliatepress_notification_duration).',
                        });    
                    }
                }.bind(this) )
                .catch( function (error) {   
                    vm.is_get_user_data_loader = "0";
                    vm.is_disabled = 0;                                     
                    vm.$notify({
                            title: "'.esc_html__('Error', 'affiliatepress-affiliate-marketing').'",
                            message: "'.esc_html__('Something went wrong..', 'affiliatepress-affiliate-marketing').'",
                            type: "error",
                            customClass: "error_notification",
                            duration:'.intval($affiliatepress_notification_duration).',  
                    });
                });
            },               
            editUserclosePopover(){
                const vm = this;
                vm.userPopoverVisible = false;
            },                                
            ';

            return $affiliatepress_visits_dynamic_vue_methods;

        }
        
        /**
         * Function for dynamic View load
         *
         * @return HTML
        */
        function affiliatepress_visits_dynamic_view_load_func(){

            $affiliatepress_load_file_name = AFFILIATEPRESS_VIEWS_DIR . '/visits/manage_visits.php';
            $affiliatepress_load_file_name = apply_filters('affiliatepress_modify_visits_view_file_path', $affiliatepress_load_file_name);
            include $affiliatepress_load_file_name;

        }

        
        /**
         * Function for visits default Vue Data
         *
         * @return void
        */
        function affiliatepress_visits_vue_data_fields(){

            global $affiliatepress_visits_vue_data_fields;            
            $affiliatepress_pagination          = wp_json_encode(array( 10, 20, 50, 100, 200, 300, 400, 500 ));
            $affiliatepress_pagination_arr      = json_decode($affiliatepress_pagination, true);
            $affiliatepress_pagination_selected = $this->affiliatepress_per_page_record;

            $affiliatepress_visits_vue_data_fields = array(
                'bulk_action'                => 'bulk_action',
                'bulk_options'               => array(
                    array(
                        'value' => 'bulk_action',
                        'label' => esc_html__('Bulk Action', 'affiliatepress-affiliate-marketing'),
                    ),
                    array(
                        'value' => 'delete',
                        'label' => esc_html__('Delete', 'affiliatepress-affiliate-marketing'),
                    ),
                ),
                'loading'                    => false,
                'visits_search'          => array(
                    "ap_affiliates_user"     => '',
                    "ap_visit_date"          => array(),
                    "visit_type"             => '',
                ),
                'order'                      => '',
                'order_by'                   => '',
                'items'                      => array(),
                'multipleSelection'          => array(),
                'multipleSelectionVal'       => '',
                'perPage'                    => $affiliatepress_pagination_selected,
                'totalItems'                 => 0,
                'pagination_count'           => 1,
                'currentPage'                => 1,
                'savebtnloading'             => false,
                'modal_loader'               => 1,
                'is_display_loader'          => '0',
                'is_disabled'                => false,
                'is_apply_disabled'          => false,
                'is_display_save_loader'     => '0',
                'is_multiple_checked'        => false,              
                'pagination_length_val'      => '10',
                'pagination_val'             => array(
                    array(
                        'text'  => '10',
                        'value' => '10',
                    ),
                    array(
                        'text'  => '20',
                        'value' => '20',
                    ),
                    array(
                        'text'  => '50',
                        'value' => '50',
                    ),
                    array(
                        'text'  => '100',
                        'value' => '100',
                    ),
                    array(
                        'text'  => '200',
                        'value' => '200',
                    ),
                    array(
                        'text'  => '300',
                        'value' => '300',
                    ),
                    array(
                        'text'  => '400',
                        'value' => '400',
                    ),
                    array(
                        'text'  => '500',
                        'value' => '500',
                    ),
                ),
                'is_get_user_data_loader'     => '0',
                'userPopoverVisible'          => false,
                'affiliate_user_details' => array(
                    'affiliate_user_name'  => '',
                    'affiliate_user_email' => '',
                    'affiliate_user_full_name'=> '',
                    'affiliate_user_edit_link' => '',
                ),
                'affiliatepress_wordpress_user_delete'=>'',
                'show_user_details' => '1',
            );
        }



    }
}
global $affiliatepress_visits;
$affiliatepress_visits = new affiliatepress_visits();
