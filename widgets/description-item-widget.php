<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class DescriptionItemWidget extends Widget_Base{

    public function get_name(){
        return 'description-item-widget';
    }

    public function get_title(){
        return 'Description item widget';
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
            'icon',
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
        <div class="description-item">
            <div class="description-item__header">
                <img
                    src="<?php echo $settings['image']['url'] ?>"
                    alt="<?php echo $settings['label_heading']?>"
                    class="description-item__image">
            </div>
            <div class="description-item__body">
                <div class="description-item__inner">
                    <img
                        src="<?php echo $settings['icon']['url'] ?>"
                        alt="<?php echo $settings['label_heading']?>"
                        class="description-item__icon">
                    <p class="description-item__title"><?php echo $settings['label_heading']?></p>
                    <div class="description-item__content">
                        <?php echo $settings['content'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template(){
        ?>
        <div class="description-item">
            <div class="description-item__header">
                <img src="{{{ settings.image.url }}}" class="description-item__image">
            </div>
            <div class="description-item__body">
                <div class="description-item__inner">
                    <img src="{{{ settings.icon.url }}}" class="description-item__image">
                    <p class="description-item__title">{{{ settings.label_heading }}}</p>
                    <div class="description-item__content">
                        {{{ settings.content }}}
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}