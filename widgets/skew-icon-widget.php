<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class SkewIconWidget extends Widget_Base{

    public function get_name(){
        return 'skew-icon-widget';
    }

    public function get_title(){
        return 'Skew icon widget';
    }

    public function get_icon(){
        return 'fa fa-camera';
    }

    public function get_categories(){
        return ['basic'];
    }

    protected function _register_controls(){

        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Settings',
            ]
        );

        $this->add_control(
            'border_style',
            [
                'label' => __( 'Background type', 'greengroup' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'border'  => __( 'Border', 'plugin-domain' ),
                    'default' => __( 'Color fluid', 'plugin-domain' ),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => 'Icon Heading',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'label_heading',
            [
                'label' => 'Label Heading',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => 'Content',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => ''
            ]
        );

        $this->end_controls_section();
    }


    protected function render(){
        $settings = $this->get_settings_for_display();
        ?>
        <div class="skew-icon-widget skew-icon-widget--<?php echo $settings['border_style']?>">
            <div class="skew-icon-widget__inner">
                <div class="skew-icon-widget__header">
                    <img
                        src="<?php echo $settings['image']['url'] ?>"
                        alt="<?php echo $settings['label_heading']?>"
                        class="skew-icon-widget__image">
                </div>
                <p class="skew-icon-widget__title"><?php echo $settings['label_heading']?></p>
                <div class="skew-icon-widget__content">
                    <?php echo $settings['content'] ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template(){
        ?>
        <div class="skew-icon-widget skew-icon-widget--{{{ settings.border_style }}}">
            <div class="skew-icon-widget__inner">
                <div class="skew-icon-widget__header">
                    <img src="{{{ settings.image.url }}}" class="skew-icon-widget__image">
                </div>
                <p class="skew-icon-widget__title">{{{ settings.label_heading }}}</p>
                <div class="skew-icon-widget__content">
                    {{{ settings.content }}}
                </div>
            </div>
        </div>
        <?php
    }
}