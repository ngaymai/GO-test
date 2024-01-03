<?php
class Database
{
    protected $connection = null;

    public function __construct()
    {
        $host        = "host = db.yzeoonnyndcsyzbpfmly.supabase.co";
        $port        = "port = 5432";
        $dbname      = "dbname = postgres";
        $credentials = "user = postgres password=bklqd16192001";
        try {
            $this->connection = pg_connect("$host $port $dbname $credentials");

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function select($query = "")
    {
        try {

            $res = pg_query($this->connection, $query);    
            $row = pg_fetch_all($res); 
            pg_close($this->connection);
            return $row;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($query = "")
    {
        try {
            $res = pg_query($this->connection, $query);                   
            pg_close($this->connection);
            return True;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    
}