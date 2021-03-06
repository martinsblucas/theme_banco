<?php

class PostMeta
{
    static function get_meta_form($post, $slug, $label, $type = 'text-field', $options = null)
    {
        if (array_key_exists(0, get_post_meta($post->ID, $slug, false)) and is_array(get_post_meta($post->ID, $slug, false)[0])) {
            $values = get_post_meta($post->ID, $slug, true);
        } elseif (count(get_post_meta($post->ID, $slug, false)) >= 1) {
            $values = get_post_meta($post->ID, $slug, false);
        } elseif ($type == 'image') {
            $values = [];
        } else {
            $values = [''];
        }
        if ($type === 'text-field') { ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label for="<?= $slug ?>">
                    <?php _e($label, 'post-types'); ?>
                </label>
                <?php
                foreach ($values as $key => $value) {
                    $total = count($values);
                    $total - $key === 1 ? $id = "id = '" . $slug . "'" : $id = null;
                    ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="<?= $slug; ?>[]" <?= $id ?>
                               value="<?= esc_attr($value) ?>"/>
                        <?php if ($key > 0) { ?>
                            <div class="input-group-append">
                                <button type="button"
                                        class="d-flex btn btn-sm btn-outline-danger align-items-center removeField">
                                    <span class="dashicons dashicons-trash"></span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <button type="button" class="btn btn-sm btn-outline-primary addField">Adicionar</button>
            </div>
        <?php } elseif ($type == 'url') { ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label for="<?= $slug ?>">
                    <?php _e($label, 'post-types'); ?>
                </label>
                <?php
                foreach ($values as $key => $value) {
                    $total = count($values);
                    $total - $key === 1 ? $id = "id = '" . $slug . "'" : $id = null;
                    ?>
                    <div class="input-group">
                        <input type="url" placeholder="http://" class="form-control" name="<?= $slug; ?>[]" <?= $id ?>
                               value="<?= esc_attr($value) ?>"/>
                    </div>
                <?php } ?>
        <?php } elseif ($type == 'number') { ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label for="<?= $slug ?>">
                    <?php _e($label, 'post-types'); ?>
                </label>
                <?php
                foreach ($values as $key => $value) {
                    $total = count($values);
                    $total - $key === 1 ? $id = "id = '" . $slug . "'" : $id = null;
                    ?>
                    <div class="input-group">
                        <input type="number" class="form-control" name="<?= $slug; ?>[]" <?= $id ?>
                               value="<?= esc_attr($value) ?>"/>
                        <?php if ($key > 0) { ?>
                            <div class="input-group-append">
                                <button type="button"
                                        class="d-flex btn btn-sm btn-outline-danger align-items-center removeField">
                                    <span class="dashicons dashicons-trash"></span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <button type="button" class="btn btn-sm btn-outline-primary addField">Adicionar</button>
            </div>
        <?php } elseif
        ($type == 'image') { ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label><?php esc_attr_e($label, 'post-types'); ?></label>
                <div class="input-group">
                    <div class="row">
                        <?php foreach ($values as $key => $value) {
                            $image = wp_get_attachment_image($value, 'medium', false, array('class' => 'img-fluid')); ?>
                            <div class="col-4">
                                <?= $image; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php $values = implode(",", $values) ?>
                <input type="hidden" name="<?= $slug; ?>" id="<?= $slug; ?>"
                       value="<?php echo esc_attr($values); ?>" class="imgIds"/>
                <button type="button" class="btn btn-sm btn-outline-primary addField">Adicionar</button>
            </div>
        <?php } elseif
        ($type == 'internal_link') {
            $posts = Meta::get_posts($options);
            ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label for="<?= $slug ?>">
                    <?php _e($label, 'post-types'); ?>
                </label>
                <?php
                foreach ($values as $key => $value) {
                    $total = count($values);
                    $total - $key === 1 ? $id = "id = '" . $slug . "'" : $id = null;
                    ?>
                    <div class="input-group">
                        <select class="form-control" name="<?= $slug; ?>[]" <?= $id ?>>
                            <?php foreach ($posts as $post) {
                                $post->ID == $value ? $selected = 'selected' : $selected = null; ?>
                                <option value="<?= esc_attr($post->ID) ?>" <?= $selected ?>><?= esc_attr($post->post_title) ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($key > 0) { ?>
                            <div class="input-group-append">
                                <button type="button"
                                        class="d-flex btn btn-sm btn-outline-danger align-items-center removeField">
                                    <span class="dashicons dashicons-trash"></span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <button type="button" class="btn btn-sm btn-outline-primary addField">Adicionar</button>
            </div>
            <?php
        }
    }

    static function get_posts($args = null)
    {
        $defaults = array(
            'numberposts' => 9999,
            'category' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'include' => array(),
            'exclude' => array(),
            'meta_key' => '',
            'meta_value' => '',
            'post_type' => 'post',
            'suppress_filters' => true,
        );
        $p = wp_parse_args($args, $defaults);

        return get_posts($p);
    }

    public function register_meta($name, $type)
    {
        $args = array(
            'object_subtype' => $name,
            'type' => $type,
            'single' => false,
            'show_in_rest' => true
        );
        return register_meta('post', $name, $args);
    }

    public function save_metas($slug, $type = 'text-field')
    {
        global $post;
        $current_user = wp_get_current_user();
        $author = $current_user->ID;
        isset ($_POST['post_ID']) ? $post_ID = $_POST['post_ID'] : $post_ID = null;
        isset ($_POST[$slug]) ? $values = $_POST[$slug] : $values = [];
        if ($type === 'image' && $values) {
            $values = explode(",", $values);
        }
        if ($values) {
            $data = [];
            foreach ($values as $key => $value) {
                if ($type == 'internal_link') {
                    $single = intval($value);
                    $test = get_post($value);
                    if (!$test) {
                        $single = null;
                        $errors['id'] = $key;
                        $errors['type'] = $type;
                        $errors['slug'] = $slug;
                        $errors['msg'] = 'Isso não é um post';
                    }
                } elseif ($type === 'url') {
                    $single = esc_url($value);
                    if (!$single) {
                        $single = null;
                        $errors['id'] = $key;
                        $errors['type'] = $type;
                        $errors['slug'] = $slug;
                        $errors['msg'] = 'Isso não é uma URL válida';
                    }
                } elseif ($type == 'image') {
                    $single = intval($value);
                    $single = wp_get_attachment_image($single, 'medium', false, array('class' => 'img-fluid'));
                    if (!$single) {
                        $single = null;
                        $errors['id'] = $key;
                        $errors['type'] = $type;
                        $errors['slug'] = $slug;
                        $errors['msg'] = 'Isso não é uma imagem';
                    }
                } elseif ($type == 'text-field') {
                    $single = sanitize_text_field($value);
                    if ($single != null and !$single) {
                        $single = null;
                        $errors['id'] = $key;
                        $errors['type'] = $type;
                        $errors['slug'] = $slug;
                        $errors['msg'] = 'Isso não é um campo de texto válido';
                    }
                } elseif ($type == 'number') {
                    $single = intval($value);
                    if ($single != null and !$single) {
                        $single = null;
                        $errors['id'] = $key;
                        $errors['type'] = $type;
                        $errors['slug'] = $slug;
                        $errors['msg'] = 'Isso não é um número válido';
                    }
                }
                if ($single != null) {
                    $data[] = $single;
                }
                if ($errors) {
                    set_transient('post-types-error-post-' . $post_ID . '-author-' . $author . '-slug-' . $slug . '-key-' . $key, $errors, 1);
                }
            }
            if(!empty($data) and $data != null) {
                update_post_meta($post_ID, $slug, $data);
            }
        }
    }

    public function meta_box_inner($post)
    { ?>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <style rel="stylesheet">
            img.is-invalid {
                border: 1px #dc3545 solid;
            }

            .invalid-feedback {
                display: block;
            }

            .input-group .row {
                width: 100%;
                margin-left: 0;
                margin-right: 0;
            }

            .input-group .col-4 {
                margin-bottom: 20px;
                padding-left: 0;
                padding-right: 0;
            }

            .form-group {
                margin: 40px 0;
            }

            .input-group {
                margin: 15px 0;
            }

            label {
                font-size: 16px;
                margin-bottom: 0;
            }
        </style>
        <div id="fichaTecnica">
            <?php
            $this->get_meta_form($post, 'url', 'Link personalizado', 'url');
            ?>
        </div>

    <?php }
}