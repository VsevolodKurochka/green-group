<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class PriceTable extends Widget_Base {

    public function get_name() {
        return 'price-table';
    }

    public function get_title() {
        return 'Custom Price Table';
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
                'label' => __( 'Name', 'green-group' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'green-group' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_title', [
                'label' => __( 'Title', 'green-group' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'green-group' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'green-group' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '' , 'green-group' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'list_price', [
                'label' => __( 'Price', 'green-group' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '' , 'green-group' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_show',
            [
                'label' => __( 'Show or hide?', 'green-group' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'show' => __( 'Show', 'green-group' ),
                    'hide' => __( 'Hide', 'green-group' )
                ],
                'default' => 'show',
            ]
        );

        $repeater->add_control(
            'list_main',
            [
                'label' => __( 'Is main?', 'green-group' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'main' => __( 'Main', 'green-group' ),
                    'secondary' => __( 'Secondary', 'green-group' )
                ],
                'default' => 'secondary',
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => __( 'Price Table', 'green-group' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['list'] ) {
            ?>
            <div class="price-table">
                <?php foreach (  $settings['list'] as $item ) { ?>
                    <?php if ($item['list_show'] !== 'hide') { ?>
                        <div class="price-table__item
                            price-table__item--<?php echo $item['list_show']; ?>
                            price-table__item--<?php echo $item['list_main']; ?>">
                            <div class="price-table__item-name">
                                <?php echo $item['list_name']; ?>
                            </div>
                            <div class="price-table__item-title">
                                <?php echo $item['list_title']; ?>
                            </div>
                            <div class="price-table__item-content">
                                <?php echo $item['list_content']; ?>
                            </div>
                            <div class="price-table__item-price">
                                <sup>$</sup><?php echo $item['list_price']; ?>
                            </div>
                        </div>
                    <?php } ?>
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
            <dt>{{{ item.list_name }}}</dt>
            <dt>{{{ item.list_title }}}</dt>
            <dd>{{{ item.list_content }}}</dd>
            <dd>{{{ item.list_price }}}</dd>
            <# }); #>
        </dl>
        <# } #>
        <?php
    }
}