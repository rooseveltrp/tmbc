<?php

use Illuminate\Database\Seeder;

use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records =             [
            [
                'parent_id' => null,
                'full_name' => "Jack Sparrow",
                'comment' => "This is the day you will always remember as the day you almost caught Captain Jack Sparrow."
            ],
            [
                'parent_id' => 1,
                'full_name' => "Joker",
                'comment' => "Why so serious? >:)"
            ],
            [
                'parent_id' => 2,
                'full_name' => "Luke Skywalker",
                'comment' => "But I was going into Tosche Station to pick up some power converters!"
            ],
            [
                'parent_id' => 3,
                'full_name' => "Iron Man",
                'comment' => "I told you, I don’t want to join your super secret boy band."
            ],
            [
                'parent_id' => null,
                'full_name' => "Gollum",
                'comment' => "My precious."
            ]
        ];

		foreach ($records as $record) {
		    $item = new Comment;
		    $item->parent_id = $record['parent_id'];
		    $item->full_name = $record['full_name'];
		    $item->comment = $record['comment'];
            $item->save();
        }
    }
}
