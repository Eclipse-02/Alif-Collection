<?php
$MYDB =
    '(DESCRIPTION =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.0.15)(PORT = 1521))
      (CONNECT_DATA =
        (SERVER = DEDICATED)
        (SERVICE_NAME = dev)
      )
    )';
$conn = oci_connect("system", "oracle", $MYDB);
    $stdi = oci_parse($conn, "SELECT * FROM FS_SEC_USERS WHERE USER_ID = '3080'");
    echo oci_execute($stdi);