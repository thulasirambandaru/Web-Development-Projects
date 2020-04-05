<?php
ini_set('display_errors','on');
define('ENV','local');
switch(ENV){
    case'local':
        define('BASE_URL','http://localhost/sunsms_new/');
        define('DB_HOST','localhost');
        define('DB_NAME', 'sunsms_new');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('PAGING_LIST', 12); 

        /*Email Config*/
        define('SMTP_EMAIL','app.mazic@gmail.com');
        define('SMTP_PASSWORD','app_mazic.');

        

        break;

    case 'Live':
        //define('BASE_URL','');
        define('BASE_URL','http://sunsms.org/app/');
        define('DB_HOST','localhost');
        define('DB_NAME', 'sunsmsor_school');
        define('DB_USERNAME', 'sunsmsor_user');
        define('DB_PASSWORD', 'Sunsms@2016');
        define('PAGING_LIST', 12);

        /*Email Config*/
        define('SMTP_EMAIL','app.mazic@gmail.com');
        define('SMTP_PASSWORD','app_mazic.');
        
}

//Constants that are used across the sites...
define('ADMIN',1);
define('TEACHER',2);
define('PARENT_ID',3);
define('STUDENT',4);
define('STUDENT_PICTURES', 'uploads/student/pictures/');
define('STUDENT_DOCUMENTS', 'uploads/student/documents/');
define('STAFF_PICTURES', 'uploads/staff/pictures/');
define('STAFF_DOCUMENTS', 'uploads/staff/documents/');
define('SCHOOL_LOGO', 'images/school/');
?>