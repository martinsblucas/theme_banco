<?php

class Meta
{
    static function get_post_meta($post, $slug, $label, $type = 'string')
    {
        if ($type === 'string') {
            $values = get_post_meta($post->ID, $slug, true); ?>
            <div class="form-group <?= $slug ?>">
                <label for="<?= $slug ?>">
                    <?php _e($label, 'post-types'); ?>
                </label>
                <?php
                if (!$values) {
                    $values = [''];
                }
                foreach ($values as $key => $value) {
                    $total = count($values);
                    $total - $key === 1 ? $id = "id = '" . $slug . "'" : $id = null;
                    ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="<?= $slug; ?>[]" <?= $id ?>
                               value="<?= esc_attr($value) ?>"/>
                        <?php if ($key > 0) { ?>
                            <div class="input-group-append">
                            <span class="d-flex btn btn-sm btn-danger align-items-center removeField">
                                <span class="dashicons dashicons-trash"></span>
                            </span>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <span class="btn btn-secondary btn-sm addField">
                    <span class="dashicons dashicons-plus"></span>
                </span>
            </div>
        <?php } elseif
        ($type == 'image') { ?>
            <div class="form-group">
                <?php
                $values = get_post_meta($post->ID, $slug, true);
                if ($values) {
                    foreach ($values as $key => $value) {
                        $image = wp_get_attachment_image($value, 'medium', false, array('id' => 'post-types-preview-image'));
                        echo $image;
                        ?>
                        <input type="hidden" name="foto-diretor[]" id="post-types_image_id"
                               value="<?php echo esc_attr($value); ?>" class="regular-text"/>
                        <input type='button' class="button-primary"
                               value="<?php esc_attr_e($label, 'post-types'); ?>"
                               id="post-types_media_manager"/>
                        <?php
                    }
                } else {
                    $image = '<img id="post-types-preview-image" src="https://picsum.photos/seed/picsum/300/300" />';
                    echo $image; ?>
                    <input type="hidden" name="foto-diretor[]" id="post-types_image_id"
                           value="" class="regular-text"/>
                    <input type='button' class="button-primary"
                           value="<?php esc_attr_e($label, 'post-types'); ?>"
                           id="post-types_media_manager"/>
                <?php } ?>

            </div>

            <?php
        }
    }

    static function register_meta($name, $type)
    {
        $args = array(
            'object_subtype' => $name,
            'type' => $type,
            'single' => false,
            'show_in_rest' => true
        );
        return register_meta('post', $name, $args);
    }

    static function save_metas($slug, $type = 'text_field')
    {
        $post_ID = $_POST['post_ID'];
        $values = $_POST[$slug];
        if ($values) {
            $data = array();
            foreach ($values as $key => $value) {
                switch ($type) {
                    default :
                        $single = sanitize_text_field($value);
                        break;
                }
                array_push($data, $single);
            }
            update_post_meta($post_ID, $slug, $data);
        }
    }

    static function add_meta_box($name, $screens)
    {
        foreach ($screens as $screen) {
            add_meta_box(
                '',
                __($name, 'post-types'),
                'meta_box_inner',
                $screen
            );
            function meta_box_inner($post)
            {
                ?>
                <link rel="stylesheet"
                      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                      crossorigin="anonymous">';
                <div id="fichaTecnica">
                    <?php
                    Meta::get_post_meta($post, 'direcao', 'Direção', 'string');
                    Meta::get_post_meta($post, 'producao', 'Produção', 'string');
                    Meta::get_post_meta($post, 'foto-diretor', 'Foto do diretor', 'image');
                    ?>
                </div>
            <?php }
        }
    }
}