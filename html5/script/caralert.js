var CA = new function() {
      var storeReady = false
      var store = new Lawnchair({}, function() {  storeReady = true})
      function isStoreReady(){
            return storeReady
      }
      this.isStoreReady = isStoreReady

      
    function getDocument(url,callback, failback) {
        $.ajax({
            url: url,
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
              var index = 0          
              store.nuke(function(){                       
                       function saveIt(){
                           if(index<result.length) { 
                              result[index].key = index
                              result[index].searchKey = result[index].CarRegNo+ ' ' +result[index].CarColor + ' ' +result[index].CarMakeModel+' ' +result[index].IncDesc
                              index++
                              store.save( result[index-1], saveIt)
                           } else {
                              callback(index)
                           }  
                        }
                        saveIt()  
                  }) 
       }    
    }
    this.getDocument = getDocument 


    function nukeDB(callback){
        store.nuke(callback)
    }
    this.nukeDB = nukeDB

    function find(searchStr, callback){
       var foundArr = new Array()
       store.all(function(allArr) {
            for(var i=0; i<allArr.length; i++){
                 if(allArr[i].searchKey.indexOf(searchStr)>=0) {
                     foundArr.push(allArr[i])
                 }
            }
            callback(foundArr)
       })
    }
    this.find = find

}
