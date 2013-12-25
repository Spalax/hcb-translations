define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dijit/_Widget',
    'dijit/_TemplatedMixin',
    'dijit/_WidgetsInTemplateMixin',
    'dojo-common/dialog/DestroyableDialog',
    'backend/router',
    '../../store/Translations',
    'dojo/i18n!../../nls/List',
    'dojo/text!./templates/UpdateForm.html',
    'dojo-common/form/FileInputAuto'
], function (declare, lang, _Widget, _TemplatedMixin, _WidgetsInTemplateMixin,
             DestroyableDialog, router, TranslationsStore, translations, updateFormTemplate) {
    var _EditLayout = declare('UpdateDialog.EditLayout', [
            _Widget,
            _TemplatedMixin,
            _WidgetsInTemplateMixin
        ], {
            templateString: updateFormTemplate,
            _t: translations,
            uploadUrl: '',
            attributeMap: {
                poUpdated: {
                    node: 'poUpdatedNode',
                    type: 'innerText'
                },
                jsUpdated: {
                    node: 'jsUpdatedNode',
                    type: 'innerText'
                }
            },
            postMixInProperties: function () {
                try {
                    this.uploadUrl = router.assemble(':id/file', { id: this.identifier }, true);
                } catch (e) {
                    console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                    throw e;
                }
            },
            refresh: function (key) {
                try {
                    var item = TranslationsStore.get(this.identifier);
                    if (item.then) {
                        item.then(lang.hitch(this, 'refresh', key));
                    }
                    switch (key) {
                    case 'js':
                        this.attr('jsUpdated', item.jsUpdatedTimestamp || this._t.uploadedNeverMessage);
                        break;
                    case 'po':
                        this.attr('poUpdated', item.poUpdatedTimestamp || this._t.uploadedNeverMessage);
                        break;
                    default:
                        this.attr('jsUpdated', item.jsUpdatedTimestamp || this._t.uploadedNeverMessage);
                        this.attr('poUpdated', item.poUpdatedTimestamp || this._t.uploadedNeverMessage);
                    }
                } catch (e) {
                    console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                    throw e;
                }
            },
            postCreate: function () {
                try {
                    this.inherited(arguments);
                    this.refresh();
                    var func = function (key) {
                        TranslationsStore.evict(this.identifier);
                        this.refresh(key);
                    };
                    this.poFileWidget.on('complete', lang.hitch(this, func, 'po'));
                    this.jsFileWidget.on('complete', lang.hitch(this, func, 'js'));
                } catch (e) {
                    console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                    throw e;
                }
            }
        });
    return declare('translations.list.UpdateDialog', [
        _Widget,
        _TemplatedMixin
    ], {
        templateString: '<a href="javascript:;" data-dojo-attach-event="onClick: _click">${!_t.uploadLinkLabel}</a>',
        _t: translations,
        postMixInProperties: function () {
            try {
                if (!this.identifier) {
                    throw 'Data must have valid set of keys';
                }
                this.inherited(arguments);
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },
        _click: function () {
            try {
                this.inherited(arguments);
                var dialog = new DestroyableDialog({ title: translations.uploadDialogTitle });
                var layout = new _EditLayout({ identifier: this.identifier });
                dialog.addChild(layout);
                dialog.show();
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        }
    });
});
