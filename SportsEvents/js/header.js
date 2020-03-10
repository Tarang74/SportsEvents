var header = document.querySelector('.header');

(function (w) {
    w.addEventListener('scroll', function () {
        if (w.pageYOffset < 1) {
            header.classList = 'header';

        } else {
            header.classList = 'header header_bg';
        }
    })
})(window);