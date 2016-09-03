var commonProperties = {

    /**
     * Ajax Request
     *
     * @param $elem
     * @param callback
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
    },

    /**
     * Update table messages
     *
     **/
    'updateData' : function() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            url: '/get-messages',
            success: function(data) {
                var tableData = '';
                $.each(data, function (key, value) {
                    tableData += '<tr><td class="col-xs-6 col-sm-4">' + value.created +'</td><td class="col-xs-6 col-sm-8">' + value.text +'</td></tr>';
                });

                $('.table tbody').html(tableData);
            }
        });
    }
};

$(function() {

    var form = $('#chat-form');

    form.on('submit', function(e) {
        e.preventDefault();
        commonProperties.queryAjax($(this), function (data) {
            if(data === 'success') {
                commonProperties.updateData();
                $('#chat-form')[0].reset();
                form.find('.text-field').removeClass('has-error');
            } else {
                form.find('.text-field').addClass('has-error');
            }

        });

    });

    if (form.find('input[type=text]').is(":focus")) {
        alert(444);
        form.find('.form-group').removeClass('has-error');
    }

});