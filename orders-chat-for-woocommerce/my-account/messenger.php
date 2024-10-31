<?php defined( 'ABSPATH' ) || die;

use U2Code\OrderMessenger\API\REST\MessagesREST;
use U2Code\OrderMessenger\Config\Config;
use U2Code\OrderMessenger\Core\ServiceContainer;
use U2Code\OrderMessenger\Entity\Message;

/**
 * View variables
 *
 * @var Message[] $messages
 * @var int $orderId
 * @var int $totalMessages
 */
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/messenger.css">
<div class="om-messenger" data-nonce="<?php echo esc_attr( wp_create_nonce( 'wp_rest' ) ); ?>"
     data-url="<?php echo esc_attr( rest_url( MessagesREST::API_NAMESPACE ) ); ?>"
     data-order-id="<?php echo esc_attr( $orderId ); ?>"
     data-limit="<?php echo esc_attr( Config::getPreloadMessagesCount() ); ?>"
     data-total="<?php echo esc_attr( $totalMessages ); ?>"
     data-max-file-size="<?php echo esc_attr( Config::getMaxFileSize( true ) ); ?>"
     data-max-file-size-string="<?php echo esc_attr( size_format( Config::getMaxFileSize( true ) ) ); ?>"
>
<div class="om-messenger__main">
        <div class="om-messages-wrapper">
			<h4>Message Log:</h4>
            <?php if ( $totalMessages < 1 ) : ?>
                <p class="om-messenger__no-messages" data-messenger-no-messages>
                    <?php esc_html_e('There are no messages yet. Your message would be the first one.', 'order-messenger-for-woocommerce' ); ?>
                </p>
            <?php else : ?>
                <?php foreach ( array_reverse( $messages ) as $key => $message ) : ?>
                    <?php 
                    ServiceContainer::getInstance()->getFileManager()->includeTemplate( $message->getViewPath(), array(
                        'message' => $message,
                    ), true ); 
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="om-messenger__footer">
        <h4 style="margin-bottom: 15px;">Send a message</h4>
        <form data-message-sending-form class="om-messenger-sending-form">
            <p>
				<input type="text" id="order_id" name="order_id" value="Order: Order #<?php echo esc_attr( $orderId ); ?> - Placed on 18th Apr 2024 for $390.86" readonly />
            </p>
            <!-- <p>
                <input type="text" id="subject" name="subject" required placeholder="Subject"/>
            </p> -->
            <p>
                <textarea maxlength="<?php echo esc_attr( Message::MAX_LENGTH ); ?>" required data-message-textarea
                          cols="30" rows="10" placeholder="Message"></textarea>
            </p>
            <div class="om-messenger-sending-form__buttons">
                <?php if ( Config::isFilesEnabled() ) : ?>
                    <div data-messenger-attach-file>
                        <input data-messenger-fileinput type="file" hidden="hidden"
                               accept="<?php echo esc_attr( implode( ', ', array_column( Config::getEnabledFileFormats(), 'mime' ) ) ); ?>"
                               id="message-attachment-<?php echo esc_attr( $orderId ); ?>">
                        <label for="message-attachment-<?php echo esc_attr( $orderId ); ?>"
                               class="om-messenger__attach-file">
                            <?php esc_attr_e( 'Attach file', 'order-messenger-for-woocommerce' ); ?>
                        </label>
                    </div>
                    <div data-messenger-attached-file style="display: none">
                        <span data-messenger-attached-file-remove class="om-messenger__attached-remove"></span>
                        <span data-messenger-attached-filename class="om-messenger__attached-filename"></span>
                    </div>
                <?php endif; ?>
                    <div class="group_button">
						<button class="button red_button" id="message-send-<?php echo esc_attr( $orderId ); ?>"><?php esc_attr_e( 'Send Message', 'order-messenger-for-woocommerce' ); ?></button>
						<button class="clear_message">Clear Message<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M21.3115 10.8198L14.0615 18.0698L5.93154 9.93982L13.1815 2.68982C13.5095 2.36312 13.9536 2.17969 14.4165 2.17969C14.8795 2.17969 15.3236 2.36312 15.6515 2.68982L21.3115 8.34982C21.6382 8.67781 21.8217 9.12188 21.8217 9.58482C21.8217 10.0478 21.6382 10.4918 21.3115 10.8198ZM3.31154 12.5898C2.60929 13.2929 2.21484 14.2461 2.21484 15.2398C2.21484 16.2336 2.60929 17.1867 3.31154 17.8898L6.14154 20.7198C6.48903 21.0687 6.90201 21.3456 7.35676 21.5345C7.81152 21.7234 8.29911 21.8207 8.79154 21.8207C9.28398 21.8207 9.77157 21.7234 10.2263 21.5345C10.6811 21.3456 11.0941 21.0687 11.4415 20.7198L13.0015 19.1298L4.87154 10.9998L3.31154 12.5898Z" fill="#212121"/>
						</svg></button>
					</div>
            </div>
            <div class="om-messenger-sending-form__messages">
                <div class="om-messenger-sending-form-error" style="display:none;" data-messenger-error></div>
            </div>
        </form>
    </div>
</div>
