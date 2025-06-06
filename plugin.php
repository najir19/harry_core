<?php

namespace HarryCore;

use HarryCore\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Harry_Core_Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('harry-core', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}


	// widget category create
	public function harry_add_widget_categories($harry_add_cat_manager)
	{
		$harry_add_cat_manager->add_category(
			'harry-category',
			[
				'title' => esc_html__('Harry Core', 'harry-core'),
				'icon' => 'fa fa-plug',
			]
		);
	}



	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'harry-core-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('harry-core-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		// Its is now safe to include Widgets files
		require_once(__DIR__ . '/widgets/hello-world.php');
		require_once(__DIR__ . '/widgets/inline-editing.php');
		require_once(__DIR__ . '/widgets/hero.php');
		require_once(__DIR__ . '/widgets/about-me.php');
		require_once(__DIR__ . '/widgets/progress.php');
		require_once(__DIR__ . '/widgets/service-box.php');
		require_once(__DIR__ . '/widgets/harry-heading.php');
		require_once(__DIR__ . '/widgets/harry-button.php');
		require_once(__DIR__ . '/widgets/portfoilo-list.php');
		require_once(__DIR__ . '/widgets/skill-list.php');
		require_once(__DIR__ . '/widgets/experience.php');
		require_once(__DIR__ . '/widgets/award.php');
		require_once(__DIR__ . '/widgets/testimonial.php');

		// Register Widgets
		$widgets_manager->register(new Widgets\Hello_World());
		$widgets_manager->register(new Widgets\Inline_Editing());
		$widgets_manager->register(new Widgets\Harry_Hero_Section());
		$widgets_manager->register(new Widgets\Harry_about_me_Section());
		$widgets_manager->register(new Widgets\Harry_Progress_Section());
		$widgets_manager->register(new Widgets\Harry_Service_Section());
		$widgets_manager->register(new Widgets\Harry_Heading());
		$widgets_manager->register(new Widgets\Harry_Button());
		$widgets_manager->register(new Widgets\Harry_Portfolio_List());
		$widgets_manager->register(new Widgets\Harry_Skill_List());
		$widgets_manager->register(new Widgets\Harry_Experience());
		$widgets_manager->register(new Widgets\Harry_Award());
		$widgets_manager->register(new Widgets\Harry_Testimonial());
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls()
	{
		require_once(__DIR__ . '/page-settings/manager.php');
		new Page_Settings();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register Categories
		add_action('elementor/elements/categories_registered', [$this, 'harry_add_widget_categories']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Harry_Core_Plugin::instance();
