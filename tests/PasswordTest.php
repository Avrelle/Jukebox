<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Regex;

class PasswordTest extends TestCase
{
    public function testValidePassword()
    {
        $validator = Validation::createValidator();
        $password = 'Toto';

        $constraint = new Regex([
            'pattern' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ]);

        $violations = $validator->validate($password, $constraint);

        $this->assertCount(0, $violations);
    }

    public function testInvalidPassword()
    {
        $validator = Validation::createValidator();
        $password = 'tata';

        $constraint = new Regex([
            'pattern' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ]);

        $violations = $validator->validate($password, $constraint);

        $this->assertCount(1, $violations);
    }
}