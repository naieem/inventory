Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};

var fileConfig = {
    "Mainurls": [
        'https://code.jquery.com/ui/1.8.16/jquery-ui.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js',
        'https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.js',
        'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.templates.js',
        'https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js',
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'
    ],
    "BootAppUrl": [
        window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js/initialize.js"
    ],
    "BaseStyleSheet": [
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',
        'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css',
        'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/css/datetimepicker.css'
    ],
    "Files": [{
        "slug": "inventory-user",
        "CustomUrl": [
            window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js/customer.js"
        ],
        "TemplateUrl": window.location.origin + "/inventory/wp-content/plugins/inventory/includes/templates/user.php"
    }]
}
window.onload = function() {
    debugger;
    console.log("page loaded");
    // var httpRequest;
    var res = window.location.search.slice(6);
    _.forEach(fileConfig.Files, function(value, key) {
        debugger;
        if (value.slug === res) {
            debugger;
            getTemplate(value.TemplateUrl).then((successMessage) => {
                document.body.className += " loading";
                loadStyles(fileConfig.BaseStyleSheet).then((result) => {
                    console.log("Stylesheets loaded");
                }, (error) => {

                });
                // loading Mainurls
                loadScript(fileConfig.Mainurls).then((result) => {
                    console.log("success loading main urls");
                    if (result === 'success') {
                        /** loading bootapps */
                        loadScript(fileConfig.BootAppUrl).then((resultbootapp) => {
                            console.log("success loading bootapps");
                            if (resultbootapp === 'success') {
                                /** loading fire apps according to page  */
                                setTimeout(function() {
                                    loadScript(value.CustomUrl).then((customapp) => {
                                        console.log("success loading customapp");
                                        if (customapp === 'success') {
                                            document.getElementById("mainDiv").innerHTML = successMessage;
                                            bootStrappingAngular();
                                        }
                                    }, (error) => {
                                        console.log();
                                    });
                                }, 1000);
                            }
                        }, (error) => {
                            console.log();
                        });
                    }
                }, (error) => {
                    console.log();
                });
            }, (error) => {
                debugger;

            });
        }
    });
};

var httpRequest;

function getTemplate(url) {
    let Compile = new Promise((resolve, reject) => {
        httpRequest = new XMLHttpRequest();
        if (!httpRequest) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    debugger;
                    resolve(httpRequest.responseText);
                    //document.getElementById("mainDiv").innerHTML = httpRequest.responseText;
                } else {
                    alert('There was a problem with the request.');
                }
            }
        };
        httpRequest.open('GET', url);
        debugger;
        httpRequest.send();
    });
    return Compile;

}

/**
 * name:loadScript.
 * type:function.
 * description:
      This function takes an array of files url and loads
      files the dom.After loading the files in the dom it returns a promise
      and sends for furthur use.
 * @param {urls to load in the dom}.
 * return: single promise after loading all files in the dom.
 * return message:'success'.
 */

function loadScript(urls) {
    debugger;
    let Compile = new Promise((resolve, reject) => {
        debugger;
        startLoading(urls);
        /** iterate through urls and load in dom */
        function startLoading(urls) {
            var scr = document.createElement('script');
            scr.onload = handleLoad;
            scr.onreadystatechange = handleReadyStateChange;
            scr.onerror = handleError;
            scr.src = urls[0];
            document.body.appendChild(scr);

            /** this function is called when file finished loading from server */
            function handleLoad() {
                console.log(urls[0], 'loaded');
                debugger;
                urls = _.remove(urls, function(value, index, array) {
                    if (!index == 0)
                        return value;
                });
                if (urls.length) {
                    debugger;
                    startLoading(urls);
                } else {
                    debugger;
                    resolve('success');
                }
            }

            function handleReadyStateChange() {
                var state;
                state = scr.readyState;
                debugger;

                if (state === "complete") {
                    console.log(urls, 'loaded successfully from ready state');
                }

            }

            function handleError() {
                console.log(urls, 'loading error');
            }
        }
    });
    return Compile;
}


/**
 * name:loadStyles.
 * type:function.
 * description:
      This function takes an array of css files url and loads
      files the dom.After loading the files in the dom it returns a promise
      and sends for furthur use.
 * @param {urls to load in the dom}.
 * return: single promise after loading all files in the dom.
 * return message:'success'.
 */

function loadStyles(urls) {
    debugger;
    let Compile = new Promise((resolve, reject) => {
        debugger;
        startLoading(urls);
        /** iterate through urls and load in dom */
        function startLoading(urls) {

            var head = document.getElementsByTagName('head')[0];
            var scr = document.createElement('link');
            scr.onload = handleLoad;
            scr.onreadystatechange = handleReadyStateChange;
            scr.onerror = handleError;
            scr.rel = 'stylesheet';
            scr.type = 'text/css';
            scr.href = urls[0];
            head.appendChild(scr);

            /** this function is called when file finished loading from server */
            function handleLoad() {
                console.log(urls[0], 'loaded');
                debugger;
                urls = _.remove(urls, function(value, index, array) {
                    if (!index == 0)
                        return value;
                });
                if (urls.length) {
                    debugger;
                    startLoading(urls);
                } else {
                    debugger;
                    resolve('success');
                }
            }

            function handleReadyStateChange() {
                var state;
                state = scr.readyState;
                debugger;

                if (state === "complete") {
                    console.log(urls, 'loaded successfully from ready state');
                }

            }

            function handleError() {
                console.log(urls, 'loading error');
            }
        }
    });
    return Compile;
}


function bootStrappingAngular() {
    setTimeout(function() {
        angular.element(function() {
            angular.bootstrap(document, ['inventoryHome']);
        });
        document.body.className = document.body.className.replace("loading", "");
    }, 1000);
}