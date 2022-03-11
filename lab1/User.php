<?php
require_once './vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Constraints\{Length, NotBlank, Email, Regex};

echo "<link rel='stylesheet' href='style.css'>";
class User
{
    private string $_id;
    private string $_mail;
    private string $_pass;
    private $_timeConstruct;

    public function __construct(string $id, string $mail, string $pass)
    {
        $this->_timeConstruct = date("F j, Y, g:i a");

        $violations = $this->validPass($pass);
        $this->violationReport($violations, 'Invalid user pass');

        $violations = $this->validIp($id);
        $this->violationReport($violations, 'Invalid user id');

        $violations = $this->validName($mail);
        $this->violationReport($violations, 'Invalid mail');


        $this->_pass = $pass;
        $this->_id = $id;
        $this->_mail = $mail;

    }

    public function getCunstDate()
    {
        return $this->_timeConstruct;
    }

    public function echoPrint(): void
    {
        echo "<br>User: Alex <br>";
        echo "Id: $this->_id<br>";
        echo "mail: $this->_mail<br>";
        echo "Password: $this->_pass<br>";
    }

    private function violationReport(ConstraintViolationListInterface $violations, string $title): void
    {
        if (count($violations) <= 0)
            return;
        echo '<h3>' . $title . '</h3>';
        foreach ($violations as $violation) {
            echo $violation->getMessage() . 'br';
        }
    }
    private function validPass(string $pass): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($pass, [
            new NotBlank(),
            new Regex(['pattern' => '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',]),
        ]);
    }
    private function validIp(string $id): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($id, [
            new NotBlank(),
            new Regex(['pattern' => '/([0-9]{1,3}[\.]){3}[0-9]{1,3}/',]),
        ]);
    }

    private function validName(string $mail): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($mail, [
            new Length(['min' => 7]),
            new NotBlank(),
            new Email(),
        ]);
    }


}
