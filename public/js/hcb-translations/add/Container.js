define([
    'dojo/_base/declare',
    'backend/layout/main/content/_ContentMixin',
    'dijit/_TemplatedMixin',
    './widget/Form',
    'dojo/text!./templates/Container.html'
], function (declare, _ContentMixin, _TemplatedMixin, Form, template) {
    return declare([
        _ContentMixin,
        _TemplatedMixin
    ], {
        templateString: template,
        formWidget: null,
        postCreate: function () {
            // summary:
            //      Creating store with data from back-end and initialize Menu widget
            //      with requested data.
            try {
                this.formWidget = this._getFormWidget();
                //                this.formWidget.reset();
                this.addChild(this.formWidget);
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },
        _getFormWidget: function () {
            try {
                return new Form();
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        },
        refresh: function () {
            try {
                this.formWidget && this.formWidget.reset();
            } catch (e) {
                console.error(this.declaredClass + ' ' + arguments.callee.nom, arguments, e);
                throw e;
            }
        }
    });
});
