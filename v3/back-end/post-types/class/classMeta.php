<?php

class Meta
{
    static function get_meta_form($post, $slug, $label, $type = 'string', $options = null)
    {
        $values = get_post_meta($post->ID, $slug, true);
        if (!$values) {
            $values = [''];
        }
        if ($type === 'string') { ?>
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
        ($type == 'image') {
            if (!$values) {
                $values = [];
            }
            ?>
            <div class="form-group <?= $type; ?> <?= $slug; ?>">
                <label><?php esc_attr_e($label, 'post-types'); ?></label>
                <div class="input-group">
                    <div class="row">
                        <?php foreach ($values as $key => $value) {
                            $image = wp_get_attachment_image($value, 'medium', false, array('class' => 'img-fluid')); ?>
                            <div class="col-2">
                                <?= $image; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php $values = implode(",", $values) ?>
                <input type="hidden" name="<?= $slug; ?>" id="<?= $slug; ?>"
                       value="<?php echo esc_attr($values); ?>" class="imgIds"/>
                <span class="btn btn-secondary btn-sm addImg">
                    <span class="dashicons dashicons-plus"></span>
                </span>
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
                            <option value="9999999">Oi</option>
                            <?php foreach ($posts as $post) {
                                $post->ID == $value ? $selected = 'selected' : $selected = null; ?>
                                <option value="<?= esc_attr($post->ID) ?>" <?= $selected ?>><?= esc_attr($post->post_title) ?></option>
                            <?php } ?>
                        </select>
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

    public function save_metas($slug, $type = 'text_field')
    {
        global $post;
        $current_user = wp_get_current_user();
        $author = $current_user->ID;
        isset ($_POST['post_ID']) ? $post_ID = $_POST['post_ID'] : $post_ID = $post->ID;
        isset ($_POST[$slug]) ? $values = $_POST[$slug] : $values = [];
        if ($type === 'image' && $values) {
            $values = explode(",", $values);
        }
        if ($values) {
            $errors = [];
            foreach ($values as $key => $value) {
                $data = [];
                switch ($type) {
                    case 'internal_link' :
                        $single = intval($value);
                        $test = get_post($single);
                        if (!$test) {
                            $errors[$key][] = 'Erro ao gravar ' . $type . ' ' . $slug;
                        }
                        break;
                    case 'image' :
                        $single = intval($value);
                        $test = wp_get_attachment_image($value, 'medium', false, array('class' => 'img-fluid'));
                        if (!$test) {
                            $single = null;
                        }
                        break;
                    default :
                        $single = sanitize_text_field($value);
                        break;
                }
                if ($single != null) {
                    $data[] = $single;
                }
            }
            if ($errors) {
                set_transient('post-types-error-post-'.$post_ID.'-author-'.$author, $errors, 999999);
            }
            update_post_meta($post_ID, $slug, $data);
        }
    }

    public function meta_box_inner($post)
    { ?>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <div id="fichaTecnica">
            <?php
            $this->get_meta_form($post, 'direcao', 'Direção', 'internal_link', ['post_type' => 'diretores']);
            $this->get_meta_form($post, 'producao', 'Produção', 'string');
            $this->get_meta_form($post, 'foto_diretor', 'Foto do diretor', 'image');
            $this->get_meta_form($post, 'foto_produtor', 'Foto do produtor', 'image');
            ?>
        </div>

    <?php }
}