var main = new Splide('#main-slider', {
    type: 'fade',
    rewind: true,
    pagination: false,
    arrows: false,
});

var thumbnails = new Splide('#thumbnail-slider', {
    fixedWidth: 90,
    fixedHeight: 90,
    rewind: true,
    pagination: false,

    arrows: false,
    isNavigation: true,
    breakpoints: {
        600: {
            fixedWidth: 60,
            fixedHeight: 44,
        },
    },
});

main.sync(thumbnails);
main.mount();
thumbnails.mount();