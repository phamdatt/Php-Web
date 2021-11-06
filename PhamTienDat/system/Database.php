<?php

class Database extends Config
{
    private $conn = NUll;
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $this->conn->set_charset("utf-8");
    }
    //product ---> c7c1_product
    protected function TableName($name)
    {
        return $this->dbfrix . $name;
    }
    protected function getRow($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    protected function getList($sql)
    {
        $result = $this->conn->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    protected function getCount($sql)
    {
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    protected function setQuery($sql, $insert = FALSE)
    {
        if ($insert == TRUE) {
            if ($this->conn->query($sql) == TRUE) {
                $last_id = $this->conn->insert_id;


                return $last_id;
            } else {

                return NULL;
            }
        } else {

            $this->conn->query($sql);
        }
    }
}
