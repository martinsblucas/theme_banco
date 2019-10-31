$(document).ready(r => {
    $(document).on('click', '.addField', a => {
        let form_group = $(a.target).closest('.form-group');
        let input_group = form_group.find('.input-group').last();
        let form_controlLast = input_group.find('.form-control');
        let id = form_controlLast.attr('id');
        form_controlLast.removeAttr('id');
        const clone = input_group.clone();
        let form_control = clone.find('.form-control');
        form_control.attr('id', id);
        form_control.removeClass('is-invalid');
        clone.find('.invalid-feedback').remove();
        let input_group_append;
        if (clone.find(".removeField").length === 0 && clone.find(".input-group-append").length === 1) {
            input_group_append = '<button type="button" class="d-flex btn btn-sm btn-outline-danger align-items-center removeField"><span class="dashicons dashicons-trash"></span></button>';
        }
        else if (clone.find(".removeField").length === 0 && clone.find(".input-group-append").length === 0) {
            input_group_append = '<div class="input-group-append"><button type="button" class="d-flex btn btn-sm btn-outline-danger align-items-center removeField"><span class="dashicons dashicons-trash"></span></button></div>';
        }
        clone.append(input_group_append);
        form_control.val('');
        clone.insertAfter(input_group);
    });
    $(document).on('click', '.removeField', r => {
        let form_groupLast = $(r.target).closest('.form-group');
        let input_group = $(r.target).closest('.input-group');
        let form_control = input_group.find('.form-control');
        let id = form_control.attr('id');
        input_group.remove();
        let input_groupLast = form_groupLast.find('.input-group').last();
        let form_controlLast = input_groupLast.find('.form-control');
        form_controlLast.attr('id', id);
    });
});