<?php
/**
 * Version 0.0.2
 */

require dirname( __FILE__ ) .'/importer/nrgblog-importer.php'; //load admin theme data importer

class MI_Theme_Demo_Data_Importer extends MI_Theme_Importer {

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 0.0.1
     *
     * @var object
     */
    private static $instance;

    /**
     * Set the key to be used to store theme options
     *
     * @since 0.0.2
     *
     * @var object
     */

    // Style 1
    public $theme_option_name1      = 'cs-framework-style-1.txt';
    public $theme_widgets1          = 'widgets-style-1.wie';
    public $content_demo_file_data1 = 'sample-data-style-1.xml';

    // Style 2
    public $theme_option_name2      = 'cs-framework-style-2.txt';
    public $theme_widgets2          = 'widgets-style-2.wie';
    public $content_demo_file_data2 = 'sample-data-style-2.xml';
    
    // Style 3
    public $theme_option_name3      = 'cs-framework-style-3.txt';
    public $theme_widgets3          = 'widgets-style-3.wie';
    public $content_demo_file_data3 = 'sample-data-style-3.xml';

    // Style 4
    public $theme_option_name4      = 'cs-framework-style-4.txt';
    public $theme_widgets4          = 'widgets-style-4.wie';
    public $content_demo_file_data4 = 'sample-data-style-4.xml';


	/**
	 * Holds a copy of the widget settings
	 *
	 * @since 0.0.2
	 *
	 * @var object
	 */
	public $widget_import_results;

    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 0.0.1
     */
    public function __construct() {

		$this->demo_files_path = dirname(__FILE__) . '/demo-files/';

        self::$instance = $this;
		parent::__construct();

    }

}

new MI_Theme_Demo_Data_Importer;
