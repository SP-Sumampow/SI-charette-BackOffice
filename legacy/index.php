<!DOCTYPE html>
<html>
<body>

<h1>The form method="get" attribute</h1>

<form action="./signUp.php" method="get" target="_blank">
    <label for="fname">email:</label>
    <input type="text" id="fname" name="email"><br><br>
    <label for="lname">password:</label>
    <input type="text" id="lname" name="password"><br><br>
    <label for="lname">name:</label>
    <input type="text" id="lname" name="name"><br><br>
    <input type="submit" value="Submit">

</form>

<p>Click on the submit button, and the input will be sent to a page on the server called "action_page.php".</p>

</body>
</html>