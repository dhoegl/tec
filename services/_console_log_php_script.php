<?php
    echo "<script language='javascript'>";
    echo "console.log('Login successful - SESSION[logged in] = " . $_SESSION['logged in'] . "');";
    echo "</script>";
?>
<!-- or -->
<?php
    $username = "Billy";
?>    
    <script language='javascript'>
        console.log('Hello : ' + '<?php echo $username; ?>')
    </script>
<?php
    // Some PHP code
?>

