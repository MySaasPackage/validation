<?php

declare(strict_types=1);

namespace MySaasPackage\Validation\Rules;

use PHPUnit\Framework\TestCase;

final class NotEmptyTest extends TestCase
{
    protected NotEmpty $rule;

    public function setup(): void
    {
        $this->rule = new NotEmpty();
    }

    public function testNotEmptyRuleSuccessfully(): void
    {
        $result = $this->rule->validate('valid text');
        $this->assertTrue($result->isValid());
        $this->assertFalse($result->isNotValid());
    }

    public function testStringTypeRuleWithInvalidInput(): void
    {
        $result = $this->rule->validate('');
        $this->assertFalse($result->isValid());
        $this->assertTrue($result->isNotValid());
        $this->assertCount(1, $result->getViolations());
        [$violation] = $result->getViolations();
        $this->assertEquals(NotEmpty::KEYWORD, $violation->keyword);
        $this->assertEquals(null, $violation->args);
        $this->assertEquals('The value cannot be empty', $violation->message);
    }
}
