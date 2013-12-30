define([
    'dojo/_base/declare',
    'dojo-common/store/JsonRest',
    'dojo/store/Cache',
    'dojo/store/Memory',
    'dojo/store/Observable'
], function (declare, JsonRest, Cache, Memory, Observable) {
    return Observable(Cache(JsonRest({
        target: '/superman/translations/modules',
        idProperty: 'id'
    }), Memory()));
});
