<?php



class ConnectionClass
{


    private $host = "your_host";
    private $user = "your_username";
    private $pass = "your_password";
    private $dbname = "your_db_name";

    function __construct($file, $description)
    {
        $this->file = $file;
        $this->description = $description;
    }

    public function getConnection()
    {
        $conn = new \mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function execute()
    {
        $conn = $this->getConnection();
        $sql = "INSERT INTO your_table (your_photo_name, your_description_photo) VALUES ('{$this->file}', '{$this->description}')";
        $conn->query($sql);
        $conn->close();
    }

    public function getAll()
    {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM your_table";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
