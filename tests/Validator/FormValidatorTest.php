<?php
namespace Tests\Validator;

use Core\Model\UserModel;
use Core\Validator\FormValidator;
use PHPUnit\Framework\TestCase;

class FormValidatorTest extends TestCase
{
    public function testIsValidEmail()
    {
        $this->assertSame(true, FormValidator::isValidEmail("test@test.com"));
        $this->assertSame(false, FormValidator::isValidEmail("test-.@test.com"));
    }

    public function testIsValidRegForm()
    {
        $userModel = new UserModel();
        $userModel->username = "alex";
        $userModel->password = "123456";
        $userModel->email = "test@test.ru";
        $userModel->fullname = "Александр";

        $this->assertSame(true, FormValidator::isValidRegForm($userModel));
    }

    public function testIsValidAuthForm()
    {
        $userModel = new UserModel();
        $userModel->username = "alex";
        $userModel->password = "123456";

        $this->assertSame(true, FormValidator::isValidAuthForm($userModel));
    }

    public function testIsValidFullname()
    {
        $this->assertSame(false, FormValidator::isValidFullname("alex"));
        $this->assertSame(true, FormValidator::isValidFullname("Александр"));
    }

    public function testIsValidUsername()
    {
        $this->assertSame(true, FormValidator::isValidUsername("alex"));
        $this->assertSame(false, FormValidator::isValidUsername("Александр"));
    }

    public function testIsValidPassword()
    {
        $this->assertSame(true, FormValidator::isValidPassword("alex123"));
        $this->assertSame(false, FormValidator::isValidPassword("Александр123"));
    }
}
