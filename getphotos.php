<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Photos</title>
    <script src="main.js"></script>
    <style>
        table, td, th {  
        border: 1px solid #ddd;
        text-align: left;
        }

        table {
        border-collapse: collapse;
        width: 100%;
        }

        
        th {
        background-color: #3C3C3E;
        color: white;
        }

        th, td {
        padding: 15px;
        }
</style>
</head>
<body>
<h1>Search Photos</h1>
<h4>Student Id: 101383139</h4>
<h4>Name: Ahmed Ali</h4>

<form>
    <fieldset>
        <legend>Search Photos</legend>
        <label>Photo title:</label>
        <input type="text" id="photo_title" name="photo_title"><br><br>
        <label>Keyword:</label>
        <input type="text" id="keyword" name="keyword"><br>
        (<strong>Note:</strong> Accepts only 1 keyword at a time)<br><br>
        <label>From:</label>
        <input type="date" id="from_date" name="from_date"><br><br>
        <label>To:</label>
        <input type="date" id="to_date" name="to_date"><br><br>
        <input type="button" value="Search" onclick="search()">
    </fieldset>
</form>

<div id="display_photo"></div>
<a href="upload.php">Upload Photo</a> 
</body>
</html>