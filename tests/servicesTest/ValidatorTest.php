<?php

use app\services\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Testing class for test Validator
 */
class ValidatorTest extends TestCase
{
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new Validator();
    }

    protected function tearDown()
    {
        $this->fixture = null;
    }

    /**
     * Test ValidateInt method
     *
     * @dataProvider providerTestValidateInt
     */
    public function testValidateInt($value, $expect)
    {
        $result = $this->fixture->validateInt($value);

        $this->assertEquals($expect, $result);
    }

    /**
     * Provider data array for function testValidateInt
     *
     * @return array
     */
    public function providerTestValidateInt()
    {
        return [
            ['21', 21],
            [43, 43],
            [' 92', 92],
            ['abc', 0],
        ];
    }

    /**
     * Test sanitizeSpecialChars method
     *
     * @dataProvider providerTestSanitizeSpecialChars
     */
    public function testSanitizeSpecialChars($str, $expect)
    {
        $result = $this->fixture->sanitizeSpecialChars($str);

        $this->assertEquals($expect, $result);
    }

    /**
     * Provider data array for function testSanitizeSpecialChars
     *
     * @return array
     */
    public function providerTestSanitizeSpecialChars()
    {
        return [
            ['<b>John</b>', '&#60;b&#62;John&#60;/b&#62;'],
            [
                '<script>alert(\'Hi\');</script>',
                '&#60;script&#62;alert(&#39;Hi&#39;);&#60;/script&#62;'
            ],
            ['Hello', 'Hello'],
            ['<', '&#60;'],
        ];
    }
}
