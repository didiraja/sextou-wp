<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var Hostinger_Onboarding $onboarding_steps */
$onboarding_steps = $onboarding;
$content          = $onboarding_steps->get_content();
$remaining_tasks  = 0;
/** @var Hostinger_Onboarding_Step $step */
foreach ( $onboarding_steps->get_steps() as $step ) {
	$remaining_tasks = ! $step->completed() ? ++ $remaining_tasks : $remaining_tasks;
}
?>
<div class="hostinger hsr-onboarding">
    <h2 class="hsr-onboarding__title"><?php echo $content['title']; ?></h2>
    <p class="hsr-onboarding__description"><?php echo $content['description']; ?></p>
    <div data-remaining-tasks="<?php echo $remaining_tasks ?>" class="hsr-onboarding-steps">
		<?php
		$can_open_accordion = true;
		/** @var Hostinger_Onboarding_Step $step */
		foreach ( $onboarding_steps->get_steps() as $step ): ?>
            <div class="hsr-onboarding-step">
                <div class="hsr-onboarding-step--title">
					<?php $completed_class = $step->completed() ? 'completed' : ''; ?>
                    <span class="hsr-onboarding-step--status <?php echo $completed_class ?>"></span>
                    <h4><?php echo $step->get_title() ?></h4>
					<?php
					$class_name = '';
					if ( $can_open_accordion && ! $step->completed() ) {
						$class_name         = 'open';
						$can_open_accordion = false;
					}
					?>
                    <div class="hsr-onboarding-step--expand <?php echo $class_name ?>"></div>
                </div>
                <div class="hsr-onboarding-step--content <?php echo $class_name ?>">
					<?php foreach ( $step->get_body() as $key => $item ) : ?>
						<?php $counter = $key + 1; ?>
                        <div class="hsr-onboarding-step--body">
                            <span class='hsr-onboarding-step--body__counter'><?php echo $counter ?></span>
                            <div class="hsr-onboarding-step--body__content">
                                <div class="hsr-onboarding-step--body__title">
                                    <h4><?php echo $item['title'] ?></h4>
                                </div>
                                <p><?php echo $item['description'] ?></p>
                            </div>
                        </div>
					<?php endforeach; ?>
                    <div class="hsr-onboarding-step--footer">
                        <a data-step="<?php echo $step->step_identifier() ?>"
                           class="hsr-btn hsr-secondary-btn hsr-got-it-btn"
                           href="#"><?php _e( 'Got it!', 'hostinger' ) ?> </a>
                        <a class="hsr-btn hsr-primary-btn"
                           target="_blank"
                           href="<?php echo $step->get_redirect_link() ?>">
							<?php _e( 'Take me there', 'hostinger' ) ?>
                        </a>
                    </div>
                </div>
            </div>
		<?php endforeach; ?>
		<?php
		$preview_btn = ! $onboarding_steps->maintenance_mode_enabled() ? 'hsr-preview' : '';
		$completed   = $remaining_tasks === 0 ? 'completed' : '';
		?>
        <a class="hsr-btn hsr-primary-btn hsr-no-bg-btn hsr-publish-btn <?php echo $completed; ?> <?php echo $preview_btn ?>"
           href="<?php echo $content['btn']['url']; ?>"><?php echo $content['btn']['text']; ?></a>
        <a target="_blank" class="hsr-btn hsr-primary-btn hsr-no-bg-btn hsr-preview-btn <?php echo $preview_btn; ?>"
           href="<?php echo home_url() ?>"><?php echo $content['btn']['text']; ?></a>
    </div>
    <div class="hsr-modal hsr-publish-modal">
        <div class="hsr-publish-overlay"></div>
        <div class="hsr-publish-modal--body">
            <div class="hsr-circular">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM45.3333 24C45.3333 35.7821 35.7821 45.3333 24 45.3333C12.2179 45.3333 2.66667 35.7821 2.66667 24C2.66667 12.2179 12.2179 2.66667 24 2.66667C35.7821 2.66667 45.3333 12.2179 45.3333 24Z"
                          fill="#EBE4FF"/>
                    <mask id="mask0_7023_11690" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                          width="48" height="48">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM45.3333 24C45.3333 35.7821 35.7821 45.3333 24 45.3333C12.2179 45.3333 2.66667 35.7821 2.66667 24C2.66667 12.2179 12.2179 2.66667 24 2.66667C35.7821 2.66667 45.3333 12.2179 45.3333 24Z"
                              fill="white"/>
                    </mask>
                    <g mask="url(#mask0_7023_11690)">
                        <path d="M24 0H48V48H0.333333L0 24H24V0Z" fill="#673DE6"/>
                    </g>
                </svg>
            </div>

            <div class="hsr-success-circular">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM45.3333 24C45.3333 35.7821 35.7821 45.3333 24 45.3333C12.2179 45.3333 2.66667 35.7821 2.66667 24C2.66667 12.2179 12.2179 2.66667 24 2.66667C35.7821 2.66667 45.3333 12.2179 45.3333 24Z"
                          fill="#EBE4FF"/>
                    <mask id="mask0_7023_11585" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                          width="48" height="48">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM45.3333 24C45.3333 35.7821 35.7821 45.3333 24 45.3333C12.2179 45.3333 2.66667 35.7821 2.66667 24C2.66667 12.2179 12.2179 2.66667 24 2.66667C35.7821 2.66667 45.3333 12.2179 45.3333 24Z"
                              fill="white"/>
                    </mask>
                    <g mask="url(#mask0_7023_11585)">
                        <circle cx="24" cy="24" r="24" fill="#00B090"/>
                    </g>
                    <mask id="mask1_7023_11585" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="17"
                          width="19" height="15">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M33.4438 19.0002L20.9992 31.4448L15.0547 25.5002L16.9992 23.5557L20.9992 27.5557L31.4992 17.0557L33.4438 19.0002Z"
                              fill="#00B090"/>
                    </mask>
                    <g mask="url(#mask1_7023_11585)">
                        <path d="M17 22.5L14 25.5L21 32.5L34.5 19L31.5 16L21 26.5L17 22.5Z" fill="#00B090"/>
                    </g>
                </svg>
            </div>

            <h3><?php _e( 'Publishing website', 'hostinger' ); ?></h3>
            <p class="hsr-publish-modal--body__description"><?php _e( 'This can take some time', 'hostinger' ); ?></p>
            <div class="hsr-publish-modal--footer">
                <a class="hsr-btn hsr-outline-btn hsr-close-btn" href="#"><?php _e( 'Close', 'hostinger' ) ?></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function ($) {
        const openClass = 'open';
        const completedClass = 'completed';
        const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
        $(document).on('ready', function () {
            const stepsTitle = $('.hsr-onboarding-step--title')
            const gotItBtn = $('.hsr-got-it-btn');
            const publishBtn = $('.hsr-publish-btn');
            const closeBtn = $('.hsr-close-btn');
            const previewButton = $('.hsr-preview');

            previewButton.on('click', function () {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {
                        action: 'hostinger_track_click',
                        click_action: 'hostinger_preview_button_click'
                    },
                })
            })

            gotItBtn.on('click', function (e) {
                e.preventDefault();
                const element = $(this);
                const step = $(this).data('step');
                let remaining_tasks = $('.hsr-onboarding-steps').data('remaining-tasks');

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {
                        action: 'hostinger_complete_onboarding_step',
                        step: step,
                    },
                    success: function () {
                        element.closest('.hsr-onboarding-step--content').slideUp()
                        element.parents('.hsr-onboarding-step')
                            .find('.hsr-onboarding-step--status')
                            .addClass(completedClass)

                        if (remaining_tasks > 0) {
                            remaining_tasks = remaining_tasks - 1;
                            $('.hsr-onboarding-steps').data('remaining-tasks', remaining_tasks)

                            if (remaining_tasks === 0) {
                                $('.hsr-publish-btn').addClass(completedClass);
                            }

                        }
                    },
                })
            })

            stepsTitle.on('click', function () {
                $(this).find('.hsr-onboarding-step--expand').toggleClass(openClass);
                $(this).parent().find('.hsr-onboarding-step--content').slideToggle(200);
            })

            publishBtn.on('click', function (e) {
                e.preventDefault();
                $('.hsr-modal').addClass('open');
                $('body').addClass('modal-open');
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {
                        action: 'hostinger_publish_website',
                        maintenance: 0,
                    },
                    success: function (result) {
                        const previewBtn = $('.hsr-preview-btn');
                        $('.hsr-circular').addClass('hsr-hide')
                        $('.hsr-success-circular').addClass('hsr-show')
                        $('.hsr-publish-modal--footer').addClass('show')
                        $('.hsr-publish-modal--body h3').text(result.data.title);
                        $('.hsr-publish-modal--body__description').text(result.data.description);
                        $('.hsr-publish-btn').addClass('hsr-preview')
                        previewBtn.addClass('hsr-preview')
                        previewBtn.text(result.data.content.btn.text)
                        $('.hsr-onboarding__title').text(result.data.content.title);
                        $('.hsr-onboarding__description').text(result.data.content.description);
                    },
                })
            })

            closeBtn.on('click', function () {
                $('.hsr-modal').removeClass('open');
                $('body').removeClass('modal-open');
            })
        });
    })(jQuery);
</script>
