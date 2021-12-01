<?php

class Model
{
    private $config;
    private $mysqli;
    protected $table_name;

    public function __construct()
    {
        $this->config = new Config();
        $this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    private function query($query) {
        return $this->mysqli->query($query);
    }

    private function select($fields, $where = "", $order = "", $up = true, $limit = "") {
        for($i = 0; $i < count($fields); $i++) {
            if((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) $fields[$i] = "`".$fields[$i]."`";
        }
        $fields = implode(",", $fields);
        if(!$order) $order = "ORDER BY `id`";
        else {
            if($order != "RAND()") {
                $order = "ORDER BY `$order`";
                if(!$up) $order .= " DESC";
            } else $order = "ORDER BY $order";
        }
        if($limit) $limit = "LIMIT $limit";
        if($where) {
            $query = "SELECT $fields FROM $this->table_name WHERE $where $order $limit";
        } else {
            $query = "SELECT $fields FROM $this->table_name $order $limit";
        }

        $result_set = $this->query($query);
        if(!$result_set) return false;
        $i = 0;
        while($row = $result_set->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }
        $result_set->close();
        return $data;
    }

    public function insert($new_values) {
        $query = "INSERT INTO $this->table_name (";
        foreach ($new_values as $field=>$value) $query .= "`".$field."`,";
        $query = substr($query, 0, -1);
        $query .= ") VALUES (";
        foreach ($new_values as $value) $query .= "'".addslashes($value)."',";
        $query = substr($query, 0, -1);
        $query .= ")";
        return $this->query($query);
    }

    public function update($upd_fields, $where) {
        $query = "UPDATE $this->table_name SET ";
        foreach ($upd_fields as $field => $value) $query .= "`".$field."`='".addslashes($value)."',";
        $query = substr($query, 0, -1);
        if($where) {
            $query .= " WHERE $where";
            return $this->query($query);
        } else return false;
    }

    public function getAll($limit = "", $order = "", $up = true) {
        return $this->select(array("*"), "", $order, $up, $limit);
    }

    public function getElementOnField($field, $value) {
        if ($arr = $this->select(array("*"), "`".$field."`='".addslashes($value)."'")) {
            return $arr[0];
        }
        return false;
    }

    public function getCount() {
        $data = $this->select(array("COUNT(`id`)"));
        return $data[0]["COUNT(`id`)"];
    }
}