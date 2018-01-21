<?php

declare(strict_types=1);

namespace Todora;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\VarDateTimeImmutableType;

class DateTimeImmutableMicrosecondsType extends VarDateTimeImmutableType
{
    /**
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (\is_object($value) &&
            $value instanceof \DateTimeImmutable &&
            ($platform instanceof PostgreSqlPlatform || $platform instanceof MySQL57Platform)
        ) {
            $dateTimeFormat = $platform->getDateTimeFormatString();

            return $value->format("{$dateTimeFormat}.u");
        }

        return parent::convertToDatabaseValue($value, $platform);
    }
}
