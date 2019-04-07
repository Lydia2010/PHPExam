<?php
  class User {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
        //Find user by emeil
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users where email = :email');
            $this->db->bind(':email',$email);

            $row = $this->db->single();

            //Check row
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }

    }
      public function checkUserExists($name)
      {
          $query = "select count(*) from users where name=:name";
          $this->db->query($query);
          $this->db->bind(":name", $name, PDO::PARAM_STR);
          $this->db->execute();
          $rowCount = $this->db->fetchColumn();

          if ($rowCount == 0) {
              //"invalid login"
              return false;
          } else {
              return true;
          }
      }


      public function createAccount($name, $password)
      {
          $alreadyExists = $this->checkUserExists($name);
          if ($alreadyExists) {
              return false;
          }


          $query = "insert into users(name, password) values(:name,:password)";
          $this->db->query($query);
          $this->db->bind(":name", $name);
          $this->db->bind(":password", $password);

          $success = $this->db->execute();
          return $success;
      }


  }
