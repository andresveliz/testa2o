Backend Installation
Clone the repository

git clone https://github.com/andresveliz/testa2o
Switch to the repo folder

cd a2oDev
Install all the dependencies using composer

composer install
Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env
Generate a new application key

php artisan key:generate

Run the serve
php artisan serve
You can now access the server at http://localhost:8000

FrontEnd Installation
Switch to the repo folder

cd a2ofront

Continue with:
npm install

Compiles and hot-reloads for development
npm run serve
