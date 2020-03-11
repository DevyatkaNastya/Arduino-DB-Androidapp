<?php
/* Константы БД */

define ('DBHOST', 'mysql.zzz.com.ua');
define ('DBNAME', 'arduinosensordb'); // Имя базы данных
define ('DBUSER', 'arduinosensordb'); // Пользователь базы
define ('DBPASS', '19966226zN'); // Пароль БД

/* Подключение к БД */
mysql_pconnect(DBHOST, DBUSER, DBPASS) or die('Соединение отсутсвует!');
mysql_select_db(DBNAME) or die ('Соединение с БД отсутсвует!');
mysql_query('SET NAMES utf8');
?>