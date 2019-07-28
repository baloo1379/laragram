require('./bootstrap');

import bsCustomFileInput from 'bs-custom-file-input';

(function(){
    bsCustomFileInput.init();

    $('#shareModal').on('show.bs.modal', function (event) {
        let modal = $(this);
        const button = $(event.relatedTarget);
        const url = button.data('url');
        console.log(url);

        const fb = `https://www.facebook.com/dialog/share?app_id=2418427178387412&display=page&href=${encodeURIComponent(url)}&redirect_uri=${encodeURIComponent(url)}`;
        const msg = `https://www.facebook.com/dialog/send?app_id=2418427178387412&&display=page&link=${encodeURIComponent(url)}&redirect_uri=${encodeURIComponent(url)}`;
        const tw = `https://twitter.com/share?text=${encodeURIComponent('See this post on Laragram')}&url=${encodeURIComponent(url)}`;
        const mail = `mailto:?subject=${encodeURIComponent('See this post on Laragram')}&body=${encodeURIComponent('See this post on Laragram\n')}${encodeURIComponent(url)}`;
        modal.find('.modal-body #facebook').attr('href', fb);
        modal.find('.modal-body #messenger').attr('href', msg);
        modal.find('.modal-body #twitter').attr('href', tw);
        modal.find('.modal-body #email').attr('href', mail);
        modal.find('.modal-body #copy').attr('href', url);
    })

    $('#copy').click(evt => {
        evt.preventDefault();
        const url = evt.target.getAttribute('href');
        copyStringToClipboard(url);
    });
})();

function copyStringToClipboard (str) {
    // Create new element
    var el = document.createElement('textarea');
    // Set value (string to be copied)
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);
}

