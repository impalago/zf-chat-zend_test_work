var commonProperties = {

    /**
     * Ajax Request
     *
     * @param $elem
     * @param callback
     * @param data
     **/
    'queryAjax' : function($elem, callback) {
        $.ajax({
            type: $elem.attr('method'),
            url: $elem.attr('action'),
            data: $elem.serialize(),
            success: function(data) {
                if(typeof callback === 'function') {
                    callback(data);
                } else {
                    location.reload();
                }
            }
        });
    }

};

$(function() {

    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        commonProperties.queryAjax($(this), function (data) {
            console.log(data);
            $('#chat-form')[0].reset();
        });

    });

});