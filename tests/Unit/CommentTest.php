<?php

namespace Tests\Unit;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * Tests if we can save
     *
     * @return void
     */
    public function testGetAllNestedComments()
    {
        $records = Comment::getAllNestedComments(null);
        $this->assertEquals("Jack Sparrow", $records[1]['full_name']);
    }


}
