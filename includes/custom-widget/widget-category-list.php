<?php
/**
 * Displays Category List
 *
 */

class uShop_Widget_Category_List extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-category-list',
            'description' => __( 'Displays Category List', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-category-list', __( 'uShop : Category List', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_category_list';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( !empty($instance['title']) ) ? $instance['title'] : '';
        $select_category  = isset( $instance['select_category'] ) ? array_map( 'esc_attr', $instance['select_category'] ) : '';


        echo $args['before_widget']; ?>
        <div class="widget-category-list text-center">
            <?php if( $title != '' ) { ?>
                <div class="widgets-heading">
                    <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                </div>
            <?php } ?>
            <div class="category-list-contents">
                <div class="row category-list-wrap">

                <?php
                foreach ( $select_category as $cat_array ) {

                    $cat_name = get_term_by( 'id', $cat_array, 'product_cat' );

                    $thumbnail_id = wp_get_attachment_url( get_term_meta( $cat_name->term_id, 'thumbnail_id', true ) );?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="cat-list-items position-relative">
                            <a href="<?php echo esc_url( get_category_link( $cat_name->term_id ) ); ?>">
                                <img src="<?php echo ( $thumbnail_id != '' ) ? $thumbnail_id : 'http://via.placeholder.com/700x700'; ?>" class="img-fluid d-inline-block" />
                            </a>
                            <div class="cat-list-meta">
                                <div class="cat-meta-count">
                                    <span><?php echo esc_html( $cat_name->count ); ?></span>
                                </div>
                                <h3>
                                    <a href="<?php echo esc_url( get_category_link( $cat_name->term_id ) ); ?>"><?php echo esc_html( $cat_name->name ); ?></a>
                                </h3>
                                <p><?php echo esc_html( wp_trim_words( $cat_name->description, $num_words = 15, $more = '… ' ) ); ?></p>
                                <a href="<?php echo esc_url( get_category_link( $cat_name->term_id ) ); ?>" class="cat-meta-btn d-inline-block"><?php esc_html_e( 'Show Now', 'ushop' ); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['select_category'] 		= array_map( 'sanitize_text_field', (array)$new_instance['select_category'] );
        $instance[ 'enable_content' ] = absint( $new_instance[ 'enable_content' ] );
        $instance[ 'enable_count' ] = absint( $new_instance[ 'enable_count' ] );
        $instance[ 'enable_title' ] = absint( $new_instance[ 'enable_title' ] );
        return $instance;
    }
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $select_category       = isset( $instance['select_category'] ) ? array_map( 'esc_attr', $instance['select_category'] ) : '';
        $enable_content = !empty( $instance['enable_content'] ) ? $instance['enable_content'] : '' ;
        $enable_count = !empty( $instance['enable_count'] ) ? $instance['enable_count'] : '' ;
        $enable_title = !empty( $instance['enable_title'] ) ? $instance['enable_title'] : '' ;
        ?>
        <div class="ushop-wrap">
            <div class="full-width">
                <div class="col-12">
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                    </h2>
                </div>
                <div class="col-12">
                    <h5>
                        <label for="<?php echo $this->get_field_id( 'select_category' ); ?>"><?php _e( 'Choose the categories you wish to display Category from:', 'ushop' ); ?></label>
                        <select data-placeholder="<?php echo __('Select the categories you wish to display posts from.', 'ushop'); ?>" multiple="multiple" name="<?php echo $this->get_field_name( 'select_category' ); ?>" id="<?php echo $this->get_field_id( 'select_category' ); ?>" class="widefat trending-posts-dropdown">
                            <?php
                            $cats = get_categories( array('taxonomy' => 'product_cat' ) );
                            foreach( $cats as $cat ) : ?>
                                <?php printf(
                                    '<option value="%s" %s>%s</option>',
                                    $cat->cat_ID,
                                    in_array( $cat->cat_ID, (array)$select_category) ? 'selected="selected"' : '',
                                    $cat->cat_name
                                );?>
                            <?php endforeach; ?>
                        </select>
                    </h5>
                </div>
                <div class="col-3">
                    <h5>
                        <label>
                            <input class="checkbox" type="checkbox" name="<?php echo $this->get_field_name( 'enable_content' ); ?>" id="<?php echo $this->get_field_id( 'enable_content' ); ?>" value="1" <?php checked( $enable_content, '1' ); ?>>
                            <span><?php _e( 'Hide/Show Content ( Pro )', 'ushop' ); ?></span>
                        </label>
                    </h5>
                </div>
                <div class="col-3">
                    <h5>
                        <label>
                            <input class="checkbox" type="checkbox" name="<?php echo $this->get_field_name( 'enable_count' ); ?>" id="<?php echo $this->get_field_id( 'enable_count' ); ?>" value="1" <?php checked( $enable_count, '1' ); ?>>
                            <span><?php _e( 'Hide/Show Count ( Pro )', 'ushop' ); ?></span>
                        </label>
                    </h5>
                </div>
                <div class="col-3">
                    <h5>
                        <label>
                            <input class="checkbox" type="checkbox" name="<?php echo $this->get_field_name( 'enable_title' ); ?>" id="<?php echo $this->get_field_id( 'enable_title' ); ?>" value="1" <?php checked( $enable_title, '1' ); ?>>
                            <span><?php _e( 'Hide/Show Title of The Category ( Pro )', 'ushop' ); ?></span>
                        </label>
                    </h5>
                </div>
            </div>
        </div>
        <?php
    }
}