<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sextou-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php
    if (is_singular()) :
      the_title('<h1 class="entry-title">', '</h1>');
    else :
      the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    endif;

    if ('events' === get_post_type()) :
    ?>
      <div class="is-event">
        <h3>É evento</h3>

        <?php
        // Get the current user's ID.
        $user_id = get_current_user_id();

        if (is_user_logged_in()) {
          $rsvp_status = set_user_event_rsvp($user_id, get_the_ID());

          echo '<p>Your RSVP status: <strong>' . esc_html($rsvp_status) . '</strong></p>';
        }
        ?>


        <?php


        if (is_user_logged_in()) {

          $event_id = get_the_ID();
          $current_status = set_user_event_rsvp($user_id, $event_id);

          $attending_class = $current_status === 'attending' ? 'highlighted' : '';
          $maybe_class = $current_status === 'maybe' ? 'highlighted' : '';
          $not_attending_class = $current_status === 'not_attending' ? 'highlighted' : '';
        ?>
          <form method="post" action="">
            <button type="submit" name="rsvp_status" value="attending" class="rsvp-button <?php echo $attending_class; ?>">Attending</button>
            <button type="submit" name="rsvp_status" value="maybe" class="rsvp-button <?php echo $maybe_class; ?>">Maybe</button>
            <button type="submit" name="rsvp_status" value="not_attending" class="rsvp-button <?php echo $not_attending_class; ?>">Not Attending</button>
          </form>

        <?php
        }

        // Handle the form submission.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['rsvp_status'])) {
            $new_status = sanitize_text_field($_POST['rsvp_status']);
            set_user_event_rsvp($user_id, $event_id, $new_status);
          }
        }
        ?>

      </div>
    <?php endif;

    if ('post' === get_post_type()) :
    ?>
      <div class="entry-meta">
        <?php
        sextou_theme_posted_on();
        sextou_theme_posted_by();
        ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <?php sextou_theme_post_thumbnail(); ?>

  <div class="entry-content">
    <?php
    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'sextou-theme'),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post(get_the_title())
      )
    );

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'sextou-theme'),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php sextou_theme_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->