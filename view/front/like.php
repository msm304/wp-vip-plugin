<?php
function wp_ls_like_layout()
{
    $ls_settings = get_option('_like_post');
?>
    <div class="like-container" style="position:
    <?php echo $ls_settings['_ls_position_type'] ?>;
    <?php echo $ls_settings['_ls_direction_y'] ?><?php echo $ls_settings['_ls_offset_y'] ?>px;
    <?php echo $ls_settings['_ls_direction_x'] ?><?php echo $ls_settings['_ls_offset_x'] ?>px;
    background-color: <?php echo $ls_settings['_ls_bg_color'] ?>;
    border-radius:<?php echo $ls_settings['_ls_border_radius'] ?>px">
        <div class='middle-wrapper'>
            <div class='like-wrapper'>
                <?php if (metadata_exists('user', get_current_user_id(), '_ls_like_post_ids')) {
                    $post_id = get_user_meta(get_current_user_id(), '_ls_like_post_ids', true);
                } else {
                    $post_id = [];
                } ?>
                <a class='<?php echo in_array(get_the_ID(), $post_id) ? 'user-liked unlike-button' : 'like-button' ?>' data-post-id="<?php echo get_the_ID() ?>" data-user-id="<?php echo get_current_user_id() ?>">
                    <span class="like-counter"><?php echo get_post_meta(get_the_ID(), '_ls_like_number', true) ? get_post_meta(get_the_ID(), '_ls_like_number', true) : '0' ?></span>
                    <span class='like-icon'>
                        <div class='heart-animation-1'></div>
                        <div class='heart-animation-2'></div>
                    </span>
                </a>
            </div>
        </div>
    </div>
<?php
}

add_shortcode('like-post', 'wp_ls_like_layout');
