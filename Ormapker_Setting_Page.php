<?php

class Ormapker_Settings_Page {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
    }

    public function wph_create_settings() {
        $page_title = 'Ormapker settings';
        $menu_title = 'Ormapker';
        $capability = 'manage_options';
        $slug = 'Ormapker';
        $callback = array($this, 'wph_settings_content');
        $icon = 'dashicons-location';
        // $position = 7;
        add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon);  
    }

    public function wph_settings_content() { ?>
        <div class="wrap">
            <h1>Ormapker</h1>
            <?php settings_errors(); ?>
            <form method="POST" action="options.php">
                <?php
                    settings_fields( 'Ormapker' );
                    do_settings_sections( 'Ormapker' );
                    submit_button();
                ?>
            </form>
        </div> <?php
    }

    public function wph_setup_sections() {
        add_settings_section( 'Ormapker_section', 'Manage Ormapker settings', array(), 'Ormapker' );
    }

    public function wph_setup_fields() {
        $fields = array(

                    array(
                        'section' => 'Ormapker_section',
                        'label' => 'Google Maps API key',
                        'id' => 'ormapker_google_maps_api',
                        'desc' => 'Put your google maps API key',
                        'type' => 'text',
                    ),

                    // array(
                    //     'section' => 'Ormapker_section',
                    //     'label' => 'Active',
                    //     'id' => 'ormapker_active',
                    //     'desc' => 'Activate / deactivate Ormapker',
                    //     'type' => 'checkbox',
                    // ),
        
                    array(
                        'section' => 'Ormapker_section',
                        'label' => 'Centre latitude',
                        'id' => 'ormapker_centre_latitude',
                        'desc' => 'Latitude of the central point of the map',
                        'type' => 'number',
                    ),
        
                    array(
                        'section' => 'Ormapker_section',
                        'label' => 'Centre longitude',
                        'id' => 'ormapker_centre_longitude',
                        'desc' => 'Longitude of the central point of the map',
                        'type' => 'text',
                    ),
        
                    array(
                        'section' => 'Ormapker_section',
                        'label' => 'Zoom level',
                        'id' => 'ormapker_zoom',
                        'desc' => 'Zoom of the map',
                        'type' => 'number',
                    )
        );
        foreach( $fields as $field ){
            add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'Ormapker', $field['section'], $field );
            register_setting( 'Ormapker', $field['id'] );
        }
    }

    public function wph_field_callback( $field ) {
        $value = get_option( $field['id'] );
        $placeholder = '';
        if ( isset($field['placeholder']) ) {
            $placeholder = $field['placeholder'];
        }
        switch ($field['type']) {
            case 'checkbox':
                printf('<input %s id="%s" name="%s" type="checkbox" value="1">',
                    $value === '1' ? 'checked' : '',
                    $field['id'],
                    $field['id']
                );
                break;
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" step="any" />',
                    $field['id'],
                    $field['type'],
                    $placeholder,
                    $value
                );
                break;
            default:
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
                    $field['id'],
                    $field['type'],
                    $placeholder,
                    $value
                );
        }
        if( isset($field['desc']) ) {
            if( $desc = $field['desc'] ) {
                printf( '<p class="description">%s </p>', $desc );
            }
        }
    }
}