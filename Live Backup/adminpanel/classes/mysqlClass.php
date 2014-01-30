<?php

/**
 *  Db - A simple mysql database class
 *
 *
 */
class Db {

    private $connectionId = array();
    public $cfg;

    public function __construct() {
        global $cfg;  ///for accessing confuguration file
        $this->cfg = $cfg;
        if (function_exists('mysqli_connect') && isset($cfg['db_host']) && isset($cfg['db_user']) && isset($cfg['db_pass']) && isset($cfg['db_name']) && isset($cfg['db_port']) && $cfg['db_port'] != '') {
            $this->connectionId = @mysqli_connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name'], $cfg['db_port']);
        } elseif (function_exists('mysqli_connect') && isset($cfg['db_host']) && isset($cfg['db_user']) && isset($cfg['db_pass']) && isset($cfg['db_name'])) {
            $this->connectionId = @mysqli_connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
        }
        if ($this->connectionId == FALSE) {
            die('Error on connecting to Database');
        }
        mysqli_set_charset($this->connectionId, 'utf8');
    }

    /**
     *  function for inserting data into table
     *   @param string tableName
     * 	 @param array values(associative array to inserting corresponding to fieldname as key and value as values)
     *
     */
    public function insert($tblName, $values) {
        if (is_array($values) && count($values) > 0) {
            $keys = array_keys($values);
            $sql = "INSERT INTO $tblName (`";
            $sql.=implode("`,`", $keys) . "`) VALUES (";
            $values = $values;
            $sql.="'" . implode("', '", $values) . "')";
            //echo $sql;
            $res = @mysqli_query($this->connectionId, $sql);
            if ($this->connectionId->error != '') {
                return array('error' => $this->connectionId->error);
            }
            return $res;
        }
    }

    /* function for inserting multiple value
     * @param string tableName
     * @param multidimensional array values(associative array to inserting corresponding to fieldname as key and value as values) Ex. array(array('fieldname'=>'value','fieldname'=>'value'),array('fieldname'=>'value','fieldname'=>'value'))
     *
     */

    public function insertMultiple($tblName, $values) {
        if (is_array($values) && count($values) > 0) {
            $sql = "";
            $keys = array_keys($values[0]);
            $sql.= " INSERT INTO $tblName (`";
            $sql.=implode("`,`", $keys) . "`) VALUES ";
            foreach ($values as $value) {
                $arr_val = array();
                $sql.="(";
                foreach ($value as $val) {
                    $sql.="'" . trim(htmlspecialchars($val, ENT_QUOTES, "UTF-8")) . "',";
                }
                $sql = rtrim($sql, ",");
                $sql.="),";
            }
            $sql = rtrim($sql, ",");
            @mysqli_query($this->connectionId, $sql);
            if ($this->connectionId->error != '') {
                return array('error' => $this->connectionId->error);
            }
            return TRUE;
        }
    }

    /**
     *  function for select data from table
     *   @param string tableName
     * 	 @param mix fieldNames
     * 	 @param array fieldNames(indexed array to selecting fields)
     *
     *
     */
    public function select($tableName, $fieldNames = '', $where = array(), $groupBy = '', $orderByColumn = '', $desc = FALSE, $limit = '', $offSet = '') {
        $conditions = array();
        $condition = "";
        $fields = "";
        $sql = "SELECT ";
        //where condition
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $key => $value) {
                if ($key != '')
                    $conditions[] = $key . "='" . mysqli_real_escape_string($this->connectionId, $value) . "'";
            }
            $condition = "WHERE " . implode(" AND ", $conditions);
        }
        //fieldname condition
        if ($fieldNames == '' || $fieldNames == '*') {
            $fields = "*";
        } elseif (is_array($fieldNames)) {
            $fields = "`" . implode("`,`", $fieldNames) . "`";
        } else {
            $fields = (string) ("`" . $fieldNames . "`");
        }
        $sql.="$fields FROM $tableName $condition";
        //group by condition
        if (isset($groupBy) && $groupBy != '') {
            $sql.=" GROUP BY " . $groupBy;
        }

        //order by column
        if (is_array($orderByColumn) && count($orderByColumn) > 0) {
            $sql.=" ORDER BY " . implode(",", $orderByColumn);
        } elseif ($orderByColumn != '') {
            $sql.=" ORDER BY " . $orderByColumn;
        }
        //descending selection
        if ($desc) {
            $sql.=" DESC ";
        }
        //offset and limits
        if ($limit != '')
            $sql.= " LIMIT $limit";
        if ($limit != '' && $offSet != '')
            $sql.=" ,$limit" . " ";
        $sql.=" ; ";
        $result = mysqli_query($this->connectionId, $sql);
        if ($this->connectionId->error != '') {
            return $this->connectionId->error;
        }
        $returnThis = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $returnThis[] = $rows;
        }
        mysqli_free_result($result);
        return $returnThis;
    }

    /*
     *
     * function to check unique in table
     *
     *
     */

    public function isUnique($table, $field, $data) {
        $result = $this->select($table, $field, array($field => $data));
        if (count($result) > 0) {
            return false;
        }
        else
            return true;
    }

    /*
     *
     * function search with left join
     *
     *
     */

    public function leftjoin($lefttable, $righttable, $matchedrow, $fields, $order = '') {
        if ($order != '') {
            $order.=" ORDER BY $order";
        }
        $condition = ' ';
        if (is_array($fields) && count($fields) > 0) {
            $fields = implode(", ", $fields);
        }
        if (is_array($matchedrow) && count($matchedrow) > 0) {
            foreach ($matchedrow as $key => $value) {
                $condition.=' ' . $key . '=' . $value . ' AND';
            }
            $condition = rtrim($condition, 'AND');
        }
        $sql = ("SELECT $fields FROM $lefttable LEFT JOIN $righttable ON $condition $order");
        $result = mysqli_query($this->connectionId, $sql);
        if ($this->connectionId->error != '') {
            return $this->connectionId->error;
        }
        $returnThis = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $returnThis[] = $rows;
        }
        return $returnThis;
    }

    /*
      function for updating table

     */

    public function update($tablename, $set, $where) {
        if ((!is_array($set) && $set != NULL) || (!is_array($where) && $where != NULL)) {

            return $this->debug("array", "Update", $tablename);
        } else {
            $where_count = 0;
            $condition = '';
            $count = 0;
            foreach ($set as $key => $val) {
                if ($count == 0)
                    $set = "`" . $key . "`" . "='" . htmlspecialchars($val, ENT_QUOTES, "UTF-8") . "'";
                else
                    $set .= ", " . "`" . $key . "`" . "= '" . htmlspecialchars($val, ENT_QUOTES, "UTF-8") . "'";
                $count++;
            }
            foreach ($where as $key => $value) {
                if ($where_count == 0)
                    $condition = "`" . $key . "`" . "='" . $value . "'";
                else
                    $condition .= " AND " . "`" . $key . "`" . "= '" . $value . "'";
                $where_count++;
            }
            $query = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $condition;
            $this->query($query);

            if ($this->affected() > 0) {
                return TRUE;
            } else {
                return $this->connectionId->error;
            }
        }
    }

    /* function for Multiple updating table
     * correspondig to array key and value
     * $setarr=array('set'=>array('field1'=>'value1'),
      'where'=>array('field2'=>'value2','field3'=>'value3'));
     *
     */

    public function updateMultiple($tableName, $setarr) {
        if (!is_array($setarr) || !count($setarr) > 0) {
            return false;
        }
        $sql = "";
        foreach ($setarr as $set) {
            $select = $this->select($tableName, "*", $set['where']);
            if (count($select) > 0) {
                foreach ($setarr as $set) {
                    $sql.=" UPDATE $tableName SET ";
                    foreach ($set['set'] as $key => $value) {
                        $sql.=" $key = '" . $value . "',   ";
                    }
                    $sql = rtrim($sql, ", ");
                    $sql.=" WHERE ";
                    foreach ($set['where'] as $key => $value) {
                        $sql.=" $key = '" . $value . "'   AND";
                    }
                    $sql = rtrim($sql, "AND");
                    $sql.=" ; ";
                }
            } else {
                $field = array();
                $data = array();
                foreach ($set['set'] as $key => $value) {
                    $field[] = $key;
                    $data[] = $value;
                }
                foreach ($set['where'] as $key => $value) {
                    $field[] = $key;
                    $data[] = $value;
                }
                $sql.=" INSERT INTO $tableName (`" . implode("`, `", $field) . "`) VALUES('" . implode("', '", $data) . "'); ";
            }
        }

        // echo $sql;
        mysqli_multi_query($this->connectionId, $sql);

        while (mysqli_more_results($this->connectionId)) {
            mysqli_use_result($this->connectionId);
            mysqli_next_result($this->connectionId);
        }
        $result = mysqli_error($this->connectionId);
        if ($result == '') {
            return 'success';
        } else {
            $err = 'Error on updating..';
            return $err;
        }
    }

    /*
      function for updating table condition where in

     */

    public function updateWhereIn(
    $tablename, $set = array(), $where = array()) {
        if ((!is_array($set) && $set != NULL) || (!is_array($where) && $where != NULL)) {

            return $this->debug("array ", "Update", $tablename);
        } else {
            $condition = ' WHERE ';
            $count = 0;
            foreach ($set as $key => $val) {
                if ($count == 0)
                    $set = "`" . $key . "`" . " = '" . $val . "'"
                    ;
                else
                    $set .= ", " . "`" . $key . "`" . " = '" . $val . "'";
                $count++;
            }
            foreach ($where as $key => $value) {
                $condition.= "`" . $key . "` IN ('" . $value . "' ) ";
            }
            $query = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $condition;

            $this->query($query);

            if ($this->affected() > 0) {
                return TRUE;
            } else {
                return $this->connectionId->error;
            }
        }
    }

    /* function for select using wherein clouse
     * @param tableName string
     * @param fieldNames string | * | array
     * @param where array('fieldsname'=>'comma sep val','fieldsname'=>'comma sep val')
     * @param orderbycolumn string
     * @param desc string
     * @param limit int
     * @param offset int
     */

    public function selectWhereIn(
    $tableName, $fieldNames = '', $where = array(), $orderByColumn = '', $desc = FALSE, $limit = '', $offSet = '') {
        $conditions = array();
        $condition = "";
        $fields = "";
        $sql = "  SELECT ";
        //where condition
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $key => $value) {
                if ($key != '')
                    $conditions[] = $key . " IN('" . str_replace(",", "', '", mysqli_real_escape_string($this->connectionId, $value)) . "')";
            }
            $condition = "WHERE " . implode(" AND ", $conditions);
        }
        //fieldname condition
        if ($fieldNames == '' || $fieldNames == '*') {
            $fields = "*";
        } elseif (is_array($fieldNames)) {
            $fields = "`" . implode("`, `", $fieldNames) . "`";
        } else {
            $fields = (string) ("`" . $fieldNames . "`");
        }
        $sql.="$fields FROM $tableName $condition";
        //order by column
        if (is_array($orderByColumn) && count($orderByColumn) > 0) {
            $sql.=" ORDER BY " . implode(", ", $orderByColumn);
        } elseif ($orderByColumn != '') {
            $sql.=" ORDER BY " . $orderByColumn;
        }
        //descending selection
        if ($desc) {
            $sql.=" DESC ";
        }
        //offset and limits
        if ($limit != '')
            $sql.=
                    " LIMIT $limit";
        if ($limit != '' && $offSet != '')
            $sql.=
                    ", $limit";
        $result = mysqli_query($this->connectionId, $sql);
        if ($this->connectionId->error != '') {
            return $this->connectionId->error;
        }
        $returnThis = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $returnThis[] = $rows;
        }
        return $returnThis;
    }

    /*
      function for deleting row from table

     */

    function delete($tablename, $where, $limit = "") {
        if ((!is_array($where) && $where != NULL)) {
            return $this->debug("array", "Delete

            ", $tablename);
        } else {
            $where_count = 0;
            foreach ($where as $key => $value) {

                if ($where_count == 0)
                    $where = "`" . $key . "`" . " = '" . $value . "'";
                else
                    $where .= " AND " . "`" . $key . "`" . " = " . $value;
                $where_count++;
            }

            $query = "  DELETE FROM
                " . $tablename . " WHERE " . $where;
            //echo $query;die;
            if ($limit != "")
                $query .= " LIMIT " . $limit;
            $this->query($query);

            if ($this->affected() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function debug($type =
    "", $action = "", $tablename = "") {
        switch ($type) {

            case "array":
                $message = $action . "   Error Occured";
                $result = "Could not update " . $tablename . " as variable supplied must be an array.";
                $query = "";
                $output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";

                break;
            default:
                if (mysqli_errno($this->connectionId)) {
                    $message = "MySQL Error Occured";
                    $result = mysqli_errno($this->connectionId) . ": " . mysqli_error($this->connectionId);
                    $output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
                } else {
                    $message = "MySQL Query Executed Succesfully.";
                    $result = mysqli_affected_rows($this->connectionId) . " Rows Affected";
                    $output = "view logs for details";
                }

                $linebreaks = array("\n", "\r");
                if ($this->query != "")
                    $query = "QUERY = " . str_replace($linebreaks, " ", $this->query);
                else
                    $query = "";
                break;
        }


        $output = $message . ":" . $result;

        return $output;
    }

    function query($query) {
        $dbQryResult = mysqli_query($this->connectionId, $query);
        return $dbQryResult;
    }

    function affected() {
        return mysqli_affected_rows($this->connectionId);
    }

    /*     * *

      function for getting insert id

     */

    public function getInsertId() {
        return @mysqli_insert_id($this->connectionId);
    }

    /*     * *

      function for getting connection id

     */

    public function getConnectionId() {
        return $this->connectionId;
    }

    public function isUniqueMultiple($table, $field, $data) {
        $result = $this->select($table, $field, $data);
        if (count($result) > 0) {
            return false;
        } else {
            return true;
        }
    }

}

?>