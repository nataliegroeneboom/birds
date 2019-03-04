# Bird Encyclopedia - learning to build a website in php

I am learning the basics of CRUD object orientated PHP by creating a table of bird species where you can add, delete, edit and view individually details about birds.  

### Added a interface
The entryPoint class method gets called in the index.php file.  This class is dependent on the Routes class method getRoutes.  You can use interfaces to 
describe what methods a class should contain.  I create an interface and add the hint to the EntryPoint constructor.  I then extend the BirdRoute file to implement the interface.  This results in the BirdRoute file must contain the method inside the interface.  The BirdRoute Class can be type hinted using the interface.  


