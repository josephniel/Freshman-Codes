<form class="assign-ticket-page clearfix no-margin"
      method="POST"
      action="<?=base_url('assign/assign_analysts')?>"
      enctype="multipart/form-data"
      ng-controller="assignUploadCtrl as assignPage"
      id="assignUploadForm"
      ng-submit="assignPage.submitForm($event)"
>

    <div class="progress">
          <div class="progress-bar progress-bar-striped" 
               role="progressbar" 
               style="width: 33%;">
              Step 1: Upload Extracts
          </div>
    </div>
    
    <hr>
    
    <table class="table table-bordered">
    
        <tbody>
        
            <tr>
                <td>
                    <label for="line-item-input"
                           class="no-margin pull-right"
                    >
                        Upload Line Item Extract
                    </label>
                </td>
                <td>
                    <input type="file" 
                           name="line-item-input"
                           id="line-item-input"
                           class="form-control"
                           ng-required="true"
                           >
                </td>
            </tr>
            
            <tr>
                <td>
                    <label for="review-ticket-input"
                           class="no-margin pull-right"
                    >
                        Upload Review Ticket Extract
                    </label>
                </td>
                <td>
                    <input type="file" 
                           name="review-ticket-input"
                           id="review-ticket-input"
                           class="form-control"
                           ng-required="true"
                           >
                </td>
            </tr>
            
            <tr>
                <td>
                    <label for="call-ticket-input"
                           class="no-margin pull-right"
                    >
                        Upload Call Ticket Extract
                    </label>
                </td>
                <td>
                    <input type="file" 
                           name="call-ticket-input"
                           id="call-ticket-input"
                           class="form-control"
                           ng-required="true"
                           >
                </td>
            </tr>
            
        </tbody>
        
    </table>

    <button type="submit"
            class="btn btn-primary pull-right no-margin"
            >
        Proceed to Assigning Analysts
    </button>
    
</form>