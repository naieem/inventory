Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};
var app;
var fileConfig = {
        "Files": [{
            "slug": "inventory-user",
            "Mainurls": [
                'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
                'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.js',
                'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.templates.js',
                'https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js',
                'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'
            ],
            "BootAppUrl": [
                window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js/initialize.js",
            ],
            "CustomUrl": [
                window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js/customer.js"
            ],
            "TemplateUrl": window.location.origin + "/inventory/wp-content/plugins/inventory/includes/templates/user.php"
        }]
    }
    // var resource = document.createElement('script');
    //     resource.async = "true";
    //     resource.src = window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js/customer.js";
    //     var script = document.getElementsByTagName('script')[0];
    //     script.parentNode.insertBefore(resource, script);
    // document.onreadystatechange = function(e) {
    //     if (document.readyState === 'complete') {
    //         debugger;
    //         //dom is ready, window.onload fires later
    //     }
    // };
window.onload = function() {
    debugger;
    console.log("page loaded");
    // var httpRequest;
    var res = window.location.search.slice(6);
    _.forEach(fileConfig.Files, function(value, key) {
        debugger;
        if (value.slug === "inventory-user") {
            debugger;
            getTemplate(value.TemplateUrl).then((successMessage) => {
                //document.getElementById("mainDiv").innerHTML = '<div ng-controller="userctrl">{{name}}</div>';
                document.getElementById("mainDiv").innerHTML = "<img src='http://localhost/inventory/wp-content/plugins/inventory/includes/images/gears.gif'>";

                includeScript(value.Mainurls).then((successMessage) => {
                    console.log("Yay! " + successMessage);
                    // setTimeout(function() {
                    //     debugger;
                    //     includeScript(value.CustomUrl).then((successMessage) => {
                    //         console.log("Yay! " + successMessage);
                    //     });
                    // }, 2000);
                    includeScript(value.BootAppUrl).then((successMessage) => {
                        console.log("Yay! " + successMessage);
                        setTimeout(function() {
                            debugger;
                            includeScript(value.CustomUrl).then((successMessage) => {
                                console.log("Yay! " + successMessage);
                                document.getElementById("mainDiv").innerHTML = httpRequest.responseText;
                            });
                        }, 1000);
                    });
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

/*----------  code handler functions  ----------*/

function getContents() {
    debugger;
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
            debugger;
            //alert();
            document.getElementById("mainDiv").innerHTML = httpRequest.responseText;
        } else {
            alert('There was a problem with the request.');
        }
    }
}

function includeScript(urls) {
    var counter = 0;
    return new Promise((resolve, reject) => {
        _.forEach(urls, function(value, key) {
            compileScript(value);
            counter++;
        });
        debugger;
        if (counter == urls.length) {
            resolve("Success!");
        }
    });

}

function compileScript(url) {
    var resource = document.createElement('script');
    //resource.async = "true";
    resource.src = url;
    var script = document.body;
    script.appendChild(resource);
}

// window.addEventListener("DOMContentLoaded", function() {
//     var httpRequest;
//     var res = window.location.search.slice(6);
//     _.forEach(fileConfig.Files, function(value, key) {
//         debugger;
//         if (value.slug === "inventory-user") {
//             debugger;
//             getTemplate(value.TemplateUrl).then((successMessage) => {
//                 document.getElementById("mainDiv").innerHTML = '<div ng-controller="userctrl">{{name}}</div>';
//                 // document.getElementById("mainDiv").innerHTML = httpRequest.responseText;

//                 includeScript(value.Mainurls).then((successMessage) => {
//                     console.log("Yay! " + successMessage);
//                     includeScript(value.CustomUrl).then((successMessage) => {
//                         console.log("Yay! " + successMessage);
//                     });
//                 });
//             }, (error) => {
//                 debugger;

//             });
//         }
//     });

//     function getTemplate(url) {
//         let Compile = new Promise((resolve, reject) => {
//             httpRequest = new XMLHttpRequest();
//             if (!httpRequest) {
//                 alert('Giving up :( Cannot create an XMLHTTP instance');
//                 return false;
//             }
//             httpRequest.onreadystatechange = function() {
//                 if (httpRequest.readyState === XMLHttpRequest.DONE) {
//                     if (httpRequest.status === 200) {
//                         debugger;
//                         resolve(httpRequest.responseText);
//                         //document.getElementById("mainDiv").innerHTML = httpRequest.responseText;
//                     } else {
//                         alert('There was a problem with the request.');
//                     }
//                 }
//             };
//             httpRequest.open('GET', url);
//             debugger;
//             httpRequest.send();
//         });
//         return Compile;

//     }

//     /*----------  code handler functions  ----------*/

//     function getContents() {
//         debugger;
//         if (httpRequest.readyState === XMLHttpRequest.DONE) {
//             if (httpRequest.status === 200) {
//                 debugger;
//                 //alert();
//                 document.getElementById("mainDiv").innerHTML = httpRequest.responseText;
//             } else {
//                 alert('There was a problem with the request.');
//             }
//         }
//     }

//     function includeScript(urls) {
//         var counter = 0;
//         let Compile = new Promise((resolve, reject) => {
//             _.forEach(urls, function(value, key) {
//                 compileScript(value);
//                 counter++;
//             });
//             if (counter == urls.length) {
//                 resolve("Success!");
//             }
//         });
//         return Compile;
//     }

//     function compileScript(url) {
//         var resource = document.createElement('script');
//         //resource.async = "true";
//         resource.src = url;
//         var script = document.body;
//         script.appendChild(resource);
//     }

// }, true);