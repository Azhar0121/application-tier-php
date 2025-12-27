<?php
class Config {

    public static $DB_HOST = "localhost";
    public static $DB_USER = "root";
    public static $DB_PASS = "";
    public static $DB_CHARSET = "utf8mb4";

    // 🔑 daftar database
    public static $DATABASES = [
        'mahasiswa'  => 'realtime_db',
        'inventaris' => 'inventaris_lab_db'
    ];

    public static $APP_NAME = "REST API PHP";
    public static $DEBUG_MODE = true;
}