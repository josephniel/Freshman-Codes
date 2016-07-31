<form ng-controller="assignPageCtrl as assignPage"
      ng-init="assignPage.init(<?=$cookie->totalTicketCount?>,<?=$cookie->totalAssignedTicket?>)"
      class="assign-ticket-page clearfix no-margin"
      method="POST"
      action="<?=base_url('assign/email_analysts')?>"
      id="assignForm"
      ng-submit="assignPage.submitForm( $event )"
>

    <div class="progress">
          <div class="progress-bar progress-bar-striped" 
               role="progressbar" 
               style="width: 66%;">
              Step 2: Select Analysts and Assign Number of Tickets
          </div>
    </div>
    
    <hr>
    
    <h3>
        Tickets Assigned: 
        <span ng-bind="totalAssignedTicket" class="label label-success" ng-class="{'label-danger' : totalAssignedTicket != totalTicketCount }"></span>
        of
        <span ng-bind="totalTicketCount" class="label label-default"></span>
    </h3>
    
    <table class="table table-bordered table-striped margin-top">
    
        <thead>
            <tr>
                <th></th>
                <th width="50%" class="text-center">
                    Full Name
                </th>
                <th width="20%" class="text-center">
                    Total Tickets Assigned
                </th>
                <th width="20%" colspan="3" class="text-center">
                    No. of Tickets
                </th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php foreach( $analysts as $key => $analyst ) : ?>
            <tr>
                <td class="text-center"><?=$key+1?></td>
                <td><?=$analyst["name"]?></td>
                <td class="text-center"><?=$analyst["total"]?></td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-default"
                            ng-click="assignPage.decrementUserTicket('<?=$analyst["id"]?>ticketCount')"
                            >
                        -
                    </button>
                </td>
                <td>
                    <input type="number"
                           name="<?=$analyst["id"]?>ticketCount"
                           class="form-control text-center custom-disabled"
                           ng-value="<?=$cookie->initialTicketCount?>"
                           ng-readonly="true"
                           min="0"
                           >
                </td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-default"
                            ng-click="assignPage.incrementUserTicket('<?=$analyst["id"]?>ticketCount')"
                            ng-disabled="!assignPage.isSubmitDisabled()"
                            >
                        +
                    </button>
                </td>
                
            </tr>
            <?php endforeach; ?>
            
        </tbody>
        
    </table>

    <h3 class="pull-left no-margin">
        Tickets Assigned: 
        <span ng-bind="totalAssignedTicket" class="label label-success" ng-class="{'label-danger' : totalAssignedTicket != totalTicketCount }"></span>
        of
        <span ng-bind="totalTicketCount" class="label label-default"></span>
    </h3>
    
    <button type="submit"
            class="btn btn-lg btn-primary pull-right no-margin"
            ng-disabled="assignPage.isSubmitDisabled()"
            >
        Email Analysts
    </button>
    
</form>