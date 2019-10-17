<?php
class Meta {
    static function register_meta($name, $type) {
        $args = array(
            'object_subtype' => $name,
            'type' => $type,
            'single' => false,
            'show_in_rest' => true
        );
        return register_meta('post', $name, $args);
    }
    static function save_metas($slug) {
        $post_ID = $_POST['post_ID'];
        $values = $_POST[$slug];
        if ($values) {
            $data = array();
            foreach ($values as $key => $value) {
                array_push($data, sanitize_text_field($value));
            }
            update_post_meta($post_ID, $slug, $data);
        }
    }
    static function add_meta_box ($name, $screens) {
        foreach ($screens as $screen) {
            add_meta_box(
                '',
                __($name, 'post-types'),
                'meta_box_inner',
                $screen
            );
            function meta_box_inner($post)
            {
                $direcao = get_post_meta($post->ID, 'direcao', true);
                $producao = get_post_meta($post->ID, 'producao', true);
                ?>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
                <div id="fichaTecnica">
                    <div class="form-group direcao">
                        <label for="direcao">
                            <?php _e("Direção", 'post-types'); ?>
                        </label>
                        <?php
                        if ($direcao) {
                            foreach ($direcao as $key => $diretor) {
                                $total = count($direcao);
                                $total-$key === 1 ? $id = "id = 'direcao'" : $id = null;
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="direcao[]" <?= $id ?> value="<?= esc_attr($diretor) ?>"/>
                                    <?php if ($key > 0) { ?>
                                        <div class="input-group-append">
                            <span class="d-flex btn btn-sm btn-danger align-items-center removeField">
                                <span>Remover</span>
                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="input-group">
                                <input type="text" class="form-control" id="direcao" name="direcao[]" value=""/>
                            </div>
                        <?php } ?>
                        <span class="btn btn-secondary btn-sm addField">Adicionar diretor</span>
                    </div>
                    <div class="form-group producao">
                        <label for="producao">
                            <?php _e("Produção", 'post-types'); ?>
                        </label>
                        <?php
                        if ($producao) {
                            foreach ($producao as $key => $produtor) {
                                $total = count($producao);
                                $total-$key === 1 ? $id = "id = 'producao'" : $id = null;
                                ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="producao[]" <?= $id ?> value="<?= esc_attr($produtor) ?>"/>
                                    <?php if ($key > 0) { ?>
                                        <div class="input-group-append">
                            <span class="d-flex btn btn-sm btn-danger align-items-center removeField">
                                <span>Remover</span>
                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="input-group">
                                <input type="text" class="form-control" name="producao[]" id="producao" value=""/>
                            </div>
                        <?php } ?>
                        <span class="btn btn-secondary btn-sm addField">Adicionar produtor</span>
                    </div>
                </div>
            <?php }
        }
    }
}