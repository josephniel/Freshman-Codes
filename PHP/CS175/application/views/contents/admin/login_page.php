<div class="alert alert-info" role="alert"> You must first log in to continue. </div>

<form method="POST" 
      action="<?=base_url('admin')?>" 
      class="login-form"
>
    
    <div class="form-group">
        <label for="admin_username">Username</label>
        <input name="admin_username" 
               type="text" 
               id="admin_username" 
               class="form-control input-lg"
               >
    </div>
    
    <div class="form-group">
        <label for="admin_password">Password</label>
        <input name="admin_password" 
               type="password" 
               id="admin_password" 
               class="form-control input-lg"
                >
    </div>
    
    <button type="submit" class="btn btn-lg btn-default">Login</button>
    
</form>