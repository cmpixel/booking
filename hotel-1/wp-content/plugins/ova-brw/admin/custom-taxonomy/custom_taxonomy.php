<?php defined( 'ABSPATH' ) || exit();

// Display Custom Checkout Fields
if ( ! function_exists( 'ovabrw_custom_taxonomy' ) ) {
    function ovabrw_custom_taxonomy() {
        $list_fields = recursive_array_replace( '\\', '', get_option( 'ovabrw_custom_taxonomy', array() ) );

        if ( isset( $_POST ) && $_POST ) {
            $_POST = recursive_array_replace( '\\', '', $_POST );
        }

        $action_popup   = isset( $_POST['ova_action'] ) ? sanitize_text_field( $_POST['ova_action'] ) : '';
        $slug           = isset( $_POST['slug'] ) ? sanitize_text_field( $_POST['slug'] ) : '';
        
        if ( $action_popup == 'new' ) {
            $slug = apply_filters( 'ovabrw_prefix_cus_tax', 'brw_' ) . $slug;
        }

        //Update popup (Add New and Edit)
        if ( ! empty( $action_popup ) ) {
            if ( isset( $_POST ) && array_key_exists( 'name', $_POST ) && !empty( $_POST['name'] ) && array_key_exists( 'slug', $_POST ) && !empty( $_POST['slug'] ) && array_key_exists( 'singular_name', $_POST ) && !empty( $_POST['singular_name'] ) ) {
                $list_fields[$slug] = array(
                    'name'              => isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ): '',
                    'singular_name'     => isset( $_POST['singular_name'] ) ? sanitize_text_field( $_POST['singular_name'] ) : '',
                    'label_frontend'    => isset( $_POST['label_frontend'] ) ? sanitize_text_field( $_POST['label_frontend'] ) : '',
                    'enabled'           => ( isset( $_POST['enabled'] ) && $_POST['enabled'] != '' ) ? 'on' : '',
                    'show_listing'      => ( isset( $_POST['show_listing'] ) && $_POST['show_listing'] != '' ) ? 'on' : '',
                    
                );
            }
        
            if ( isset( $_POST ) ) {
                if ( $action_popup == 'new' ) {
                    update_option('ovabrw_custom_taxonomy', $list_fields);
                } elseif ( $action_popup == 'edit' ) {
                    $old_slug = isset( $_POST['ova_old_slug'] ) ? $_POST['ova_old_slug'] : '';

                    if ( ! empty( $old_slug ) && array_key_exists( $old_slug, $list_fields ) && $old_slug != $slug  ) {
                        unset($list_fields[$old_slug]);
                    }
                    if ( ! $slug ) {
                        unset($list_fields[$slug]);
                    }

                    update_option('ovabrw_custom_taxonomy', $list_fields);
                }
            }
        }
        //end popup
        // Update in Listing custom post type (Remove, Enable, Disable)
        $action_update = isset( $_POST['ovabrw_update_table'] ) ? sanitize_text_field( $_POST['ovabrw_update_table'] ) : '';

        if ( $action_update === 'update_table' ) {
            if ( isset( $_POST['remove'] ) && $_POST['remove'] == 'remove' ) {
                $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                    foreach( $select_field as $field ) {
                        if ( array_key_exists( $field, $list_fields ) ) {
                            unset( $list_fields[$field] );
                        }
                    }
                }
            }

            if ( isset( $_POST['enable'] ) && $_POST['enable'] == 'enable' ) {
                $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                    foreach( $select_field as $field ) {
                        if ( ! empty( $field ) && array_key_exists( $field, $list_fields ) ) {
                            $list_fields[$field]['enabled'] = 'on';
                        }
                    }
                }
            }

            if ( isset( $_POST['disable'] ) && $_POST['disable'] == 'disable' ) {
                $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                    foreach( $select_field as $field ) {
                        if ( ! empty( $field ) && array_key_exists( $field, $list_fields ) ) {
                            $list_fields[$field]['enabled'] = '';
                        }
                    }
                }
            }

            update_option('ovabrw_custom_taxonomy', $list_fields);
        }
        ?>
        <div class="wrap">
            <div class="ova-list-checkout-field">
                <form method="post" id="ova_update_form" action="">
                    <input type="hidden" name="ovabrw_update_table" value="update_table" >
                    <table cellspacing="0" cellpadding="10px">
                        <thead>
                            <th colspan="6">
                                <button type="button" class="button button-primary" id="ovabrw_openform">
                                    + <?php esc_html_e( 'Add Taxonomy', 'ova-brw' ); ?>
                                </button>
                                <input type="submit" class="button" name="remove" value="remove"  >
                                <input type="submit" class="button" name="enable" value="enable" >
                                <input type="submit" class="button" name="disable" value="disable" >
                            </th>
                            <tr>
                                <th class="check-column">
                                    <input type="checkbox" style="margin:0px 4px -1px -1px;" id="ovabrw_select_all_field" />
                                </th>
                                <th class="slug">
                                    <?php esc_html_e('Slug', 'ova-brw'); ?>
                                </th>
                                <th class="name">
                                    <?php esc_html_e('Name', 'ova-brw'); ?>
                                </th>
                                <th class="singular_name">
                                    <?php esc_html_e('Singular name', 'ova-brw'); ?>
                                </th>
                                 <th class="label_frontend">
                                    <?php esc_html_e('Label Frontend', 'ova-brw'); ?>
                                </th>
                                <th class="manage_tax">
                                    <?php esc_html_e('Manage Taxonomy', 'ova-brw'); ?>
                                </th>
                                <th class="status">
                                    <?php esc_html_e('Enabled', 'ova-brw'); ?>
                                </th>
                                <th class="status">
                                    <?php esc_html_e('Show in Listing', 'ova-brw'); ?>
                                </th>    
                                <th class="action">
                                    <?php esc_html_e('Edit', 'ova-brw'); ?>
                                </th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ( !empty( $list_fields ) ) : ?>
                                <?php foreach( $list_fields as $key => $field ):
                                    $slug = $key;
                                    $name = array_key_exists( 'name', $field ) ? $field['name'] : '';
                                    $singular_name  = array_key_exists( 'singular_name', $field ) ? $field['singular_name'] : '';
                                    $label_frontend = array_key_exists( 'label_frontend', $field ) ? $field['label_frontend'] : '';
                                    $enabled        = array_key_exists( 'enabled', $field ) ? $field['enabled'] : '';
                                    $show_listing   = array_key_exists( 'show_listing', $field ) ? $field['show_listing'] : '';
                                    $enabled_status = $enabled ? '<span class="dashicons dashicons-yes tips" data-tip="Yes"></span>' : '-';
                                    $show_listing_status = $show_listing ? '<span class="dashicons dashicons-yes tips" data-tip="Yes"></span>' : '-';

                                    $class_disable  = !$enabled ? 'class="ova-disable"' : '';
                                    $disable_button = !$enabled ? 'disabled' : '';
                                    $value_enabled  = $enabled == 'on' ? $slug : '';
                                    
                                    $data_edit = [
                                        'slug'              => $slug,
                                        'name'              => $name,
                                        'singular_name'     => $singular_name,
                                        'label_frontend'    => $label_frontend,
                                        'show_listing'      => $show_listing,
                                        'enabled'           => $enabled
                                        
                                    ];

                                    $data_edit = json_encode( $data_edit );
                                ?>
                            <tr <?php echo $class_disable ?>>
                                <input type="hidden" name="remove_field[]" value="">
                                <input type="hidden" name="enable_field[]" value="<?php echo esc_attr( $value_enabled ); ?>">
                                <td class="ova-checkbox">
                                    <input type="checkbox" name="select_field[]" value="<?php echo $slug; ?>" />
                                </td>
                                <td class="ova-slug">
                                    <?php echo esc_html( $slug ); ?>
                                </td>
                                <td class="ova-name">
                                    <?php echo esc_html( $name ); ?>
                                </td>
                                <td class="ova-singular_name">
                                    <?php echo esc_html( $singular_name ); ?>
                                </td>
                                <td class="ova-label-frontend">
                                    <?php echo esc_html( $label_frontend ); ?>
                                </td>
                                <td>
                                    <?php 
                                    $terms = get_terms( array(
                                        'taxonomy'      => $slug,//i guess campaign_action  is your  taxonomy 
                                        'hide_empty'    => false
                                    ));
                                    ?>
                                    <a href="<?php echo admin_url('edit-tags.php?post_type=product&taxonomy='.$slug); ?>" title="<?php esc_html_e( 'Manage Taxonomy: Add/Update value of taxonomy', 'ova-brw' ); ?>">
                                        <i class="dashicons dashicons-category"></i>
                                        (<?php echo ! is_wp_error( $terms ) ? count( $terms ): 0; ?>)    
                                    </a>
                                </td>
                                <td class="ova-enable status">
                                    <?php echo $enabled_status; ?>
                                </td>
                                <td class="ova-show-listing status">
                                    <?php echo $show_listing_status; ?>
                                </td>
                                <td class="ova-edit edit">
                                    <button type="button" <?php echo esc_attr( $disable_button ); ?> class="button ova-button ovabrw_edit_field_form" data-data_edit="<?php echo esc_attr( $data_edit ); ?>" >
                                        <?php esc_html_e( 'Edit', 'ova-brw' ); ?>
                                    </button>
                                </td>
                            </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>           
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="ova-wrap-popup-ckf">
                <div id="ova_new_field_form" class="ova-popup-wrapper">
                    <a href="javascript:void(0)" class="close_popup" id="ovabrw_close_popup" >X</a>
                    <?php ova_output_popup_custom_tax_form( 'new', $list_fields ); ?>
                </div>
            </div>
        </div>
        <?php 
    }
}

if ( ! function_exists( 'ova_output_popup_custom_tax_form' ) ) {
    function ova_output_popup_custom_tax_form( $form_type = '', $list_fields = [] ) {
    ?>
        <form method="post" id="ova_popup_field_form" action="">
            <input type="hidden" name="ova_action" value="<?php echo $form_type; ?>" />
            <input type="hidden" name="ova_old_name" value="" />
            <input type="hidden" name="ova_old_slug" value="" />
            <table width="100%">
                <tr>                
                    <td colspan="2" class="err_msgs"></td>
                </tr>
                <tr class="ova-row-slug">
                    <td class="label">
                        <?php esc_html_e( 'Slug', 'ova-brw' ); ?>
                    </td>
                    <td>
                        <input type="text" name="slug" value="" placeholder="<?php esc_html_e( 'taxonomy_1', 'ova-brw' ); ?> ">
                        <br>
                        <span>
                            <?php esc_html_e( 'Taxonomy key, must not exceed 32 characters', 'ova-brw' ); ?>
                        </span>
                    </td>
                </tr>
                <tr class="ova-row-name">
                    <td class="label">
                        <?php esc_html_e( 'Name', 'ova-brw' ); ?>
                    </td>
                    <td>
                        <input type="text" name="name" value="" placeholder="<?php esc_html_e( 'Taxonomys 1', 'ova-brw' ); ?> ">
                    </td>
                </tr>
                <tr class="ova-row-sigular-name">
                    <td class="label">
                        <?php esc_html_e( 'Singular name', 'ova-brw' ); ?>
                    </td>
                    <td>
                        <input type="text" name="singular_name" value="" placeholder="<?php esc_html_e( 'Taxonomy 1', 'ova-brw' ); ?> ">
                    </td>
                </tr>
                <tr class="ova-row-label-frontend">
                    <td class="label">
                        <?php esc_html_e( 'Label frontend', 'ova-brw' ); ?>
                    </td>
                    <td>
                        <input type="text" name="label_frontend" value="" placeholder="<?php esc_html_e( 'Label', 'ova-brw' ); ?> ">
                    </td>
                </tr>
                <tr class="row-required">
                    <td>&nbsp;</td>
                    <td class="check-box">
                        <input id="ova_enable" type="checkbox" name="enabled" checked="checked" value="on">
                        <label for="ova_enable">
                            <?php esc_html_e( 'Enable', 'ova-brw' ); ?>
                        </label>
                        <br/>
                    </td>                     
                    <td class="label"></td>
                </tr>
                <tr class="row-show-listing">
                    <td>&nbsp;</td>
                    <td class="check-box">
                        <input id="show_listing" type="checkbox" name="show_listing" checked="checked" value="on">
                        <label>
                            <?php esc_html_e( 'Show in Listing', 'ova-brw' ); ?>
                        </label>
                        <br/>
                    </td>                     
                    <td class="label"></td>
                </tr>
            </table>
            <button type='submit' class="button button-primary">
                <?php esc_html_e( 'save', 'ova-brw' ); ?>
            </button>
        </form>
        <?php
    }
}