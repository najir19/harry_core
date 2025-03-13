<?php

namespace HarryCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Harry Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Harry_Button extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'harry-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Harry Button', 'harry-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['harry-category'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['harry-core'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		// Title and content section
		$this->start_controls_section(
			'harry_button_section',
			[
				'label' => esc_html__('Button text and url', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  button 
		$this->add_control(
			'harry_button',
			[
				'label' => esc_html__('Button Text', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('All Projects', 'harry_core'),
				'placeholder' => esc_html__('All Projects', 'harry_core'),
				'label_block' => true,

			]
		);
		//  button url 
		$this->add_control(
			'harry_button_url',
			[
				'label' => esc_html__('Button URL', 'harry_core'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (! empty($settings['harry_button_url']['url'])) {
			$this->add_link_attributes('harry_button_url', $settings['harry_button_url']);
		}

?>

		<?php if (!empty($settings['harry_button'])): ?>
			<div class="portfolio__more-9 mb-85 text-md-end">
				<a <?php $this->print_render_attribute_string('harry_button_url'); ?> class="tp-btn-5 "><?php echo esc_html($settings['harry_button']); ?></a>
			</div>
		<?php endif ?>

<?php
	}
}
