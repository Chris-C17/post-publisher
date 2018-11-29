<?php
/**
 * PDO Database Class
 * Connect to database and Create prepared statements
 * Bind values
 * Return rows and results
 */
# Include methods to SELCECT, INSERT from databases etc (model uses this file)
class DatabaseController
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    # Use database handler ($dbh) to prepare statements (instead of $pdo)
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        //# Set DSN (mySQL)
        //$dsn = 'mysql:host=' . $host. ';dbname=' . $dbname;

        # Set DSN (SQLite)
        $dsn = 'sqlite:' . $this->dbname;

//        # Create options to check for open DB connections and set the ERRMODE (MySQL)
//        $options = array(
//            PDO::ATTR_PERSISTENT => true,
//            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//        );

        # Create PDO instance - database is opened (or created if it doesn't exist)
        # in the mvc/public/ directory
        try
        {
//          $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);   // MySQL
            $this->dbh = new PDO($dsn);

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    # Prepare statement with query (sequence: make query, bind value, execute)
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    # Bind Values
    public function bind($param, $value, $type = null)
    {
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    # execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    # Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    # Get single record as object (fetch a single row)
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    # Get row count - I don't think this function works with SQLite
    # (might need to implement different code)
    # https://stackoverflow.com/questions/883365/row-count-with-pdo
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}