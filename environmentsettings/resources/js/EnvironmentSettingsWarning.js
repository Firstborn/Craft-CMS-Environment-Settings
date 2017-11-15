(function($) {

    Craft.EnvironmentSettingsWarning = Garnish.Base.extend({
        init: function () {
           $('div.field.first').first().prepend('<p class="warning">These settings may be overridden by the Environment Settings configuration settings.<br/></p>');
        }
    });
})(jQuery);