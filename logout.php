<?php
session_start();
session_destroy();
echo "Session Destroyed";
?>
<script type="text/javascript">location.href = 'store.php';</script>