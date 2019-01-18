<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsControllerTest extends TestCase
{
    /**
     * Functional test to see if the index page is loading
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Functional test to make sure the JSON response is working
     */
    public function testAll()
    {
        $response = $this->get('/comments/all');
        $response->assertJsonCount(1);
    }

    /**
     * Functional test to save a new DB record
     */
    public function testSave()
    {
        $response = $this->post('/comments/save', array(
            "full_name" => "Albert Einstein",
            "comment" => "Life is like riding a bicycle. To keep your balance 
                          you must keep moving."
        ));
        $response->assertStatus(200);
    }
}
