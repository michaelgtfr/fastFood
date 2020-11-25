import './styles/command.css';

jQuery(document).ready(function () {
    buttonDeleted();
    jQuery('.add-another-collection-widget').append(function () {
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

    jQuery(".button_add_product").click( function(e) {
        e.preventDefault();
        let add_product_button_id = $(this).attr("name");
        let product_quantity = document.querySelector("#detail_form_quantity_" + add_product_button_id).value;

        $.ajax({
            url: "/addShoppingCart",
            type: "POST",
            data: "id=" + add_product_button_id +
                "&quantity=" + product_quantity,
            dataType: "text",

            success(codeHtml) {
                let product_in_the_basket = JSON.parse(codeHtml);

                let existProductInTheShoppingCart = $('#shopping_class_' + add_product_button_id);
                existProductInTheShoppingCart.remove();

                let price_products = product_in_the_basket.price * product_quantity;

                jQuery(".panier_description").after("" +
                    "<div id=\"shopping_class_" + add_product_button_id + "\" class=\"product_selected row col-sm-12\">" +
                    "<p class=\"col-sm-4\">" + product_in_the_basket.name + "</p>" +
                    "<p class=\"col-sm-4\">" + price_products + "</p>" +
                    "<button id=\"delete_shopping_"+ add_product_button_id + "\" " +
                    "class=\"button_delete_shopping btn btn-warning col-sm-4\" name=\"" + add_product_button_id + "\">" +
                    "<i class=\"far fa-trash-alt\"></i></button>" +
                    "</div>"
                );
                $(this).ready(function (){
                    buttonDeleted();
                });
            },
            error(content, status) {
                console.log(content, status);
            },
        });
    });
    // function delete of button
    function buttonDeleted() {
        jQuery(".button_delete_shopping").click( function(e) {
            e.preventDefault();
            let description_part_product = $(this).parent();
            let delete_product_button_id = $(this).attr("name");

            $.ajax({
                url: "/deleteProductShoppingCart",
                type: "POST",
                data: "id=" + delete_product_button_id,
                dataType: "text",

                success() {
                    description_part_product.remove();
                },
                error(content, status) {
                    console.log(content, status);
                },
            });
        });
    }
});