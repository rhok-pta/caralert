function testRetrieveData() {
   function doTest(index){
      ok(index == 3)
      start()
   } 

   function doFail(){
     ok(false)
     start()
   }

   function run() {
       CA.nukeDB(function(){
             CA.getDocument('test.data',doTest, doFail)
        })
   }
   this.run = run
}

function testSearchData() {
   function doTest(index) {
      CA.find("717", doSearchTest) 
   }

   function doFail(){
     ok(false)
     start()
   }

   function doSearchTest(foundArr){
      ok(foundArr[0].CarRegNo == 'TJB717GP')
      start() 
   }
   function run() {
       CA.nukeDB(function(){
             CA.getDocument('test.data',doTest, doFail)
        })
   }
   this.run = run

}
