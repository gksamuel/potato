<?php

/**
 * Description of PotatoORM
 *
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category library
 */
class PotatoORM {
    /*
     * Constructor method for potatoORM class
     * Creates database object
     */

    public function __construct() {
        $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USERNAME, PASSWORD);
    }

    /*
     * getAll method - fetches all records from the table.
     * @param none
     * @returns n/a
     * 
     */

    function getAll() {
        $classname = get_class($this);
        $statement = $this->db->prepare("SELECT * FROM $classname");
        $statement->execute();
        $this->$classname = (array) $statement->fetchAll();
    }

    /*
     * destroy method - deletes a record from a table
     * @params id - the primary key of the record to be deleted.
     * @returns n/a
     */

    function destroy($id) {
        $primaryKey = $this->getKey(get_class($this));
        $classname = get_class($this);
        $statement = $this->db->prepare("delete from $classname where $primaryKey = $id");
        $statement->execute();
        $this->error = $statement->errorInfo();
    }

    /*
     * find method - retreives a record from a table
     * @param $id - the primary key of the record to be retrieved.
     * @returns n/a
     */

    function find($id) {
        $primaryKey = $this->getKey(get_class($this));
        $classname = get_class($this);
        $statement = $this->db->prepare("select *  from $classname where $primaryKey = $id");
        $statement->execute();
        $props = get_class_vars($classname);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            foreach ($props as $name => $value) {
                $this->$name = $row[$name];
            }
        }
    }

    /*
     * save method - updates a record in the table.
     * if the record does not exist it will create a new record.
     */

    function save() {
        try {
            $primaryKey = $this->getKey(get_class($this));
            $classname = get_class($this);
            $props = get_class_vars($classname);
            if ($this->$primaryKey == null) {
                $insertParams = $this->getInsertClause($props);
                $query = "insert into $classname " . $insertParams['columns'] . " values " . $insertParams['values'];
                $statement = $this->db->prepare($query);
                $statement->execute();
                $error = $statement->errorInfo();
                if ($error[0] == "00000") {
                    $this->$primaryKey = $this->db->lastInsertId();
                } else {
                    $this->error = $error;
                    throw new Exception($error[2]);
                }
            } else {
                $whereclause = $this->getWhereClause($props);
                $query = "update $classname set $whereclause where  $primaryKey = " . $this->$primaryKey;
                $statement = $this->db->prepare($query);
                $statement->execute();
            }
        } catch (Exception $e) {
            
        }
    }

    /*
     * getKey method - identifies the primary key of a table
     * @param $model - the name of the class. This is assumed to be the name of the table
     */

    function getKey($model) {
        $select = $this->db->query("SELECT * FROM $model limit 1");
        $meta = $select->getColumnMeta(0);
        $columns = $select->columnCount();
        $x = 0;
        while ($x < $columns) {
            $meta = $select->getColumnMeta($x);
            if ($meta['flags'][1] == 'primary_key') {
                return $meta['name'];
            }
            $x++;
        }
    }

    /*
     * getWhereClause method - this method constucts the where clause of sql update statement.
     * @param $props - an array containing the properties of the table.
     * @return $whereClause - a string containing the where clause of the sql statement.
     */

    function getWhereClause($props) {
        $whereclause = "";
        $counter = 0;
        foreach ($props as $name => $value) {
            $whereclause .= $name . " = '" . $this->$name . "'";
            if ($counter < count($props) - 1) {
                $whereclause .= ",";
            }
            $counter++;
        }
        return $whereclause;
    }

    /*
     * getInsertClause method - This method constructs the insert clause of the the sql statement
     * @param $props - an array containing the properties of the table.
     * @return $insert - a string containing the insert clause of the sql statement.
     */

    function getInsertClause($props) {
        $columns = "";
        $values = "";
        $counter = 0;
        foreach ($props as $name => $value) {
            if ($this->$name != null) {
                $columns .= $name;
                $values .= "'" . $this->$name . "'";
                if ($counter < count($props) - 1) {
                    $columns .= ",";
                    $values .= ",";
                }
            }
            $counter++;
        }
        $columns = "(" . $columns . ")";
        $values = "(" . $values . ")";
        $insert['columns'] = $columns;
        $insert['values'] = $values;
        return $insert;
    }

}
