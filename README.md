# Bird Encyclopedia - learning to build a website in php

I am learning the basics of CRUD object orientated PHP by creating a table of bird species where you can add, delete, edit and view individually details about birds.  

### Simplified my templates
Originally I had a header, footer and a navigation template.  I combined them into a layout template where in 
the main section will render the template determined by the 'action' of the user and if none will render home template.

### loadTemplate a reusable function
After the action method is called and stored in a variable, I created a reusable loadTemplate function to extract
varibles (if there are variables) and load the appropariate template associated with the action. 

### Change actions to routes
I explain how I do this in my blog [here](http:/nataliegroeneboom.co.uk).


