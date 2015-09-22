<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookTableSeeder extends Seeder {
	
	function run() {
		Book::truncate();
		Book::Create([
			'title' => 'Journey to the center of the world',
			'writer' => 'Julio Verne',
			'user_id' => 1,
		]);

		Book::Create([
			'title' => 'The adventures of Tom Sawyer',
			'writer' => 'Mark Twain',
			'user_id' => 2,
		]);

		Book::Create([
			'title' => 'Harry Potter',
			'writer' => 'J.K Rowling',
			'user_id' => 3,
		]);
	}
	
}
