define([
    'dojo/_base/declare',
    'backend/layout/main/content/package',
    'dojo/store/JsonRest',
    'dojo/i18n!./nls/Package',
    'xstyle/css!./../../css/translations.css'
], function (declare, _Package, JsonRest, translation) {
    return declare('TranslationsPackage', [_Package], {
        defaultRoute: '/translations',
        title: translation.packageTitle
    });
});
