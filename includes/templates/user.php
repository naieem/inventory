<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
	.error{
		color: red;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="userctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" ng-click="show_modal()">Add New Customer</button>
			<!-- Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new customer</h4>
						</div>
						<div class="modal-body">
							<form name="new_user" id="new_user" validate>
								<div class="form-group">
									<label for="name">Customer name</label>
									<input type="text" class="form-control" name="name" ng-model="customer.name" required>
								</div>

								<div class="form-group">
									<label for="email">Customer Email</label>
									<input type="email" class="form-control" name="email" ng-model="customer.email" required>
									</div>
								<div class="form-group">
									<label for="phonenumber">Customer Phone number</label>
									<input type="number" class="form-control" name="phone" ng-model="customer.phone" required>
									</div>
								<div class="form-group">
									<label for="company">Customer Company</label>
									<input type="text" name="company" class="form-control" ng-model="customer.company" required>
									</div>
								<div class="form-group">
									<label for="streat">Customer Street Address</label>
									<input type="text" class="form-control" name="street" ng-model="customer.street" required>
									</div>


								<div class="form-group">
									<label for="email">Customer City</label>
									<input type="text" class="form-control" name="city" ng-model="customer.city" required>
								</div>
								<div class="form-group">
									<label for="province">Customer Province</label>
									<input type="text" name="province" class="form-control" ng-model="customer.province" required>
								</div>
								<div class="form-group">
									<label for="postal">Customer Postal</label>
									<input type="text" name="postal" class="form-control" ng-model="customer.postal" required>
								</div>
								<div class="form-group">
									<label for="Country">Customer Country</label>
									<select class="form-control select2" name="currency" ng-model="customer.country">
										<option ng-repeat="countries in country" ng-value="countries.id">{{countries.country_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="currency">Currency:</label>
									<select class="form-control" name="currency" ng-model="customer.currency">
										<option ng-repeat="currencies in currency | orderBy:'inv_currency_code'" ng-value=" currencies.id">{{currencies.inv_currency_code}}</option>
									</select>
								</div>

								<button type="button" class="btn btn-default" submit-button="true" ng-click="add_user(customer)">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>

			<!-- Edit Modal -->
			<div class="modal fade" id="editModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit</h4>
						</div>
						<div class="modal-body">
							<form name="new_user_edit" id="new_user_edit" validate>
								<div class="form-group">
									<label for="name">Customer name</label>
									<input type="text" class="form-control" name="name" ng-model="customer.inv_customer_name" required>
								</div>

								<div class="form-group">
									<label for="email">Customer Email</label>
									<input type="email" class="form-control" name="email" ng-model="customer.inv_customer_email" required>
								</div>
								<div class="form-group">
									<label for="phonenumber">Customer Phone number</label>
									<input type="number" string-to-number class="form-control" name="phone" 
									ng-model="customer.inv_customer_phone_number" required>
								</div>
								<div class="form-group">
									<label for="company">Customer Company</label>
									<input type="text" name="company" class="form-control" ng-model="customer.inv_customer_company" required>
								</div>
								<div class="form-group">
									<label for="streat">Customer Street Address</label>
									<input type="text" class="form-control" name="street" ng-model="customer.inv_customer_street_address" required>
								</div>


								<div class="form-group">
									<label for="email">Customer City</label>
									<input type="text" class="form-control" name="city" ng-model="customer.inv_customer_city" required>
								</div>
								<div class="form-group">
									<label for="province">Customer Province</label>
									<input type="text" name="province" class="form-control" ng-model="customer.inv_customer_province" required>
								</div>
								<div class="form-group">
									<label for="postal">Customer Postal</label>
									<input type="text" name="postal" class="form-control" ng-model="customer.inv_customer_postal_code" required>
								</div>
								<div class="form-group">
									<label for="Country">Customer Country</label>
									<!-- <input type="text" class="form-control" name="country" ng-model="customer.inv_customer_country" required> -->

									<select class="form-control select2" name="country" ng-model="customer.inv_customer_country">
										<option ng-repeat="countries in country" value="{{countries.id}}">{{countries.country_name}}</option>
									</select>

								</div>

								<div class="form-group">
									<label for="currency">Currency:</label>
									<select class="form-control" required name="currency" ng-model="customer.inv_currency_inv_currency_id">
										<option ng-repeat="currencies in currency | orderBy:'inv_currency_code'" value="{{currencies.id}}">{{currencies.inv_currency_code}}</option>
									</select>
								</div>

								<button type="button" class="btn btn-default" submit-button="true" ng-click="edit(customer)">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>

			<!--List of all users -->
			<h2>All Customer</h2>
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );



?>">
			</p>
			<div class="table-responsive">  
				<datatable templateurl="table.html"></datatable>
				</div>
			
		</div>
	</div>
</div>