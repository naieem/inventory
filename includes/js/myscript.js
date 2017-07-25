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
        if (value.slug === res) {
            debugger;
            getTemplate(value.TemplateUrl).then((successMessage) => {
                //document.getElementById("mainDiv").innerHTML = '<div ng-controller="userctrl">{{name}}</div>';
                document.body.className += " loading";
                //document.getElementById("mainDiv").innerHTML = "<img src='http://localhost/inventory/wp-content/plugins/inventory/includes/images/gears.gif'>";
                debugger;
                console.log("before main");
                includeScript(value.Mainurls);
                console.log("after main");
                debugger;
                console.log("before bott");
                includeScript(value.BootAppUrl);
                console.log("after boot");
                debugger;
                console.log("before custom");
                setTimeout(function() {
                    includeScript(value.CustomUrl);
                    console.log("before data load");
                    document.getElementById("mainDiv").innerHTML = successMessage;
                    setTimeout(function() {
                        document.body.className = document.body.className.replace("loading", "");
                    }, 1000);
                }, 1000);
                console.log("after custom");
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

function includeScript(urls) {
    debugger;
    var counter = 0;
    var resource = document.createElement('script');
    //resource.async = "true";
    resource.src = urls[0];
    var script = document.body;
    script.appendChild(resource);
    urls = _.remove(urls, function(value, index, array) {
        if (!index == 0)
            return value;
    });
    if (urls.length) {
        debugger;
        includeScript(urls);
    } else {
        console.log("input ses");
        return true;
    }
}

// function compileScript(url) {
//     var resource = document.createElement('script');
//     //resource.async = "true";
//     resource.src = url;
//     var script = document.body;
//     script.appendChild(resource);
// }

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