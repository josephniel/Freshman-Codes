<?php if( $cookie->addAnalystAlert == 1 ) { //dwng_id name should be = 6?>

    <div class="alert alert-danger no-margin-bottom"> DWNG ID must have 6 characters. </div> 

<?php } else if( $cookie->addAnalystAlert == 2 ) { //dwng_id is taken?>

    <div class="alert alert-danger no-margin-bottom"> DWNG ID is already taken. Try a different one. </div>

<?php } else if( $cookie->addAnalystAlert == 3 ) { //myreq_id > 6?>

    <div class="alert alert-danger no-margin-bottom"> MyRequest ID should be at least 6 characters. </div>

<?php } else if( $cookie->addAnalystAlert == 4 ) { //myreq_id is take?>

    <div class="alert alert-danger no-margin-bottom"> MyRequest ID is already taken. Try a different one. </div>

<?php } ?>

<?php 
    if(get_cookie("addAnalystCookie")) {
        $addAnalystArray = json_decode(base64_decode(get_cookie("addAnalystCookie")));
    }
?>

<form method="POST" 
      action="<?=base_url('admin/process_add_analyst')?>" 
      class="manage-admin-form row"
      autocomplete="false"
      >
    
    <div class="form-group col-xs-6">
        <label for="new_analyst_first_name">First Name</label>
        <input name="new_analyst_first_name" 
               type="text" 
               id="new_analyst_first_name" 
               class="form-control"
               value="<?=$addAnalystArray->first_name?>"
               >
    </div>
    
    <div class="form-group col-xs-6">
        <label for="new_analyst_last_name">Last Name</label>
        <input name="new_analyst_last_name" 
               type="text" 
               id="new_analyst_last_name" 
               class="form-control"
               value="<?=$addAnalystArray->last_name?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_analyst_dwng_id">DWNG ID</label>
        <input name="new_analyst_dwng_id" 
               type="text" 
               id="new_analyst_dwng_id" 
               class="form-control"
               value="<?=$addAnalystArray->dwng_id?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_analyst_my_request_id">MyRequest ID</label>
        <input name="new_analyst_my_request_id" 
               type="text" 
               id="new_analyst_my_request_id"
               class="form-control"
               value="<?=$addAnalystArray->my_request_id?>"
               >
    </div>
    
    <div class="form-group col-xs-12">
        <label for="new_analyst_email">Email Address</label>
        <input name="new_analyst_email" 
               type="text" 
               id="new_analyst_email"
               class="form-control"
               value="<?=$addAnalystArray->email_address?>"
               >
    </div>
    
    <div class="col-xs-12">
        <button type="submit" class="btn btn-success">Add Analyst</button>
    </div>
    
</form>