(function ($) {
    $.fn.localisationForm = function (settings) {

        var settings = $.extend({
            // These are the defaults.
            errorMessage: "Error",
            notFoundErrorMessage: "Not Found"
        }, settings);

        return this.each(function () {
            var rootForm = $(this);

            rootForm.find('.pleiades_search').on('click', function (e) {
                e.preventDefault();
                var btn = $(this),
                    errorEl = $(this).parents('.input-group').siblings('.pleiades-error'),
                    input = $(this).parent().siblings('input[type=number]');

                if (input.val() !== "") {
                    // Display loader
                    btn.prepend($('<i class="fas fa-spinner fa-pulse mr-2"></i>'));
                    // Empty error message
                    errorEl.text('');

                    var labelId = $(this).parent().parent().parent().siblings('label').attr('id'),
                        labelSeg = labelId.split('_'),
                        fields = {};

                    // Get the fields to fill if the request is successful
                    rootForm.find('.pleiades_field').each(function () {
                        var seg = $(this).attr('id').split('_');
                        if (seg[0] == labelSeg[0] && seg[1] == labelSeg[1]) {
                            fields[seg[2]] = $(this).siblings().find('input');
                        }
                    });

                    $.getJSON("https://pleiades.stoa.org/places/" + input.val() + "/json")
                        .done(function (data) {
                            if (fields.hasOwnProperty('nom'))
                                fields.nom.attr('readonly', true).val(data.title);
                            if (fields.hasOwnProperty('longitude'))
                                fields.longitude.attr('readonly', true).val(data.reprPoint[0]);
                            if (fields.hasOwnProperty('latitude'))
                                fields.latitude.attr('readonly', true).val(data.reprPoint[1]);
                            input.attr('readonly', true);
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            var error = "{{'generic.messages.error_unknown'|trans}}";
                            if (errorThrown === "Not Found") {
                                error = "{{'generic.messages.error_not_found'|trans}}";
                            }
                            errorEl.text(error);
                            input.val('');
                        })
                        .always(function () {
                            btn.find('i').remove();
                        });
                }

                return false;
            });
            rootForm.find('.pleiades_clear').on('click', function (e) {
                e.preventDefault();
                var labelId = $(this).parent().parent().parent().siblings('label').attr('id'),
                    labelSeg = labelId.split('_');

                rootForm.find('.pleiades_field').each(function () {
                    var seg = $(this).attr('id').split('_');
                    if (seg[0] == labelSeg[0] && seg[1] == labelSeg[1]) {
                        $(this).siblings().find('input').attr('readonly', false).val('');
                    }
                });
                $(this).parent().siblings('input[type=number]').val('').attr('readonly', false);
                return false;
            });
            rootForm.find('.pleiades_view').on('click', function (e) {
                var id = parseInt($(this).parent().siblings('input[type=number]').val(), 10);
                console.log(id);
                if (Number.isNaN(id) || id == 0) {
                    e.preventDefault();
                    return false;
                }
                $(this).attr('href', "https://pleiades.stoa.org/places/" + id);
            });

            rootForm.find('.pleiades_search').each(function (i, searchButton) {
                var idField = $(searchButton).parent().siblings('input[type=number]');
                if (idField.val() !== "") {
                    var labelId = $(searchButton).parent().parent().parent().siblings('label').attr('id'),
                        labelSeg = labelId.split('_');

                    rootForm.find('.pleiades_field').each(function () {
                        var seg = $(this).attr('id').split('_');
                        if (seg[0] == labelSeg[0] && seg[1] == labelSeg[1]) {
                            $(this).siblings().find('input').attr('readonly', true);
                        }
                    });
                    idField.attr('readonly', true);
                }
            })
        });
    }
})(jQuery);