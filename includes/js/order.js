app.controller('orderctrl', function($scope, $http) {
    $scope.show_location = '';
    $scope.showloader = false;
    $scope.newReciepe = [];
    $scope.editReciepe = [];
    $scope.get_order = function() {
        $scope.loading = true;
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all_orders";
        // params.table = "inv_";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response);
            if (response.data == "null") {
                $scope.orders = [];
            } else {
                $scope.orders = response.data;
            }
            $scope.loading = false;
        }, function(error) {
            console.log(error);
            $scope.loading = false;
        });
    };
    $scope.change_customer = function(id) {
        for (var i = 0; i < $scope.customers.length; i++) {
            if ($scope.customers[i].id == id) {
                $scope.show_location = $scope.customers[i].inv_customer_name;
            }
        }
    }
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
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.loading = true;
        $scope.edit_cat = data;
        for (var i = 0; i < $scope.customers.length; i++) {
            if ($scope.customers[i].id == data.inv_customer_inv_customer_id) {
                $scope.show_location = $scope.customers[i].inv_customer_name;
            }
        }
        var params = [];
        params.action = "inventory_crud_function";
        params.type = "get_order_lines";
        // params.table = "inv_product";
        params.id = data.inv_order_orderid;
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.loading = false;
            $scope.edit_cat = data;
            $scope.editReciepe = response.data;
            jQuery("#editModal").modal("show");
        }, function(error) {
            console.log(error);
        });
        // jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        $scope.showloader = true;
        data.action = "inventory_crud_function";
        data.type = "update_order";
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
                    - Adding lines for recipe in order table
                 */
                var cnt = 0;
                if ($scope.editReciepe.length > 0) {
                    for (var i = 0; i < $scope.editReciepe.length; i++) {
                        var arr = [];
                        arr.data = [];
                        arr.data.push($scope.editReciepe[i]);
                        arr.action = "inventory_crud_function";
                        arr.type = "update_order_mapping_while_edit";
                        arr.id = data.inv_order_orderid;

                        $http({
                            url: myAjax.ajaxurl,
                            method: "POST",
                            params: arr
                        }).then(function(response) {
                            console.log(response);
                            if (response.data == '1') {
                                cnt++;
                            }
                            if (cnt == $scope.editReciepe.length) {
                                $scope.showloader = false;
                                console.log('successful');
                                jQuery("#editModal").modal("hide");
                                $scope.cat = [];
                                $scope.show_location = '';
                                $scope.editReciepe = [];
                                $scope.get_order();
                            }
                        }, function(error) {
                            console.log(error);
                        });
                    }
                } else {
                    $scope.showloader = false;
                    console.log('successful');
                    jQuery("#editModal").modal("hide");
                    $scope.cat = [];
                    $scope.show_location = '';
                    $scope.editReciepe = [];
                    $scope.get_order();
                }
            }
        }, function(error) {
            console.log(error);
        });
    };

    $scope.add_element = function(val) {
        var obj = {
            ID: '',
            qty: '',
            currency: ''
        };
        if (val == "recipe") {
            // obj.type = "recipe";
            $scope.newReciepe.push(obj);
            console.log($scope.newReciepe);
        }
    }
    $scope.add_element_edit = function(val) {
        var obj = {
            inv_recipe_id_inv_recipe: '',
            inv_order_line_qty: '',
            inv_currency_inv_currency_id: ''
        };
        if ($scope.editReciepe != 'null') {
            if (val == "recipe") {
                $scope.editReciepe.push(obj);
                console.log($scope.editReciepe);
            }
        } else {
            $scope.editReciepe = [];
            if (val == "recipe") {
                $scope.editReciepe.push(obj);
                console.log($scope.editReciepe);
            }
        }
    }
    $scope.removeField = function(index, type) {
        if (type == 'recipe') {
            $scope.newReciepe.remove(index);
        }
    }
    $scope.removeFieldEdit = function(index, type) {
        if (type == 'recipe') {
            $scope.editReciepe.remove(index);
        }
    }
    $scope.add = function(cat) {
        $scope.showloader = true;
        console.log($scope.newReciepe.length);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_order";
        console.log(cat);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: cat
        }).then(function(response) {
            console.log(response);
            if (response.data) {
                /**                
                    Repeating Data Adding:
                    - Adding lines for recipe in order table
                 */
                var cnt = 0;
                if ($scope.newReciepe.length > 0) {
                    for (var i = 0; i < $scope.newReciepe.length; i++) {
                        var arr = [];
                        arr.data = [];
                        arr.data.push($scope.newReciepe[i]);
                        arr.action = "inventory_crud_function";
                        arr.type = "update_order_mapping";
                        arr.id = response.data;
                        $http({
                            url: myAjax.ajaxurl,
                            method: "POST",
                            params: arr
                        }).then(function(response) {
                            console.log(response);
                            if (response.data == '1') {
                                cnt++;
                            }
                            if (cnt == $scope.newReciepe.length) {
                                $scope.showloader = false;
                                console.log('successful');
                                jQuery("#newUserModal").modal('hide');
                                $scope.cat = [];
                                $scope.show_location = '';
                                $scope.newReciepe = [];
                                $scope.get_order();
                            }
                        }, function(error) {
                            console.log(error);
                        });
                    }
                } else {
                    $scope.showloader = false;
                    console.log('successful');
                    jQuery("#newUserModal").modal('hide');
                    $scope.cat = [];
                    $scope.show_location = '';
                    $scope.newReciepe = [];
                    $scope.get_order();
                }
            }
        }, function(error) {
            // $scope.cat = [];
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
            params.type = "delete_order";
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
                    $scope.get_order();
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
    $scope.get_customer = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_customer";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.customers = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_recipe = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all_recipe";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.recipes = response.data;
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
    $scope.get_recipe();
    $scope.get_supplier();
    $scope.get_customer();
    $scope.get_currency();
    $scope.get_order();
    $scope.get_location();
});
