<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class ImageSlider extends Widget_Base {

    public function get_name() {
        return 'image-slider';
    }

    public function get_title() {
        return __( 'Image Slider', 'elementor' );
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
            'image',
            [
                'label' => 'Image Heading',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Images', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => 'Slider item',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['list'] ) {
            ?>
            <div class="image-slider js-image-slider">
                <?php foreach (  $settings['list'] as $item ) { ?>
                    <div class="image-slider__item">
                        <img
                            src="<?php echo $item['image']['url'] ?>"
                            alt="image slider"
                            class="image-slider__image">
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
            <img src="{{{ item.image.url }}}" /
            <# }); #>
        </dl>
        <# } #>
        <?php
    }
}