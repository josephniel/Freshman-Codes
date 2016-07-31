<form class="assign-ticket-page clearfix no-margin"
      method="POST"
      action="<?=base_url('generate/generate_prod')?>"
      enctype="multipart/form-data"
      ng-controller="generateUploadCtrl as generatePage"
      id="generateUploadForm"
      ng-submit="generatePage.submitForm($event)"
>
    
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
        Generate Productivity Report
    </button>
    
</form>