📚 Laravel Book Review Application

A simple book review application built with Laravel where users can register, log in, and submit reviews for different books. Users can edit or delete their reviews and view book ratings and comments from other users.
🚀 Features

✅ View Books & Reviews - Anyone can browse books and see their ratings & reviews.
✅ User Authentication - Users must register or log in to leave a review.
✅ Rate & Review Books - Logged-in users can leave one review per book, but they can edit it multiple times.
✅ Dashboard for Users - Displays all books with reviews, including who reviewed them and their comments.
✅ Profile Management - Users can update their profile details.
✅ Navigation - Smooth transitions between Home, Dashboard, and Profile pages.
✅ Sorting by Ratings - Books are displayed based on their average rating (highest first).
✅ Fully Functional Buttons - All navigation buttons work seamlessly to move between pages.


🖥️ System Requirements

Before installing, ensure your system meets the following requirements:

PHP: 8.1.12 or later

Laravel: 10.48.29

Composer: Latest version

Node.js: 16.x or later

NPM: Latest version

MySQL: 5.7 or later (or any compatible database)

Web Server: Apache, Nginx, or Laravel's built-in server

🛠️ Installation Guide

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
 please run  the folowwing commands because these file was in .gitignore to ignore.
 
 mkdir bootstrap\cache
 
mkdir storage\framework\sessions

mkdir storage\framework\cache

mkdir storage\framework\views
  
then

  php artisan key:generate


4- Set Up the Database

php artisan migrate 

then run the 

php artisan db:seed --class=BookSeeder


5-Compile Frontend Assets

npm run dev
please leave it running.

6- start the server in different terminal 

php artisan serve

Now, open  in your browser and check if your project runs!

ok check now its running



🎯 How the Application Works

🔹 Public Pages (No Login Required)

📌 View all books, their reviews, and ratings.

📌 Click "Login to Review" - If you are not registered, you must sign up first.

🔹 User Dashboard (After Login)

📌 See all listed books and their ratings.

📌 Add a review and rating to a book (only once per book, but you can edit it multiple times).

📌 Edit or delete your reviews.

📌 Navigate easily using dashboard buttons.

📌 Visit Profile Page to update your details.

🔹 Navigation & Functionality

📌 All buttons are working (e.g., Home, Dashboard, Profile, Logout).

📌 Books are sorted by highest average rating.

📌 In the Dashboard, all reviews are displayed with reviewer names and comments.

📌 To review a book: Select a rating, enter a comment, then submit.

🛠️ Technologies Used

Laravel (Backend Framework)

MySQL (Database)

Blade (Templating Engine)

Bootstrap/Tailwind CSS (Frontend UI)

Vite (Asset Compilation)

📬 Need Help?

For any confusion or assistance, feel free to contact me:📧 Email: izhar.khan.dev@gmail.com
