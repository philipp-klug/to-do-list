<?php

class todo {

    private $dbcon;
    protected $id;
    protected $title;

    /**
     * Constructor with DB connection
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
    }


    /**
     * Setter Title
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Statement add
     * Insert value that is in input named 'title' was entered
     * @return bool
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

    /**
     * Statement delete
     * @return bool
     */
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

    /**
     * Statement check
     * toggle 'checked' in db if 'check-btn' pressed
     * @return bool
     */
    public function check() {
        try {
            //checks, if to-do was entered

            if(empty($this->id)) {
                return false;
            } else {
                //execute statement
                $stmt = $this->dbcon->query("SELECT id, checked FROM todos WHERE id=$this->id");
                $todo = $stmt->fetch(PDO::FETCH_ASSOC);
                //$this->console_log($todo);
                $uId = $todo['id'];
                $checked = $todo['checked'];

                //toggle value
                $uChecked = $checked ? 0 : 1;

                //$this->console_log($uChecked);
                $res = $this->dbcon->query("UPDATE todos SET checked=$uChecked WHERE id =$uId");
                return true;
            }
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Statement get all
     * Returns all entries
     * @return object or false
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
