# BlogBackground

Backend blog project based on `MVC framework` (Model - View - Controller). 


## Environment

- Apache 2.4.39
- PHP 7.3.4
- MySQL 5.7.26
- Smarty 3.1.34-dev

## Single entry system
  
- `/public/`: public resources (index.php, .css / .js files, images)
  
- `/app/`: application directory
  
    - `admin`: backend module (model / view / controller)
    
    - `home`: frontend module (model / view / controller)
    
- `/config/`: directory of configurations (article data, display errors, etc.)
  
- `/core/`: initialization, public controller & model, PDO base class
    
- `/vendor`: gadgets, e.g. Smarty template engine, fonts, captcha
      

## MySQL connection

**PHP Data Objects (PDO)** database abstraction layer is double-encapsulated to fit backend transactions better. 

See `/core/Dao.php` for more details. 


## Views

**Smarty template engine** is used to embed PHP grammars in HTML files:  

~~~HTML
<div class = "simple-tips">
   <h2>Network</h2>
       <ul>
           <li>Current IP: {$smarty.server.REMOTE_ADDR}</li>
           <li>PHP version: {PHP_VERSION}</li>
           <li>Browser: {$smarty.server.HTTP_USER_AGENT}</li>
       </ul>
~~~

Click [here](https://www.smarty.net/docs/en/) to get more informations about Smarty.


## Public controller

Base class for all controllers. Smarty method initialization & double-encapsulation, success / error page, etc. 

See `/core/Controller.php` for more details.


## Public Model

Base class for all models. DAO instantiation & double-encapsulation, MySQL operation methods, etc. 

See `/core/Model.php` for more details.


2020 By Newiz
