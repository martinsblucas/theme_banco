$ = jQuery;
$(document).ready(r => {

    const totalPages = Math.ceil(bancoloadmore.wp_query.found_posts / bancoloadmore.posts_per_page);

    !bancoloadmore.wp_query.query.paged ? bancoloadmore.wp_query.query.paged = 1 : null;

    let loadedPages = bancoloadmore.wp_query.query.paged;

    $(window).on('scroll', scrollEvent => {

        const eventTarget = $(scrollEvent.target);
        const card_group_banco = eventTarget.find('.card-group-banco.row');
        const eventTargetScrollTop = eventTarget.scrollTop();
        const cardsOfPage = eventTarget.find(`.page-${loadedPages}`);
        const cardsOfNextPage = eventTarget.find(`.page-${loadedPages + 1}`);

        let lastCardOfPage;
        let lastCardOfPageOffset;

        if (cardsOfPage.length > 0) {
            lastCardOfPage = cardsOfPage.last();
            lastCardOfPageOffset = lastCardOfPage.offset().top;
        }

        if (lastCardOfPage && cardsOfPage.length > 0 && lastCardOfPageOffset - eventTargetScrollTop < 0 && loadedPages < totalPages && cardsOfNextPage.length === 0) {
            card_group_banco.trigger(`load-more`);
        }

    });


    $(document).on('load-more', '.card-group-banco.row', e => {

        loadedPages++;

        const data = {
            action: 'load_more',
            post_type: bancoloadmore.wp_query.query['post_type'],
            tax_query: bancoloadmore.wp_query.tax_query,
            meta_query: bancoloadmore.wp_query.meta_query,
            s: bancoloadmore.wp_query.query['s'],
            paged: loadedPages,
        };

        $.get(bancoloadmore.ajaxurl, data, r => {
            if (bancoloadmore.wp_query.found_posts > bancoloadmore.posts_per_page) {
                for (const i in r.data.results) {
                    $(e.target).append(r.data.results[i]);
                }
                $(e.target).find(`.page-${data.paged}`).show('slow');
            }

        });

    });

});