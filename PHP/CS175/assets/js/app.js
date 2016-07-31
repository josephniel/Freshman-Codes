(function() {
    
    angular
    .module( 'tapt', [] )
        
    .controller( 'assignUploadCtrl', [ '$scope', function( $scope ){
        
        this.submitForm = function( e ) {
            
            e.stopPropagation();
            e.preventDefault();
            
            if( document.getElementById( 'assignUploadForm' ).classList.contains( 'ng-valid' ) ) {
                
                document.getElementById( 'loader' ).style.display = 'block';
                
                document.getElementById( 'assignUploadForm' ).submit();
            }
        }
        
    }])
    
    .controller( 'assignPageCtrl', [ '$scope', function( $scope ){
        
        this.init = function( ttc, tat ) {
            $scope.totalTicketCount = ttc;
            $scope.totalAssignedTicket = tat;
        }
        
        this.incrementUserTicket = function( id ) {
            
            var el = document.getElementsByName(id)[0];
            var currVal = parseInt(el.getAttribute("value"));
            
            if( $scope.totalAssignedTicket != $scope.totalTicketCount ) {
                el.setAttribute( "value", (currVal + 1) );
                $scope.totalAssignedTicket++;
            }
        }
        
        this.decrementUserTicket = function( id ) {
            
            var el = document.getElementsByName(id)[0];
            var currVal = parseInt(el.getAttribute("value"));
            
            if( currVal > 0 ) {
                el.setAttribute( "value", (currVal - 1) );
                $scope.totalAssignedTicket--;
            }
        }
        
        this.isSubmitDisabled = function() {
            return $scope.totalTicketCount != $scope.totalAssignedTicket;
        }
        
        this.submitForm = function( e ) {
            
            e.stopPropagation();
            e.preventDefault();
            
            if( $scope.totalTicketCount == $scope.totalAssignedTicket ) {
                
                document.getElementById( 'loader' ).style.display = 'block';
                
                document.getElementById( 'assignForm' ).submit();
            }
            else {
                alert( 'Please assign all tickets.' );
            }
        }
        
    }])
    
    .controller( 'generateUploadCtrl', [ '$scope', function( $scope ){
        
        this.submitForm = function( e ) {
            
            e.stopPropagation();
            e.preventDefault();
            
            if( document.getElementById( 'generateUploadForm' ).classList.contains( 'ng-valid' ) ) {
                
                document.getElementById( 'loader' ).style.display = 'block';
                
                document.getElementById( 'generateUploadForm' ).submit();
            }
        }
        
    }])
    
    .controller( 'analystPageCtrl', [ '$scope', function( $scope ){
        
        $scope.status = [];
        
        this.enableEdit = function( id ) {
            
            $scope.status[id] = !$scope.status[id];
        }
        
    }]);
    
})();