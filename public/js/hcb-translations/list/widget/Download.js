define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dijit/_Widget',
    'dijit/_TemplatedMixin',
    'dojo/request',
    'backend/router',
    'dojo-common/response/_MessageMixin',
    'dojo-common/response/_StatusMixin',
    'dojo-common/response/_DataMixin',
    'dojo/i18n!../../nls/List'
], function (declare, lang, _Widget, _TemplatedMixin, request,
             router, _MessageMixin, _StatusMixin, _DataMixin,
             translations) {

    return declare('translations.list.Download', [
        _Widget,
        _TemplatedMixin
    ], {
        _t: translations,
        templateString: '<a href="javascript:;" data-dojo-attach-event="onClick: _click">${!_t.downloadLinkLabel}</a>',

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
                request.get(router.assemble(':id/download/package.zip', { id: this.identifier }, true),
                            {handleAs: 'json'})
                       .then(lang.hitch(this, '_onSuccess'),
                             lang.hitch(this, '_onFail'));
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },

        _onFail: function (resp) {
            try {
                var resp = new (declare([_MessageMixin, _StatusMixin]))(resp);
                console.error("Failed download resp >>>", resp);
            } catch (e) {
                 console.error(this.declaredClass+" "+arguments.callee.nom, arguments, e);
                 throw e;
            }
        },

        _onSuccess: function (resp) {
            try {
                var resp = new (declare([_MessageMixin, _StatusMixin, _DataMixin]))(resp);
                resp.optional('message');

                if (window && window.location) {
                    window.location.href = resp.getData().archive;
                }
            } catch (e) {
                 console.error(this.declaredClass+" "+arguments.callee.nom, arguments, e);
                 throw e;
            }
        }
    });
});
