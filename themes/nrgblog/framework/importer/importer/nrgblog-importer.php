<?php

/**
 *
 * This class provides the capability to import demo content as well as import widgets and WordPress menus
 *
 * @since 2.2.0
 *
 * @category MIPORTFOLIO Framework
 * @package  new
 * @author   relstudiosnx
 * @link     http://relstudiosnx.com/
 *
 */
class MI_Theme_Importer {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
    public $content_demo_file1;
    public $content_demo_file2;
    public $content_demo_file3;
    public $content_demo_file4;

    public $theme_option1;
    public $theme_option2;
    public $theme_option3;
    public $theme_option4;

    public $widget_option1;
    public $widget_option2;
    public $widget_option3;
	public $widget_option4;


	/**
	 * Flag imported to prevent duplicates
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $flag_as_imported = array();

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 2.2.0
     *
     * @var object
     */
    private static $instance;

    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 2.2.0
     */
    public function __construct() {

        self::$instance = $this;

        // Style 1
        $this->content_demo_file1 = $this->demo_files_path . $this->content_demo_file_data1;
        $this->theme_option1 = $this->demo_files_path . $this->theme_option_name1;
        $this->widget_option1 = $this->demo_files_path . $this->theme_widgets1;

        // Style 2
        $this->content_demo_file2 = $this->demo_files_path . $this->content_demo_file_data2;
        $this->theme_option2 = $this->demo_files_path . $this->theme_option_name2;
        $this->widget_option2 = $this->demo_files_path . $this->theme_widgets2;

        // Style 3
        $this->content_demo_file3 = $this->demo_files_path . $this->content_demo_file_data3;
        $this->theme_option3 = $this->demo_files_path . $this->theme_option_name3;
        $this->widget_option3 = $this->demo_files_path . $this->theme_widgets3;

        // Style 4
        $this->content_demo_file4 = $this->demo_files_path . $this->content_demo_file_data4;
        $this->theme_option4 = $this->demo_files_path . $this->theme_option_name4;
        $this->widget_option4 = $this->demo_files_path . $this->theme_widgets4;

        add_action( 'admin_menu', array($this, 'add_admin') );

    }

	/**
	 * Add Panel Page
	 *
	 * @since 2.2.0
	 */
    public function add_admin() {
        
        add_theme_page("Import Demo Data", "Import Demo Data", 'switch_themes', 'mi_demo_installer', array($this, 'demo_installer') );

    }

    /**
     * [demo_installer description]
     *
     * @since 2.2.0
     *
     * @return [type] [description]
     */
    public function demo_installer() {

        ?>
        <div id="icon-tools" class="icon32"><br></div>
        <h2>Import Demo Data</h2>
        <div style="background-color: #F5FAFD; margin:10px 0;padding: 10px;color: #0C518F;border: 3px solid #CAE0F3; claer:both; width:90%; line-height:18px;">
            <p class="tie_message_hint">Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will
            allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:</p>

              <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
                  <li>No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified .</li>
                  <li>No WordPress settings will be modified .</li>
                  <li>Posts, pages, some images, some widgets and menus will get imported .</li>
                  <li>Images will be downloaded from our server, these images are copyrighted and are for demo use only .</li>
                  <li>Please click import only once and wait, it can take a couple of minutes.</li>
              </ul>
         </div>

        <div style="background-color: #F5FAFD; margin:10px 0;padding: 10px;color: #0C518F;border: 3px solid #CAE0F3; claer:both; width:90%; line-height:18px;">
            <div style="padding: 2em 0;">
                <form method="post" style="display: inline-block; margin-left: 2em;">
                    <input type="hidden" name="demononce-1" value="<?php print wp_create_nonce('mi-demo-code-1'); ?>" />
                    <input name="reset" class="panel-save button-primary" type="submit" value="Import Style 1" />
                    <input type="hidden" name="action" value="demo-data-1" />
                </form>
                <form method="post" style="display: inline-block; margin-left: 2em;">
                    <input type="hidden" name="demononce-2" value="<?php print wp_create_nonce('mi-demo-code-2'); ?>" />
                    <input name="reset" class="panel-save button-primary" type="submit" value="Import Style 2" />
                    <input type="hidden" name="action" value="demo-data-2" />
                </form>
                <form method="post" style="display: inline-block; margin-left: 2em;">
                    <input type="hidden" name="demononce-3" value="<?php print wp_create_nonce('mi-demo-code-3'); ?>" />
                    <input name="reset" class="panel-save button-primary" type="submit" value="Import Style 3" />
                    <input type="hidden" name="action" value="demo-data-3" />
                </form>
                <form method="post" style="display: inline-block; margin-left: 2em;">
                    <input type="hidden" name="demononce-4" value="<?php print wp_create_nonce('mi-demo-code-4'); ?>" />
                    <input name="reset" class="panel-save button-primary" type="submit" value="Import Style 4" />
                    <input type="hidden" name="action" value="demo-data-4" />
                </form>
            </div>
        </div>
        <br />
        <br />

        <?php

		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

        if( 'demo-data-1' == $action && check_admin_referer( 'mi-demo-code-1' , 'demononce-1' ) ){
            $this->set_demo_data( $this->content_demo_file1, $this->theme_option1, $this->widget_option1 );
        }

        if( 'demo-data-2' == $action && check_admin_referer( 'mi-demo-code-2' , 'demononce-2' ) ){
            $this->set_demo_data( $this->content_demo_file2, $this->theme_option2, $this->widget_option2 );
        }

        if( 'demo-data-3' == $action && check_admin_referer( 'mi-demo-code-3' , 'demononce-3' ) ){
            $this->set_demo_data( $this->content_demo_file3, $this->theme_option3, $this->widget_option3 );
        }

        if( 'demo-data-4' == $action && check_admin_referer( 'mi-demo-code-4' , 'demononce-4' ) ){
            $this->set_demo_data( $this->content_demo_file4, $this->theme_option4, $this->widget_option4 );
        }
    }

    /**
     * import demo data
     *
     * @since 2.2.0
     *
     * @return null
     */
    public function set_demo_data( $file, $option = false, $widgets = false ) {

	    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

        require_once ABSPATH . 'wp-admin/includes/import.php';

        $importer_error = false;

        if ( !class_exists( 'WP_Importer' ) ) {

            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

            if ( file_exists( $class_wp_importer ) ){

                require_once($class_wp_importer);

            } else {

                $importer_error = true;

            }

        }

        if ( ! class_exists( 'WP_Import' ) ) {

            $class_wp_import = F_PATH . '/importer/importer/wordpress-importer.php';

            if ( file_exists( $class_wp_import ) )
                require_once( $class_wp_import );
            else
                $importer_error = true;

        }

        if( $importer_error ) {

            die("Error on import");

        } else {

            if(!is_file( $file )){

                print "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the Wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";

            } else {

                $wp_import = new WP_Import();
                $wp_import->fetch_attachments = true;
                $wp_import->import( $file );

                if( $option ) { //set framework options
                    WP_Filesystem();
                    global $wp_filesystem;
                    $s = cs_decode_string($wp_filesystem->get_contents($option));
                    update_option( '_cs_options', $s );
                }

                if( $widgets ) {
                    $this->import_widgets($widgets);
                }

         	}

    	}

    }

        public function import_widgets($file){
        global $wp_registered_sidebars, $wp_registered_widget_controls;
        $widget_controls = $wp_registered_widget_controls;
    
        $available_widgets = array();
    
        foreach ( $widget_controls as $widget ) {
    
            if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { 
    
                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];
    
            }
    
        }

        WP_Filesystem();
        global $wp_filesystem;
        $data = $wp_filesystem->get_contents( $file );

        $data = json_decode( $data );
        // Get all existing widget instances
        $widget_instances = array();
        foreach ( $available_widgets as $widget_data ) {
            $widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
        }
        // Begin results
        $results = array();

        // Loop import data's sidebars
        foreach ( $data as $sidebar_id => $widgets ) {

            // Skip inactive widgets
            // (should not be in export file)
            if ( 'wp_inactive_widgets' == $sidebar_id ) {
                continue;
            }

            // Check if sidebar is available on this site
            // Otherwise add widgets to inactive, and say so
            if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = esc_html__( 'Sidebar does not exist in theme (using Inactive)', 'widget-importer-exporter' );
            }

            // Result for sidebar
            $results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();

            // Loop widgets
            foreach ( $widgets as $widget_instance_id => $widget ) {

                $fail = false;

                // Get id_base (remove -# from end) and instance ID number
                $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

                // Does site support this widget?
                if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = esc_html__( 'Site does not support widget', 'widget-importer-exporter' ); // explain why widget not imported
                }

                // Filter to modify settings before import
                // Do before identical check because changes may make it identical to end result (such as URL replacements)
                $widget = apply_filters( 'wie_widget_settings', $widget );

                // Does widget with identical settings already exist in same sidebar?
                if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

                    // Get existing widgets in this sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' );
                    $sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                    // Loop widgets with ID base
                    $single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
                    foreach ( $single_widget_instances as $check_id => $check_widget ) {

                        // Is widget in same sidebar and has identical settings?
                        if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

                            $fail = true;
                            $widget_message_type = 'warning';
                            $widget_message = esc_html__( 'Widget already exists', 'widget-importer-exporter' ); // explain why widget not imported

                            break;

                        }

                    }

                }

                // No failure
                if ( ! $fail ) {

                    // Add widget instance
                    $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                    $single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                    $single_widget_instances[] = (array) $widget; // add it

                        // Get the key it was given
                        end( $single_widget_instances );
                        $new_instance_id_number = key( $single_widget_instances );

                        // If key is 0, make it 1
                        // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                        if ( '0' === strval( $new_instance_id_number ) ) {
                            $new_instance_id_number = 1;
                            $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                            unset( $single_widget_instances[0] );
                        }

                        // Move _multiwidget to end of array for uniformity
                        if ( isset( $single_widget_instances['_multiwidget'] ) ) {
                            $multiwidget = $single_widget_instances['_multiwidget'];
                            unset( $single_widget_instances['_multiwidget'] );
                            $single_widget_instances['_multiwidget'] = $multiwidget;
                        }

                        // Update option with new widget
                        update_option( 'widget_' . $id_base, $single_widget_instances );

                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                    update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

                    // Success message
                    if ( $sidebar_available ) {
                        $widget_message_type = 'success';
                        $widget_message = esc_html__( 'Imported', 'widget-importer-exporter' );
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = esc_html__( 'Imported to Inactive', 'widget-importer-exporter' );
                    }

                }

                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : esc_html__( 'No Title', 'widget-importer-exporter' ); // show "No Title" if widget instance is untitled
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

            }

        }

    }

}
?>
