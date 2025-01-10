<?php

class UserManager extends DBManager {

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
        $this->columns = ['id', 'name', 'password', 'user_type_id'];
    }

    // Public Methods
    public function login($email, $password){
        $stmt = $this->db->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result && password_verify($password, $result['password'])) {
            $user = (object) [
                'id' => $result['id'],
                'email' => $result['email'],
                'is_admin' => $result['user_type_id'] == 1
            ];
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
}

