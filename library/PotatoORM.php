<?php

/**
 * Databaase abstraction library
 * @author samuel gachanja <gksamuel1@gmail.com>
 * @version 1.0 March 2016
 * @category model
 */

/**
 * Contains functions to interact with the database
 */
class PotatoORM {

    /**
     * Constructor method for potatoORM class
     * Creates database object
     */
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USERNAME, PASSWORD);
        } catch (Exception $e) {
            echo "Could not  connect to database";
            die();
        }
    }

    /**
     * getAll method - fetches all records from the table.
     * @param none
     * @returns true if records were retrieved false if unable to get records
     * 
     */
    function getAll() {
        $classname = get_class($this);
        $statement = $this->db->prepare("SELECT * FROM $classname");
        $statement->execute();
        $this->$classname = (array) $statement->fetchAll();
        if ($statement->errorInfo()[0] == '00000') {
            return true;
        } else {
            return false;
        }
    }

    /**
      destroy method - deletes a record from a table
      @returns true if records were retrieved false if unable to get records
      @param integer $id - the primary key of the record to be deleted.
     */
    function destroy($id) {
        $primaryKey = $this->getKey(get_class($this));
        $classname = get_class($this);
        $statement = $this->db->prepare("delete from $classname where $primaryKey = $id");
        $statement->execute();
        $this->error = $statement->errorInfo();
        if ($statement->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * find method - retreives a record from a table
     * @param $id - the primary key of the record to be retrieved.
     * @returns true if records was found, false if record was not found
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
        if ($statement->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * save method - updates a record in the table.
     * if the record does not exist it will create a new record.
     * @returns true if record was saved, false if unable to save record
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
                    return true;
                } else {
                    $this->error = $error;
                    return false;
                }
            } else {
                $whereclause = $this->getWhereClause($props);
                $query = "update $classname set $whereclause where  $primaryKey = " . $this->$primaryKey;
                $statement = $this->db->prepare($query);
                $statement->execute();
                if ($statement->rowCount() == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            echo "Could not save record";
        }
    }

    /**
     * getKey method - identifies the primary key of a table
     * @param $model - the name of the class. This is assumed to be the name of the table
     * @return String - the name of the table primary key
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
        return false;
    }

    /**
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

    /**
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
