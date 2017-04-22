// jQuery(document).ready(function() {
//     jQuery(".btn-default").click(function(e) {
//         e.preventDefault();
//         alert("hi jquery is working");
//         jQuery.ajax({
//             type: "post",
//             //dataType : "json",
//             url: myAjax.ajaxurl,
//             data: { action: "my_ajax",name:"name"},
//             success: function(data) {
//                 //if(data=='20')
//                 // var newstr = data.substring(0, data.length - 1);
//                 // jQuery("#sku").val("");
//                 // jQuery("#pur").val("");
//                 // jQuery("#sold").val("");
//                 // jQuery(".show").html(newstr).fadeIn("fast").delay(5000).fadeOut("slow");
//                 // jQuery("#sku").focus();
//                 alert(data);
//                 //else alert("not done");
//             }
//         });
//     });
// });


var app = angular.module('inventoryHome', []);
app.controller('homectrl', function($scope, $http) {
    // $http.get("welcome.htm")
    // .then(function(response) {
    //     $scope.myWelcome = response.data;
    // });

    $scope.name = "dsfd";
    $scope.hello = function() {
        $http({
            url: myAjax.ajaxurl,
            method: "POST",
            params: { action: "inventory_crud_function", name: "fgfd" }
        }).then(function(response) {
            console.log(response.data);
        }, function(error) {
            console.log(error);
        });
    };
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
        // $scope.get_all_user = function() {
        //     var params = {};
        //     params.action = "inventory_crud_function";
        //     params.type = "get_all_user";
        //     $http({
        //         url: myAjax.ajaxurl,
        //         method: "POST",
        //         params: params
        //     }).then(function(response) {
        //         console.log(response.data);
        //         $scope.users = response.data;
        //     }, function(error) {
        //         console.log(error);
        //     });
        // };
    $scope.get_category();
    // $scope.get_all_user();
});


/*
 *
 * Custom directive for showing parent category
 */
app.directive('parent', function() {
    return {
        restrict: 'E',
        scope: {
            category: '=info',
            catId:'=cid'
        },
        link: function(scope, element, attr) {
            for (var i = 0; i < scope.category.length; i++) {
               if(scope.category[i].id==scope.catId){
                  element.html(scope.category[i].inv_product_cat_name);
               }
            }
        }
    };
});
