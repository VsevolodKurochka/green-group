<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TestimonialSlider extends Widget_Base {

    public function get_name() {
        return 'testimonial-slider';
    }

    public function get_title() {
        return __( 'Testimonial Slider', 'elementor' );
    }

    public function get_categories(){
        return ['basic'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Settings',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_name', [
                'label' => __( 'Name', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_location', [
                'label' => __( 'Location', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '' , 'plugin-domain' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Testimonials', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ list_name }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['list'] ) {
            ?>
            <div class="testimonials-slider js-testimonials-slider">
                <?php foreach (  $settings['list'] as $item ) { ?>
                    <div class="testimonials-slider__item">
                        <i aria-hidden="true" class="fas fa-quote-left testimonials-slider__item-quote"></i>
                        <div class="testimonials-slider__item-content">
                            <?php echo $item['list_content']; ?>
                        </div>
                        <div class="testimonials-slider__item-name">
                            <?php echo $item['list_name']; ?>
                        </div>
                        <div class="testimonials-slider__item-location">
                            <?php echo $item['list_location']; ?>
                        </div>
                        <div class="testimonials-slider__item-rating">
                            <i aria-hidden="true" class="fas fa-star"></i>
                            <i aria-hidden="true" class="fas fa-star"></i>
                            <i aria-hidden="true" class="fas fa-star"></i>
                            <i aria-hidden="true" class="fas fa-star"></i>
                            <i aria-hidden="true" class="fas fa-star"></i>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?
        }
    }

    protected function _content_template() {
        ?>
        <# if ( settings.list.length ) { #>
        <dl>
            <# _.each( settings.list, function( item ) { #>
            <dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_name }}}</dt>
            <dd>{{{ item.list_location }}}</dd>
            <dd>{{{ item.list_content }}}</dd>
            <# }); #>
        </dl>
        <# } #>
        <?php
    }
}