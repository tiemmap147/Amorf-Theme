<?php
/**
 * The template for displaying comments
 * 
 * @package My_Custom_Blog
 */

// If the current post is protected and the visitor has not yet entered the password, return early
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One comment on &ldquo;%s&rdquo;', 'my-custom-blog'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx(
                        '%1$s comment on &ldquo;%2$s&rdquo;',
                        '%1$s comments on &ldquo;%2$s&rdquo;',
                        $comment_count,
                        'comments title',
                        'my-custom-blog'
                    )),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>
        
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => 'my_custom_blog_comment',
            ));
            ?>
        </ol>
        
        <?php
        // Comment pagination
        the_comments_navigation(array(
            'prev_text' => esc_html__('&larr; Older Comments', 'my-custom-blog'),
            'next_text' => esc_html__('Newer Comments &rarr;', 'my-custom-blog'),
        ));
        
    endif; // Check for have_comments().
    
    // If comments are closed and there are comments, display a notice
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'my-custom-blog'); ?></p>
    <?php endif; ?>
    
    <?php
    // Comment form
    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'my-custom-blog') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
        'fields'             => array(
            'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'my-custom-blog') . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'my-custom-blog') . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'my-custom-blog') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></p>',
        ),
        'class_submit'       => 'submit btn btn-primary',
        'label_submit'       => esc_html__('Post Comment', 'my-custom-blog'),
        'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    ));
    ?>
    
</div>



