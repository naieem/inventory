(function() {
    'use strict';

    app.controller('userctrl', userctrl);

    userctrl.$inject = ['$timeout', '$scope', '$http', 'BaseUrls'];

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
                $scope.totalItems = $scope.users.length;
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
    }
    $scope.get_country();
    $scope.get_currency();
    $scope.get_all_user();
    /*----------  Pagination config area  ----------*/

    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;
    $scope.maxSize = 15; //Number of pager buttons to show
    $scope.viewby = 10;
    $scope.pageChanged = function() {
        console.log('Page changed to: ' + $scope.currentPage);
    };
    $scope.setItemsPerPage = function(num) {
        $scope.itemsPerPage = num;
        $scope.currentPage = 1; //reset to first page
    }
});