<?php

class todo {

    private $dbcon;
    protected $id;
    protected $title;

    /**
     * ___DEBUG
     */
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    /**
     * Constructor for DB connection
     * @param $dbcon
     */
    function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }

    /**
     * Setter ID
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
        $this->console_log($id);
    }


    /**
     * Setter Title
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }


    /**
     * ***
     * Statements
     * ***
     */
    public function add() {
        try {
            $stmt = $this->dbcon->prepare("INSERT INTO todos(title) VALUE(:title)");
            $stmt->bindparam(':title', $this->title);
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function delete(){
        try {
            $stmt = $this->dbcon->prepare("DELETE FROM todos WHERE id=:id");
            $stmt->bindparam(":id",$this->id);
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function check() {
        $stmt = $this->dbcon->query("SELECT id, checked FROM todos WHERE id=$this->id");
        die($stmt);
        try {
            //checks, if to-do was entered

            if(empty($this->id)) {
                echo 'error';
            } else {
                //execute statement
                $stmt = $this->dbcon->query("SELECT id, checked FROM todos WHERE id=$this->id");


                $todo = $stmt->fetch();
                $stmt->execute();

                $uId = $todo['id'];
                $checked = $todo['checked'];

                //toggle value
                $uChecked = $checked ? 0 : 1;

                $res = $this->dbcon->prepare("UPDATE todos SET checked=:uChecked WHERE id =:uid");
                $res->bindparam(
                    ":uChecked",$uChecked,
                    ":uid",$this->id
                );
                $res->execute();



            }

        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Get all entry
     */
    public function getAll() {
        try {
            $stmt = $this->dbcon->prepare("SELECT * FROM todos ORDER BY id DESC ");
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e){
                echo $e->getMessage();
                return false;
        }
    }
}
