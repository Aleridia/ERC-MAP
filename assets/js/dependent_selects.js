(function ($) { //Appelé dans app.js qui est appellé par tout le monde. Donc ça s'applique à tous ?
    $.fn.dependentSelects = function (settings) { //Le plugin des box combo

        var settings = $.extend({
            // These are the defaults.
        }, settings); //Il fusionne deux objets, le 2 dans le 1. Avec un seul objet, il se prend lui-même en 1
        if (!settings.hasOwnProperty('data_url')) {// vérifie si la propriété 'data_url' existe
            throw "Data URL was not specified";
        }

        return this.each(function () {
            var selectFirst = $(this).find('select').first(),
                selectLast = $(this).find('select').last();


            selectLast.attr('disabled', (selectFirst.val() == ""))
                .trigger('chosen:updated');

            selectFirst.on('change', function () {
                var me = $(this);
                if (me.val() == "" || me.val() == null) {
                    selectLast.html('');
                    selectLast.attr('disabled', true);
                    if (selectLast.hasClass('autocomplete')) {
                        selectLast.trigger('chosen:updated');
                    }
                    return;
                }
                $.getJSON({
                    url: settings.data_url,
                    data: {
                        parentId: me.val()
                    },
                    success: function (rows) {
                        selectLast.html('');
                        selectLast.append('<option value selected></option>');
                        $.each(rows, function (key, row) {
                            selectLast.append('<option value="' + row.id + '">' + row.name + '</option>');
                        });
                        selectLast.attr('disabled', rows.length == 0);
                        if (selectLast.hasClass('autocomplete')) {
                            selectLast.trigger('chosen:updated');
                        }
                        selectFirst.trigger('dependent:updated');
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
        });
    }
})(jQuery); //Transtype en JQuery car cela doit rendre un objet JQuery