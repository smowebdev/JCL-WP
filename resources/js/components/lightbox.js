import GLightbox from 'glightbox';
import '../../../node_modules/glightbox/dist/css/glightbox.min.css';

document.addEventListener('DOMContentLoaded', function () {
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        closeOnOutsideClick: true,
    });

    function jclClosest(elem, selector) {
        while (elem !== document.body) {
            elem = elem.parentElement;
            if (!elem) {
                return false;
            }
            var matches = typeof elem.matches == 'function' ? elem.matches(selector) : elem.msMatchesSelector(selector);
            if (matches) {
                return elem;
            }
        }
    }

    function jclHasClass(node, name) {
        return node.classList.contains(name);
    }

    document.addEventListener('click', (e) => {
        const glightboxBody = document.getElementById('glightbox-body');
        if (!glightboxBody) return;
        const lightboxImage = document.querySelector('.gslide-image img');
        console.log(!jclClosest(e.target, '.gbtn'), !jclHasClass(e.target, 'gnext'), !jclHasClass(e.target, 'gprev'), !jclClosest(e.target, '.glightbox'));
        if (
            !jclClosest(e.target, '.gbtn') &&
            !jclHasClass(e.target, 'gnext') &&
            !jclHasClass(e.target, 'gprev') &&
            !jclClosest(e.target, '.glightbox')) {
            lightbox.close();
        }
    });

})