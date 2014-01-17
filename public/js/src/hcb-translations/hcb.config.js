define([], function() {
    return {
        "route": "/translations",
        "modules": [{
            "route": "",
            "module": "list/Container"
        },
        {
            "route": "/add",
            "module": "add/Container"
        }]
    }
});
