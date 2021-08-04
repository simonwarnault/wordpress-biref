<?php
/**
 * Help Panel.
 *
 * @package Bakes_And_Cakes
 */
?>
<!-- Help file panel -->
<div id="help-panel" class="panel-left">

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Documentation Link', 'bakes-and-cakes' ); ?></h4>
        <p><?php esc_html_e( 'Are you new to the WordPress world? Our step by step easy documentation guide will help you create an attractive and engaging website without any prior coding knowledge or experience.', 'bakes-and-cakes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/bakes-and-cakes/' ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'bakes-and-cakes' ); ?>" target="_blank">
            <?php esc_html_e( 'View Documentation', 'bakes-and-cakes' ); ?>
        </a>
    </div><!-- .panel-aside -->
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'Support Ticket', 'bakes-and-cakes' ); ?></h4>
        <p><?php printf( __( 'It\'s always better to visit our %1$sDocumentation Guide%2$s before you send us a support query.', 'bakes-and-cakes' ), '<a href="'. esc_url( 'https://docs.rarathemes.com/docs/bakes-and-cakes/' ) .'" target="_blank">', '</a>' ); ?></p>
        <p><?php printf( __( 'If the Documentation Guide didn\'t help you, contact us via our %1$sSupport Ticket%2$s. We reply to all the support queries within one business day, except on the weekends.', 'bakes-and-cakes' ), '<a href="'. esc_url( 'https://rarathemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/support-ticket/' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'bakes-and-cakes' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'bakes-and-cakes' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Bakes And Cakes Demo', 'bakes-and-cakes' ); ?></h4>
        <p><?php esc_html_e( 'Visit the demo to get more idea about our theme design and its features.', 'bakes-and-cakes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/previews/?theme=bakes-and-cakes' ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'bakes-and-cakes' ); ?>" target="_blank">
            <?php esc_html_e( 'View Demo', 'bakes-and-cakes' ); ?>
        </a>
    </div><!-- .panel-aside -->
</div>