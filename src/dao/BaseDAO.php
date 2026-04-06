<?php
abstract class BaseDAO {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
}