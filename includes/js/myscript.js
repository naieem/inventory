Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};

var app = angular.module('inventoryHome', ['ui.bootstrap.datetimepicker', 'ui.bootstrap']);
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
        restrict: 'EA',
        link: function(scope, elem, attrs) {
            elem.autocomplete({
                source: function(request, response) {

                    //term has the data typed by the user
                    var params = request.term;

                    //simulates api call with odata $filter
                    var data = scope.products;
                    if (data) {
                        var result = $filter('filter')(data, { inv_product_name: params });

                        angular.forEach(result, function(item) {
                            //console.log(item);
                            //scope.temp_data.push(item);
                            item['value'] = item['inv_product_name'];
                        });
                    }
                    response(result);

                },
                minLength: 1,
                select: function(event, ui) {
                    //console.log(elem[0].value);
                    $timeout(function() {
                        // force a digest cycle to update the views
                        scope.$apply(function() {
                            scope.setClientData(ui.item);
                        });
                    }, 1000);

                },
            });
        }

    };
}
