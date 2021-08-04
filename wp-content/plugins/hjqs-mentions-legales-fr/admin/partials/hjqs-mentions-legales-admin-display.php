<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Hjqs_Mentions_Legales
 * @subpackage Hjqs_Mentions_Legales/admin/partials
 */
?>
<div class="hjqs-ml-wrapper">
    <div class="hjqs-ml-header">
        <h1 class="hjqs-ml-title">Mentions légales <small><a target="_blank" class="button-secondary" href="https://hugojqs.fr">by Hugojqs</a></small></h1>
        <p class="submit">
            <input form="hjqs-form-settings" name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
        </p>
    </div>
    <form action="options.php" method="post" id="hjqs-form-settings">
        <?php
            settings_fields('hjqs_mentions_legales_options_group');
            do_settings_sections('hjqs-mentions-legales');
        ?>

    </form>

    <div class="hjqs-ml-footer">
        <p class="submit">
            <input form="hjqs-form-settings" name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
        </p>
    </div>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
