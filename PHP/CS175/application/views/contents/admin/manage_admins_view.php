<table class="table table-bordered table-striped no-margin-bottom">

    <thead>
        <tr>
            <th width="10%" class="text-center">Option</th>
            <th width="25%">First Name</th>
            <th width="25%">Last Name</th>
            <th width="20%">Username</th>
            <th width="20%">Password</th>
        </tr>
    </thead>
    
    <tbody>
    
    <?php foreach( $admin_list as $admin ){ ?>    
        <tr>
            <td class="text-center">
            <?php if($admin->type != 1){ ?>
                <a href="<?=base_url("admin/process_delete_admin/{$admin->deleteUri}")?>" class="text-danger">
                    Delete
                </a>
            <?php } else { ?>
                -
            <?php } ?>
            </td>
            <td><?=$admin->first_name?></td>
            <td><?=$admin->last_name?></td>
            <td><?=$admin->username?></td>
            <td><?=($admin->type != 1) ? $admin->password : "-" ?></td>
        </tr>
      
    <?php } ?>
        
    </tbody>
    
</table>