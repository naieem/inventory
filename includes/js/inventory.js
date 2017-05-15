app.controller('inventoryctrl', function($scope, $http) {
    $scope.newProduct = [];
    $scope.editProduct = [];
    $scope.show_location = '';
    $scope.supplier = '';
    $scope.get_inventory = function() {
        $scope.loading = true;
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all_inventory";
        params.table = "inv_inventory";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response);
            $scope.inventories = response.data;
            $scope.loading = false;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_location = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_location";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.locations = response.data;
            /* Code for separating parent and child category */
            $scope.obj = response.data;
            $scope.parent = [];
            $scope.children = [];
            for (var i = 0; i < $scope.obj.length; i++) {
                if ($scope.obj[i]['inv_location_parent'] == 0) {
                    $scope.parent.push($scope.obj[i]);
                }
                if ($scope.obj[i]['inv_location_parent'] != 0) {
                    $scope.children.push($scope.obj[i]);
                }
            }

            $scope.grandParent = [];
            for (var i = 0; i < $scope.parent.length; i++) {
                $scope.temparr = [];
                $scope.temparr.children = [];
                for (var j = 0; j < $scope.children.length; j++) {
                    if ($scope.parent[i]['id'] == $scope.children[j]['inv_location_parent']) {
                        $scope.temparr.children.push($scope.children[j]);
                    }
                }
                $scope.temparr.push($scope.parent[i]);
                $scope.grandParent.push($scope.temparr);
            }
            console.log("parent", $scope.parent);
            console.log("children", $scope.children);
            console.log('grandParent', $scope.grandParent);
            /* Parent and child separing code end */
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_users = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all_users";
        // params.table = "";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response);
            $scope.users = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.change_location = function(id) {
        for (var i = 0; i < $scope.locations.length; i++) {
            if ($scope.locations[i].id == id) {
                $scope.show_location = $scope.locations[i].inv_location_name;
            }
        }
    }

    $scope.edit_modal = function(data) {
        $scope.loading = true;
        console.log(data);
        $scope.edit_cat = data;
        for (var i = 0; i < $scope.locations.length; i++) {
            if ($scope.locations[i].id == data.inv_location_inv_location_id) {
                $scope.show_location = $scope.locations[i].inv_location_name;
            }
        }
        var params = [];
        params.action = "inventory_crud_function";
        params.type = "get_inventory_lines";
        // params.table = "inv_product";
        params.id = data.id;
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.loading = false;
            $scope.edit_cat = data;
            $scope.editProduct = response.data;
            $scope.supplier = response.data[0].inv_supplier_inv_supplier_id;
            jQuery("#editModal").modal("show");
        }, function(error) {
            console.log(error);
        });
        // jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_inventory";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);

            if (response.data) {
                /**                
                    Repeating Data Adding:
                    - Adding lines for inventory in inventory table
                 */
                var cnt = 0;
                for (var i = 0; i < $scope.editProduct.length; i++) {
                    var arr = [];
                    arr.data = [];
                    arr.data.push($scope.editProduct[i]);
                    arr.action = "inventory_crud_function";
                    arr.type = "update_inventory_mapping_edit";
                    arr.id = data.id;
                    arr.supplier = data.supplier;
                    arr.user = data.wp_users_id_users;
                    arr.date_time = cat.inv_inventory_date;
                    arr.location = data.inv_location_inv_location_id;
                    $http({
                        url: myAjax.ajaxurl,
                        method: "POST",
                        params: arr
                    }).then(function(response) {
                        console.log(response);
                        if (response.data == '1') {
                            cnt++;
                        }
                        if (cnt == $scope.editProduct.length) {
                            $scope.showloader = false;
                            jQuery("#editModal").modal("hide");
                            $scope.cat = [];
                            $scope.show_location = '';
                            $scope.editProduct = [];
                            $scope.get_inventory();
                        }
                    }, function(error) {
                        console.log(error);
                    });
                }
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.add_element = function() {
        var obj = {
            ID: '',
            amount: '',
            unit: ''
        };
        // obj.type = "recipe";
        $scope.newProduct.push(obj);
        console.log($scope.newProduct);
    }
    $scope.add_element_edit = function(val) {
        var obj = {
            inv_recipe_id_inv_recipe: '',
            inv_order_line_qty: '',
            inv_currency_inv_currency_id: ''
        };
        $scope.editProduct.push(obj);
        console.log($scope.editProduct);
    }
    $scope.removeField = function(index) {
        $scope.newProduct.remove(index);
    }
    $scope.add = function(cat) {
        cat.action = "inventory_crud_function";
        cat.type = "add_new_inventory";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: cat
        }).then(function(response) {
            console.log(response);
            if (response.data) {
                /**                
                    Repeating Data Adding:
                    - Adding lines for inventory in inventory table
                 */
                var cnt = 0;
                for (var i = 0; i < $scope.newProduct.length; i++) {
                    var arr = [];
                    arr.data = [];
                    arr.data.push($scope.newProduct[i]);
                    arr.action = "inventory_crud_function";
                    arr.type = "update_inventory_mapping";
                    arr.id = response.data;
                    arr.supplier = cat.supplier;
                    arr.user = cat.wp_users_id_users;
                    arr.date_time = cat.inv_inventory_date;
                    arr.location = cat.inv_location_inv_location_id;
                    $http({
                        url: myAjax.ajaxurl,
                        method: "POST",
                        params: arr
                    }).then(function(response) {
                        console.log(response);
                        if (response.data == '1') {
                            cnt++;
                        }
                        if (cnt == $scope.newProduct.length) {
                            $scope.showloader = false;
                            jQuery("#newUserModal").modal('hide');
                            $scope.cat = [];
                            $scope.show_location = '';
                            $scope.newProduct = [];
                            $scope.get_inventory();
                        }
                    }, function(error) {
                        console.log(error);
                    });
                }
            }
        }, function(error) {
            // $scope.cat = [];
            console.log(error);
        });
    };
    $scope.delete = function(id) {
        $scope.loading = true;
        console.log(id);
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "delete_inventory";
        // params.table = "inv_inventory";
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
                $scope.get_inventory();
                // },1000);
            } else if (response.data === '23000') {
                alert("you can not delete this.Because it is used in somewhere else.");
                $scope.loading = false;
            }
        }, function(error) {
            console.log(error);
        });
    }
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
    $scope.get_product = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_product";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.products = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_product();
    $scope.get_supplier();
    $scope.get_location();
    $scope.get_users();
    $scope.get_units();
    $scope.get_inventory();
});
