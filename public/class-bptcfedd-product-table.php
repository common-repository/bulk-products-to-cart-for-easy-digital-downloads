<?php
/**
 * The product table functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/himanshud
 * @since      1.0.0
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 */

/**
 * The product table functionality of the plugin.
 *
 * @package    Bulk_Products_To_Cart_For_Edd
 * @subpackage Bulk_Products_To_Cart_For_Edd/public
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Bptcfedd_Product_Table {

	/**
	 * The table id.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      int    $table_id    The table id.
	 */
	public $table_id;

	/**
	 * The shortcode attitudes.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $attitudes    The shortcode attitudes.
	 */
	public $attitudes;

	/**
	 * The table configs.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $configs    The table configs.
	 */
	public $configs;

	/**
	 * The table columns.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $columns    The table columns.
	 */
	public $columns;

	/**
	 * The table query.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      WP_Query    $query    The table query.
	 */
	public $query;

	/**
	 * The table download_id.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      int    $download_id    The table download_id.
	 */
	public $download_id;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    int $table_id   The id of table.
	 */
	public function __construct( $table_id ) {

		global $bptcfedd_tatts;
		$this->table_id = $table_id;
		$this->attitudes = $bptcfedd_tatts; 
		$this->configs  = bptcfedd_get_table_configs( $table_id );

	}

	/**
	 * Get query object
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_get_query() {

		$query = isset( $this->query ) ? $this->query : false;
		return $query;

	}

	/**
	 * Get current page
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_get_paged() {

		$page_key = sprintf( '%d_paged', $this->table_id );
		$paged    = ! empty( $_GET[ $page_key ] ) ? bptcfedd_sanitize_text_field( $_GET[ $page_key ] ) : 1;
		return $paged;

	}

	/**
	 * Display product table header
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_header() {

		$tb_columns    = $this->configs['columns'];
		$columns       = bptcfedd_get_table_columns( $this->table_id, $tb_columns );
		$this->columns = $columns;

		?>
		<?php if ( ! empty( $columns ) ) { ?>
			<?php foreach ( $columns as $ckey => $column ) { ?>
				<th class="bptcfedd-head-col bptcfedd-<?php echo esc_attr( $ckey ); ?>"><?php echo $column; ?></th>
			<?php } ?>
			<?php
		}

		do_action( 'bptcfedd_after_table_head', $this->table_id, $this->attitudes, $this);

	}

	/**
	 * Display product table body
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_body() {

		$query = $this->bptcfedd_run_query();

		?>
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) { ?>
				<?php
				global $post;
				$query->the_post();
				$this->download_id = get_the_ID();
				$download_post     = get_post( $this->download_id );
				$post              = $download_post;
				?>
				<tr data-download-id=<?php echo esc_attr( get_the_ID() ); ?>>
					<?php if ( ! empty( $this->columns ) ) { ?>
						<?php foreach ( $this->columns as $ckey => $column ) { ?>
							<?php $method = sprintf( 'bptcfedd_display_col_%s', $ckey ); ?>
							<td class="bptcfedd-col-val bptcfedd-col-val-<?php echo esc_attr( $ckey ); ?>"><?php $this->$method(); ?></td>
						<?php } ?>
					<?php } ?>
				</tr>
			<?php } ?>
			<?php
			do_action( 'bptcfedd_after_table_body', $this->table_id, $this->attitudes, $this);
		}

	}

	/**
	 * Display checkbox for product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_checkbox() {

		?>
		<div class="bptcfedd-checkbox-wrap">
			<input type="checkbox" class="bptcfedd-table-checkbox" name="bptcfedd_checkbox[]" value="<?php echo esc_attr( $this->download_id ); ?>">
		</div>
		<?php

	}

	/**
	 * Display id of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_id() {

		?>
		<div class="bptcfedd-id-wrap">
			<p><?php the_ID(); ?></p>
		</div>
		<?php

	}

	/**
	 * Display title of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_title() {

		?>
		<div class="bptcfedd-title-wrap">
			<?php edd_get_template_part( 'shortcode', 'content-title' ); ?>
		</div>
		<?php

	}

	/**
	 * Display image of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_img() {

		?>
		<div class="bptcfedd-img-wrap">
			<?php edd_get_template_part( 'shortcode', 'content-image' ); ?>
		</div>
		<?php

	}

	/**
	 * Display price of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_price() {

		?>
		<div class="bptcfedd-price-wrap">
			<?php edd_get_template_part( 'shortcode', 'content-price' ); ?>
		</div>
		<?php

	}

	/**
	 * Display excerpt of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_excerpt() {

		?>
		<div class="bptcfedd-excerpt-wrap">
			<?php edd_get_template_part( 'shortcode', 'content-excerpt' ); ?>
		</div>
		<?php

	}

	/**
	 * Display add to cart button for product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_addtocart() {

		?>
		<div class="bptcfedd-addtocart-wrap">
			<?php edd_get_template_part( 'shortcode', 'content-cart-button' ); ?>
		</div>
		<?php

	}

	/**
	 * Display categories of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_cats() {

		$args     = array(
			'fields' => 'names',
		);
		$get_cats = wp_get_post_terms( $this->download_id, 'download_category', $args );

		?>
		<?php if ( ! empty( $get_cats ) ) { ?>
			<?php $cats = implode( ', ', $get_cats ); ?>
			<div class="bptcfedd-cats-wrap">
				<p><?php echo esc_html( $cats ); ?></p>
			</div>
		<?php } ?>
		<?php

	}

	/**
	 * Display tags of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_tags() {

		$args     = array(
			'fields' => 'names',
		);
		$get_tags = wp_get_post_terms( $this->download_id, 'download_tag', $args );

		?>
		<?php if ( ! empty( $get_tags ) ) { ?>
			<?php $tags = implode( ', ', $get_tags ); ?>
			<div class="bptcfedd-tags-wrap">
				<p><?php echo esc_html( $tags ); ?></p>
			</div>
		<?php } ?>
		<?php

	}

	/**
	 * Display date of product
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_col_date() {

		$date_format = get_option( 'date_format' );
		?>
		<div class="bptcfedd-date-wrap">
			<?php echo get_the_date( $date_format ); ?>
		</div>
		<?php

	}

	/**
	 * Display pagination for product table
	 *
	 * @since    1.0.0
	 */
	public function bptcfedd_display_pagination() {

		$is_enabled = isset( $this->configs['conditions']['pagination'] ) ? true : false;

		if ( ! $is_enabled ) {
			return;
		}

		$query = $this->query;
		$paged = $this->bptcfedd_get_paged();
		$args  = array(
			'format'    => sprintf( '?%d_paged=%%#%%', $this->table_id ),
			'type'      => 'plain',
			'mid_size'  => 3,
			'prev_next' => true,
			'current'   => max( 1, $paged ),
			'total'     => $query->max_num_pages,
		);

		?>
		<div class="bptcfedd-pagination bptcfedd-pagination-<?php echo esc_attr( $this->table_id ); ?>">
			<?php echo paginate_links( $args ); ?>
		</div>
		<?php

	}

	/**
	 * Run the query for product table
	 *
	 * @since     1.0.0
	 * @return    WP_Query   $final_query     The object of WP_Query class
	 */
	public function bptcfedd_run_query() {

		$conditions     = $this->configs['conditions'];
		$tax_args       = $this->bptcfedd_prepare_query_tax_args();
		$args           = $this->bptcfedd_prepare_query_args();
		$only_tax_query = empty( $args['post__in'] ) && empty( $conditions['exclude_downloads'] );

		if ( ! empty( $tax_args ) ) {

			if ( $only_tax_query ) {
				$paged                      = $this->bptcfedd_get_paged();
				$tax_args['posts_per_page'] = intval( $conditions['per_page'] );
				$tax_args['paged']          = $paged;
			}

			$tax_query = new WP_Query( $tax_args );

			if ( ! empty( $args['post__in'] ) && ! empty( $tax_query->posts ) ) {
				$args['post__in'] = array_merge( $args['post__in'], $tax_query->posts );
			} elseif ( ! $only_tax_query ) {
				$args['post__in'] = $tax_query->posts;
			}
		}

		if ( ! empty( $conditions['exclude_downloads'] ) ) {
			$posts = array();

			if ( ! empty( $args['post__in'] ) ) {
				foreach ( $args['post__in'] as $key => $id ) {
					if ( ! in_array( $id, $conditions['exclude_downloads'] ) ) {
						$posts[] = $id;
					}
				}
				$args['post__in'] = $posts;
			} else {
				$args['post__not_in'] = $conditions['exclude_downloads'];
			}
		}

		if ( ! empty( $args['post__in'] ) || ! empty( $conditions['exclude_downloads'] ) || empty( $tax_args ) ) {
			$final_query = new WP_Query( $args );
		} else {
			$final_query = $tax_query;
		}

		$this->query = $final_query;

		return $final_query;
	}

	/**
	 * Get query args
	 *
	 * @since     1.0.0
	 * @return    array   $args     The array of args
	 */
	public function bptcfedd_prepare_query_args() {

		$conditions   = $this->configs['conditions'];
		$paged        = $this->bptcfedd_get_paged();
		$args         = array(
			'post_type'   => 'download',
			'post_status' => 'publish',
			'fields'      => 'ids',
			'paged'       => $paged,
		);
		$tax_queryies = array();

		$args['posts_per_page'] = intval( $conditions['per_page'] );

		if ( ! empty( $conditions['downloads'] ) ) {
			$args['post__in'] = $conditions['downloads'];
		}

		$args['order']   = $conditions['order'];
		$args['orderby'] = $conditions['orderby'];

		return $args;

	}

	/**
	 * Get tax query args
	 *
	 * @since     1.0.0
	 * @return    array   $args     The array of args
	 */
	public function bptcfedd_prepare_query_tax_args() {

		$conditions   = $this->configs['conditions'];
		$args         = array();
		$tax_queryies = array();

		if ( ! empty( $conditions['categories'] ) ) {
			$tax_queryies[] = array(
				'taxonomy' => 'download_category',
				'terms'    => $conditions['categories'],
			);
		}

		if ( ! empty( $conditions['tags'] ) ) {
			$tax_queryies[] = array(
				'taxonomy' => 'download_tag',
				'terms'    => $conditions['tags'],
			);
		}

		if ( ! empty( $conditions['exclude_categories'] ) ) {
			$tax_queryies[] = array(
				'taxonomy' => 'download_category',
				'terms'    => $conditions['exclude_categories'],
				'operator' => 'NOT IN',
			);
		}

		if ( ! empty( $conditions['exclude_tags'] ) ) {
			$tax_queryies[] = array(
				'taxonomy' => 'download_tag',
				'terms'    => $conditions['exclude_tags'],
				'operator' => 'NOT IN',
			);
		}

		if ( ! empty( $tax_queryies ) ) {
			$tax_queryies['relation'] = 'AND';
			$args                     = array(
				'post_type'      => 'download',
				'tax_query'      => $tax_queryies,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			);
		}

		return $args;

	}

}
