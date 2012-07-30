$(function () {
    $('#analyze').click(function() {
        $('#form').attr('action', 'analyze');
        $('#form').submit();
    });

    $('#clean').click(function() {
        $('#form').attr('action', 'clean');
        $('#form').submit();
    });

    if ($('#code').length) {
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            matchBrackets: true,
            lineWrapping: true,
            mode: 'php'
        });
    }

    if ($('#contributors').length) {
        $.ajax({
            url: 'https://api.github.com/repos/klaussilveira/PHPHint/contributors',
            dataType: 'jsonp',
            success: function(data) {
                var items = [];

                $.each(data.data, function(key, val) {
                    items.push('<li><a href="' + val.url + '" rel="avatarover" data-placement="top" data-title="' + val.login + '" data-content="' + val.login + ' has made ' + val.contributions + ' contributions to PHPHint"><img src="' + val.avatar_url + '" width="32" height="32" /></a></li>');
                });

                $('<ul/>', {
                    'class': 'contributor-list',
                    html: items.join('')
                }).appendTo('#contributors');
                $('[rel=avatarover]').popover();
            }
        });
    }
});
