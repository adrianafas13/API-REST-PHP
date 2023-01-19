<?php

    class User{
        private $name;
        private $lastName;
        private $birthday;
        private $country;

        public function __construct($name, $lastName, $birthday, $country){
            $this->name = $name;
            $this->lastName = $lastName;
            $this->birthday = $birthday;
            $this->country = $country;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
            return $this;
        }

        public function getLastName(){
            return $this->lastName;
        }

        public function setLastName($lastName){
            $this->lastName = $lastName;
            return $this;

        }

        public function getBirthday(){
            return $this->birthday;
        }

        public function setBirthday($birthday){
            $this->birthday = $birthday;
            return $this;
        }

        public function getCountry(){
            return $this->country;
        }

        public function setCountry($country){
            $this->country = $country;
            return $this;
        }


        public function __toString(){
            return $this->name ." ".$this->lastName ." ".$this->birthday ." ".$this->country;
        }

        //methods

        public function createUser(){
            $contentFile = file_get_contents("../data/users.json");
            $users = json_decode($contentFile, true);
            $users[] = array(
                "name"=> $this->name,
                "lastName"=> $this->lastName,
                "birthday"=> $this->birthday,
                "country"=> $this->country
            );
            $file = fopen("../data/users.json","w");
            fwrite($file, json_encode($users));
            fclose($file);
        }

        public static function readUser(){
            $contentFile = file_get_contents("../data/users.json");
            echo $contentFile;
        }

        public static function getUser($id){
            $contentFile = file_get_contents("../data/users.json");
            $users = json_decode($contentFile, true);
            echo json_encode($users[$id]);
        }

        public function updateUser($id){
            $contentFile = file_get_contents("../data/users.json");
            $users = json_decode($contentFile, true);
            $user = array(
                'name'=> $this->name,
                'lastName'=> $this->lastName,
                'birthday'=> $this->birthday,
                'country'=> $this->country,
            );
            $users[$id] = $user;
            $file = fopen('../data/users.json','w');
            fwrite($file, json_encode($users));
            fclose($file);
        }

        public static function deleteUser($id){
            $contentFile = file_get_contents("../data/users.json");
            $users = json_decode($contentFile, true);
            array_splice($users, $id, 1);
            $file = fopen('../data/users.json','w');
            fwrite($file, json_encode($users));
            fclose($file);
        }
    }

?>