<?php ?>
<div class="container" ng-app="inventoryHome" ng-controller="userctrl">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New User</button>

				<!-- Modal -->
				<div class="modal fade" id="newUserModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add new user</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Customer name</label>
										<input type="text" class="form-control" name="name" ng-model="customer.name" required>
										<span ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
									</div>

									<div class="form-group">
										<label for="email">Customer Email</label>
										<input type="email" class="form-control" name="email" ng-model="customer.email" required>
										<span ng-show="new_user.email.$touched && new_user.email.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="phonenumber">Customer Phone number</label>
										<input type="number" class="form-control" name="phone" ng-model="customer.phone" required>
										<span ng-show="new_user.phone.$touched && new_user.phone.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="company">Customer Company</label>
										<input type="text" name="company" class="form-control" ng-model="customer.company" required>
										<span ng-show="new_user.company.$touched && new_user.company.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="streat">Customer Street Address</label>
										<input type="text" class="form-control" name="street" ng-model="customer.street" required>
										<span ng-show="new_user.street.$touched && new_user.street.$invalid">This field is required.</span>
									</div>


									<div class="form-group">
										<label for="email">Customer City</label>
										<input type="text" class="form-control" name="city" ng-model="customer.city" required>
										<span ng-show="new_user.city.$touched && new_user.city.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="province">Customer Province</label>
										<input type="text" name="province" class="form-control" ng-model="customer.province" required>
										<span ng-show="new_user.province.$touched && new_user.province.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="postal">Customer Postal</label>
										<input type="text" name="postal" class="form-control" ng-model="customer.postal" required>
										<span ng-show="new_user.postal.$touched && new_user.postal.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="Country">Customer Country</label>
										<input type="text" class="form-control" name="country" ng-model="customer.country" required>
										<span ng-show="new_user.country.$touched && new_user.country.$invalid">This field is required.</span>
									</div>

									<div class="form-group">
										<label for="currency">Curerncy:</label>
										<select class="form-control" required name="currency" ng-model="customer.currency">
											<option ng-repeat="currencies in currency" ng-value=" currencies.id">{{currencies.inv_currency_code}}</option>
										</select>
										<span ng-show="new_user.currency.$touched && new_user.currency.$invalid">This field is required.</span>
									</div>

									<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="add_user(customer)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>

				<!--List of all users -->
				<h2>All Users</h2>
				<div class="table-responsive">          
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Company</th>
								<th>Street</th>
								<th>City</th>
								<th>Province</th>
								<th>Postal</th>
								<th>Currency</th>
								<th>Country</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="user in users | orderBy:'inv_customer_name'">
								<td>{{$index}}</td>
								<td>{{user.inv_customer_name}}</td>
								<td>{{user.inv_customer_email}}</td>
								<td>{{user.inv_customer_phone_number}}</td>
								<td>{{user.inv_customer_company}}</td>
								<td>{{user.inv_customer_street_address}}</td>
								<td>{{user.inv_customer_city}}</td>
								<td>{{user.inv_customer_province}}</td>
								<td>{{user.inv_customer_postal_code}}</td>
								<td>{{user.inv_currency_code}}</td>
								<td>{{user.inv_customer_country}}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>