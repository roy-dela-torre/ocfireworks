<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments" class="d-flex align-items-center justfiy-content-between">
		<!-- <h2 class="woocommerce-Reviews-title d-none">
			<?php
			//$count = $product->get_review_count();
			//if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				//$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				//echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			//} else {
				//esc_html_e( 'Reviews', 'woocommerce' );
			//}
			?>
		</h2> -->
			<div class="row justify-content-between w-100">
				<div class="col-lg-7 col-md-12">
					<div class="left_content_reviews d-flex flex-column">
						<?php if ( ! wc_review_ratings_enabled() ) {
							return;
						}

						$rating_count = $product->get_rating_count();
						$review_count = $product->get_review_count();
						$average      = $product->get_average_rating();

						if ( $rating_count > 0 ) : ?>
							<div class="total_reviews d-flex align-items-center">
								<div class="review_summary">
									<span><?php echo number_format($review_count, 1); ?></span>
								</div>
								<div class="product_reviews d-flex align-items-center">
									<p class="mb-0">Average rating</p>
									<div class="star">
										<?php 
										for ($i = 1; $i <= 5; $i++): ?>
											<?php if ($i <= $review_count): ?>
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#FFD600">
													<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
												</svg>
											<?php else: ?>
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#A9A9A9">
													<path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z"/>
												</svg>
											<?php endif; ?>
										<?php endfor; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<!-- Button trigger modal -->
						<button type="button" class="red_button text-center write_review" data-bs-toggle="modal" data-bs-target="#write_a_review">Write a Review</button>

						<!-- Modal -->
						<div class="modal fade" id="write_a_review" tabindex="-1" aria-labelledby="write_a_reviewLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
										<div id="review_form_wrapper">
											<div id="review_form">
												<div class="header d-flex align-items-center justify-content-between">
													<h2 class="text-white">Write A Review </h2>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
															<g clip-path="url(#clip0_1181_51581)">
																<path d="M2.93179 17.5698C1.97669 16.6474 1.21486 15.5439 0.690774 14.3239C0.166684 13.1038 -0.109178 11.7916 -0.120716 10.4638C-0.132254 9.13605 0.120763 7.81926 0.623572 6.59029C1.12638 5.36133 1.86891 4.24481 2.80784 3.30589C3.74677 2.36696 4.86328 1.62443 6.09225 1.12162C7.32121 0.61881 8.63801 0.365793 9.9658 0.377331C11.2936 0.388869 12.6058 0.664731 13.8258 1.18882C15.0459 1.71291 16.1493 2.47473 17.0718 3.42984C18.8934 5.31586 19.9013 7.84188 19.8785 10.4638C19.8557 13.0858 18.8041 15.5939 16.95 17.448C15.0959 19.3021 12.5878 20.3538 9.9658 20.3766C7.34383 20.3994 4.81781 19.3914 2.93179 17.5698ZM11.4018 10.4998L14.2318 7.66984L12.8218 6.25984L10.0018 9.08984L7.17179 6.25984L5.76179 7.66984L8.59179 10.4998L5.76179 13.3298L7.17179 14.7398L10.0018 11.9098L12.8318 14.7398L14.2418 13.3298L11.4118 10.4998H11.4018Z" fill="white"/>
															</g>
															<defs>
																<clipPath id="clip0_1181_51581">
																<rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
																</clipPath>
															</defs>
														</svg>
													</button>
												</div>
												<?php
												$commenter    = wp_get_current_commenter();
												$comment_form = array(
													/* translators: %s is product title */
													'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
													/* translators: %s is product title */
													'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
													'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
													'title_reply_after'   => '</span>',
													'comment_notes_after' => '',
													'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
													'logged_in_as'        => '',
													'comment_field'       => '',
												);

												$name_email_required = (bool) get_option( 'require_name_email', 1 );
												$fields              = array(
													'author' => array(
														'label'    => __( 'Full Name', 'woocommerce' ),
														'type'     => 'text',
														'value'    => $commenter['comment_author'],
														'required' => $name_email_required,
													),
													'email'  => array(
														'label'    => __( 'Email', 'woocommerce' ),
														'type'     => 'email',
														'value'    => $commenter['comment_author_email'],
														'required' => $name_email_required,
													),
												);

												$comment_form['fields'] = array();

												foreach ( $fields as $key => $field ) {
													$field_html  = '<p class="comment-form-' . esc_attr( $key ) . ' d-flex flex-column">';
													$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

													if ( $field['required'] ) {
														$field_html .= '&nbsp;<span class="required">*</span>';
													}

													$field_html .= '</label><input placeholder="'.esc_html( $field['label'] ).'" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

													$comment_form['fields'][ $key ] = $field_html;
												}

												$account_page_url = wc_get_page_permalink( 'myaccount' );
												if ( $account_page_url ) {
													/* translators: %s opening and closing link tags respectively */
													$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
												}

												if ( wc_review_ratings_enabled() ) {
													$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
														<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
														<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
														<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
														<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
														<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
														<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
													</select></div>';
												}

												$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required placeholder="Your Message..."></textarea></p>';

												comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
												?>
											</div>
										</div>
									<?php else : ?>
										<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-5 col-lg-6 col-md-12">
					<ol class="ps-0 commentlist">
						<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
					</ol>
					<button class="red_button load_more">Load More</button>
				</div>
			</div>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
			<?php if ( !have_comments() ) : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
			<?php endif; ?>
	</div>
</div>
