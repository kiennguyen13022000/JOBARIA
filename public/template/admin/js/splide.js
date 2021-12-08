var splide = new Splide('#splide-slider', {
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

splide.sync(thumbnails);
splide.mount();
thumbnails.mount();


