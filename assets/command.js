import './styles/command.css';

jQuery(document).ready(function () {
    jQuery('.add-another-collection-widget').append(function (e) {
        let another = jQuery(jQuery(this));
        let list = jQuery(jQuery(this).attr('data-list-selector'));

        // Try to find the counter of the list or use the length of the list
        let counter = another.attr('data-widget-counter');

        // grab the prototype template
        let newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);

        // create a new list element and add it to the list
        let newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(another);
    });
});