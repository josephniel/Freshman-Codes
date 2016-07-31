<?php if( $cookie->addAdminAlert == 1 ) { ?>

    <div class="alert alert-danger no-margin-bottom"> Passwords should be the same. </div>

<?php } else if( $cookie->addAdminAlert == 2 ) { ?>

    <div class="alert alert-danger no-margin-bottom"> Username is already taken. Try a different one. </div>

<?php } else if( $cookie->addAdminAlert == 3 ) { ?>

    <div class="alert alert-danger no-margin-bottom"> First name and/or last name should be at least 6 characters. </div>

<?php } else if( $cookie->addAdminAlert == 4 ) {?>

    <div class="alert alert-danger no-margin-bottom"> Username should be at least 6 characters. </div>

<?php } else if( $cookie->addAdminAlert == 5 ) {?>

    <div class="alert alert-danger no-margin-bottom"> Password/s should be at least 6 characters. </div>

<?php } ?>

<?php 
    if(get_cookie("addAdminCookie")) {
        $addAdminArray = json_decode(base64_decode(get_cookie("addAdminCookie")));
    }
?>

<form method="POST" 
      action="<?=base_url('admin/process_add_admin')?>" 
      class="manage-admin-form row"
      autocomplete="false"
      >
    
    <div class="form-group col-xs-6">
        <label for="new_admin_first_name">First Name</label>
        <input name="new_admin_first_name" 
               type="text" 
               id="new_admin_first_name" 
               class="form-control"
               value="<?=$addAdminArray->first_name?>"
               >
    </div>
    
    <div class="form-group col-xs-6">
        <label for="new_admin_last_name">Last Name</label>
        <input name="new_admin_last_name" 
               type="text" 
               id="new_admin_last_name" 
               class="form-control"
               value="<?=$addAdminArray->last_name?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_admin_username">Username</label>
        <input name="new_admin_username" 
               type="text" 
               id="new_admin_username" 
               class="form-control"
               value="<?=$addAdminArray->username?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_admin_password">Password</label>
        <input name="new_admin_password" 
               type="password" 
               id="new_admin_password"
               class="form-control"
               value="<?=$addAdminArray->password?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_admin_checker_password">Retype Password</label>
        <input name="new_admin_checker_password" 
               type="password" 
               id="new_admin_checker_password"
               class="form-control"
               value="<?=$addAdminArray->password_verify?>"
               >
    </div>
    
    <div class="col-xs-12">
        <button type="submit" class="btn btn-success">Add Admin</button>
    </div>
    
</form>