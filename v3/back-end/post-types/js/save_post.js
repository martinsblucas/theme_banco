$(document).ready(r => {
    $(document).on('click', '.editor-post-publish-button', c => {
        setTimeout(t => {
            const post_id = wp.data.select('core/editor').getCurrentPostId();
            get_transients(post_id);
            delete_transients(post_id);
        },1000);
    });
});
const get_transients = (post_id) => {
    const data = {
        action: 'post_types_get_errors',
        id: post_id
    };
    $.get(ajaxurl, data, g => {
        if (g.success === true) {
            console.log(g.data);
        }
    });
};
const delete_transients = (post_id) => {
    const data = {
        action: 'post_types_delete_errors',
        id: post_id
    };
    $.get(ajaxurl, data, g => {});
};