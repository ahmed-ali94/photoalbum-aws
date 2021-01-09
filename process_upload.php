<?php
error_reporting(E_ALL);
require '../aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Common\Exception\S3Exception;



if (isset($_POST["photo_title"], $_POST["photo_desc"], $_POST["upload_date"], $_POST["photo_keywords"]))
{
    $title = $_POST["photo_title"];
    $description = $_POST["photo_desc"];
    $date = $_POST["upload_date"];
    $keywords = $_POST["photo_keywords"];
}

$errMsg = "";

//check if title has been set 

if ($title == "")
{
    $errMsg = "<p style='color:red;'><strong>Please enter atitle!</strong></p>";
    echo $errMsg;
}

if ($description == "")
{
    $errMsg = "<p style='color:red;'><strong>Please enter a description!</strong></p>";
    echo $errMsg;
}

if ($date == "")
{
    $errMsg = "<p style='color:red;'><strong>Please enter a date!</strong></p>";
    echo $errMsg;
}

if ($keywords == "")
{
    $errMsg = "<p style='color:red;'><strong>Please enter photo keywords!</strong></p>";
    echo $errMsg;
}


if ($errMsg == "") // check to see if there is no error messages
{
    $checkIMG = getimagesize($_FILES["pic_file"]["tmp_name"]);

    $isImage = strtok($_FILES["pic_file"]["type"],"/");

    $uploadOK = 1; 

    if ($isImage == "image" && $checkIMG !== false)
    {
        $uploadOK = 1;

    }
    else
    {
        echo "<ul style='color:red;'><strong>Upload Error:</strong> <li style='color:black;'>File is not an image <strong style='color:black;'><u>OR</u></strong></li> <li style='color:black;'>The image file size is > 2MB</li></ul>";

        $uploadOK = 0;
    }


    if ($uploadOK == 0)
    {
        echo  "<p style='color:red;'><strong>Your file was not uploaded for the listed reasons above.</strong></p>";
    }
    else
    {
        $fileName = $_FILES["pic_file"]["name"]; 
        $localPath = "uploads/$fileName";
        $is_file_uploaded = move_uploaded_file($_FILES["pic_file"]["tmp_name"],$localPath); // move image file to local uploads folder 

        if ($is_file_uploaded) // upload the file from folder to s3 bucket
        {
            $s3_client = new S3Client([
                'version' => 'latest',
                'region' => 'us-east-1']);

            $uploader = new MultipartUploader($s3_client,$localPath,['bucket'=> 'image-bucket-101383139', 'key'=> $fileName]);

            try {

                $result = $uploader->upload();

                echo "<p style='color:green;'><strong>Photo has been uploaded to S3!</strong></p>";
        
                
            } catch (S3Exception $e) {
                echo $e->getMessage() . PHP_EOL;
            }

            if ($result) // add the meta-data to RDS
            {

                $conn = @mysqli_connect("master-database.cwajqy4blrnn.us-east-1.rds.amazonaws.com", "admin", "101383139", "master_database");

                if (!$conn) {     // display error connection if unable to connect.
                    echo "<p> Database Connection Error!</p>";
                }

                $query = "INSERT INTO photos (Title,Description,Date,Keywords,URL) VALUES ('$title','$description','$date','$keywords','http://d2gbjsuhko0007.cloudfront.net/$fileName')";

                $sql_execute = mysqli_query($conn, $query);

                if (!$sql_execute) {
                    echo "<p style='color:red;'> Something is wrong with the SQL query</p>";
                    mysqli_close($conn);
                }

                else
                {
                    echo "<p style='color:green;'> Added the photo meta-data to database</p><br><br><a href='getphotos.php'>Photo Search</a>";
                    mysqli_close($conn);
                }

            }

        }
    }

}
?>