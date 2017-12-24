<?php

namespace PostgreSQLTutorial;

class BlobDB
{
    private $pdo;

    private function connect()
    {
        $parameter = parse_ini_file('database.ini');
        if ($parameter === false)
            throw new Exception("Error reading database configuration file");
        
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s' , $parameter['host'] , $parameter['port'] , $parameter['database']);
        $this -> pdo = new \PDO($dsn , $parameter['user'] , $parameter['password']);
        $this -> pdo -> setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
    }

    public function __construct()
    {
        $this -> connect();
    }

    public function insert($stockId , $fileName , $mimeType , $pathToFile)
    {
        if (!file_exists($pathToFile))
            throw new Exception("File %s not found");

        $sql = 'insert into company_files (stock_id , mime_type , file_name , file_data)
                values (:stock_id , :mime_type , :file_name , :file_data)' ;

        try {
            $this -> pdo -> beginTransaction();

            $fileData = $this -> pdo -> pgsqlLOBCreate();
            $stream = $this -> pdo -> pgsqlLOBOpen($fileData , 'w');

            $fh = fopen($pathToFile , 'rb');
            stream_copy_to_stream($fh , $stream);

            $fh = null;
            $stream = null;

            $pdoState = $this -> pdo -> prepare($sql);

            $pdoState -> execute(
                [
                    ":stock_id" => $stockId,
                    ":mime_type" => $mimeType,
                    ":file_name" => $fileName,
                    ":file_data" => $fileData
                ]
            );

            $this -> pdo -> commit();
        } catch (\PDOException $e) {
            $this -> pdo -> rollBack();
            throw $e;
        }
        return $this -> pdo -> lastInsertId('company_files_id_seq');
    }

    public function read($id)
    {
        $sql = "select file_data, mime_type from company_files where id = :id";
        $this -> pdo -> beginTransaction();

        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute([$id]);

        $stmt->bindColumn('file_data', $fileData, \PDO::PARAM_STR);
        $stmt->bindColumn('mime_type', $mimeType, \PDO::PARAM_STR);
        $stmt->fetch(\PDO::FETCH_BOUND);
        $stream = $this->pdo->pgsqlLOBOpen($fileData, 'r');

        header("Content-type:" . $mimeType);
        fpassthru($stream);
    }

    public function delete($id)
    {
        try {
            $this -> pdo -> beginTransaction();

            // $pdoState = $this -> pdo -> prepare("select file_data from company_files where id = :id");
            // $pdoState -> execute ([$id]);
            // $pdoState -> bindColumn('file_data' , $fileData , \PDO::PARAM_STR);
            // $pdoState -> closeCursor();

            // $this -> pdo -> pgsqlLOBUnlink($fileData);
            $pdoState = $this -> pdo -> prepare("delete from company_files where id = :id");
            $pdoState -> execute ([$id]);   

            $this -> pdo -> commit();

            return $pdoState -> rowCount();
        } catch (\PDOException $e) {
            $this -> pdo -> rollBack();
            throw $e;
        }
    }
}
