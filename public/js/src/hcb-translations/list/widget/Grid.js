define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/_base/array',
    'hcb-translations/store/Translations',
    'dgrid/OnDemandGrid',
    'dgrid/extensions/ColumnHider',
    'dgrid/extensions/ColumnResizer',
    'dgrid/extensions/CompoundColumns',
    'dgrid/extensions/DijitRegistry',
    'hc-backend/dgrid/_Selection',
    'hc-backend/dgrid/_Refresher',
    'hc-backend/dgrid/_ListCustomRowsWidget',
    'dgrid/Keyboard',
    'dgrid/selector',
    'hcb-translations/list/widget/UpdateDialog',
    'hcb-translations/list/widget/Download',
    'put-selector/put',
    'dojo/on',
    'hc-backend/router',
    'dojo/i18n!../../nls/List'
], function (declare, lang, array, TranslationsStore, OnDemandGrid,
             ColumnHider, ColumnResizer, CompoundColumns, DijitRegistry,
             _Selection, _Refresher, _ListCustomRowsWidget, Keyboard, selector,
             UpdateDialog, Download, put, on, router, translation) {

    return declare([
        OnDemandGrid,
        ColumnHider,
        ColumnResizer,
        Keyboard,
        CompoundColumns,
        _Selection,
        _Refresher,
        DijitRegistry,
        _ListCustomRowsWidget
    ], {
        store: TranslationsStore,
        columns: [
            selector({
                label: '',
                width: 40,
                selectorType: 'checkbox'
            }),
            {
                label: translation.labelId,
                field: 'id',
                hidden: true,
                sortable: true,
                resizable: false
            },
            {
                label: translation.labelCode,
                field: 'code',
                sortable: true,
                resizable: true
            },
            {
                label: translation.labelModule,
                field: 'module',
                resizable: true
            },
            {
                label: translation.labelTranslationsControl,
                resizable: false,
                children: [
                    {
                        renderCell: function (object, value, cell) {
                            try {
                                if (!object || !object.id) {
                                    return value;
                                }

                                var widget = new Download({ identifier: object.id });
                                widget.placeAt(cell);
                            } catch (e) {
                                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                                throw e;
                            }
                        }
                    },
                    {
                        renderCell: function (object, value, cell) {
                            try {
                                if (!object || !object.id) {
                                    return value;
                                }
                                var dialog = new UpdateDialog({ identifier: object.id,
                                                                hasJs: object.hasJs });
                                dialog.placeAt(cell);
                            } catch (e) {
                                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                                throw e;
                            }
                        }
                    }
                ]
            }
        ],
        loadingMessage: translation.loadingMessage,
        noDataMessage: translation.noDataMessage,
        showHeader: true,
        allowTextSelection: true
    });
});
