app.controller('locationctrl', function($scope, $http, dataTableService) {

    $scope.get_location = function() {
        $scope.loading = true;
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_location";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response);
            if (response.data == "null") {
                $scope.locations = [];
            } else {
                $scope.locations = response.data;
                $scope.totalItems = $scope.locations.length;
                setDataTableData();
            }
            $scope.loading = false;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.edit_modal = function(data) {
        console.log(data);

        $scope.edit_cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_location";
        // console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);
            if (response.data == '1') {
                jQuery("#editModal").modal("hide");
                // setTimeout(function () {
                $scope.get_location();
                // },1000);
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_location";
        console.log(cat);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: cat
        }).then(function(response) {
            console.log(response);
            if (response.data === '1') {
                console.log('successful');
                jQuery("#newUserModal").modal('hide');
                $scope.cat = [];
                $scope.get_location();
            }
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
            params.table = "inv_location";
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
                    // setTimeout(function () {
                    $scope.get_location();
                    // },1000);

                } else if (response.data === '23000') {
                    alert("you can not delete this.Because it is used in somewhere else.");
                    $scope.loading = false;
                }
            }, function(error) {
                console.log(error);
            });
        }

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

    $scope.show_modal = function() {
        jQuery("#newUserModal").modal("show");
    }

    $scope.get_customer = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_customer";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.customer = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_customer();
    $scope.get_country();
    $scope.get_location();

    /**
     * Datatable and Pagination Configuration 
     */

    function setDataTableData() {
        var Headings = ['#', 'Name', 'Parent', 'Street', 'City', 'Province', 'Postal', 'Country'];
        var keys;
        var includes = ['id', 'inv_location_name', 'inv_location_parent', 'inv_location_street_address', 'inv_location_city', 'inv_location_province', 'inv_location_postal_code', 'inv_location_country'];

        let parents = [];
        parents.push({
            name: "inv_location_parent",
            fields: "inv_location_name",
            arrayinfo: $scope.locations
        }, {
            name: "inv_location_country",
            fields: "country_name",
            arrayinfo: $scope.country
        });

        dataTableService.setTableData($scope.locations, parents, includes, Headings).then(function(response) {

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