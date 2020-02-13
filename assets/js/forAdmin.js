jQuery(document).ready(function () {
    var $wrapper = $('.js-genus-scientist-wrapper');
    $wrapper.on('click', '.js-remove-scientist', function (e) {
        e.preventDefault();
        $(this).closest('.js-genus-scientist-item')
            .fadeOut()
            .remove();
    });
});
let radio = document.getElementsByName('radioName')
for (let i = 0; i < radio.length; i++) {
    radio[i].onclick = function () {
        removeValue()
        document.getElementById('articles_imgArticles_' + i + '_general').value = 1
//                console.log(222, radio[i].value)
    }
}

function removeValue() {
    for (let i = 0; i < radio.length; i++) {
        document.getElementById('articles_imgArticles_' + i + '_general').removeAttribute('value')
    }
}

jQuery(document).ready(function () {
    jQuery('.add-another-collection-widget').click(function (e) {
        var list = jQuery(jQuery(this).attr('data-list-selector'));
        // Try to find the counter of the list or use the length of the list
        var counter = list.data('widget-counter') || list.children().length;

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);

        // create a new list element and add it to the list
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    });
});