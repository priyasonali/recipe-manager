# Welcome to the recipe-manager wiki!

### A CRUD application for recipes built using Angular leveraging a PHP based RESTful API. 

Steps:
* Download or fork the project directory.
* Name your folder and put all the content of recipe-manager folder inside of that. Then delete recipe-manager folder.
* Go to config.json and update the "root": "/foldername" to the folder name that you have created.
* Install the composer for php inside of api folder. Follow the following link or use composer website:
<https://www.youtube.com/watch?v=BnIZVHmROkk>
* Configure your mysql database on the server(databsename, user and pass).
* Open http://serverdomain/foldername/api/install
* Enter the database name, username and password. Submit it.
* Your database is created now.


>This api will accepts data in both `application/x-www-form-urlencoded` and `application/json`.
>Be sure set the appropriate `content-type` header accordingly.