(function(window) {


    // angular.element(function() {
    //     angular.bootstrap(document, ['ui.bootstrap.datetimepicker', 'ui.bootstrap', 'inventoryHome']);
    // });

    app = angular.module('inventoryHome', ['ui.bootstrap.datetimepicker', 'ui.bootstrap']);
    debugger;
    app.controller('homectrl', function($scope, $http) {

    });

    app.config([function() {
        jQuery(".select2").select2({
            allowClear: true
        });
        jQuery.curCSS = function(element, prop, val) {
            return jQuery(element).css(prop, val);
        };
    }]);

    app.constant('BaseUrls', {
        "jsFiles": window.location.origin + "/inventory/wp-content/plugins/inventory/includes/js",
        "images": window.location.origin + "/inventory/wp-content/plugins/inventory/includes/images"
    });
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
                setTimeout(function(argument) {
                    for (var i = 0; i < scope.arr.length; i++) {
                        if (scope.arr[i].id == scope.identifier) {
                            element.html(scope.arr[i][scope.field]);
                        }
                    }

                }, 1000);
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

    app.directive('clientAutoComplete', ['$filter', '$timeout', clientAutoCompleteDir]);

    function clientAutoCompleteDir($filter, $timeout) {
        return {
            restrict: 'A',
            link: function(scope, elem, attrs) {
                elem.autocomplete({
                    source: function(request, response) {

                        //term has the data typed by the user
                        var params = request.term;

                        //simulates api call with odata $filter
                        var data = scope.products;
                        var unit = scope.units;
                        if (data) {
                            var result = $filter('filter')(data, params);
                            angular.forEach(result, function(item) {
                                //console.log(item);
                                //scope.temp_data.push(item);
                                var unitObj = $filter('filter')(unit, { id: item['inv_product_size_unit'] });
                                item['value'] = item['inv_product_name'] + ' -' + item['inv_product_size'] + unitObj[0].inv_inventory_units_name;
                            });
                        }
                        response(result);
                    },
                    minLength: 3,
                    select: function(event, ui) {
                        scope.$apply(function() {
                            scope.setClientData(ui.item, attrs.uiIndex, attrs.type);
                            // delete ui.item.value;
                        });
                        // $timeout(function() {
                        //     // force a digest cycle to update the views
                        //     console.log(scope.newProducts[attrs.uiIndex]);
                        //     // $scope.newProducts[attrs.uiIndex]['ID']=ui.item.id;
                        // }, 1000);

                    },
                });
            }

        };
    }
    debugger;
})(window);