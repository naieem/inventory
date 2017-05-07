Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};
var app = angular.module('inventoryHome', ['ui.bootstrap.datetimepicker']);
app.controller('homectrl', function($scope, $http) {

    // $scope.name = "dsfd";
    // $scope.hello = function() {
    //     $http({
    //         url: myAjax.ajaxurl,
    //         method: "POST",
    //         params: { action: "inventory_crud_function", name: "fgfd" }
    //     }).then(function(response) {
    //         console.log(response.data);
    //     }, function(error) {
    //         console.log(error);
    //     });
    // };
});

app.controller('userctrl', function($scope, $http) {
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
            $scope.users = response.data;
            $scope.loading = false;
        }, function(error) {
            console.log(error);
        });
    };
    $scope.delete = function(id) {
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
    $scope.get_currency();
    $scope.get_all_user();
});

app.controller('pcatctrl', function($scope, $http) {
    $scope.add_cat = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_product_cat";
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
                $scope.get_parent_category();
                $scope.get_category();
            }
        }, function(error) {
            console.log(error);
        });
    };

    $scope.get_category = function() {
        $scope.loading = true;
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
            $scope.loading = false;
        }, function(error) {
            console.log(error);
        });
    };
    $scope.delete = function(id) {
        $scope.loading = true;
        console.log(id);
        var params = {};
        params.action = "inventory_crud_function";
        params.type = "delete";
        params.table = "inv_product_cat";
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
                $scope.get_parent_category();
                $scope.get_category();
            } else if (response.data === '23000') {
                alert("you can not delete this.Because it is used in somewhere else.");
                $scope.loading = false;
            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit_cat = function(data) {
        console.log(data);
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_product_category";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);
            if (response.data == '1') {
                jQuery("#editModal").modal("hide");
                $scope.cat = [];
                $scope.get_parent_category();
                $scope.get_category();
            }
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
    $scope.get_parent_category();
    $scope.get_category();
});

app.controller('supplierctrl', function($scope, $http) {
    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_supplier";
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
                $scope.get_supplier();
            }
        }, function(error) {
            console.log(error);
        });
    };

    $scope.get_supplier = function() {
        $scope.loading = true;
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
            $scope.loading = false;
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
        params.type = "delete";
        params.table = "inv_supplier";
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
                $scope.get_supplier();
            } else if (response.data === '23000') {
                alert("you can not delete this.Because it is used in somewhere else.");
                $scope.loading = false;
            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        console.log(data);
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_supplier";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);
            if (response.data == '1') {
                jQuery("#editModal").modal("hide");
                $scope.get_supplier();
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_supplier();
});

app.controller('productctrl', function($scope, $http) {
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
            $scope.products = response.data;
            $scope.loading = false;
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
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.cat = data;
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
            for (var i = 0; i < $scope.obj.length; i++) {
                if ($scope.obj[i]['inv_product_cat_parent'] == 0) {
                    $scope.parent.push($scope.obj[i]);
                }
                if ($scope.obj[i]['inv_product_cat_parent'] != 0) {
                    $scope.children.push($scope.obj[i]);
                }
            }

            $scope.grandParent = [];
            for (var i = 0; i < $scope.parent.length; i++) {
                $scope.temparr = [];
                $scope.temparr.children = [];
                for (var j = 0; j < $scope.children.length; j++) {
                    if ($scope.parent[i]['id'] == $scope.children[j]['inv_product_cat_parent']) {
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
    $scope.get_supplier();
    $scope.get_category();
    $scope.get_parent_category();
    $scope.get_product();
});

app.controller('recipectctrl', function($scope, $http) {
    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_recipe_category";
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
                $scope.get_category();
            }
        }, function(error) {
            console.log(error);
        });
    };

    $scope.get_category = function() {
        $scope.loading = true;
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
            $scope.loading = false;
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
        params.type = "delete";
        params.table = "inv_recipe_cat";
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
                $scope.get_category();
                // },1000);

            } else if (response.data === '23000') {
                alert("you can not delete this.Because it is used in somewhere else.");
                $scope.loading = false;
            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        console.log(data);
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_recipe_category";
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
                $scope.get_category();
                // },1000);
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_category();
    // $scope.get_product();
});

app.controller('recipectrl', function($scope, $http) {
    $scope.newProducts = [];
    $scope.newReciepe = [];
    $scope.showloader=false;

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
        $scope.showloader=true;
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
                $scope.showloader=false;
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
            // if(response.data){
            //    console.log('new user adding successful');
            // }
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
        $scope.showloader=true;
        temparr.mapping = [];
        if ($scope.editProducts) {
            for (var i = 0; i < $scope.editProducts.length; i++) {
                var res = checkDuplicate('product', $scope.editProducts[i].inv_product_id_inv_product, $scope.editProducts);
                if (!res) {
                    $scope.editProducts[i].type = "product";
                } else {
                    alert("Duplicate product entry");
                    $scope.showloader=false;
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
                    $scope.showloader=false;
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
                        $scope.showloader=false;
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
            // for (var i = 0; i < arr.length; i++) {
            //     if (arr[i].inv_product_id_inv_product == id) {
            //         result = true;
            //         break;
            //     } else {
            //         result = false;
            //     }
            // }
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

app.controller('locationctrl', function($scope, $http) {
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
            $scope.locations = response.data;
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
    $scope.get_location();
});

app.controller('inventoryctrl', function($scope, $http) {
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
            console.log(response);
            $scope.locations = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
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
    $scope.show_location = '';
    $scope.change_location = function(id) {
        for (var i = 0; i < $scope.locations.length; i++) {
            if ($scope.locations[i].id == id) {
                $scope.show_location = $scope.locations[i].inv_location_name;
            }
        }
    }
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.edit_cat = data;
        for (var i = 0; i < $scope.locations.length; i++) {
            if ($scope.locations[i].id == data.inv_location_inv_location_id) {
                $scope.show_location = $scope.locations[i].inv_location_name;
            }
        }
        jQuery("#editModal").modal("show");
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
            if (response.data == '1') {
                jQuery("#editModal").modal("hide");
                // setTimeout(function () {
                $scope.get_inventory();
                // },1000);
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_inventory";
        cat.unit = '1';
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
                $scope.show_location = '';
                $scope.get_inventory();
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
    $scope.get_inventory();
});

app.controller('orderctrl', function($scope, $http) {
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
            $scope.orders = response.data;
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
            $scope.loading = false;
        });
    };
    $scope.show_location = '';
    $scope.change_customer = function(id) {
        for (var i = 0; i < $scope.customers.length; i++) {
            if ($scope.customers[i].id == id) {
                $scope.show_location = $scope.customers[i].inv_customer_name;
            }
        }
    }
    $scope.edit_modal = function(data) {
        console.log(data);
        $scope.edit_cat = data;
        for (var i = 0; i < $scope.customers.length; i++) {
            if ($scope.customers[i].id == data.inv_customer_inv_customer_id) {
                $scope.show_location = $scope.customers[i].inv_customer_name;
            }
        }
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        // var params = {};
        data.action = "inventory_crud_function";
        data.type = "update_order";
        console.log(data);
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: data
        }).then(function(response) {
            console.log(response.data);
            if (response.data == '1') {
                jQuery("#editModal").modal("hide");
                $scope.show_location = '';
                $scope.get_order();
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_order";
        // cat.unit = '1';
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
                $scope.show_location = '';
                $scope.get_order();
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
            'MMM dd yyyy - HH:mm:ss');

        return _date.toUpperCase();

    };
});
