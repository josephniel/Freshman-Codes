<form method="POST"
      action="<?=base_url('admin/process_edit_analyst')?>"
      class="clearfix no-margin"
>

    <table class="table table-bordered table-striped no-margin-bottom"
           ng-controller="analystPageCtrl as analystPage"
    >

        <thead>
            <tr>
                <th width="15%" class="text-center" colspan="2">Options</th>
                <th width="20%">First Name</th>
                <th width="20%">Last Name</th>
                <th width="10%">DWNG ID</th>
                <th width="15%">MyRequest ID</th>
                <th width="20%">Email Address</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach( $analyst_list as $analyst ) : ?>    
            <tr>
                <td class="text-center">
                    <a href="<?=base_url("admin/process_delete_analyst/{$analyst->dwng_id}")?>" class="text-danger">
                        Delete 
                    </a>
                </td>
                <td class="text-center">
                    <a ng-click="analystPage.enableEdit(<?=$analyst->id?>)" href="">
                        <span ng-show="status[<?=$analyst->id?>]">Edit</span>
                        <span ng-hide="status[<?=$analyst->id?>]">Close</span>
                    </a>
                </td>
                <td>
                    <input type="text"
                           name="<?=$analyst->id?>-first_name"
                           class="form-control"
                           ng-class="{ 'custom-disabled' : status[<?=$analyst->id?>] }"
                           value="<?=$analyst->first_name?>"
                           ng-init="status[<?=$analyst->id?>] = true"
                           ng-readonly="status[<?=$analyst->id?>]"
                    >
                </td>
                <td>
                    <input type="text"
                           name="<?=$analyst->id?>-last_name"
                           class="form-control"
                           ng-class="{ 'custom-disabled' : status[<?=$analyst->id?>] }"
                           value="<?=$analyst->last_name?>"
                           ng-init="status[<?=$analyst->id?>] = true"
                           ng-readonly="status[<?=$analyst->id?>]"
                    >
                </td>
                <td>
                    <input type="text"
                           name="<?=$analyst->id?>-dwng_id"
                           class="form-control"
                           ng-class="{ 'custom-disabled' : status[<?=$analyst->id?>] }"
                           value="<?=$analyst->dwng_id?>"
                           ng-init="status[<?=$analyst->id?>] = true"
                           ng-readonly="status[<?=$analyst->id?>]"
                    >
                </td>
                <td>
                    <input type="text"
                           name="<?=$analyst->id?>-my_request_id"
                           class="form-control"
                           ng-class="{ 'custom-disabled' : status[<?=$analyst->id?>] }"
                           value="<?=$analyst->my_request_id?>"
                           ng-init="status[<?=$analyst->id?>] = true"
                           ng-readonly="status[<?=$analyst->id?>]"
                    >
                </td>
                <td>
                    <input type="text"
                           name="<?=$analyst->id?>-email_address"
                           class="form-control"
                           ng-class="{ 'custom-disabled' : status[<?=$analyst->id?>] }"
                           value="<?=$analyst->email_address?>"
                           ng-init="status[<?=$analyst->id?>] = true"
                           ng-readonly="status[<?=$analyst->id?>]"
                    >
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>
    
    <hr>
    
    <button type="submit" 
            class="btn btn-primary pull-right no-margin"
    >
        Save Changes
    </button>
    
</form>