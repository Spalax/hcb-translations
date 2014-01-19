define([], function() {
    return {
        "route": "/translations",
        "prio": 2,
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
