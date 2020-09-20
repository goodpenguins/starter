<?php
/**
 * Comment part
 *
 * @package starter
 */

defined( 'ABSPATH' ) || exit;

$starter_name_email_required = (bool) get_option( 'require_name_email', 1 ) ? 'required' : '';
$starter_rating_required     = wc_review_ratings_required() ? 'required' : '';
$starter_comment_recaptcha   = get_theme_mod( 'comment_recaptcha', false );
$starter_comment_rating      = 0;
?>
<!-- rating -->
<?php if ( wc_review_ratings_enabled() ) : ?>
	<div class="col-md-5">
		<ul class="list-unstyled form-control ratings_list js_ratings_list">
			<li>
				<span><?php esc_html_e( 'Price:', 'starter' ); ?></span>
				<div class="d-flex justify-content-end flex-wrap text-right js_rating" data-elem-width="22">
					<?php require get_stylesheet_directory() . '/woocommerce-custom/global/rating.php'; ?>
					<input type="text" name="price_rating" id="price_rating_<?php echo esc_attr( $starter_product_id ); ?>" class="js_rating_input" <?php echo esc_attr( $starter_rating_required ); ?> hidden>
					<div class="invalid-feedback"><?php esc_html_e( 'Price rating is required.', 'starter' ); ?></div>
				</div>
			</li>
			<li>
				<span><?php esc_html_e( 'Quality:', 'starter' ); ?></span>
				<div class="d-flex justify-content-end flex-wrap text-right js_rating" data-elem-width="22">
					<?php require get_stylesheet_directory() . '/woocommerce-custom/global/rating.php'; ?>
					<input type="text" name="quality_rating" id="quality_rating_<?php echo esc_attr( $starter_product_id ); ?>" class="js_rating_input" <?php echo esc_attr( $starter_rating_required ); ?> hidden>
					<div class="invalid-feedback"><?php esc_html_e( 'Quality rating is required.', 'starter' ); ?></div>
				</div>
			</li>
			<li>
				<span><?php esc_html_e( 'Shipping:', 'starter' ); ?></span>
				<div class="d-flex justify-content-end flex-wrap text-right js_rating" data-elem-width="22">
					<?php require get_stylesheet_directory() . '/woocommerce-custom/global/rating.php'; ?>
					<input type="text" name="shipping_rating" id="shipping_rating_<?php echo esc_attr( $starter_product_id ); ?>" class="js_rating_input" <?php echo esc_attr( $starter_rating_required ); ?> hidden>
					<div class="invalid-feedback"><?php esc_html_e( 'Shipping rating is required.', 'starter' ); ?></div>
				</div>
			</li>
			<li class="total_row">
				<span class="text_total_row"><?php esc_html_e( 'Your Overall Rating:', 'starter' ); ?></span>
				<span class="text_total_rating js_total_ratings"></span>
				<input name="rating" class="js_avarage_rating" data-minimum-rating="4" hidden>
			</li>
		</ul>
	</div>
<?php endif; ?>
<!-- END rating -->

<!-- comment form -->
<div class="col-md-7">
	<?php if ( ! is_user_logged_in() ) : ?>
		<div class="row">
			<div class="col-md-6 form-group">
				<div class="js_label_on_input">
					<input type="text" class="form-control" name="author" id="author_<?php echo esc_attr( $starter_product_id ); ?>" <?php echo esc_attr( $starter_name_email_required ); ?>>
					<label for="author_<?php echo esc_attr( $starter_product_id ); ?>"><?php esc_html_e( 'Your name', 'starter' ); ?></label>
					<div class="invalid-feedback"><?php esc_html_e( 'This field is required.', 'starter' ); ?></div>
				</div>
			</div>
			<div class="col-md-6 form-group">
				<div class="js_label_on_input">
					<input type="email" class="form-control" name="email" id="email_<?php echo esc_attr( $starter_product_id ); ?>" <?php echo esc_attr( $starter_name_email_required ); ?>>
					<label for="email_<?php echo esc_attr( $starter_product_id ); ?>"><?php esc_html_e( 'Your Email Address', 'starter' ); ?></label>
					<div class="invalid-feedback"><?php esc_html_e( 'This field is required.', 'starter' ); ?></div>
					<div class="invalid-feedback not_required_feedback"><?php esc_html_e( 'Please enter a valid email address.', 'starter' ); ?></div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="form-group js_label_on_input">
		<textarea id="comment_<?php echo esc_attr( $starter_product_id ); ?>" class="form-control" name="comment" cols="45" rows="8" required></textarea>
		<label for="comment_<?php echo esc_attr( $starter_product_id ); ?>"><?php esc_html_e( 'Your Review', 'starter' ); ?></label>
		<div class="invalid-feedback"><?php esc_html_e( 'This field is required.', 'starter' ); ?></div>
	</div>
	<div class="form-group">
		<div class="form-control wrap_file_uploader js_label_on_input js_wrap_upload_files">
			<?php
				$starter_maximum_length = get_theme_mod( 'comment_maximum_files', 10 ); /*maximum files*/
				$starter_maximum_weight = get_theme_mod( 'comment_maximum_weight', 15 ); /*MB, each file maximum weight*/
			?>
			<input class="custom-file-input js_field_file_upload" data-length="<?php echo esc_attr( $starter_maximum_length ); ?>" data-weight="<?php echo esc_attr( $starter_maximum_weight ); ?>" id="comment_fileupload_<?php echo esc_attr( $starter_product_id ); ?>" type="file" name="files[]" multiple accept="image/jpeg,image/jpg,image/png" aria-describedby="fileHelp">
			<label><?php esc_html_e( 'Attachment (Optional)', 'starter' ); ?></label>
			<label class="file_label" for="comment_fileupload_<?php echo esc_attr( $starter_product_id ); ?>"><?php echo starter_get_svg( array( 'icon' => 'bi-image' ) ); ?></label>
			<ul class="list-unstyled list_file_upload js_list_file_upload"></ul>
			<div class="invalid-feedback js_filelength_invalid_feedback d-none">
				<?php
					// Translators: $s maximum count of files.
					echo sprintf( esc_html__( 'Maximum %s files.', 'starter' ), esc_html( $starter_maximum_length ) );
				?>
			</div>
			<div class="invalid-feedback js_filesize_invalid_feedback d-none">
				<?php
					// Translators: $s maximum count of files.
					echo sprintf( esc_html__( 'File must be less than %sMB.', 'starter' ), esc_html( $starter_maximum_weight ) );
				?>
			</div>
			<div class="invalid-feedback js_type_invalid_feedback d-none">
				<?php esc_html_e( 'File type is not valid.', 'starter' ); ?>
			</div>
		</div>
		<input type="hidden" class="hiddenUploadFilesComment" name="hiddenUploadFilesComment">
		<small id="fileHelp" class="form-text text-muted">
			<?php
				// Translators: $s maximum count of files.
				echo sprintf( esc_html__( 'You can upload up to %1$s files in png, jpg or jpeg format size limit %2$s MB each.', 'starter' ), esc_html( $starter_maximum_length ), esc_html( $starter_maximum_weight ) );
			?>
		</small>
	</div>
	<?php if ( $starter_comment_recaptcha ) : ?>
		<div class="mb-4">
			<div class="g-recaptcha" data-callback="recaptchaCallbackComment"></div>
			<input type="hidden" class="form-control" id="js_comment_hidden_recaptcha" required name="hiddenRecaptchaComment">
			<div class="invalid-feedback"><?php esc_html_e( 'This field is required.', 'starter' ); ?></div>
		</div>
	<?php endif; ?>
	<div class="custom-control custom-checkbox mb-4">
		<input name="privacy_policy" type="checkbox" class="custom-control-input" id="check_privacy_policy_<?php echo esc_attr( $starter_product_id ); ?>" required checked>
		<label class="custom-control-label" for="check_privacy_policy_<?php echo esc_attr( $starter_product_id ); ?>"><?php esc_html_e( 'I have read & accept the Privacy Policy', 'starter' ); ?></label>
		<div class="invalid-feedback"><?php esc_html_e( 'This field is required.', 'starter' ); ?></div>
	</div>
	<input type="hidden" name="product_id" value="<?php echo esc_attr( $starter_product_id ); ?>">
	<input type="hidden" name="comment_post_ID" value="<?php echo esc_attr( $starter_product_id ); ?>">
	<input type="hidden" name="action" value="starter_send_comment">
	<input type="hidden" name="security" value="<?php echo esc_html( wp_create_nonce( 'comment' ) ); ?>">
	<div class="row">
		<div class="col-lg-5 col-sm-6">
			<button type="submit" class="btn btn-block btn-lg btn-primary js_comment_submit" disabled>
				<span class="btn_static_txt"><?php esc_html_e( 'Submit review', 'starter' ); ?></span>
				<span class="loading_txt"><?php esc_html_e( 'Loading...', 'starter' ); ?></span>
			</button>
		</div>
	</div>
</div>
<!-- END comment form -->

<!-- fileupload template -->
<div class="js_fileupload_tpl d-none" tabindex="-3">
	<li class="template-upload">
		<div class="preview"></div>
		<div class="file_info">
			<div class="file_name js_file_name"></div>
			<div class="file_size js_file_size" data-size></div>
		</div>
		<a href="#" class="cancel remove_thumbnail_img" role="button" aria-label="Remove file">
			<?php echo starter_get_svg( array( 'icon' => 'bi-remove' ) ); ?>
		</a>
	</li>
</div>
<!-- END fileupload template -->

<!-- confirm modal if low rating -->
<div class="modal comment_confirm_modal js_comment_confirm_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><?php esc_html_e( 'Sorry to interrupt!', 'starter' ); ?></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'starter' ); ?>"><?php echo starter_get_svg( array( 'icon' => 'bi-remove' ) ); ?></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-secondary" role="alert">
					<?php echo starter_get_svg( array( 'icon' => 'sad_face' ) ); ?>
					<p><?php esc_html_e( 'We are extremely sorry to interrupt but it looks like you were not happy with our product!', 'starter' ); ?></p>
				</div>
				<p><?php esc_html_e( 'We want you to know that we value you as a customer and it\'s super important to us that you\'re 100% satisfied with your order!', 'starter' ); ?></p>
				<p><?php esc_html_e( 'Please contact us and give us the opportunity to take care of any issues you may be having. We\'re here for you!', 'starter' ); ?></p>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-sm-6 wrap_btn">
						<a href="#" class="btn btn-outline-primary btn-block btn-md js_comment_submit_anyway" role="button"><?php esc_html_e( 'Submit review anyway', 'starter' ); ?></a>
					</div>
					<div class="col-sm-6 wrap_btn">
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'contact-us', '', site_url() ) ); ?>" class="btn btn-primary btn-block btn-md" role="button"><?php esc_html_e( 'Contact support', 'starter' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END confirm modal if low rating -->

<?php if ( $starter_comment_recaptcha ) : ?>
<script>
	function recaptchaCallbackComment() {
		var response = grecaptcha.getResponse();
		document.getElementById( 'js_comment_hidden_recaptcha' ).val( response );
		document.getElementById( 'js_comment_hidden_recaptcha' ).classList.remove( 'is-invalid' );
	}
	var onloadCallback = function() {
		var recaptchaComment = document.querySelector( '.js_comment_form .g-recaptcha' );
		recaptchaIdComment = grecaptcha.render( recaptchaComment, {
			'sitekey' : '<?php echo esc_html( get_theme_mod( 'public_recaptcha_key' ) ); ?>'
		});
	};
</script>
<?php endif; ?>

<?php
	$starter_blueimp_script = array(
		get_template_directory_uri() . '/assets/js/blueimp/vendor/jquery.ui.widget.js',
		get_template_directory_uri() . '/assets/js/blueimp/blueimp-tmpl/js/tmpl.js',
		get_template_directory_uri() . '/assets/js/blueimp/blueimp-load-image/js/load-image.all.min.js',
		get_template_directory_uri() . '/assets/js/blueimp/blueimp-canvas-to-blob/js/canvas-to-blob.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.iframe-transport.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.fileupload.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.fileupload-process.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.fileupload-image.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.fileupload-validate.js',
		get_template_directory_uri() . '/assets/js/blueimp/jquery.fileupload-ui.js'
	);
?>
<script>
	var blueimp_script = <?php echo wp_json_encode( $starter_blueimp_script ); ?>;
</script>