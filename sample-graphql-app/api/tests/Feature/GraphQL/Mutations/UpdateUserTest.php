<?php

namespace Tests\Feature\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function ユーザーの更新処理ができること()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $valuables = [
            'id' => 1,
            'name' => 'takumi',
            'email'=> 'takumi@example.com',
            'file' => null
        ];
        $files = [
            0 => UploadedFile::fake()->create('test.png', 500)
        ];

        $this->actingAs($user, 'api');
        $response = $this->executeGraphQL($valuables, $files);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    /**
     * @param array $valuables
     * @param array $file
     * @return TestResponse
     */
    private function executeGraphQL(array $valuables, array $file): TestResponse
    {
        return $this->multipartGraphQL(
            [
                'query' => '
                    mutation($id: ID! $name: String, $email: String, $file: Upload) {
                        updateUser(input: { id: $id, name: $name, email: $email, file: $file }) {
                            id
                        }
                    }
                ',
                'variables' => $valuables
            ],
            [
                '0' => ['variables.file'],
            ],
            $file
        );
    }
}
