const mysql = require('mysql2');

const db = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: 'fira~~', 
    database: 'provinsi_db',
});

module.exports = db;