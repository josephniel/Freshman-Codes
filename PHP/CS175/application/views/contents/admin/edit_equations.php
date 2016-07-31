<?php 

    $content = 
        array(
            array( 
                "key" => "D", 
                "name" => "Raw Review", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "E", 
                "name" => "Raw Line Item", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "F", 
                "name" => "Raw My Request/Additional Task", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "G", 
                "name" => "Raw Email", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "H", 
                "name" => "Raw Bulk", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "I", 
                "name" => "Raw Telephone", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "J", 
                "name" => "Raw Install", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "K", 
                "name" => "Review", 
                "formula" => $equation_list["K"] 
            ),
            array(
                "key" => "L", 
                "name" => "Line Item", 
                "formula" => $equation_list["L"] 
            ),
            array( 
                "key" => "M", 
                "name" => "My Request/Additional Task", 
                "formula" => $equation_list["M"] 
            ),
            array( 
                "key" => "N", 
                "name" => "Email", 
                "formula" => $equation_list["N"] 
            ),
            array( 
                "key" => "O", 
                "name" => "Bulk", 
                "formula" => $equation_list["O"] 
            ),
            array( 
                "key" => "P", 
                "name" => "Telephone", 
                "formula" => $equation_list["P"] 
            ),
            array( 
                "key" => "Q", 
                "name" => "Install", 
                "formula" => $equation_list["Q"] 
            ),
            array( 
                "key" => "R", 
                "name" => "Total Task", 
                "formula" => $equation_list["R"] 
            ),
            array( 
                "key" => "S", 
                "name" => "Working Days", 
                "formula" => "N/A" 
            ),
            array( 
                "key" => "T", 
                "name" => "Total Work in Minutes", 
                "formula" => $equation_list["T"] 
            ),
            array( 
                "key" => "U", 
                "name" => "MDT Production", 
                "formula" => $equation_list["U"] 
            ),
            array( 
                "key" => "V", 
                "name" => "Raw Ticket Count", 
                "formula" => $equation_list["V"]
            ),
            array(
                "key" => "W", 
                "name" => "BIC", 
                "formula" => $equation_list["W"] 
            )
        );

    $editable_keys = array( "K", "L", "M", "N", "O", "P", "Q", "R", "T", "U", "V", "W" );

?>

<?php if( $cookie->editEquationAlert == 1 ) { ?>

    <div class="alert alert-success"> Edits have been saved. </div>

<?php } ?>

<form method="POST"
      action="<?=base_url("admin/process_edit_equation")?>"
      class="no-margin-bottom"
      >

<table class="table table-bordered table-striped no-margin-bottom">

    <thead>
    
        <tr>
            <th width="10%" class="text-center">Field Key</th>
            <th>Field Name</th>
            <th>Formula</th>
        </tr>
    
    </thead>
    
    <tbody>
    
    <?php foreach( $content as $row ) { ?>
                
        <tr>
            
            <td class="text-center"><?=$row["key"]?></td>
            <td><?=$row["name"]?></td>
            
            <?php
    
            if( in_array( $row["key"], $editable_keys ) ){
                
            ?>
                <td>
                    <input type="text" 
                           class="form-control" 
                           name="<?=$row["key"]?>"
                           value="<?=$row["formula"]?>"
                           >
                </td>
            <?php
                
            } else {
                
            ?>
                <td>
                    <input type="text" 
                           class="form-control" 
                           value="<?=$row["formula"]?>"
                           disabled="disabled"
                           >
                </td>
            <?php
                
            } 
                                       
            ?>
                
        </tr>
                
    <?php } ?>
        
        <tr>
        
            <td colspan="3" class="clearfix">
            
                <button class="btn btn-success pull-right">Save Changes</button>
                
            </td>
            
        </tr>
        
    </tbody>
    
</table>
    
</form>

    