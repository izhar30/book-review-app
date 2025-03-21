<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald' , 'images' => 'images/greategatsby.jpeg'],
            ['title' => '1984', 'author' => 'George Orwell', 'images' => 'images/1984.jpeg'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee' , 'images' => 'images/killmokingbird.jpeg'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'images' => 'images/pride.jpeg'],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville', 'images' => 'images/mobydick.jpeg'],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'images' => 'images/richdad.jpeg'],
        ];

        Book::insert($books);
  }
}
