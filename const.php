<?php
//const 定数記入
class ConstClass {
    const DB_NAME = getenv('DATA_NAME');
    const HOST = getenv('DB_HOSTNAME');
    const USER_ID = getenv('DB_USERNAME');
    const PASSWORD = getenv('DB_PASSWORD');
}
