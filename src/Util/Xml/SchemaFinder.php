<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\Xml;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @psalm-immutable
 */
final class SchemaFinder
{
    /**
     * @throws Exception
     */
    public function find(string $version): string
    {
        $filename = $this->path() . $version . '.xsd';

        if (!\is_file($filename)) {
            throw new Exception(
                \sprintf(
                    'Schema for PHPUnit %s is not available',
                    $version
                )
            );
        }

        return $filename;
    }

    private function path(): string
    {
        if (\defined('__PHPUNIT_PHAR_ROOT__')) {
            return __PHPUNIT_PHAR_ROOT__ . '/schema/';
        }

        return __DIR__ . '/../../../schema/';
    }
}
