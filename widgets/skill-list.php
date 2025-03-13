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
class Harry_Skill_List extends Widget_Base
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
		return 'harry-skill-list';
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
		return __('Harry Skill', 'harry-core');
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
		$repeater = new \Elementor\Repeater();
		// Progress section
		$this->start_controls_section(
			'harry_skill_section',
			[
				'label' => esc_html__('Skill Section', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$repeater->add_control(
			'harry_number',
			[
				'label' => esc_html__('Number', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('90', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$repeater->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Skill Name', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Figma', 'harry_core'),
				'label_block' => true,

			]
		);

		//  image
		$repeater->add_control(
			'harry_skill_image',
			[
				'label' => esc_html__('Choose Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'harry_skill_repeater_list',
			[
				'label'  => esc_html__('Skill List', 'harry_core'),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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

?>



		<div class="skill__item-wrapper-9">
			<div class="row">
				<?php foreach ($settings['harry_skill_repeater_list'] as $single_skill_item) :
				?>
					<div class="col-xxl-6 col-md-6 col-sm-6 col-6">
						<div class="skill__item-9">
							<div class="skill__icon-9">
								<span>
									<img src="<?php echo esc_url($single_skill_item['harry_skill_image']['url']) ?>" alt="">
								</span>
							</div>
							<div class="skill__content-9">
								<h4><?php echo esc_html($single_skill_item['harry_main_title']) ?> <span>(<span data-purecounter-duration="1" data-purecounter-end="90" class="purecounter"><?php echo esc_html($single_skill_item['harry_number']) ?></span>%)</span></h4>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>

<?php
	}
}
