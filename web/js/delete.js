$(function () {
    $('body').on('click', '.delete-selection', function () {

        url = Routing.generate($(this).attr('data-action'), {id: $(this).attr('data-id')});

        $.delete = function (url, data, callback, type) {

            if ($.isFunction(data)) {
                type = type || callback,
                    callback = data,
                    data = {};
            }

            return $.ajax({
                url: url,
                type: 'DELETE',
                success: callback,
                data: data,
                contentType: type
            });
        };

        $.delete(url, function (response) {
            cont = 1;
            arr = [];
            do {
                [].forEach.call($(response), function (el) {
                    if ($(el).attr('id') === 'param' + cont) {
                        arr[cont] = $(el).attr('val');
                        cont++;
                    }
                });
            } while (cont < 6);

            bootbox.dialog({
                title: arr[1],
                message: arr[2] + response,
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-remove"></i> ' + arr[3],
                        className: "btn-primary btn-sm"
                    },
                    delete: {
                        label: '<i class="fa fa-trash-o"></i>' + arr[4],
                        className: "btn-danger btn-sm",
                        callback: function () {
                            $.delete(url, $('form[name=form]').serialize(), function (data) {
                                noty({
                                    text: data.message,
                                    type: data.type,
                                    layout: data.layout,
                                    timeout: data.time
                                });
                                var refreshId = setInterval(function () {
                                    location.href = Routing.generate(arr[5]);
                                }, data.time + 1000);
                            });
                        }
                    }
                }
            });
        });
    });
});