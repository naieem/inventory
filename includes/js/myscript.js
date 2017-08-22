Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};

var app = angular.module('inventoryHome', ['ui.bootstrap.datetimepicker', 'ui.bootstrap']);
app.controller('homectrl', function($scope, $http) {
    $scope.obj = {
        name: "bal",
        title: "Chal"
    }
});

app.config([function() {
    jQuery(".select2").select2({
        allowClear: true
    });
    jQuery.curCSS = function(element, prop, val) {
        return jQuery(element).css(prop, val);
    };
}]);
/*
 *
 * Custom directive for showing parent category
 */
app.directive('parent', function() {
    return {
        restrict: 'E',
        scope: {
            arr: '=info',
            identifier: '=cid',
            field: '@field'
        },
        link: function(scope, element, attr) {
            if (scope.arr && scope.arr.length) {
                debugger;
                setTimeout(function(argument) {
                    for (var i = 0; i < scope.arr.length; i++) {
                        if (scope.arr[i].id == scope.identifier) {

                            element.html(scope.arr[i][scope.field]);
                        }
                    }

                }, 1000);
            }
        }
    };
});

/*
 *
 * Custom directive for showing parent category
 */
app.directive('validate', function() {
    return {
        restrict: 'AEC',
        link: function(scope, element, attr) {
            init();

            function init() {
                onInit();
                onEventFormvalidation('keyup');
                onEventFormvalidation('mouseover');
                disbleSubmitButton(element[0].id, true);
            }

            /**
             * Initialization and adding *
             */
            function onInit() {
                angular.forEach(element[0].children, function(element, key) {
                    if (element.children && element.children.length && element.children[1] && element.children[1].required) {
                        var oldHtml = element.children[0].innerHTML;
                        element.children[0].innerHTML = modifyHtml(oldHtml);
                    }
                });
                // var elem = document.getElementById(element[0].id);
                // var event = new Event('keyup'); // (*)
                // elem.dispatchEvent(event);
            }

            /**
             * function get called when an input field gets focused
             */
            function onEventFormvalidation(event) {
                element[0].addEventListener(event, function(elements) {
                    var store = [];
                    //var focusedElement = document.activeElement;
                    angular.forEach(elements.currentTarget, function(element, key) {
                        var lastChildOfParentNode = element.parentNode.lastElementChild;
                        var toAfterElment = element.nextSibling;
                        var parentElement = element.parentNode;
                        //var isFocusedElement = (focusedElement == element);
                        if (element.required) {
                            switch (element.type) {
                                case "text":
                                    textCheckValidator();
                                    break;

                                case "email":
                                    emailCheckValidator();
                                    break;
                                case "number":
                                    numberCheckValidator();
                                    break;

                                default:
                                    break;
                            }
                        } else {

                        }

                        /**
                         * Checking for input field type text
                         */
                        function textCheckValidator() {

                            var messageBody = '';
                            if (element.hasAttribute("required-message")) {
                                messageBody = element.getAttribute("required-message");
                            } else {
                                messageBody = 'This field is required';
                            }
                            renderErrorInformation(element.validity.valid, messageBody);
                        }

                        /**
                         * Checking for input field type number
                         */
                        function numberCheckValidator() {
                            var messageBody = '';
                            if (element.hasAttribute("required-message")) {
                                messageBody = element.getAttribute("required-message");
                            } else {
                                messageBody = 'This field is required';
                            }
                            renderErrorInformation(element.validity.valid, messageBody);
                        }

                        /**
                         * Checking for input field type email
                         */
                        function emailCheckValidator() {

                            var messageBody = '';
                            var EMAIL_REGEXP = /^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                            if (element.hasAttribute("required-message")) {
                                messageBody = element.getAttribute("required-message");
                            } else {
                                messageBody = 'Email is not valid';
                            }
                            var decision = EMAIL_REGEXP.test(element.value) ? true : false;

                            renderErrorInformation(decision, messageBody);
                        }

                        /**
                         * Rendering error message info form
                         * @param {*} isValid 
                         * @param {*} message 
                         */
                        function renderErrorInformation(isValid, message) {
                            if (!isValid) {
                                if (lastChildOfParentNode.tagName !== 'SPAN' && lastChildOfParentNode.className !== 'has-error') {
                                    var newElement = document.createElement("span");
                                    newElement.setAttribute("class", "has-error");
                                    newElement.innerHTML = message;
                                    parentElement.insertBefore(newElement, toAfterElment);
                                }
                            } else {
                                if (lastChildOfParentNode.tagName == 'SPAN' && lastChildOfParentNode.className == 'has-error') {
                                    parentElement.removeChild(toAfterElment);
                                }
                            }
                            store.push(isValid);
                        }

                    });

                    /** now searching for store array and find if any false value
                     *  if there is false value then disablesubmitbutton and go agian
                     */
                    var dcsn = _.filter(store, function(o) { return !o });
                    if (dcsn && dcsn.length > 0) {
                        disbleSubmitButton(elements.currentTarget.id, true);
                    } else {
                        disbleSubmitButton(elements.currentTarget.id, false);
                    }
                }, true);
            }

            /**
             * Disabling submit button on various input field validation
             * @param {*} action 
             */
            function disbleSubmitButton(formId, action) {
                var btn = document.querySelectorAll("#" + formId + " button");
                var elementIndex = btn.length - 1;

                if (btn[elementIndex].hasAttribute('submit-button')) {
                    if (action) {
                        btn[elementIndex].setAttribute('disabled', true);
                    } else {
                        btn[elementIndex].removeAttribute('disabled');
                    }
                }
            }

            /**
             * Function used to manupulate * for required fields
             * @param {*} oldHtml 
             */
            function modifyHtml(oldHtml) {
                var string = "<span style=\"color:red\"> *</span>";

                return oldHtml + string;
            }
        }
    };
});

app.directive('stringToNumber', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function(value) {
                return '' + value;
            });
            ngModel.$formatters.push(function(value) {
                return parseFloat(value);
            });
        }
    };
});

app.filter('datetime', function($filter) {
    return function(input) {
        if (input == null) {
            return "";
        }
        var _date = $filter('date')(new Date(input),
            'MMM dd yyyy');

        return _date.toUpperCase();

    };
});

app.directive('numbersOnly', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function(inputValue) {
                // this next if is necessary for when using ng-required on your input. 
                // In such cases, when a letter is typed first, this parser will be called
                // again, and the 2nd time, the value will be undefined
                if (inputValue == undefined) return ''
                var transformedInput = inputValue.replace(/[^0-9]/g, '');
                if (transformedInput != inputValue) {
                    modelCtrl.$setViewValue(transformedInput);
                    modelCtrl.$render();
                }

                return transformedInput;
            });
        }
    };
});

// app.directive('clientAutoComplete', ['$filter', '$timeout', clientAutoCompleteDir]);

// function clientAutoCompleteDir($filter, $timeout) {
//     return {
//         restrict: 'A',
//         link: function(scope, elem, attrs) {
//             elem.autocomplete({
//                 source: function(request, response) {

//                     //term has the data typed by the user
//                     var params = request.term;

//                     //simulates api call with odata $filter
//                     var data = scope.products;
//                     var unit = scope.units;
//                     if (data) {
//                         var result = $filter('filter')(data, params);
//                         angular.forEach(result, function(item) {
//                             //console.log(item);
//                             //scope.temp_data.push(item);
//                             var unitObj = $filter('filter')(unit, { id: item['inv_product_size_unit'] });
//                             item['value'] = item['inv_product_name'] + ' -' + item['inv_product_size'] + unitObj[0].inv_inventory_units_name;
//                         });
//                     }
//                     response(result);

//                 },
//                 minLength: 3,
//                 select: function(event, ui) {
//                     scope.$apply(function() {
//                         scope.setClientData(ui.item, attrs.uiIndex, attrs.type);
//                         // delete ui.item.value;
//                     });
//                     // $timeout(function() {
//                     //     // force a digest cycle to update the views
//                     //     console.log(scope.newProducts[attrs.uiIndex]);
//                     //     // $scope.newProducts[attrs.uiIndex]['ID']=ui.item.id;
//                     // }, 1000);

//                 },
//             });
//         }

//     };
// }


/**
 * Datatable directive declaration function 
 */
app.directive("datatable", function() {
    return {
        // require: "parent",
        restrict: 'E',
        // scope: {
        //     info: '=',
        //     country: '='
        // },
        link: function(scope, element, attrs) {
            scope.getContentUrl = function() {
                return '../wp-content/plugins/inventory/includes/templates/' + attrs.templateurl;
            }
        },
        /* dynamic controller coding */

        //controller: "@",
        //name: "controllerName",

        /* dynamic templating coding */
        template: '<div ng-include="getContentUrl()"></div>'
    }
});


/**
 * DataTable service for using in controller
 */
app.service('dataTableService', dataTableService);

dataTableService.$inject = ['$q'];

function dataTableService($q) {
    this.setTableData = setTableData;

    /**
     * Settings datatable values and other variables
     * @param {*} data [main array value of information to render]
     * @param {*} parents [array value who has parent directive to use]
     * @param {*} includes [fields which are needed to include from information array]
     * @param {*} Headings [Headings text which needs to show in header title]
     */
    function setTableData(data, parents, includes, Headings) {
        var deferred = $q.defer();
        let keys = [];
        _.forEach(includes, function(value, key, collection) {

            var obj = {};
            // if (_.indexOf(includes, key) > -1) {
            obj.name = value;
            if (parents.length > 0) {
                var p = checkParentInfo(value);
            } else {
                var p = false;
            }

            if (p) {
                obj.arrayinfo = p.arrayinfo;
                obj.parent = true;
                obj.cid = p.name;
                obj.field = p.fields;
            } else {
                obj.parent = false;
            }
            keys.push(obj);

            // }
        });
        setTableInfo();

        function checkParentInfo(key) {
            var ob = _.find(parents, { name: key });
            return ob;
        }

        function setTableInfo() {
            deferred.resolve({
                Heading: Headings,
                MainData: data,
                keys: keys
            });
        }
        return deferred.promise;
    }
}