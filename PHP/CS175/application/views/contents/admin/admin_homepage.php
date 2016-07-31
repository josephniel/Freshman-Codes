<div class="admin-topbar clearfix">

    <span class="pull-left">Welcome, <strong><?=$cookie->adminName?></strong>!</span>
    
    <span class="pull-right">
        <a href="<?=base_url('admin/logout')?>">Logout</a>
    </span>
    
</div>

<ul class="nav nav-tabs admin-homepage-nav">
    
    <li class="<?php if($cookie->adminPageType == 0) echo "active"; ?>">
        <a href="<?=base_url("admin/edit_equations")?>">Edit PR Field Formulas</a>
    </li>
    
    <li class="<?php if($cookie->adminPageType == 1) echo "active"; ?>">
        <a href="<?=base_url("admin/manage_users_view")?>">View Users</a>
    </li>
    
    <li class="<?php if($cookie->adminPageType == 4) echo "active"; ?>">
        <a href="<?=base_url("admin/manage_users_add")?>">Add User</a>
    </li>
    
    <?php if( $cookie->adminType == 1 ){ ?>
    
        <li class="<?php if($cookie->adminPageType == 2) echo "active"; ?>">
            <a href="<?=base_url("admin/manage_admins_view")?>">View Admins</a>
        </li>
    
        <li class="<?php if($cookie->adminPageType == 3) echo "active"; ?>">
            <a href="<?=base_url("admin/manage_admins_add")?>">Add Admin</a>
        </li>
    
    <?php } ?>
    
</ul>

<div class="admin-homepage-contents">

<?php 

    switch($cookie->adminPageType)
    {
        case 0:
            include_once("edit_equations.php");
            break;
        case 1:
            include_once("manage_users_view.php");
            break;
        case 4:
            include_once("manage_users_add.php");
            break;
        case 2:
            include_once("manage_admins_view.php");
            break;
        case 3:
            include_once("manage_admins_add.php");
            break;
    }
    
?>
    
</div>