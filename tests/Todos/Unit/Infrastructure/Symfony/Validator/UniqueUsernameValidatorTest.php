<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Unit\Infrastructure\Symfony\Validator;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;
use Todora\Todos\Application\Query\UniqueUsernameQueryInterface;
use Todora\Todos\Application\Query\UniqueUsernameView;
use Todora\Todos\Infrastructure\Symfony\Validator\UniqueUsername;
use Todora\Todos\Infrastructure\Symfony\Validator\UniqueUsernameValidator;

class UniqueUsernameValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider emptyOrNonStringValueProvider
     */
    public function validateDoNothingWithEmptyOrNonStringValue($value): void
    {
        /** @var UniqueUsernameQueryInterface|\PHPUnit_Framework_MockObject_MockObject $mockUniqueUsernameQuery */
        $mockUniqueUsernameQuery = $this->createMock(UniqueUsernameQueryInterface::class);
        /** @var ExecutionContextInterface|\PHPUnit_Framework_MockObject_MockObject $mockContext */
        $mockContext = $this->createMock(ExecutionContextInterface::class);
        /** @var UniqueUsername|\PHPUnit_Framework_MockObject_MockObject $mockConstraint */
        $mockConstraint = $this->createMock(UniqueUsername::class);

        $validator = new UniqueUsernameValidator($mockUniqueUsernameQuery);
        $validator->initialize($mockContext);

        $mockUniqueUsernameQuery
            ->expects($this->never())
            ->method('execute')
        ;

        $validator->validate($value, $mockConstraint);
    }

    /** @test */
    public function validateDoNothingWithUniqueUsername(): void
    {
        /** @var UniqueUsernameQueryInterface|\PHPUnit_Framework_MockObject_MockObject $mockUniqueUsernameQuery */
        $mockUniqueUsernameQuery = $this->createMock(UniqueUsernameQueryInterface::class);
        /** @var ExecutionContextInterface|\PHPUnit_Framework_MockObject_MockObject $mockContext */
        $mockContext = $this->createMock(ExecutionContextInterface::class);
        /** @var UniqueUsername|\PHPUnit_Framework_MockObject_MockObject $mockConstraint */
        $mockConstraint = $this->createMock(UniqueUsername::class);
        $mockUniqueUsernameView = $this->createMock(UniqueUsernameView::class);

        $validator = new UniqueUsernameValidator($mockUniqueUsernameQuery);
        $validator->initialize($mockContext);

        $mockUniqueUsernameQuery
            ->method('execute')
            ->willReturn($mockUniqueUsernameView)
        ;

        $mockUniqueUsernameView
            ->method('isUnique')
            ->willReturn(true)
        ;

        $mockContext
            ->expects($this->never())
            ->method('buildViolation')
        ;

        $validator->validate('SomeName', $mockConstraint);
    }

    /** @test */
    public function validateAddViolationOnNonUniqueUsername(): void
    {
        /** @var UniqueUsernameQueryInterface|\PHPUnit_Framework_MockObject_MockObject $mockUniqueUsernameQuery */
        $mockUniqueUsernameQuery = $this->createMock(UniqueUsernameQueryInterface::class);
        /** @var ExecutionContextInterface|\PHPUnit_Framework_MockObject_MockObject $mockContext */
        $mockContext = $this->createMock(ExecutionContextInterface::class);
        /** @var UniqueUsername|\PHPUnit_Framework_MockObject_MockObject $mockConstraint */
        $mockConstraint = $this->createMock(UniqueUsername::class);
        $mockUniqueUsernameView = $this->createMock(UniqueUsernameView::class);
        $mockConstraintViolationBuilder = $this->createMock(ConstraintViolationBuilderInterface::class);

        $validator = new UniqueUsernameValidator($mockUniqueUsernameQuery);
        $validator->initialize($mockContext);

        $mockUniqueUsernameQuery
            ->method('execute')
            ->willReturn($mockUniqueUsernameView)
        ;

        $mockUniqueUsernameView
            ->method('isUnique')
            ->willReturn(false)
        ;

        $mockContext
            ->method('buildViolation')
            ->willReturn($mockConstraintViolationBuilder)
        ;

        $mockConstraintViolationBuilder
            ->expects($this->once())
            ->method('addViolation')
        ;

        $validator->validate('SomeName', $mockConstraint);
    }

    public function emptyOrNonStringValueProvider(): array
    {
        return [
            'emptyArray' => [
                [],
            ],
            'false' => [
                false,
            ],
            'true' => [
                true,
            ],
            'null' => [
                null,
            ],
            'emptyString' => [
                '',
            ],
        ];
    }
}
