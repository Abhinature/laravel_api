<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class SubmissionControllerTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Test submitting valid data to the API endpoint.
     *
     * @return void
     */
    public function testSubmitValidData()
    {
        $data = [
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "message" => "This is a test message."
        ];

        $response = $this->postJson('/submit', $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Submission received, processing...'
            ]);
    }

    public function testSubmitInvalidData()
    {
        $data = [
            // Missing 'email' field
            "name" => "John Doe",
            "message" => "This is a test message."
        ];

        $response = $this->postJson('/submit', $data);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => [
                    'email' => [
                        'The email field is required.'
                    ]
                ]
            ]);
    }
}
