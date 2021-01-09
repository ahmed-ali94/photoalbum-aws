<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Pictures</title>
</head>
<body>
<h1>Photo Uploader</h1>
<h4>Student Id: 101383139</h4>
<h4>Name: Ahmed Ali</h4>

<form action="process_upload.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Upload Pics</legend>
        <label>Photo title:</label>
        <input type="text" id="photo_title" name="photo_title"><br><br>
        <label>Select photo:</label>
        <input type="file" id="pic_file" name="pic_file"><br>
        (<strong>Note:</strong> Image file <u>must not exceed 2mb</u>)<br><br>
        <label>Description:</label>
        <input type="text" id="photo_desc" name="photo_desc"><br><br>
        <label>Date:</label>
        <input type="date" id="upload_date" name="upload_date"><br><br>
        <label>Keywords (Seperated by a comma. e.g. keyword1,keyword2)</label><br><br>
        <input type="text" id="photo_keywords" name="photo_keywords"><br><br>
        <input type="submit" value="Upload" name="upload">
    </fieldset>
</form>

<a href="getphotos.php">Photo Search</a> 
</body>
</html>