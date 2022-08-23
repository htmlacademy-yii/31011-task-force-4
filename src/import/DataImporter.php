<?php
namespace Blacking\TaskForce\import;

use SplFileObject;
use RuntimeException;
use Blacking\TaskForce\exception\FileFormatException;
use Blacking\TaskForce\exception\SourceFileException;

class DataImporter
{
    private  $filename;
    private  $columns;
    private  $fileObject;

    public function __construct(string $filename, array $columns, $table_sql_name, $sqlfilename)
    {
        $this->filename = $filename;
        $this->columns = $columns;
        $this->table_sql_name = $table_sql_name;
        $this->sqlfilename = $sqlfilename;
    }

    private function import():void
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Заданы неверные заголовки столбцов");
        }

        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }

        try {
            $this->fileObject = new SplFileObject($this->filename);
        }
        catch (RuntimeException $exception) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $header_data = $this->getHeaderData();

        if ($header_data !== $this->columns) {
            throw new FileFormatException("Исходный файл не содержит необходимых столбцов");
        }

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }
    }

    private function getData():array {
        return $this->result;
    }

    private function getHeaderData():?array {
        $this->fileObject->rewind();
        $data = $this->fileObject->fgetcsv();

        return $data;
    }

    private function getNextLine():?iterable {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }

        return $result;
    }

    private function validateColumns(array $columns):bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        }
        else {
            $result = false;
        }

        return $result;
    }

    private function dataToSql(): void
    {
        $sql_query = 'INSERT INTO ' . $this->table_sql_name;
        $sql_query_arr = [];

        foreach ($this->getData() as $values) {
            if ($values !== []) {
                foreach ($this->getHeaderData() as $key) {
                    $new_key[] = '`' . $key .'`';
                }
                foreach ($values as $value) {
                    $new_values[] = '"' . $value .'"';
                }
                $sql_query_arr[] = $sql_query . ' (' . implode(', ', $new_key) . ') VALUE ' . '(' . implode(', ', $new_values) . ');' . PHP_EOL;
                $new_key = [];
                $new_values = [];
            }
        }

        $this->sql_queries = $sql_query_arr;
    }

    private function saveSqlFile(): void
    {
        $sql_file = new SplFileObject($this->sqlfilename . '.sql', 'w');

        foreach ($this->sql_queries as $sql_query) {
            $sql_file->fwrite($sql_query);
        }
    }

    public function convert(): void
    {
        $this->import();
        $this->getData();
        $this->dataToSql();
        $this->saveSqlFile();
    }
}
