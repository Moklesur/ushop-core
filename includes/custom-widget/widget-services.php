<?php
/**
 * Displays Services
 *
 */

class uShop_Widget_Services extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-services',
            'description' => __( 'Displays Services', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-services', __( 'uShop : Services', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_services';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        for ( $i=1; $i < 4; $i++ ) {
            ${'title' . $i} 	= isset( $instance['title' . $i] ) ? wp_kses_post( $instance['title' . $i] ) : '';
            ${'content' . $i} 	= isset( $instance['content' . $i] ) ? wp_kses_post( $instance['content' . $i] ) : '';
            ${'icon' . $i} 		= isset( $instance['icon' . $i] ) ? esc_html( $instance['icon' . $i] ) : '';
        }

        echo $args['before_widget']; ?>
        <div class="widget-services text-center row">
            <?php for ( $i=1; $i < 4; $i++ ) { ?>
                <div class="col-lg-4 col-md-4 col-12 mt-30 position-relative">
                    <div class="mb-3">
                        <i class="<?php echo ${'icon' . $i}; ?> f-2x"></i>
                    </div>
                    <div class="services-contents">
                        <div class="widgets-heading">
                            <h5><?php echo  ${'title' . $i}; ?></h5>
                        </div>
                        <p class="services-text mb-0"><?php echo ${'content' . $i}; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        for ( $i=1; $i < 4; $i++ ) {
            $instance['title' . $i] 	= wp_kses_post( $new_instance['title' . $i] );
            $instance['content' . $i] 	= wp_kses_post( $new_instance['content' . $i] );
            $instance['icon' . $i] 		= sanitize_text_field( $new_instance['icon' . $i] );
        }
        return $instance;
    }
    public function form( $instance ) { ?>
        <div class="ushop-wrap">
            <div class="full-width">
                <?php
                for ( $i=1; $i < 4; $i++ ) {
                    ${'title' . $i} = isset($instance['title' . $i]) ? wp_kses_post($instance['title' . $i]) : '';
                    ${'content' . $i} = isset($instance['content' . $i]) ? wp_kses_post($instance['content' . $i]) : '';
                    ${'icon' . $i} = isset($instance['icon' . $i]) ? esc_html($instance['icon' . $i]) : '';
                    ?>
                    <div class="col-12">
                        <h3 class="heading-services"><?php echo sprintf( __('items %s', 'ushop'), $i ); ?></h3>
                    </div>
                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Title', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' . $i ); ?>" name="<?php echo $this->get_field_name( 'title' . $i ); ?>" type="text" value="<?php echo ${'title' . $i}; ?>" />
                    </div>
                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'content' . $i ); ?>"><?php _e( 'Content', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'content' . $i ); ?>" name="<?php echo $this->get_field_name( 'content' . $i ); ?>" type="text" value="<?php echo ${'content' . $i}; ?>" />
                    </div>
                    <div class="col-3">
                        <label for="<?php echo $this->get_field_id( 'icon' . $i ); ?>"><?php _e( 'icon', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'icon' . $i ); ?>" name="<?php echo $this->get_field_name( 'icon' . $i ); ?>" type="text" value="<?php echo ${'icon' . $i}; ?>" />
                        <small>
                            <?php esc_html_e( 'For the icon Please', 'ushop'); ?>
                            <a href="<?php echo esc_url( 'http://ionicons.com/' ); ?>" target="_blank">
                                <?php esc_html_e( ' Click Here', 'ushop' );?>
                            </a>
                        </small>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}