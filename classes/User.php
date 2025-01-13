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

    public function passwordsMatch($password, $confirmed){
        return $password === $confirmed;
    }

    public function register($email, $password){
        $result = $this->db->query("
            SELECT * FROM users WHERE email = '$email'
        ");

        if(count($result) > 0){
            return false;
        }
        
        $newUserId = $this->create([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'user_type_id' => 2
        ]);

        return $newUserId;
    }
}

