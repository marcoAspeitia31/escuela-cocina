<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="text-center my-4">Comentarios</h2>
        <ul class="comment-list alert list-unstyled">
            <?php
                $comments = get_comments(array(
                    'post_id' => $post->ID,
                    'status' => 'approve'
                ));
                wp_list_comments(array(
                    'per_page' => 10,
                    'reverse_top_level' => false
                ), $comments);
            ?>
        </ul>
    </div>
    <!-- comments -->
    <div class="col-md-8 comments-form">
        <?php comment_form(); ?>
    </div>
    <!-- comment-form -->
</div>