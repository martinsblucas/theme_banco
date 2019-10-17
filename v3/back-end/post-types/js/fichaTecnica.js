$(document).ready(r => {
    $(document).on('click', '.addField', a => {
        let form_group = $(a.target).closest('.form-group');
        let input_group = form_group.find('.input-group').last();
        let form_controlLast = input_group.find('.form-control');
        let id = form_controlLast.attr('id');
        form_controlLast.removeAttr('id');
        let clone = input_group.clone();
        let form_control = clone.find('.form-control');
        form_control.attr('id', id);
        console.log(id);
        if (clone.find(".input-group-append").length === 0) {
            let input_group_append = '<div class="input-group-append"><span class="d-flex btn btn-sm btn-danger removeField"><span class="align-self-center">Remover</span></span></div>';
            clone.append(input_group_append);
        }
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