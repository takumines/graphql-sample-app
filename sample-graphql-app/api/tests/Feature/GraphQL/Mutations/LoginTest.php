<?php

namespace Tests\Feature\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function ログインが成功すること()
    {
        $params = [
            'email' => 'test01@example.com',
        ];
        $user = User::factory()->create($params);

        $response = $this->executeGraphQL([...$params, 'password' => 'password']);

        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'login' => [
                    'token'
                ]
            ]
        ]);
    }

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function パスワードの値が存在しない場合はバリデーションエラーになること()
    {
        $params = [
            'email' => 'test01@example.com',
        ];
        $user = User::factory()->create($params);

        $response = $this->executeGraphQL($params);
        $response->assertJsonStructure([
            'errors' => [
                [
                    'message'
                ]
            ]
        ]);
        $response->assertGraphQLErrorMessage('Variable "$password" of required type "String!" was not provided.');
    }

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function ログイン情報が間違っている場合、Authenticationエラーがかえること()
    {
        $params = [
            'email' => 'test01@example.com',
        ];
        $user = User::factory()->create($params);

        $response = $this->executeGraphQL([...$params, 'password' => 'hogehoge']);
        $response->assertJsonStructure([
            'errors' => [
                [
                    'message'
                ]
            ]
        ]);
        $response->assertGraphQLErrorMessage('Unauthorized');
        $response->assertGraphQLErrorCategory('authentication');
    }

    /**
     * @param array $params
     * @return TestResponse
     */
    private function executeGraphQL(array $params): TestResponse
    {
        return $this->graphQL(
            '
                mutation($email: String!, $password: String!) {
                    login(input: { email: $email, password: $password }) {
                        token
                    }
                }
            ',
            $params
        );
    }
}
