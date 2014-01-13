define([
    'dojo/_base/declare',
    'hc-backend/layout/main/content/package',
    'dojo/i18n!./nls/Package',
    'xstyle/css!./css/translations.css'
], function (declare, _Package, translation) {
    return declare('TranslationsPackage', [_Package], {
        title: translation.packageTitle
    });
});
