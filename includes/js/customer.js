(function(window) {
    debugger;
    // alert("hello world");
    // setTimeout(function() {
    //     document.getElementById("mainDiv").innerHTML = `
    //     <div  ng-app="inventoryHome" ng-controller="userctrl">
    //     {{name}}
    //     </div>
    //     `;
    // }, 2000);
    console.log(window);
    // app.controller('userctrl', function($scope) {
    //     $scope.name = "fs";
    //     debugger;
    //     //$scope.$apply();
    //     // angular.module('ui.bootstrap.datetimepicker')
    //     //     .run(function() {
    //     //         debugger;
    //     //     });

    // });

    window.app.controller('userctrl', function($timeout, $scope, $http, BaseUrls) {
        debugger;
        $scope.BaseUrls = BaseUrls;
        console.log(BaseUrls);
        $scope.add_user = function(customer) {
            // console.log(customer);
            customer.action = "inventory_crud_function";
            customer.type = "add_new_user";
            console.log(customer);
            $http({
                url: myAjax.ajaxurl,
                method: "POST",
                params: customer
            }).then(function(response) {
                console.log(response.data);
                if (response.data === '1') {
                    console.log('new user adding successful');
                    jQuery("#newUserModal").modal('hide');
                    $scope.get_all_user();
                }
            }, function(error) {
                console.log(error);
            });
        };

        $scope.edit_modal = function(data) {
            console.log(data);
            $scope.customer = data;
            jQuery("#editModal").modal("show");
        }

        $scope.add_modal = function() {
            jQuery("#newUserModal").modal("show");
        }

        $scope.edit = function(data) {
            debugger;
            data.action = "inventory_crud_function";
            data.type = "update_customer";
            console.log(data);
            $http({
                url: myAjax.ajaxurl,
                method: "POST",
                params: data
            }).then(function(response) {
                console.log(response.data);
                if (response.data == '1') {
                    jQuery("#editModal").modal("hide");
                    // setTimeout(function () {
                    $scope.get_all_user();
                    // },1000);
                }
            }, function(error) {
                console.log(error);
            });
        };

        $scope.get_currency = function() {
            var params = {};
            params.action = "inventory_crud_function";
            params.type = "get_currency";
            $http({
                url: myAjax.ajaxurl,
                method: "POST",
                params: params
            }).then(function(response) {
                console.log(response.data);
                $scope.currency = response.data;
                // if(response.data){
                //    console.log('new user adding successful');
                // }
            }, function(error) {
                console.log(error);
            });
        };

        $scope.get_country = function() {
            var params = {};
            params.action = "inventory_crud_function";
            params.type = "get_country";
            $http({
                url: myAjax.ajaxurl,
                method: "POST",
                params: params
            }).then(function(response) {
                console.log(response.data);
                $scope.country = response.data;
                // if(response.data){
                //    console.log('new user adding successful');
                // }
            }, function(error) {
                console.log(error);
            });
        };
        $scope.get_all_user = function() {
            $scope.loading = true;
            var params = {};
            params.action = "inventory_crud_function";
            params.type = "get_all_user";
            $http({
                url: myAjax.ajaxurl,
                method: "POST",
                params: params
            }).then(function(response) {
                console.log(response.data);
                if (response.data == "null") {
                    $scope.users = [];
                } else {
                    $scope.users = response.data;
                }
                $scope.loading = false;
            }, function(error) {
                console.log(error);
            });
        };
        $scope.delete = function(id) {
            var DeleteConfirmation = confirm("Do you wish to proceed?");
            if (DeleteConfirmation == true) {
                $scope.loading = true;
                console.log(id);
                var params = {};
                params.action = "inventory_crud_function";
                params.type = "delete";
                params.table = "inv_customer";
                params.id = id;
                $http({
                    url: myAjax.ajaxurl,
                    method: "POST",
                    params: params
                }).then(function(response) {
                    console.log(response.data);
                    // $scope.delete = response.data;
                    if (response.data === '1') {
                        console.log('successful');
                        $scope.get_all_user();
                    } else if (response.data === '23000') {
                        alert("you can not delete this.Because it is used in somewhere else.");
                        $scope.loading = false;
                    }
                }, function(error) {
                    console.log(error);
                });
            }

        }
        $scope.get_country();
        $scope.get_currency();
        $scope.get_all_user();
        // $timeout(function() {
        //     $scope.$apply();
        // }, 1000);
    });

    setTimeout(function() {
        debugger;
        angular.element(function() {
            angular.bootstrap(document, ['inventoryHome']);
        });
    }, 1000);
})(window);