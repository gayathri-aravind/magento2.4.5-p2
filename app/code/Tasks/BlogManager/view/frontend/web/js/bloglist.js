define([
    "jquery",
    'mage/translate'
], function ($, $t) {
    $('.blog-list-table .blog-list-table-action.blog-list-table-action-delete a').on('click', function(e){
        var self=this;
        e.preventDefault();
        var url = $(self).attr('href');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: {},
            beforeSend: function() {
                $('body').trigger("processStart");
            },
            success: function (response) {
                $('body').trigger("processStop");
                $(self).closest('.blog-list-table-row').remove();
            },
            error: function (response) {
                $('body').trigger("processStop");
            }
        })
    })
});