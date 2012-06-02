function testRetrieveData() {


   function doTest(){
      ok(true)
      start()
   } 

   function doFail(){
     ok(false)
     start()
   }

   function run() {
       CA.getDocument(doTest, doFail)

   }
   this.run = run
}
