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