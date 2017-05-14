app.controller('recipectrl', function($scope, $http) {
    $scope.newProducts = [];
    $scope.newReciepe = [];
    $scope.showloader = false;

    $scope.add_element = function(val) {
        var obj = {
            ID: '',
            qty: '',
            unit: '',
            type: ''
        };
        if (val == "product") {
            obj.type = "product";
            $scope.newProducts.push(obj);
            console.log($scope.newProducts);
        } else {
            obj.type = "recipe";
            $scope.newReciepe.push(obj);
            console.log($scope.newReciepe);
        }
    }
    $scope.add_element_edit = function(val) {
        var obj = {
            inv_product_has_inv_recipe_qty: '',
            inv_inventory_units_inv_inventory_units_id: '',
            type: ''
        };
        if (val == "product") {
            obj.type = "product";
            obj.inv_product_id_inv_product = '';
            if ($scope.editProducts) {
                $scope.editProducts.push(obj);
            } else {
                $scope.editProducts = [];
                $scope.editProducts.push(obj);
            }
            console.log($scope.editProducts);
        } else {
            obj.type = "recipe";
            obj.inv_recipe_inv_recipe_id = '';
            if ($scope.editReciepe) {
                $scope.editReciepe.push(obj);
            } else {
                $scope.editReciepe = [];
                $scope.editReciepe.push(obj);
            }
            console.log($scope.editReciepe);
        }
    }
    $scope.add = function(cat) {
        $scope.showloader = true;
        var temparr = {};
        temparr.mapping = [];
        var newarr = $scope.newProducts.concat($scope.newReciepe);
        temparr.mapping.push(newarr);
        temparr.recipe = cat;
        temparr.action = "inventory_crud_function";
        temparr.type = "add_new_recipe";
        console.log(temparr);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: temparr
        }).then(function(response) {
            console.log(response);
            if (response.data === '1') {
                console.log('successful');
                $scope.showloader = false;
                jQuery("#newUserModal").modal('hide');
                $scope.cat = [];
                $scope.get_recipe();
                $scope.newProducts = [];
                $scope.newReciepe = [];
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.removeField = function(index, type) {
        if (type == 'product') {
            $scope.newProducts.remove(index);
        }
        if (type == 'recipe') {
            $scope.newReciepe.remove(index);
        }
    }
    $scope.removeField_edit = function(index, type) {
        if (type == 'product') {
            $scope.editProducts.remove(index);
        }
        if (type == 'recipe') {
            $scope.editReciepe.remove(index);
        }
    }
    $scope.changeIngredients = function(arg) {
        if (arg == '1') {
            $scope.edit_cat.inv_recipe_inv_recipe_id = 0;
        } else {
            $scope.edit_cat.inv_product_id_inv_product = 0;
        }
    }
    $scope.get_recipe = function() {
        $scope.loading = true;
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all_recipe";
        // params.table = "inv_recipe";
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.recipies = response.data;
            $scope.loading = false;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };

    /**
     *
     * Parent children dropdown list
     *
     */

    $scope.get_category = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_recipe_cat";
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
            for (var i = 0; i < $scope.obj.length; i++) {
                if ($scope.obj[i]['inv_recipe_cat_parent'] == 0) {
                    $scope.parent.push($scope.obj[i]);
                }
                if ($scope.obj[i]['inv_recipe_cat_parent'] != 0) {
                    $scope.children.push($scope.obj[i]);
                }
            }

            $scope.grandParent = [];
            for (var i = 0; i < $scope.parent.length; i++) {
                $scope.temparr = [];
                $scope.temparr.children = [];
                for (var j = 0; j < $scope.children.length; j++) {
                    if ($scope.parent[i]['id'] == $scope.children[j]['inv_recipe_cat_parent']) {
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

    $scope.get_product = function() {
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "get_all";
        params.table = "inv_product";
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
    $scope.delete = function(id) {
        $scope.loading = true;
        console.log(id);
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "delete_recipe";
        params.table = "inv_recipe";
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
                setTimeout(function() {
                    $scope.get_recipe();
                }, 1000);

            } else if (response.data === '23000') {
                alert("you can not delete this.Because it is used in somewhere else.");
                $scope.loading = false;
            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.edit_modal = function(data, id) {
        $scope.loading = true;
        $scope.editProducts = [];
        $scope.editReciepe = [];
        var params = [];
        params.action = "inventory_crud_function";
        params.type = "get_recipe_mapping";
        // params.table = "inv_product";
        params.id = id;
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: params
        }).then(function(response) {
            console.log(response.data);
            $scope.loading = false;
            $scope.edit_cat = data;
            if (response.data.product != null)
                $scope.editProducts = response.data.product;
            else {
                $scope.editProducts = [];
            }
            if (response.data.recipe != null)
                $scope.editReciepe = response.data.recipe;
            else {
                $scope.editReciepe = [];
            }
            jQuery("#editModal").modal("show");
            // $scope.products = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
        // if (data.inv_recipe_inv_recipe_id == 0) {
        //     data.ingredients = '1';
        // } else {
        //     data.ingredients = '2';
        // }
        // console.log(data);
        // $scope.edit_cat = data;
        // jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        var temparr = {};
        $scope.showloader = true;
        temparr.mapping = [];
        if ($scope.editProducts) {
            for (var i = 0; i < $scope.editProducts.length; i++) {
                var res = checkDuplicate('product', $scope.editProducts[i].inv_product_id_inv_product, $scope.editProducts);
                if (!res) {
                    $scope.editProducts[i].type = "product";
                } else {
                    alert("Duplicate product entry");
                    $scope.showloader = false;
                    return false;
                }
            }
        }
        if ($scope.editReciepe) {
            for (var i = 0; i < $scope.editReciepe.length; i++) {
                var res = checkDuplicate('recipe', $scope.editReciepe[i].inv_recipe_inv_recipe_id, $scope.editReciepe);
                if (!res) {
                    $scope.editReciepe[i].type = "recipe";
                } else {
                    alert("Duplicate recipe entry");
                    $scope.showloader = false;
                    return false;
                }
            }
        }
        var newarr = $scope.editProducts.concat($scope.editReciepe);
        temparr.mapping.push(newarr);
        temparr.recipe = data;
        temparr.action = "inventory_crud_function";
        temparr.type = "update_recipe";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: temparr
        }).then(function(response) {
            console.log(response.data);

            /**            
                Adding mapping ingredients:
                - Adding product one by one
                - Adding recipe one by one
            */

            var cnt = 0;
            for (var i = 0; i < newarr.length; i++) {
                var arr = [];
                arr.data = newarr[i];
                arr.action = "inventory_crud_function";
                arr.type = "update_recipe_mapping";
                arr.id = data.id;
                $http({
                    url: myAjax.ajaxurl,
                    method: "POST",
                    params: arr
                }).then(function(response) {
                    console.log(response.data);
                    if (response.data == '1') {
                        cnt++;
                    }
                    if (cnt == newarr.length) {
                        $scope.showloader = false;
                        jQuery("#editModal").modal("hide");
                        setTimeout(function() {
                            $scope.get_recipe();
                            $scope.editProducts = [];
                            $scope.editReciepe = [];
                        }, 1000);
                    }
                }, function(error) {
                    console.log(error);
                });
            }
            /**
             *
             * Ingredients adding coding ends
             *
             */


        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_recipe();
    $scope.get_product();
    $scope.get_category();

    function checkDuplicate(type, id, arr) {
        var result = false;
        if (type == 'product') {
            var valueArr = arr.map(function(item) {
                return item.inv_product_id_inv_product
            });
            var isDuplicate = valueArr.some(function(item, idx) {
                console.log(item);
                return valueArr.indexOf(item) != idx
            });
            console.log(isDuplicate);
            return isDuplicate;
        }
        if (type == 'recipe') {
            var valueArr = arr.map(function(item) {
                return item.inv_recipe_inv_recipe_id
            });
            var isDuplicate = valueArr.some(function(item, idx) {
                console.log(item);
                return valueArr.indexOf(item) != idx
            });
            console.log(isDuplicate);
            return isDuplicate;
        }
    }
});