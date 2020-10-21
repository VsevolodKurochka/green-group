<?php
namespace WPC;

// use Elementor\Plugin; ?????
class Widget_Loader{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    private function include_widgets_files(){
        require_once(__DIR__ . '/widgets/description-item-widget.php');
        require_once(__DIR__ . '/widgets/testimonial-slider.php');
        require_once(__DIR__ . '/widgets/image-slider.php');
        require_once(__DIR__ . '/widgets/price-table.php');
    }

    public function register_widgets(){

        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\DescriptionItemWidget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TestimonialSlider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ImageSlider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PriceTable());
    }

    public function __construct(){
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }
}

// Instantiate Plugin Class
Widget_Loader::instance();