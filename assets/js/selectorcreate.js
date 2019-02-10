(function ($) {
    $.fn.selectOrCreate = function () {
        var toggleCreationSelection = function (container, creation) {
            container.children('.selectorcreate_selection')[(creation === false ?
                "slideDown" :
                "slideUp")](300);
            container.children('.selectorcreate_creation')[(creation === true ?
                "slideDown" :
                "slideUp")](300);
        }

        return this.each(function () {
            var container = $(this);

            container.children('.selectorcreate_selection')
                .find('select.autocomplete')
                .chosen({
                    disable_search_threshold: 10,
                    no_results_text: "{{ 'autocomplete.no_matches'|trans }}",
                    allow_single_deselect: true,
                    group_search: false,
                    display_selected_options: false,
                    include_group_label_in_selected: true
                });

            var radio = container.children('.selectorcreate_decision')
                .find('input[type=radio]');

            radio.on('change', function (e) {
                console.log("change " + $(this).attr('name'));
                var radioValue = container.children('.selectorcreate_decision')
                    .find('input[type=radio]:checked')
                    .val();
                if (radioValue) {
                    toggleCreationSelection(container, radioValue === 'create');
                }
            });
            var initialSelection = null;
            if (radio.filter(':checked').length === 1) {
                initialSelection = radio.filter(':checked').val() === 'create'
            }
            toggleCreationSelection(container, initialSelection);
        });
    };
})(jQuery);