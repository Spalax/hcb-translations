define([
    'dojo/_base/declare',
    'dijit/form/Form',
    'dijit/_WidgetsInTemplateMixin',
    'dojo/text!./templates/Form.html',
    'dojo/i18n!../../nls/Add',
    'hc-backend/component/form/_ResourceSaverMixin',
    'hc-backend/component/form/_EnterKeyMixin',
    'hcb-translations/store/Modules',
    'hcb-translations/store/Translations',
    'dijit/form/TextBox',
    'dijit/form/FilteringSelect',
    'dijit/form/ValidationTextBox',
    'dijit/form/Button',
    'dojo-common/form/BusyButton'
], function (declare, Form, _WidgetsInTemplateMixin, template, translation, _ResourceSaverMixin, _EnterKeyMixin,
             ModulesStore, TranslationsStore) {
    return declare([
        Form,
        _ResourceSaverMixin,
        _EnterKeyMixin,
        _WidgetsInTemplateMixin
    ], {
        templateString: template,
        _t: translation,
        postCreate: function () {
            try {
                this.moduleWidget.attr('store', ModulesStore);
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },
        _getPersister: function () {
            try {
                return TranslationsStore;
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        }
    });
});
