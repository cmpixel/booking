<?php defined( 'ABSPATH' ) || exit();

// Display Custom Checkout Fields
if ( ! function_exists( 'ovabrw_custom_checkout_field' ) ) {
    function ovabrw_custom_checkout_field() {
        /* Jquery ui */
        wp_enqueue_script('jquery-ui', OVABRW_PLUGIN_URI.'assets/libs/jquery-ui/jquery-ui.min.js', array('jquery'), false, true);
        wp_enqueue_style('jquery-ui', OVABRW_PLUGIN_URI.'assets/libs/jquery-ui/jquery-ui.min.css', array(), null);

        $list_fields = recursive_array_replace( '\\', '', get_option( 'ovabrw_booking_form', array() ) );

        if ( isset( $_POST ) && $_POST ) {
            $_POST = recursive_array_replace( '\\', '', $_POST );
        }

        $action_popup   = isset( $_POST['ova_action'] ) ? sanitize_text_field( $_POST['ova_action'] ) : '';
        $name           = isset( $_POST['name'] ) ? sanitize_text_field( sanitize_title( $_POST['name'] ) ) : '';
        
        // Update popup
        if ( isset( $_POST ) && ! empty( $_POST ) ) {
            if ( current_user_can('publish_posts') ) {
                if ( array_key_exists( 'name', $_POST ) && ! empty( $_POST['name'] ) ) {
                    $list_fields[$name] = array(
                        'type'          => isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '',
                        'label'         => isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '',
                        'description'   => isset( $_POST['description'] ) ? sanitize_text_field( $_POST['description'] ) : '',
                        'default'       => isset( $_POST['default'] ) ? sanitize_text_field( $_POST['default'] ) : '',
                        'placeholder'   => isset( $_POST['placeholder'] ) ? sanitize_text_field( $_POST['placeholder'] ) : '',
                        'class'         => isset( $_POST['class'] ) ? sanitize_text_field( $_POST['class'] ) : '',
                        'required'      => isset( $_POST['required'] ) ? sanitize_text_field( $_POST['required'] ) : '',
                        'enabled'       => isset( $_POST['enabled'] ) ? sanitize_text_field( $_POST['enabled'] ) : '',
                        'show_in_email' => isset( $_POST['show_in_email'] ) ? sanitize_text_field( $_POST['show_in_email'] ) : '',
                        'show_in_order' => isset( $_POST['show_in_order'] ) ? sanitize_text_field( $_POST['show_in_order'] ) : '',
                    );
                }

                if ( isset( $_POST['type'] ) && $_POST['type'] == 'select' ) {
                    $list_fields[$name]['ova_options_key']      = ovabrw_sanitize_keys( $_POST['ova_options_key'], $_POST['ova_options_text'] );
                    $list_fields[$name]['ova_options_text']     = $_POST['ova_options_text'];
                    $list_fields[$name]['ova_options_price']    = $_POST['ova_options_price'];
                    $list_fields[$name]['ova_options_qty']      = $_POST['ova_options_qty'];
                    $list_fields[$name]['placeholder']          = '';
                }

                if ( isset( $_POST['type'] ) && $_POST['type'] == 'radio' ) {
                    $list_fields[$name]['ova_values']   = $_POST['ova_values'];
                    $list_fields[$name]['ova_prices']   = $_POST['ova_prices'];
                    $list_fields[$name]['ova_qtys']     = $_POST['ova_qtys'];
                    $list_fields[$name]['placeholder']  = '';
                }

                if ( isset( $_POST['type'] ) && $_POST['type'] == 'checkbox' ) {
                    $list_fields[$name]['placeholder']          = '';
                    $list_fields[$name]['ova_checkbox_key']     = ovabrw_sanitize_keys( $_POST['ova_checkbox_key'], $_POST['ova_checkbox_text'] );
                    $list_fields[$name]['ova_checkbox_text']    = $_POST['ova_checkbox_text'];
                    $list_fields[$name]['ova_checkbox_price']   = $_POST['ova_checkbox_price'];
                    $list_fields[$name]['ova_checkbox_qty']     = $_POST['ova_checkbox_qty'];
                }

                if ( isset( $_POST['type'] ) && $_POST['type'] == 'file' ) {
                    $list_fields[$name]['placeholder']      = '';
                    $list_fields[$name]['default']          = '';
                    $list_fields[$name]['max_file_size']    = $_POST['max_file_size'];
                }

                if ( $action_popup == 'new' ) {
                    update_option( 'ovabrw_booking_form', $list_fields );
                } elseif ( $action_popup == 'edit' ) {
                    $old_name = isset( $_POST['ova_old_name'] ) ? $_POST['ova_old_name'] : '';

                    if ( ! empty( $old_name ) && array_key_exists( $old_name, $list_fields ) && $old_name != $name  ) {
                        unset($list_fields[$old_name]);
                    }

                    if ( ! $name ) {
                        unset($list_fields[$name]);
                    }

                    update_option('ovabrw_booking_form', $list_fields);
                }

                //end popup
                $action_update = isset( $_POST['ovabrw_update_table'] ) ? sanitize_text_field( $_POST['ovabrw_update_table'] ) : '';

                if ( $action_update === 'update_table' ) {
                    if ( isset( $_POST['remove'] ) && $_POST['remove'] == 'remove' ) {
                        $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                        if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                            foreach ( $select_field as $field ) {
                                if ( array_key_exists( $field, $list_fields ) ) {
                                    unset( $list_fields[$field] );
                                }
                            }
                        }
                    }

                    if ( isset( $_POST['enable'] ) && $_POST['enable'] == 'enable' ) {
                        $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                        if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                            foreach ( $select_field as $field ) {
                                if ( ! empty( $field ) && array_key_exists( $field, $list_fields ) ) {
                                    $list_fields[$field]['enabled'] = 'on';
                                }
                            }
                        }
                    }

                    if ( isset( $_POST['disable'] ) && $_POST['disable'] == 'disable' ) {
                        $select_field = isset( $_POST['select_field'] ) ? $_POST['select_field'] : [];

                        if ( is_array( $select_field ) && ! empty( $select_field ) ) {
                            foreach ( $select_field as $field ) {
                                if ( ! empty( $field ) && array_key_exists( $field, $list_fields ) ) {
                                    $list_fields[$field]['enabled'] = '';
                                }
                            }
                        }
                    }

                    update_option( 'ovabrw_booking_form', $list_fields );
                }
            } else {
                if ( ! array_key_exists( $name, $list_fields ) && $name && $action_popup == 'new' ) {
                    $list_fields[$name] = array(
                        'type'          => isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : '',
                        'label'         => isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '',
                        'description'   => isset( $_POST['description'] ) ? sanitize_text_field( $_POST['description'] ) : '',
                        'default'       => isset( $_POST['default'] ) ? sanitize_text_field( $_POST['default'] ) : '',
                        'placeholder'   => isset( $_POST['placeholder'] ) ? sanitize_text_field( $_POST['placeholder'] ) : '',
                        'class'         => isset( $_POST['class'] ) ? sanitize_text_field( $_POST['class'] ) : '',
                        'required'      => isset( $_POST['required'] ) ? sanitize_text_field( $_POST['required'] ) : '',
                        'enabled'       => '',
                        'show_in_email' => isset( $_POST['show_in_email'] ) ? sanitize_text_field( $_POST['show_in_email'] ) : '',
                        'show_in_order' => isset( $_POST['show_in_order'] ) ? sanitize_text_field( $_POST['show_in_order'] ) : '',
                    );

                    if ( isset( $_POST['type'] ) && $_POST['type'] == 'select' ) {
                        $list_fields[$name]['ova_options_key']      = ovabrw_sanitize_keys( $_POST['ova_options_key'], $_POST['ova_options_text'] );
                        $list_fields[$name]['ova_options_text']     = $_POST['ova_options_text'];
                        $list_fields[$name]['ova_options_price']    = $_POST['ova_options_price'];
                        $list_fields[$name]['ova_options_qty']      = $_POST['ova_options_qty'];
                        $list_fields[$name]['placeholder']          = '';
                    }

                    if ( isset( $_POST['type'] ) && $_POST['type'] == 'radio' ) {
                        $list_fields[$name]['ova_values']   = $_POST['ova_values'];
                        $list_fields[$name]['ova_prices']   = $_POST['ova_prices'];
                        $list_fields[$name]['ova_qtys']     = $_POST['ova_qtys'];
                        $list_fields[$name]['placeholder']  = '';
                    }

                    if ( isset( $_POST['type'] ) && $_POST['type'] == 'checkbox' ) {
                        $list_fields[$name]['placeholder']          = '';
                        $list_fields[$name]['ova_checkbox_key']     = ovabrw_sanitize_keys( $_POST['ova_checkbox_key'], $_POST['ova_checkbox_text'] );
                        $list_fields[$name]['ova_checkbox_text']    = $_POST['ova_checkbox_text'];
                        $list_fields[$name]['ova_checkbox_price']   = $_POST['ova_checkbox_price'];
                        $list_fields[$name]['ova_checkbox_qty']     = $_POST['ova_checkbox_qty'];
                    }

                    if ( isset( $_POST['type'] ) && $_POST['type'] == 'file' ) {
                        $list_fields[$name]['placeholder']      = '';
                        $list_fields[$name]['default']          = '';
                        $list_fields[$name]['max_file_size']    = $_POST['max_file_size'];
                    }

                    update_option( 'ovabrw_booking_form', $list_fields );
                }
            }
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
                                    + <?php esc_html_e( 'Add field', 'ova-brw' ); ?>
                                </button>
                                <input type="submit" class="button" name="remove" value="remove" />
                                <input type="submit" class="button" name="enable" value="enable" />
                                <input type="submit" class="button" name="disable" value="disable" />
                                <div class="ovabrw-loading">
                                    <span class="dashicons dashicons-update-alt"></span>
                                </div>
                            </th>
                            <tr>
                                <th class="check-column">
                                    <input 
                                        type="checkbox" 
                                        style="margin:0px 4px -1px -1px;" 
                                        id="ovabrw_select_all_field" />
                                </th>
                                <th class="name"><?php esc_html_e('Name', 'ova-brw'); ?></th>
                                <th class="id"><?php esc_html_e('Type', 'ova-brw'); ?></th>
                                <th><?php esc_html_e('Label', 'ova-brw'); ?></th>
                                <th><?php esc_html_e('Placeholder', 'ova-brw'); ?></th>
                                <th class="status"><?php esc_html_e('Required', 'ova-brw'); ?></th>
                                <th class="status"><?php esc_html_e('Enabled', 'ova-brw'); ?></th>    
                                <th class="action"><?php esc_html_e('Edit', 'ova-brw'); ?></th> 
                            </tr>
                        </thead>
                        <tbody class="ovabrw-sortable-ajax">
                            <?php if ( ! empty( $list_fields ) ): 
                                foreach ( $list_fields as $key => $field ):
                                    $name               = $key;
                                    $type               = array_key_exists( 'type', $field ) ? $field['type'] : '';
                                    $max_file_size      = array_key_exists( 'max_file_size', $field ) ? $field['max_file_size'] : '';
                                    $label              = array_key_exists( 'label', $field ) ? $field['label'] : '';
                                    $description        = array_key_exists( 'description', $field ) ? $field['description'] : '';
                                    $placeholder        = array_key_exists( 'placeholder', $field ) ? $field['placeholder'] : '';
                                    $default            = array_key_exists( 'default', $field ) ? $field['default'] : '';
                                    $class              = array_key_exists( 'class', $field ) ? $field['class'] : '';
                                    $required           = array_key_exists( 'required', $field ) ? $field['required'] : '';
                                    $enabled            = array_key_exists( 'enabled', $field ) ? $field['enabled'] : '';
                                    $ova_options_key    = array_key_exists( 'ova_options_key', $field ) ? $field['ova_options_key'] : [];
                                    $ova_options_text   = array_key_exists( 'ova_options_text', $field ) ? $field['ova_options_text'] : [];
                                    $ova_options_price  = array_key_exists( 'ova_options_price', $field ) ? $field['ova_options_price'] : [];
                                    $ova_options_qty  = array_key_exists( 'ova_options_qty', $field ) ? $field['ova_options_qty'] : [];
                                    $ova_values         = array_key_exists( 'ova_values', $field ) ? $field['ova_values'] : [];
                                    $ova_prices         = array_key_exists( 'ova_prices', $field ) ? $field['ova_prices'] : [];
                                    $ova_qtys           = array_key_exists( 'ova_qtys', $field ) ? $field['ova_qtys'] : [];
                                    $ova_checkbox_key   = array_key_exists( 'ova_checkbox_key', $field ) ? $field['ova_checkbox_key'] : [];
                                    $ova_checkbox_text  = array_key_exists( 'ova_checkbox_text', $field ) ? $field['ova_checkbox_text'] : [];
                                    $ova_checkbox_price = array_key_exists( 'ova_checkbox_price', $field ) ? $field['ova_checkbox_price'] : [];
                                    $ova_checkbox_qty   = array_key_exists( 'ova_checkbox_qty', $field ) ? $field['ova_checkbox_qty'] : [];
                                    $required_status    = $required ? '<span class="dashicons dashicons-yes tips" data-tip="Yes"></span>' : '-';
                                    $enabled_status     = $enabled ? '<span class="dashicons dashicons-yes tips" data-tip="Yes"></span>' : '-';
                                    $class_disable  = ! $enabled ? 'class="ova-disable"' : '';
                                    $disable_button = ! $enabled ? 'disabled' : '';
                                    $value_enabled  = $enabled == 'on' ? $name : '';
                                    
                                    $data_edit = [
                                        'name'                  => $name,
                                        'type'                  => $type,
                                        'max_file_size'         => $max_file_size,
                                        'label'                 => $label,
                                        'description'           => $description,
                                        'placeholder'           => $placeholder,
                                        'default'               => $default,
                                        'class'                 => $class,
                                        'ova_options_key'       => $ova_options_key,
                                        'ova_options_text'      => $ova_options_text,
                                        'ova_options_price'     => $ova_options_price,
                                        'ova_options_qty'       => $ova_options_qty,
                                        'ova_values'            => $ova_values,
                                        'ova_prices'            => $ova_prices,
                                        'ova_qtys'              => $ova_qtys,
                                        'ova_checkbox_key'      => $ova_checkbox_key,
                                        'ova_checkbox_text'     => $ova_checkbox_text,
                                        'ova_checkbox_price'    => $ova_checkbox_price,
                                        'ova_checkbox_qty'      => $ova_checkbox_qty,
                                        'required'              => $required,
                                        'enabled'               => $enabled
                                    ];

                                    $data_edit = json_encode( $data_edit );
                            ?>
                            <tr <?php echo $class_disable; ?>>
                                <input type="hidden" name="ovabrw_fields[]" value="<?php echo esc_attr( $name ); ?>">
                                <input type="hidden" name="remove_field[]" value="">
                                <input type="hidden" name="enable_field[]" value="<?php echo esc_attr( $value_enabled ); ?>">
                                <td class="ova-checkbox">
                                    <input type="checkbox" name="select_field[]" value="<?php echo $name; ?>" />
                                </td>
                                <td class="ova-name"><?php echo esc_html( $key ); ?></td>
                                <td class="ova-type"><?php echo esc_html( $type ); ?></td>
                                <td class="ova-label"><?php echo esc_html( $label ); ?></td>
                                <td class="ova-placeholder"><?php echo esc_html( $placeholder ); ?></td>
                                <td class="ova-require status"><?php echo $required_status; ?></td>
                                <td class="ova-enable status"><?php echo $enabled_status; ?></td>
                                <td class="ova-edit edit">
                                    <button type="button" <?php echo esc_attr( $disable_button ); ?> class="button ova-button ovabrw_edit_field_form" data-data_edit="<?php echo esc_attr( $data_edit ); ?>">
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
                <div id="ova_new_field_form" title="<?php esc_html_e( 'New Checkout Field', 'ova-brw' ); ?>" class="ova-popup-wrapper">
                    <a href="javascript:void(0)" class="close_popup" id="ovabrw_close_popup">X</a>
                    <?php ova_output_popup_form_fields( 'new', $list_fields ); ?>
                </div>
            </div>
        </div>
        <?php 
    }
}

if ( ! function_exists( 'ova_output_popup_form_fields' ) ) {
    function ova_output_popup_form_fields( $form_type = '', $list_fields = [] ) {
    ?>
        <form method="post" id="ova_popup_field_form" action="">
            <input type="hidden" name="ova_action" value="<?php echo $form_type; ?>" />
            <input type="hidden" name="ova_old_name" value="" />
            <table width="100%">
                <tr class="ova-row-type">
                    <td class="label"><?php esc_html_e( 'Type', 'ova-brw' ) ?></td>
                    <td>
                        <select name="type" id="ova_type">
                            <option value="text"><?php esc_html_e('Text', 'ova-brw'); ?></option>
                            <option value="password"><?php esc_html_e('Password', 'ova-brw'); ?></option>
                            <option value="email"><?php esc_html_e('Email', 'ova-brw'); ?></option>
                            <option value="tel"><?php esc_html_e('Phone', 'ova-brw'); ?></option>
                            <option value="textarea"><?php esc_html_e('Textarea', 'ova-brw'); ?></option>
                            <option value="radio"><?php esc_html_e('Radio', 'ova-brw'); ?></option>
                            <option value="checkbox"><?php esc_html_e('Checkbox', 'ova-brw'); ?></option>
                            <option value="file"><?php esc_html_e('File', 'ova-brw'); ?></option>
                            <option value="select"><?php esc_html_e('Select', 'ova-brw'); ?></option>
                        </select>
                        <span class="formats-file-size">
                            <em>
                                <?php esc_html_e( 'Formats: .jpg, .jpeg, .png, .pdf, .doc', 'ova-brw' ); ?>
                            </em>
                        </span>
                    </td>
                </tr>
                <tr class="row-options">
                    <td width="30%" class="label" valign="top"><?php esc_html_e('Options', 'ova-brw'); ?></td>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ova-sub-table">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e( 'Value(unique)', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Text', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Price', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Quantity', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Actions', 'ova-brw' ); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ovabrw-sortable">
                                <tr>
                                    <td><input type="text" name="ova_options_key[]" placeholder="text" /></td>
                                    <td><input type="text" name="ova_options_text[]" placeholder="text" /></td>
                                    <td><input type="text" name="ova_options_price[]" placeholder="number" /></td>
                                    <td><input type="number" name="ova_options_qty[]" placeholder="number" /></td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_addfield btn btn-blue" title="Add new option">+</a>
                                    </td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_remove_row btn btn-red" title="Remove option">x</a>
                                    </td>
                                    <td class="ova-box sort">
                                        <span class="dashicons dashicons-menu" title="Drag & Drop"></span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <span>
                                            <em><?php esc_html_e( 'Quantity: maximum per booking', 'ova-brw' ) ?></em>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>                
                    </td>
                </tr>
                <tr class="row-values">
                    <td width="30%" class="label" valign="top"><?php esc_html_e('Values', 'ova-brw'); ?></td>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ova-sub-table">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e( 'Value(unique)', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Price', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Quantity', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Actions', 'ova-brw' ); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ovabrw-sortable">
                                <tr>
                                    <td><input type="text" name="ova_values[]" placeholder="text"></td>
                                    <td><input type="text" name="ova_prices[]" placeholder="number"></td>
                                    <td><input type="number" name="ova_qtys[]" placeholder="number"></td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_add_value btn btn-blue" title="Add">+</a>
                                    </td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_remove_value btn btn-red" title="Remove">x</a>
                                    </td>
                                    <td class="ova-box sort">
                                        <span class="dashicons dashicons-menu" title="Drag & Drop"></span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <span>
                                            <em><?php esc_html_e( 'Quantity: maximum per booking', 'ova-brw' ) ?></em>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>                
                    </td>
                </tr>
                <tr class="row-checkbox-options">
                    <td width="30%" class="label" valign="top"><?php esc_html_e('Options', 'ova-brw'); ?></td>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ova-sub-table">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e( 'Value(unique)', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Text', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Price', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Quantity', 'ova-brw' ); ?></th>
                                    <th><?php esc_html_e( 'Actions', 'ova-brw' ); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ovabrw-sortable">
                                <tr>
                                    <td>
                                        <input type="text" name="ova_checkbox_key[]" placeholder="text">
                                    </td>
                                    <td>
                                        <input type="text" name="ova_checkbox_text[]" placeholder="text">
                                    </td>
                                    <td>
                                        <input type="text" name="ova_checkbox_price[]" placeholder="number">
                                    </td>
                                    <td>
                                        <input type="number" name="ova_checkbox_qty[]" placeholder="number">
                                    </td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_add_checkbox_option btn btn-blue" title="Add new option">+</a>
                                    </td>
                                    <td class="ova-box">
                                        <a href="javascript:void(0)" class="ovabrw_remove_checkbox_option btn btn-red" title="Remove option">x</a>
                                    </td>
                                    <td class="ova-box sort">
                                        <span class="dashicons dashicons-menu" title="Drag & Drop"></span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <span>
                                            <em><?php esc_html_e( 'Quantity: maximum per booking', 'ova-brw' ) ?></em>
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>                
                    </td>
                </tr>
                <tr class="ova-row-file-size">
                    <td class="label"><?php esc_html_e( 'Max Size', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="max_file_size" value="20" />
                        <span><?php esc_html_e( 'Default: 20MB', 'ova-brw' ); ?></span>
                    </td>
                </tr>
                <tr class="ova-row-name">
                    <td class="label"><?php esc_html_e( 'Name', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="name" value="" />
                        <span>
                            <em>
                                <?php esc_html_e( 'Unique, only lowercase, not space', 'ova-brw' ); ?>
                            </em>
                        </span>
                    </td>
                </tr>
                <tr class="ova-row-label">
                    <td class="label"><?php esc_html_e( 'Label', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="label" value="" />
                    </td>
                </tr>
                <tr class="ova-row-description">
                    <td class="label"><?php esc_html_e( 'Description', 'ova-brw' ); ?></td>
                    <td>
                        <textarea name="description" value=""></textarea>
                    </td>
                </tr>
                <tr class="ova-row-placeholder">
                    <td class="label"><?php esc_html_e( 'Placeholder', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="placeholder" value="" />
                    </td>
                </tr>
                <tr class="ova-row-default">
                    <td class="label"><?php esc_html_e( 'Default value', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="default" value="" />
                    </td>
                </tr>
                <tr class="ova-row-class">
                    <td class="label"><?php esc_html_e( 'Class', 'ova-brw' ); ?></td>
                    <td>
                        <input type="text" name="class" value="" />
                    </td>
                </tr>
                <tr class="row-required">
                    <td>&nbsp;</td>
                    <td class="check-box">
                        <input id="ova_required" type="checkbox" name="required" checked="on" />
                        <label for="ova_required"><?php esc_html_e( 'Required', 'ova-brw' ); ?></label>
                        <br/>
                        <input id="ova_enable" type="checkbox" name="enabled" checked="on" />
                        <label for="ova_enable"><?php esc_html_e( 'Enable', 'ova-brw' ); ?></label>
                        <br/>
                    </td>                     
                    <td class="label"></td>
                </tr>
            </table>
            <button type='submit' class="button button-primary"><?php esc_html_e( 'save', 'ova-brw' ); ?></button>
        </form>
        <?php
    }
}

if ( ! function_exists( 'ovabrw_sanitize_keys' ) ) {
    function ovabrw_sanitize_keys( $args = [], $default = [] ) {
        if ( empty( $args ) || ! is_array( $args ) ) return $args;

        foreach ( $args as $k => $v ) {
            if ( ! $v && isset( $default[$k] ) && $default[$k] ) {
                $v = $default[$k];
            }

            $args[$k] = sanitize_text_field( sanitize_title( $v ) );
        }

        return $args;
    }
}