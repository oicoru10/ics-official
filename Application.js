jQuery.sap.declare("Application"); 

jQuery.sap.require("sap.ui.app.Application"); 

//Application is the ID

sap.ui.app.Application.extend("Application", {

    init : function() {

        // set global models

       var domainString = "document.domain";  

                    domainstring = "*.com";

                    'Access-Control-Allow-Origin: *.local.com';

                    'Access-Control-Allow-Headers: X-KEY';


        var oModel = new sap.ui.model.odata.ODataModel("http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV",false,"thanagone.ku","p@ssw0rd");   
  

        

        sap.ui.getCore().setModel(oModel);  

        

    },

    

    main : function() {     

        // create app view and put to html root element

        var root = this.getRoot();

        sap.ui.jsview("app", "view.App").placeAt(root);  //root is div id content 

    }

});