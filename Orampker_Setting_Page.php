<?php

class Orampker_Settings_Page {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
    }

    public function wph_create_settings() {
        $page_title = 'Orampker settings';
        $menu_title = 'Orampker';
        $capability = 'manage_options';
        $slug = 'Orampker';
        $callback = array($this, 'wph_settings_content');
                add_options_page($page_title, $menu_title, $capability, $slug, $callback);
        
    }

    public function wph_settings_content() { ?>
        <div class="wrap">
            <h1>Orampker</h1>
            <?php settings_errors(); ?>
            <form method="POST" action="options.php">
                <?php
                    settings_fields( 'Orampker' );
                    do_settings_sections( 'Orampker' );
                    submit_button();
                ?>
            </form>
        </div> <?php
    }

    public function wph_setup_sections() {
        add_settings_section( 'Orampker_section', 'Manage Orampker settings', array(), 'Orampker' );
    }

    public function wph_setup_fields() {
        $fields = array(
                    array(
                        'section' => 'Orampker_section',
                        'label' => 'Active',
                        'id' => 'orampker_active',
                        'desc' => 'Activate / deactivate Orampker',
                        'type' => 'checkbox',
                    ),
        
                    array(
                        'section' => 'Orampker_section',
                        'label' => 'Centre latitude',
                        'id' => 'orampker_centre_latitude',
                        'desc' => 'Latitude of the central point of the map',
                        'type' => 'number',
                    ),
        
                    array(
                        'section' => 'Orampker_section',
                        'label' => 'Centre longitude',
                        'id' => 'orampker_centre_longitude',
                        'desc' => 'Longitude of the central point of the map',
                        'type' => 'text',
                    ),
        
                    array(
                        'section' => 'Orampker_section',
                        'label' => 'Zoom level',
                        'id' => 'orampker_zoom',
                        'desc' => 'Zoom of the map',
                        'type' => 'number',
                    )
        );
        foreach( $fields as $field ){
            add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'Orampker', $field['section'], $field );
            register_setting( 'Orampker', $field['id'] );
        }
    }
    public function wph_field_callback( $field ) {
        $value = get_option( $field['id'] );
        $placeholder = '';
        if ( isset($field['placeholder']) ) {
            $placeholder = $field['placeholder'];
        }
        switch ( $field['type'] ) {
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