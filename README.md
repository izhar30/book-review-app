
Steps to Set Up Your Laravel Project Locally this for windows.

1-Clone the Repository
git clone https://github.com/izhar30/book-review-app.git
cd book-review-app


2-Install Dependencies

composer install

npm install

3- Configure the Environment
  copy .env.example .env

  php artisan key:generate

if this error persists

In PackageManifest.php line 178:

  The C:\book-review-app\bootstrap\cache directory must be present and writable.

run the following command

  mkdir bootstrap\cache
then

  php artisan key:generate


4- Set Up the Database

php artisan migrate 

then run the 

php artisan db:seed --class=BookSeeder


5-Compile Frontend Assets

npm run dev

6- start the server 

php artisan serve

Now, open  in your browser and check if your project runs!
if this issue happen 

file_put_contents(C:\book-review-app\storage\framework/sessions/YOhzABmGxpDwySjKhO5UHmBFwppDYZbI0jIwVnXJ): Failed to open stream: No such file or directory



please run  the folowwing commands becaus these file was in .gitignore

mkdir storage\framework\sessions
mkdir storage\framework\cache
mkdir storage\framework\views



