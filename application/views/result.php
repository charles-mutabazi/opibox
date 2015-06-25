<!DOCTYPE html>
<html>
<head>
    <title>Verbose Upload</title>
</head>
<body>
<?php
if($errors)
{
    echo "<h3>Errors</h3>";
    echo $errors;
}
if($result)
{
    echo "<h3>Result</h3>";
    print_r("<pre>".$result."</pre>");
}
if($files)
{
    echo "<h3>FILES array</h3>";
    print_r("<pre>".$files."</pre>");
}
if($post)
{
    echo "<h3>POST array</h3>";
    print_r("<pre>".$post."</pre>");
}
?>
</body>
</html>