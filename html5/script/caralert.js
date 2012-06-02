var CA = new function() {
      var storeReady = false
      var store = new Lawnchair({}, function() {  storeReady = true})
      function isStoreReady(){
            return storeReady
      }
      this.isStoreReady = isStoreReady

      
    function getDocument(callback, failback) {
        $.ajax({
            //url: '_show/xmlmessage/'+messageid,
            url: 'test.data',
            type: "GET",
            data: "",
            contentType: "application/json",
            dataType: "json",
            success: AjaxCallback,
            cache: false,
            error: AjaxFailed
        });

        function AjaxFailed(result) {
          if (result.status == 200 && result.statusText.toUpperCase() == "OK") {
	        AjaxCallback(eval(result.responseText));
          }
          else {
	        failback("FAILED : " + result.status + ' ' + result.statusText);
          }
       }
       function AjaxCallback(result) {            
              alert(result)
              callback(result)
 
       }    
    }
    this.getDocument = getDocument 

}
