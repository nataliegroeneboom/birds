# Bird Encyclopedia - learning to build a website in php

I am learning the basics of CRUD object orientated PHP by creating a table of bird species where you can add, delete, edit and view individually details about birds.  

### Rewriting my code: Adding Birds

I am rewriting my code so the there are reusable methods.

In my bird website I have a class called Bird that manages the update,
insert, deletion of birds on the website.  I want to move my some 
of my functions to a generic DatabaseTable class managing all tables queries. I am focusing on the editing page.



### Adding the Action: edit
I have done a bit of editing on the create.html.php file with lots of if statements so that I can reuse the 
template for creating a new bird and editing an existing bird.
Like the read individual button, the edit button has the id passed to it.  Notice that its the same edit action as the create button.
```html
<a href="index.php?action=edit&id=<?=$bird['id']?>" 
```
 Below is the input of the name (a snippet as this is repeated on the other form input values)
 ```html
<td><input type='text' name="bird[birdname]" class='form-control' value="<?=$bird['birdname']?? '' ?>"/></td>
```

### Adding a preview image to the page
Previously the page wasn't rendering the uploaded image.  