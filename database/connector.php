<?php

class DatabaseConnector
{
    private $databaseName;

    private $databasePassword;

    private $databaseUsername;

    private $connection;

    private $statement;
    public function __construct()
    {
        $this->databaseName = DB_NAME;
        $this->databasePassword = DB_PASSWORD;
        $this->databaseUsername = DB_USERNAME;

        $this->connection = $this->connectToDatabase($this->databaseName, $this->databaseUsername, $this->databasePassword);
    }

    /** Attempt connecting to the database
     * @param $databaseName
     * @param $username
     * @param $password
     * @return PDO|null
     */
    private function connectToDatabase($databaseName, $username, $password)
    {
        $connection = null;
        try {
            $connection = new PDO('mysql:host=localhost;dbname=shop', $username, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch (Exception $exception) {
            echo $exception->getMessage();
        }

        return $connection;
    }

    /** prepare the query to be executed
     * @param $query
     * @return $this
     */
    public function query($query)
    {
        $this->statement = $this->connection->prepare($query);
        return $this;
    }

    /** bind wildcard parameters to the query
     * @param $param
     * @param $value
     * @param null $type
     * @return $this
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
        return $this;
    }


    /**
     * execute the query
     */
    public function execute()
    {
        $this->statement->execute();
    }

    /** insert records to a table
     * @param $data
     */
    public function insert($data)
    {
        $this->statement->execute($data);
    }


    /** return a collection of results from database query
     * @return mixed
     */
    public function fetchResults()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }


    /** return the first result from a database query
     * @return mixed
     */
    public function fetchOne()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }


}