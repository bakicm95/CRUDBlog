<<<====== Database settings: =======>>>
Create new Database and check .env file for db settings


- Run "php artisan migrate"
- Run "db:seed"
- Or Run "php artisan migrate --seed"

<<<====== User settings: =======>>>

Users:
 - Superadministrator: username = "superadministrator@app.com"
 - Administrator: username = "administrator@app.com"
 - Editor: username = "edit@app.com"
 - Author: username = "author@app.com"
 -- Password is "password" for every user

- Create new User, and set the Roles and Permissions
- Create CRUD Post permission and sync to Role You want

<<<====== Tech =======>>>

BE: Laravel/MySql/ + Laratrust/Observers
FE: Vue.js/Bulma/Buefy/jQuery/Ajax/HTML/SCSS