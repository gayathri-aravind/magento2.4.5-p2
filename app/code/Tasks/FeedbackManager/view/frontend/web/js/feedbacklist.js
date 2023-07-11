define([
    "jquery",
    'Magento_Ui/js/modal/confirm',
    'Magento_Ui/js/modal/alert',
    'mage/translate'
], function ($, confirmation, alert, $t) {
    $('.feedback-list-table .feedback-list-table-action.feedback-list-table-action-delete a').on('click', function(e){ // On clicking the Delete link
        var self=this;
        e.preventDefault();
        confirmation({
            title: $t('Delete?'),
            content: $t('Are you sure you want to delete this feedback?'),
            actions: {
                confirm: function(){
                    //If confirmed
                    var url = $(self).attr('href');
                    // alert('URL', url);
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: url,
                        data: {},
                        beforeSend: function() {
                            $('body').trigger("processStart"); // start the loader
                        },
                        success: function (response) {
                            $('body').trigger("processStop"); // stop the loader, once the response got in success
                            $(self).closest('.feedback-list-table-row').remove(); // Remove the table row
                            alert({
                                content: response.message
                            });
                        },
                        error: function (response) {
                            $('body').trigger("processStop"); // stop the loader, in case of any error
                            alert({
                                content: $t('Something went wrong.')
                            });
                        }
                    })
                }
            }
        });
    })
});