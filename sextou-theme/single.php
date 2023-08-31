<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sextou-theme
 */

get_header();
?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();

    get_template_part('template-parts/content', get_post_type());

    if ('events' === get_post_type()) :
  ?>
      <div class="is-event">
        <h3>É evento</h3>

        <?php

        if (is_user_logged_in()) {

          $event_id = get_the_ID();
          $current_status = get_user_rsvp($user_id, $event_id);

          $attending_class = $current_status === 'attending' ? 'highlighted' : '';
          $maybe_class = $current_status === 'maybe' ? 'highlighted' : '';
          $not_attending_class = $current_status === 'not_attending' ? 'highlighted' : '';
        ?>

          <?php
          // Get the current user's ID.
          $user_id = get_current_user_id();

          $rsvp_status = get_user_rsvp($user_id, $event_id);

          echo '<p>Your RSVP status: <strong>' . esc_html($rsvp_status) . '</strong></p>';

          $attending_class = $rsvp_status === 'attending' ? 'highlighted' : '';
          $maybe_class = $rsvp_status === 'maybe' ? 'highlighted' : '';
          $not_attending_class = $rsvp_status === 'not_attending' ? 'highlighted' : '';

          $dir = get_template_directory_uri();

          $attend_action = $dir . "/actions/attend-status.php?event=$event_id&user=$user_id";

          ?>

          <?php echo plugin_dir_url("") . "sextou-social/sextou-social.php" ?>

          <form method="post" action="<?php echo $attend_action ?>">
            <!-- <button type="submit" name="clean_event_data" value="<?php echo $event_id; ?>" class="clean-data-button">Clean Data for This Event</button>

            <br />
            <br /> -->

            <button type="submit" name="rsvp_status" value="attending" class="rsvp-button <?php echo "" ?>">Attending</button>
            <button type="submit" name="rsvp_status" value="maybe" class="rsvp-button <?php echo "" ?>">Maybe</button>
            <button type="submit" name="rsvp_status" value="not_attending" class="rsvp-button <?php echo "" ?>">Not Attending</button>
          </form>

        <?php
        }

        // closing block
        ?>
      </div>
  <?php endif;

    the_post_navigation(
      array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'sextou-theme') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'sextou-theme') . '</span> <span class="nav-title">%title</span>',
      )
    );

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
      comments_template();
    endif;

  endwhile; // End of the loop.
  ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
