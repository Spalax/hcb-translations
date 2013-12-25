define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/_base/array',
    '../../store/Translations',
    'dgrid/OnDemandGrid',
    'dgrid/extensions/ColumnHider',
    'dgrid/extensions/ColumnResizer',
    'dgrid/extensions/CompoundColumns',
    'dgrid/extensions/DijitRegistry',
    'backend/dgrid/_Selection',
    'backend/dgrid/_ListCustomRowsWidget',
    'dgrid/Keyboard',
    'dgrid/selector',
    './UpdateDialog',
    './Download',
    'put-selector/put',
    'dojo/on',
    'backend/router',
    'dojo/i18n!../../nls/List'
], function (declare, lang, array, TranslationsStore, OnDemandGrid,
             ColumnHider, ColumnResizer, CompoundColumns, DijitRegistry,
             _Selection, _ListCustomRowsWidget, Keyboard, selector,
             UpdateDialog, Download, put, on, router, translation) {
    var _store = TranslationsStore;
    return declare([
        OnDemandGrid,
        ColumnHider,
        ColumnResizer,
        Keyboard,
        CompoundColumns,
        _Selection,
        DijitRegistry,
        _ListCustomRowsWidget
    ], {
        store: _store,
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
                                var dialog = new UpdateDialog({ identifier: object.id });
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