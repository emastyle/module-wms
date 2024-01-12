define([
    'jquery',
    'Magento_Ui/js/modal/alert'
], function ($, alert) {
    var formSubmit = function (config, sku) {
        var postData = {
            sku: sku
        };
        var title = $.mage.__('Fail!');
        $.ajax({
            url: config.postUrl,
            type: 'post',
            dataType: 'json',
            data: postData,
            showLoader: true
        }).done(function (response) {
            if (response.status && response.qty !== null) {
                title = $.mage.__('Success!');
                $('input[name="product\\[quantity_and_stock_status\\]\\[qty\\]"]').val(response.qty).change();
            }
            alert({
                title: title,
                content:response.message,
                buttons: [{
                    text: $.mage.__('OK'),
                    class: 'action-primary action-accept',
                    click: function () {
                        this.closeModal(true);
                    }
                }]
            });
        });
    };

    return function (config, element) {
        $(element).on('click', function () {
            formSubmit(config, $(this).data('sku'));
        });
    }
});
