<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="supplierctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg"  ng-click="show_modal()">Add New Supplier</button>

			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new Supplier</h4>
						</div>
						<div class="modal-body">
							<form name="new_user" id="new_supplier" validate>
								<div class="form-group">
									<label for="name">Supplier name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.name" required>
								</div>
								<button type="button" class="btn btn-default" submit-button="true" ng-click="add(cat)">Submit</button>
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
							<form name="new_user" id="edit_supplier" validate>
								<div class="form-group">
									<label for="name">Category name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_supplier_name" required>
								</div>
								<button type="button" submit-button="true" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="edit(cat)">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>				

			<!--List of all categories -->
			<h2>All Supplier</h2>
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
			<datatable templateurl="table.html"></datatable>
			</div>
		</div>
	</div>
</div>