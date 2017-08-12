app.controller('userctrl', function($scope, $http, $rootScope, dataTableService) {
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
    $scope.edit = function(data) {
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
    }

    $scope.show_modal = function() {
        jQuery("#newUserModal").modal("show");
    }
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
                setDataTableData();
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

    /**
     * Datatable and Pagination Configuration 
     */

    function setDataTableData() {
        var Headings = ['#', 'Name', 'Email', 'Phone Number', 'Company', 'Street', 'City', 'Province', 'Postal', 'Currency', 'Country'];
        var keys;
        var includes = ['id', 'inv_customer_name', 'inv_customer_email', 'inv_customer_phone_number', 'inv_customer_company', 'inv_customer_street_address', 'inv_customer_city', 'inv_customer_province', 'inv_customer_postal_code', 'inv_currency_code', 'inv_customer_country'];

        let parents = [];
        parents.push({
            name: "inv_customer_country",
            fields: "country_name",
            arrayinfo: $scope.country
        });

        dataTableService.setTableData($scope.users, parents, includes, Headings).then(function(response) {

            console.log(response);
            $scope.tabeInfo = response;
        });

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
    }

});