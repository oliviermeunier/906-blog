<?php 

namespace App\Model;

use App\Framework\AbstractModel;
use App\Exception\UserAlreadyExistsException;

class UserModel extends AbstractModel {

    function createUser(string $firstname, string $lastname, string $email, string $hash)
    {
        // Si il existe déjà un compte avec cet email... 
        if ($this->getUserByEmail($email)) {

            // ... on lance une exception ! 
            throw new UserAlreadyExistsException('Il existe déjà un compte associé à cet email');
        }

        $sql = 'INSERT INTO user
                (firstname, lastname, email, password, created_at)
                VALUES (?,?,?,?, NOW())';

        $this->database->executeQuery($sql, [$firstname, $lastname, $email, $hash]);
    }

    function getUserByEmail(string $email)
    {
        $sql = 'SELECT * 
                FROM user
                WHERE email = ?';

        return $this->database->selectOne($sql, [$email]);
    }

}