<?php
/**
 * Template Name: FAQ Page
 * Description: Frequently Asked Questions page template
 * 
 * @package Amorfs_Blog
 */

get_header(); ?>

<main id="primary" class="site-main faq-page">
    <div class="faq-container">
        <!-- FAQ Header -->
        <div class="faq-header">
            <h1 class="faq-title"><?php amorfs_e('faq_title'); ?></h1>
            <p class="faq-subtitle"><?php amorfs_e('faq_page_description'); ?></p>
        </div>

        <!-- FAQ Accordion -->
        <div class="faq-accordion">
            <?php
            // Query FAQ posts
            $faq_args = array(
                'post_type'      => 'faq',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            );
            
            $faq_query = new WP_Query($faq_args);
            
            if ($faq_query->have_posts()) :
                $item_index = 0;
                while ($faq_query->have_posts()) : $faq_query->the_post();
                    $item_index++;
                    $is_active = ($item_index === 1) ? 'active' : '';
                    $is_expanded = ($item_index === 1) ? 'true' : 'false';
                    $answer = get_post_meta(get_the_ID(), '_faq_answer', true);
                    ?>
                    
                    <div class="faq-item <?php echo esc_attr($is_active); ?>">
                        <button class="faq-question" aria-expanded="<?php echo esc_attr($is_expanded); ?>">
                            <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="faq-question-text"><?php the_title(); ?></span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        </div>
                    </div>
                    
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback: Show default FAQs if no FAQ posts exist
                ?>
                
                <!-- Question 1 -->
                <div class="faq-item active">
                    <button class="faq-question" aria-expanded="true">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_1'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_1'); ?>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_2'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_2'); ?>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_3'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_3'); ?>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_4'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_4'); ?>
                        </div>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_5'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_5'); ?>
                        </div>
                    </div>
                </div>

                <!-- Question 6 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span class="faq-icon">
                                <svg class="icon-minus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="icon-plus" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </span>
                        <span class="faq-question-text"><?php amorfs_e('faq_question_6'); ?></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php amorfs_e('faq_answer_6'); ?>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
