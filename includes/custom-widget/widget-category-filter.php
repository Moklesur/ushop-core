<?php
/**
 * Displays Category Filter
 *
 */

class uShop_Widget_Category_Filter extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-category-filter',
            'description' => __( 'Displays Category Filter', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-category-filter', __( 'uShop : Category Filter', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_category_filter';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( !empty($instance['title']) ) ? $instance['title'] : '';
        $limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 8;
        $columns = ( ! empty( $instance['columns'] ) ) ? absint( $instance['columns'] ) : 4;
        $select_category  = isset( $instance['select_category'] ) ? array_map( 'esc_attr', $instance['select_category'] ) : '';

        echo $args['before_widget']; ?>
        <div class="widget-category-filter woo-img-center add-btn-hover text-center">
            <?php if( $title != '' ) { ?>
                <div class="widgets-heading mb-5">
                    <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                </div>
            <?php } ?>
            <div class="category-filter-contents">
                <ul class="list-inline category-filter-wrap mb-5">
                    <li class="list-inline-item">
                        <a href="#" data-filter="*" class="current"><?php esc_html_e( 'All', 'ushop' ); ?></a>
                    </li>
                    <?php
                    $cat_name_val = '';
                    if ( is_array( $select_category ) || is_object( $select_category ) ){
                        foreach ( $select_category as $cat_array ) {

                            $cat_name = get_term_by( 'id', $cat_array, 'product_cat' );
                            $cat_name_val .= $cat_name->name.',';
                            echo '<li class="list-inline-item"><a href="#" data-filter=".product_cat-'. $cat_name->slug.'">'. $cat_name->name.'</a></li>';
                        }
                    }
                    $cat_name_val = substr( $cat_name_val, 0, strlen($cat_name_val)-1 );
                    ?>
                </ul>
                <?php
                echo do_shortcode( '[products  limit="' . $limit . '" class="category-filter" columns="' . $columns . '" category="' .$cat_name_val. '"]' );  ?>
            </div>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['limit'] = absint( $new_instance['limit'] );
        $instance['columns'] = absint( $new_instance['columns'] );
        $instance['select_category'] 		= array_map( 'sanitize_text_field', (array)$new_instance['select_category'] );
        return $instance;
    }
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $limit     = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 8;
        $columns     = isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 4;
        $select_category       = isset( $instance['select_category'] ) ? array_map( 'esc_attr', $instance['select_category'] ) : '';
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
                        <label for="<?php echo $this->get_field_id( 'select_category' ); ?>"><?php _e( 'Choose the categories you wish to display products from:', 'ushop' ); ?></label>
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
                        <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of products to show.', 'ushop' ); ?></label>
                        <input class="tiny-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="1" value="<?php echo $limit; ?>" size="3" />
                    </h5>
                </div>
                <div class="col-3">
                    <h5>
                        <label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Number of products to show columns in a row. ( Pro )', 'ushop' ); ?></label>
                        <input class="tiny-text" id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" type="number" step="1" min="2" max="4" value="<?php echo $columns; ?>" size="3" />
                    </h5>
                </div>
            </div>
        </div>
        <?php
    }
}