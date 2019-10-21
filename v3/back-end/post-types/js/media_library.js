$(document).ready(r => {
    $(document).on('click', '.addImg', addImg => {
        let form_group = $(addImg.target).closest('.form-group');
        let img_ids = form_group.find('.imgIds');
        addImg.preventDefault();
        let image_frame;
        if(image_frame){
            image_frame.open();
        }
        image_frame = wp.media({
            title: 'Seleção de imagens',
            multiple : true,
            library : {
                type : 'image',
            }
        });
        image_frame.on('close', () => {
            let selection =  image_frame.state().get('selection');
            let gallery_ids = [];
            let index = 0;
            selection.each((attachment) => {
                gallery_ids[index] = attachment['id'];
                index++;
            });
            let ids = gallery_ids;
            ids.length > 0 ? img_ids.val(ids) : img_ids.val('');
            img_ids.val(ids);
            Refresh_Image(ids, addImg);
        });
        image_frame.on('open', () => {
            let selection =  image_frame.state().get('selection');
            let ids = img_ids.val().split(',');
            ids.forEach((id) => {
                let attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );
            });
        });
        image_frame.open();
    });

});
function Refresh_Image(the_id, event){
    let form_group = $(event.target).closest('.form-group');
    let row = form_group.find('.input-group .row');
    let col = row.find('.col-2');
    const data = {
        action: 'post_types_get_image',
        id: the_id
    };
    $.get(ajaxurl, data, g => {
        if(g.success === true) {
            const imgs = g.data.image;
            col.remove();
            for (const i in imgs) {
                row.append(imgs[i]);
            }
        }
        else {
            col.remove();
        }
     });
}