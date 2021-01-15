<?php
session_start();
include "check_login.php";

$conn = new mysqli("localhost", "root", "", "digitech");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//////////////////// ดึงเกรดมาจากระบบตัดเกรด เพิ่มลงตาราง enroll

$sql = "INSERT INTO digitech.`enroll`\n"

    . "SELECT\n"

    . "    itsut_db.`record_course`.`ID_RC` AS enroll_id, itsut_db.`record_course`.`Student_ID` AS std_id, itsut_db.`course1`.`Course_ID` AS course_id,`itsut_db`.`record_course`.`Grade` AS grade,80\n"

    . "FROM\n"

    . "    itsut_db.`record_course` JOIN itsut_db.`course1` ON itsut_db.`record_course`.`ID_Course` = itsut_db.`course1`.`ID_Course`\n"

    . "WHERE NOT\n"

    . "    EXISTS(\n"

    . "    SELECT\n"

    . "        enroll_id \n"

    . "    FROM\n"

    . "        enroll\n"

    . "    WHERE\n"

    . "        digitech.`enroll`.`enroll_id` = itsut_db.`record_course`.`ID_RC`\n"

    . ")";


    if ($conn->query($sql) === TRUE) {
        echo "successfully ดึงเกรดมาจากระบบตัดเกรด";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }



//////////////////// คำนวณและเพิ่มข้อมูลคนที่ได้ badge ทองลงตาราง badge

      $sqlbadgegold = "INSERT INTO badge(badge.enroll_id, badge.badge_img_id,badge.Gold,badge.show_badge)\n"

      . "SELECT\n"
  
      . "    enroll.enroll_id,\n"
  
      . "    course.badge_img_id,\n"
  
      . "    \"1\",\n"
  
      . "    \"0\"\n"
  
      . "FROM\n"
  
      . "    enroll\n"
  
      . "JOIN course ON enroll.course_id = course.course_id\n"
  
      . "JOIN course_of_program ON enroll.course_id = course_of_program.course_id\n"
  
      . "JOIN program ON course_of_program.program_id = program.program_id\n"
  
      . "JOIN cert ON program.cert_id = cert.cert_id\n"
  
      . "WHERE\n"
  
      . "    IF(\n"
  
      . "        cert.cert_type_id = 1 OR 2 OR 3,\n"
  
      . "        enroll.grade <> \"F\" AND enroll.grade <> \"D\" AND(\n"
  
      . "            enroll.grade = \"B+\" OR enroll.grade = \"A\"\n"
  
      . "        ),\n"
  
      . "        enroll.grade <> \"F\" AND enroll.grade <> \"D\" AND enroll.grade = \"A\"\n"
  
      . "    ) AND enroll.hours >= 80 AND NOT EXISTS(\n"
  
      . "    SELECT\n"
  
      . "        *\n"
  
      . "    FROM\n"
  
      . "        badge\n"
  
      . "    JOIN enroll a ON\n"
  
      . "        a.enroll_id = badge.enroll_id\n"
  
      . "    WHERE\n"
  
      . "        enroll.std_id = a.std_id AND course.badge_img_id = badge.badge_img_id\n"
  
      . ")";

echo"<br>";
if ($conn->query($sqlbadgegold) === TRUE) {
    echo "successfully insert badgegold";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }




  //////////////////// คำนวณและเพิ่มข้อมูลคนที่ได้ badge เงินลงตาราง badge
  $sqlbadgesilver = "INSERT INTO badge(badge.enroll_id, badge.badge_img_id,badge.Gold,badge.show_badge)\n"

  . "SELECT\n"

  . "    enroll.enroll_id,\n"

  . "    course.badge_img_id,\n"

  . "    \"0\",\n"

  . "    \"0\"\n"

  . "FROM\n"

  . "    enroll\n"

  . "JOIN course ON enroll.course_id = course.course_id\n"

  . "JOIN course_of_program ON enroll.course_id = course_of_program.course_id\n"

  . "JOIN program ON course_of_program.program_id = program.program_id\n"

  . "JOIN cert ON program.cert_id = cert.cert_id\n"

  . "WHERE\n"

  . "    IF(\n"

  . "        cert.cert_type_id = 1 OR 2 OR 3,\n"

  . "        enroll.grade <> \"F\" AND enroll.grade <> \"D\" AND(\n"

  . "            enroll.grade = \"B+\" OR enroll.grade = \"A\"\n"

  . "        ),\n"

  . "        enroll.grade <> \"F\" AND enroll.grade <> \"D\" AND enroll.grade = \"A\"\n"

  . "    ) AND enroll.hours >= 80 AND NOT EXISTS(\n"

  . "    SELECT\n"

  . "        *\n"

  . "    FROM\n"

  . "        badge\n"

  . "    JOIN enroll a ON\n"

  . "        a.enroll_id = badge.enroll_id\n"

  . "    WHERE\n"

  . "        enroll.std_id = a.std_id AND course.badge_img_id = badge.badge_img_id\n"

  . ")";

echo"<br>";
  if ($conn->query($sqlbadgesilver) === TRUE) {
    echo "successfully insert badgesilver";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



  /////////////////////////////////// คำนวณและเพิ่มข้อมูลคนที่ได้ attendance

  $sqlattendance = "INSERT INTO attendance(\n"

    . "    attendance.std_id,\n"

    . "    attendance.program_id\n"

    . ")\n"

    . "SELECT\n"

    . "    std_id,\n"

    . "    course_of_program.program_id\n"

    . "FROM\n"

    . "    enroll\n"

    . "JOIN course_of_program ON enroll.course_id = course_of_program.course_id\n"

    . "JOIN program ON course_of_program.program_id = program.program_id\n"

    . "JOIN cert ON program.cert_id = cert.cert_id\n"

    . "WHERE\n"

    . "    enroll.grade <> \"F\" AND enroll.hours >= 80\n"

    . "GROUP BY\n"

    . "    enroll.std_id,\n"

    . "    course_of_program.program_id\n"

    . "HAVING\n"

    . "    COUNT(*) = (SELECT program.TotalCourse FROM program WHERE course_of_program.program_id = program.program_id)";


    echo"<br>";
    if ($conn->query($sqlattendance) === TRUE) {
      echo "successfully insert attendance";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }





    $sqlcertgold = "INSERT INTO cert_of_student (cert_of_student.std_id,cert_of_student.cert_id,cert_of_student.cert_type_id,cert_of_student.Gold,cert_of_student.show_cer)\n"

    . "SELECT\n"

    . "    std_id,\n"

    . "    course_of_program.program_id,\n"

    . "    cert.cert_type_id,\n"

    . "    1,0\n"

    . "FROM\n"

    . "    enroll\n"

    . "JOIN course_of_program ON enroll.course_id = course_of_program.course_id\n"

    . "JOIN program ON course_of_program.program_id = program.program_id\n"

    . "JOIN cert ON program.cert_id = cert.cert_id\n"

    . "JOIN badge ON enroll.enroll_id = badge.enroll_id\n"

    . "WHERE badge.Gold = 1 AND NOT EXISTS(\n"

    . "    SELECT\n"

    . "        *\n"

    . "    FROM\n"

    . "        cert_of_student\n"

    . "    WHERE\n"

    . "        enroll.std_id = cert_of_student.std_id AND cert.cert_id = cert_of_student.cert_id)\n"

    . "GROUP BY\n"

    . "    enroll.std_id,\n"

    . "    course_of_program.program_id\n"

    . "HAVING\n"

    . "    COUNT(*) = (SELECT program.TotalCourse FROM program WHERE course_of_program.program_id = program.program_id)";



    echo"<br>";
    if ($conn->query($sqlcertgold) === TRUE) {
      echo "successfully insert certgold";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }



    $sqlcertsilver = "INSERT INTO cert_of_student (cert_of_student.std_id,cert_of_student.cert_id,cert_of_student.cert_type_id,cert_of_student.Gold,cert_of_student.show_cer)\n"

    . "SELECT\n"

    . "    std_id,\n"

    . "    course_of_program.program_id,\n"

    . "    cert.cert_type_id,\n"

    . "    0,0\n"

    . "FROM\n"

    . "    enroll\n"

    . "JOIN course_of_program ON enroll.course_id = course_of_program.course_id\n"

    . "JOIN program ON course_of_program.program_id = program.program_id\n"

    . "JOIN cert ON program.cert_id = cert.cert_id\n"

    . "JOIN badge ON enroll.enroll_id = badge.enroll_id\n"

    . "WHERE NOT EXISTS(\n"

    . "    SELECT\n"

    . "        *\n"

    . "    FROM\n"

    . "        cert_of_student\n"

    . "    WHERE\n"

    . "        enroll.std_id = cert_of_student.std_id AND cert.cert_id = cert_of_student.cert_id)\n"

    . "GROUP BY\n"

    . "    enroll.std_id,\n"

    . "    course_of_program.program_id\n"

    . "HAVING\n"

    . "    COUNT(*) = (SELECT program.TotalCourse FROM program WHERE course_of_program.program_id = program.program_id)";


    echo"<br>";
    if ($conn->query($sqlcertsilver) === TRUE) {
      echo "successfully insert certsilver";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }



    $sqldilpoma = "INSERT INTO diploma (diploma.std_id,diploma.program_id)\n"

    . "SELECT attendance.std_id,attendance.program_id FROM attendance WHERE NOT EXISTS(\n"

    . "    SELECT\n"

    . "        *\n"

    . "    FROM\n"

    . "        diploma\n"

    . "    WHERE\n"

    . "        attendance.std_id = diploma.std_id AND attendance.program_id = diploma.program_id)";

    echo"<br>";
    if ($conn->query($sqldilpoma) === TRUE) {
      echo "successfully insert dilpoma";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }


?>