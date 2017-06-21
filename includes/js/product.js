app.controller('productctrl', function($scope, $http, $timeout) {

    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_product";
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
                $scope.get_product();
            }
        }, function(error) {
            console.log(error);
        });
    };

    $scope.get_product = function() {
        $scope.loading = true;
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_product";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            if (response.data == "null") {
                $scope.products = [];
            } else {
                $scope.products = response.data;
                $scope.totalItems = $scope.products.length;
                $scope.currentPage = 1;
                $scope.itemsPerPage = 10;
                $scope.maxSize = 15; //Number of pager buttons to show
                $scope.viewby = 10;
            }
            $scope.loading = false;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
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
            params.table = "inv_product";
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
                    $scope.get_product();
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
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.edit_cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        console.log(data);
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_product";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);
            if (response.data == '1') {
                $scope.cat = {};
                jQuery("#editModal").modal("hide");
                // setTimeout(function () {
                $scope.get_product();
                // },1000);
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_supplier = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_supplier";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.suppliers = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_category = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_product_category";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.categories = response.data;
            /* Code for separating parent and child category */
            $scope.obj = response.data;
            $scope.parent = [];
            $scope.children = [];
            $scope.grandParent = [];
            for (var i = 0; i < $scope.obj.length; i++) {
                if ($scope.obj[i]['inv_product_cat_parent'] == 0) {
                    if ($scope.parent.indexOf($scope.obj[i]['id']) == -1) {
                        $scope.parent.push($scope.obj[i]['id']);
                    }
                }
                if ($scope.obj[i]['inv_product_cat_parent'] != 0) {
                    if ($scope.parent.indexOf($scope.obj[i]['inv_product_cat_parent']) == -1) {
                        $scope.parent.push($scope.obj[i]['inv_product_cat_parent']);
                    }
                    $scope.children.push($scope.obj[i]);
                }
            }

            for (var i = 0; i < $scope.obj.length; i++) {
                if ($scope.parent.indexOf($scope.obj[i]['id']) !== -1) {
                    console.log($scope.obj[i]['id'] + "id there");
                    $scope.grandParent.push($scope.obj[i]);
                }
            }
            for (var i = 0; i < $scope.grandParent.length; i++) {
                $scope.grandParent[i].children=[];
                debugger;
                for (var j = 0; j < $scope.obj.length; j++) {
                    if($scope.grandParent[i]['id'] == $scope.obj[j]['inv_product_cat_parent']){
                       $scope.grandParent[i].children.push($scope.obj[j]); 
                    }
                }
            }


            // $scope.grandParent = [];
            // for (var i = 0; i < $scope.parent.length; i++) {
            //     $scope.temparr = [];
            //     $scope.temparr.children = [];
            //     for (var j = 0; j < $scope.children.length; j++) {
            //         if ($scope.parent[i]['id'] == $scope.children[j]['inv_product_cat_parent']) {
            //             $scope.temparr.children.push($scope.children[j]);
            //         }
            //     }
            //     $scope.temparr.push($scope.parent[i]);
            //     $scope.grandParent.push($scope.temparr);
            // }
            console.log("parent", $scope.parent);
            console.log("children", $scope.children);
            console.log('grandParent', $scope.grandParent);
            /* Parent and child separing code end */
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_parent_category = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_product_category_parent";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.parentCategories = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_units = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = 'inv_inventory_units';
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log('units', response.data);
            $scope.units = response.data;
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
    $scope.get_currency = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_currency";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.currencies = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_country();
    $scope.get_units();
    $scope.get_supplier();
    $scope.get_category();
    $scope.get_currency();
    $scope.get_product();

    /*----------  Pagination config area  ----------*/
    $scope.pageChanged = function() {
        console.log('Page changed to: ' + $scope.currentPage);
    };
    $scope.setItemsPerPage = function(num) {
        $scope.itemsPerPage = num;
        $scope.currentPage = 1; //reset to first page
    }
});
