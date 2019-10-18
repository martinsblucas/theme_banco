$(document).ready(r => {
    $('input#post-types_media_manager').click(c => {
        c.preventDefault();
        let image_frame;
        if(image_frame){
            image_frame.open();
        }
        image_frame = wp.media({
            title: 'Escolha uma imagem',
            multiple : false,
            library : {
                type : 'image',
            }
        });
        image_frame.on('close', c => {
            let selection =  image_frame.state().get('selection');
            let gallery_ids = [];
            let index = 0;
            selection.each((attachment) => {
                gallery_ids[index] = attachment['id'];
                index++;
            });
            let ids = gallery_ids.join(",");
            $('input#post-types_image_id').val(ids);
            Refresh_Image(ids);
        });
        image_frame.on('open', o => {
            let selection =  image_frame.state().get('selection');
            let ids = $('input#post-types_image_id').val().split(',');
            ids.forEach((id) => {
                let attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );
            });

        });
        image_frame.open();
    });

});
function Refresh_Image(the_id){
    const data = {
        action: 'post_types_get_image',
        id: the_id
    };
    $.get(ajaxurl, data, g => {
        if(g.success === true) {
            console.log(g);
            $('#post-types-preview-image').replaceWith( g.data.image );
        }
     });
}