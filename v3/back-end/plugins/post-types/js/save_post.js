$(document).ready(r => {
    wp.hooks.addAction('save_post', 'post_types', () => {
        $('.form-control, .img-fluid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        wp.data.dispatch('core/notices').removeNotice(100);
        wp.data.dispatch('core/notices').removeNotice(101);
        wp.data.dispatch('core/notices').removeNotice(102);
        wp.data.dispatch('core/notices').createNotice(
            'warning',
            'Aguarde enquanto salvamos a ficha técnica...',
            {
                isDismissible: true,
                id: 100,
            }
        );
    });
    wp.hooks.addAction('saved_post', 'post_types', () => {
        const post_id = wp.data.select('core/editor').getCurrentPostId();
        get_transients(post_id);
        delete_transients(post_id);
    });
    $(document).on('blur change keypress keyup', '.form-control', e => {
        let input_group = $(e.target).closest('.input-group');
        let invalid_feedback = $(input_group).find('.invalid-feedback');
        invalid_feedback.remove();
        $(e.target).removeClass('is-invalid');
    });
});
const get_transients = (post_id) => {
    const data = {
        action: 'post_types_get_errors',
        id: post_id
    };
    $.get(ajaxurl, data, g => {
        if (g.success === true) {
            const errors = g.data;
            console.log(errors);
            wp.data.dispatch('core/notices').removeNotice(100);
            let response;
            errors.length === 0 ? response = false : response = true;
            if(response === true) {
                wp.data.dispatch('core/notices').createNotice(
                    'error',
                    'Houve erro(s) no salvamento de itens da ficha técnica.',
                    {
                        isDismissible: true,
                        id: 102
                    }
                );
            }
            else {
                wp.data.dispatch('core/notices').createNotice(
                    'success',
                    'Ficha técnica salva com sucesso.',
                    {
                        isDismissible: true,
                        id: 101
                    }
                );
            }
            for (const i in errors) {
                const element = `.form-group.${errors[i]['type']}.${errors[i]['slug']}`;
                const form_group = $(element);
                const position = `${errors[i]['id']}`;
                const input_group = form_group.find('.input-group');
                let row;let col;let image;let invalid_feedback;let form_control;
                switch (errors[i]['type']) {
                    case 'image' :
                        row = input_group.find('.row');
                        col = row.find('.col-4');
                        image = $(col[position]).find('img');
                        $(image).addClass('is-invalid');
                        invalid_feedback = `<div class="invalid-feedback" role="alert">${errors[i]['msg']}</div>`;
                        $(col[position]).append(invalid_feedback);
                        break;
                    default :
                        form_control = input_group.find('.form-control');
                        $(form_control[position]).addClass('is-invalid');
                        invalid_feedback = `<div class="invalid-feedback" role="alert">${errors[i]['msg']}</div>`;
                        const check_invalid_feedback = $(input_group[position]).find('.invalid-feedback');
                        if(check_invalid_feedback.length < 1) {
                            $(input_group[position]).append(invalid_feedback);
                        }
                        break;
                }
            }
        }
    });
};
const delete_transients = (post_id) => {
    const data = {
        action: 'post_types_delete_errors',
        id: post_id
    };
    $.get(ajaxurl, data, g => {
    });
};