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
class Harry_Progress_Section extends Widget_Base
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
		return 'progress';
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
		return __('Progress', 'harry-core');
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
			'harry_progress_section',
			[
				'label' => esc_html__('Progress', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$repeater->add_control(
			'harry_sub_title',
			[
				'label' => esc_html__('Sub Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Strategy', 'harry_core'),
				'placeholder' => esc_html__('Strategy', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$repeater->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Main Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Concept', 'harry_core'),
				'placeholder' => esc_html__('Concept', 'harry_core'),
				'label_block' => true,

			]
		);
		//  description of testimonial
		$repeater->add_control(
			'harry_testimonial_description',
			[
				'label' => esc_html__('Testimonial Description', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('I design beautifully simple things,and i love what i do.', 'harry_core'),
				'placeholder' => esc_html__('I design beautifully simple things,and i love what i do.', 'harry_core'),
				'label_block' => true,

			]
		);
		//  image
		$repeater->add_control(
			'harry_progress_main_image',
			[
				'label' => esc_html__('Choose Main Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		//  image for testimonial
		$repeater->add_control(
			'harry_progress_testimonial_image',
			[
				'label' => esc_html__('Choose Testimonial Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		// switch for active item 
		$repeater->add_control(
			'active_switch',
			[
				'label' => esc_html__('Active Item', 'harry-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'harry-core'),
				'label_off' => esc_html__('Hide', 'harry-core'),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'harry_progress_repeater_list',
			[
				'label'  => esc_html__('Progress List', 'harry_core'),
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


		<!-- features area start -->
		<section class="features__area pt-140 pb-140">
			<div class="container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="features__wrapper-9 mr-30">
							<?php foreach ($settings['harry_progress_repeater_list'] as $key => $single_progress_item) :
								// $active = ($key == 1) ? 'active' : '';
								$active = $single_progress_item['active_switch'] ? 'active' : '';
								$index = $key + 1;
							?>
								<div class="features__content-9 features-item-content <?php echo esc_attr($active); ?>" rel="features-img-<?php echo esc_attr($index); ?>">
									<?php if (!empty($single_progress_item['harry_sub_title'])): ?>
										<span><?php echo esc_html($single_progress_item['harry_sub_title']); ?></span>
									<?php endif ?>
									<?php if (!empty($single_progress_item['harry_main_title'])): ?>
										<h3 class="features__title-9"><?php echo esc_html($single_progress_item['harry_main_title']); ?></h3>
									<?php endif ?>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-6 d-none d-md-block">
						<div class="features__thumb-wrapper-9 pl-20">
							<div id="features-item-thumb" class="features-img-2">
								<?php foreach ($settings['harry_progress_repeater_list'] as $key => $single_progress_item) :
									// $active = ($key == 1) ? 'active' : '';
									$active = $single_progress_item['active_switch'] ? 'active' : '';
									$index = $key + 1;
								?>
									<div class="features__thumb-9 transition-3 features-img-<?php echo esc_attr($index); ?> <?php echo esc_attr($active); ?>">
										<img src="<?php echo esc_url($single_progress_item['harry_progress_main_image']['url']) ?>" alt="">
										<div class="features__thumb-9-content">
											<p><?php echo esc_html($single_progress_item['harry_testimonial_description']) ?></p>
											<div class="features-users">
												<img src="<?php echo esc_url($single_progress_item['harry_progress_testimonial_image']['url']) ?>" alt="">
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- features area end -->
<?php
	}
}
