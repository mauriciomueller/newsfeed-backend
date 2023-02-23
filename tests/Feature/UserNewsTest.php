<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserSettingsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserNewsTest extends TestCase
{
    use RefreshDatabase;

    public array $articles;
    public array $articlesWithCategories;

    public function setUp(): void
    {
        parent::setUp();

        $this->articles = [
            'source' => [
                'id',
                'name',
            ],
            'author',
            'title',
            'description',
            'url',
            'urlToImage',
            'publishedAt',
            'content',
        ];

        $this->articlesWithCategories = $this->articles;
        $this->articlesWithCategories[] = 'categories';
    }

    public function test_get_news_for_not_logged_in_users()
    {
        $this->get(route('user.news.getUserNews'))
            ->assertStatus(403);
    }

    public function test_get_news_for_logged_in_users_without_categories_settings() {
        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
        ]);

        $userSettingsCategories = UserSettingsCategory::create([
            'user_id' => $user->id,
            'settings_categories_codes' => json_encode([])
        ]);

        $this->actingAs($user);

        $this->get(route('user.news.getUserNews'))
            ->assertJsonStructure([
                'yourNews' => [
                    '*' => $this->articles
                ]
            ])
            ->assertStatus(200);
    }

    public function test_get_news_for_logged_in_users_with_categories_settings() {
         $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test3@example.com',
            'password' => bcrypt('password'),
        ]);

        $userSettingsCategories = UserSettingsCategory::create([
            'user_id' => $user->id,
            'settings_categories_codes' => json_encode([
                'business',
                'general'
            ])
        ]);

        $this->actingAs($user);

        $this->get(route('user.news.getUserNews'))
            ->assertJsonStructure([
                'byCategories' => [
                    'business' => [
                        'articles' => [
                            '*' => $this->articles
                        ]
                    ],
                    'general' => [
                        'articles' => [
                            '*' => $this->articles
                        ]
                    ]
                ],
                'yourNews' => [
                    '*' => $this->articlesWithCategories
                ]
            ])
            ->assertStatus(200);
    }
}
