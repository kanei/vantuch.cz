jQuery(document).ready(function ($) {
    
    // Capture click event to form POST request of data
    $('#extendSchema').click(function (e) {
        
        e.preventDefault();
        var data = { 
            resourceURI: $('#resourceURI').val(),
            resourceData: $('#resourceData').val() 
        }
        $.SchemaAppForm('https://app.schemaapp.com/importpost', data, 'POST').submit();

    });
    
    $.extend({
        SchemaAppForm: function (url, data, method) {
            if (method == null)
                method = 'POST';
            if (data == null)
                data = {};

            var form = $('<form>').attr({
                method: method,
                action: url,
                target: '_blank'
            }).css({
                display: 'none'
            });

            var addData = function (name, data) {
                if ($.isArray(data)) {
                    for (var i = 0; i < data.length; i++) {
                        var value = data[i];
                        addData(name + '[]', value);
                    }
                } else if (typeof data === 'object') {
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            addData(name + '[' + key + ']', data[key]);
                        }
                    }
                } else if (data != null) {
                    form.append($('<input>').attr({
                        type: 'hidden',
                        name: String(name),
                        value: String(data)
                    }));
                }
            };

            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    addData(key, data[key]);
                }
            }
            
            return form.appendTo('body');
        }
    });
});