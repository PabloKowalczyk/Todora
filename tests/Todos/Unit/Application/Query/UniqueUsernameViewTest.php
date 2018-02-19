<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Unit\Application\Query;

use PHPUnit\Framework\TestCase;
use Todora\Todos\Application\Query\UniqueUsernameView;

class UniqueUsernameViewTest extends TestCase
{
    /**
     * @test
     * @dataProvider usernameCountProvider
     */
    public function usernameIsUniqueWithZeroAmount(int $count, bool $expectedUniqueness): void
    {
        $uniqueUsernameView = new UniqueUsernameView($count);

        $this->assertSame($expectedUniqueness, $uniqueUsernameView->isUnique());
    }

    public function usernameCountProvider(): array
    {
        return [
            'unique' => [
                'count' => 0,
                'expectedUniqueness' => true,
            ],
            'notUnique' => [
                'count' => 1,
                'expectedUniqueness' => false,
            ],
        ];
    }
}
