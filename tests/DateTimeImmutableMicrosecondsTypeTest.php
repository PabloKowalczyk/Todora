<?php

declare(strict_types=1);

namespace Todora\Tests;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\DrizzlePlatform;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;
use Todora\DateTimeImmutableMicrosecondsType;

class DateTimeImmutableMicrosecondsTypeTest extends TestCase
{
    private const TYPE_NAME = 'test_date_time_immutable_microseconds';
    /**
     * @var DateTimeImmutableMicrosecondsType|Type
     */
    private $dateTimeMicrosecondsType;

    public function setUp()
    {
        if (!Type::hasType(self::TYPE_NAME)) {
            Type::addType(self::TYPE_NAME, DateTimeImmutableMicrosecondsType::class);
        }

        $this->dateTimeMicrosecondsType = Type::getType(self::TYPE_NAME);
    }

    /**
     * @dataProvider supportedPlatformProvider
     * @test
     */
    public function supportedPlatformsWillHaveMicroseconds(AbstractPlatform $platform): void
    {
        $this->assertDateTimeFormat('Y-m-d H:i:s.u', $platform);
    }

    /**
     * @dataProvider unsupportedPlatformProvider
     * @test
     */
    public function unsupportedPlatformsWillHaveNotMicroseconds(AbstractPlatform $platform): void
    {
        $this->assertDateTimeFormat('Y-m-d H:i:s', $platform);
    }

    public function supportedPlatformProvider(): array
    {
        return [
            'postgres' => [new PostgreSqlPlatform()],
            'mysql57' => [new MySQL57Platform()],
        ];
    }

    public function unsupportedPlatformProvider(): array
    {
        return [
            'mysql' => [new MySqlPlatform()],
            'drizzle' => [new DrizzlePlatform()],
            'oracle' => [new OraclePlatform()],
        ];
    }

    private function assertDateTimeFormat(string $format, AbstractPlatform $platform): void
    {
        $dateTime = new \DateTimeImmutable();
        $dateTimeString = $dateTime->format($format);

        $this->assertSame(
            $dateTimeString,
            $this->dateTimeMicrosecondsType
                ->convertToDatabaseValue($dateTime, $platform)
        );
    }
}
