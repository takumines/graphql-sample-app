<?php

namespace Tests\Feature\GraphQL\Queries;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function ユーザー一覧が10件取得できること()
    {
        User::factory()->count(20)->create();
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'test01@example.com',
        ]);

        $params = [
            'page' => 1
        ];

        $this->actingAs($user, 'api');
        $response = $this->graphQL(
            '
                query($page: Int!) {
                    users(page: $page) {
                        data {
                            id
                        }
                        paginatorInfo {
                            total
                        }
                    }
                }
            ',
            $params
        );

        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'users' => [
                    'data' => [
                        [
                            'id'
                        ]
                    ],
                    'paginatorInfo' => [
                        'total',
                    ],
                ],
            ]
        ]);
        $this->assertEquals(count($response['data']['users']['data']), 10);
    }
}
