define([
    'dojo/_base/declare',
    'dojo/_base/array',
    'dojo/_base/lang',
    'dojo/on',
    'hc-backend/layout/main/content/_ContentMixin',
    'dijit/_TemplatedMixin',
    'dojo/text!./templates/Container.html',
    'dojo/i18n!../nls/List',
    'dojo/request',
    'hc-backend/router',
    'hcb-translations/list/widget/Grid',
    'dijit/form/Button',
    'hcb-translations/store/Translations',
    'dojo-common/dialog/ConfirmDialog',
    'dojo-common/dialog/AlertDialog'
], function (declare, array, lang, on, _ContentMixin, _TemplatedMixin,
             template, translation, request, router, Grid,
             Button, Translations, ConfirmDialog, AlertDialog) {
    return declare([
        _ContentMixin,
        _TemplatedMixin
    ], {
        templateString: template,
        baseClass: 'translationsList',
        postCreate: function () {
            try {
                var gridWidget = new Grid({ 'class': this.baseClass + 'Grid' }),
                    addWidget = new Button({
                        label: translation.addButtonLabel,
                        'class': this.baseClass + 'AddNewTranslation'
                    }),
                    delWidget = new Button({
                        label: translation.deleteButtonLabel,
                        'class': this.baseClass + 'DeleteTranslation'
                    });

                this._gridWidget = gridWidget;

                addWidget.on('click', function () {
                    router.go(router.assemble('add', {}, true));
                });

                delWidget.on('click', function (){
                    if (gridWidget.getSelectedCount() < 1) {
                        return (new AlertDialog({message: translation['alertNoRowsSelectedForDelete']})).show();
                    }

                    var dialog = new ConfirmDialog({message: translation['confirmDelete']});

                    dialog.on('ok', function () {
                        gridWidget.removeSelected();
                    });

                    dialog.show();
                });

                this.addChild(addWidget);
                this.addChild(delWidget);
                this.addChild(gridWidget);
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },

        refresh: function () {
            try {
                this._gridWidget.refresh({ keepScrollPosition: true });
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        }
    });
});
