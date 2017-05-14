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