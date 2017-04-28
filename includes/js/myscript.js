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
        }, function(error) {
            console.log(error);
        });
    };
    $scope.delete = function(id) {
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
                $scope.get_category();
            }
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
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.delete = function(id) {
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
                $scope.get_category();
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
                $scope.get_category();
            }
        }, function(error) {
            console.log(error);
        });
    };
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
    $scope.delete = function(id) {
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
    $scope.delete = function(id) {
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
            // if(response.data){
            //    console.log('new user adding successful');
            // }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_supplier();
    $scope.get_category();
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
    $scope.delete = function(id) {
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

    $scope.add = function(cat) {
        // console.log(cat);
        cat.action = "inventory_crud_function";
        cat.type = "add_new_recipe";
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
                $scope.get_recipe();
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.changeIngredients = function(arg) {
        if (arg == '1') {
            $scope.edit_cat.inv_recipe_inv_recipe_id = 0;
        } else {
            $scope.edit_cat.inv_product_id_inv_product = 0;
        }
    }
    $scope.get_recipe = function() {
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
                // setTimeout(function () {
                $scope.get_recipe();
                // },1000);

            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.edit_modal = function(data) {
        if (data.inv_recipe_inv_recipe_id == 0) {
            data.ingredients = '1';
        } else {
            data.ingredients = '2';
        }
        console.log(data);
        $scope.edit_cat = data;
        jQuery("#editModal").modal("show");
    }
    $scope.edit = function(data) {
        data.action = "inventory_crud_function";
        data.type = "update_recipe";
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
                $scope.get_recipe();
                // },1000);
            }
        }, function(error) {
            console.log(error);
        });
    };
    $scope.get_recipe();
    $scope.get_product();
    $scope.get_category();
});

app.controller('locationctrl', function($scope, $http) {

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

            }
        }, function(error) {
            console.log(error);
        });
    }
    $scope.get_location();
});

app.controller('inventoryctrl', function($scope, $http) {
    $scope.get_inventory = function() {
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
        cat.type = "add_new_inventory";
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
                $scope.get_inventory();
            }
        }, function(error) {
            $scope.cat = [];
            console.log(error);
        });
    };
    $scope.delete = function(id) {
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
