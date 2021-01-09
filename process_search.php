<?php


$conn = @mysqli_connect("master-database.cwajqy4blrnn.us-east-1.rds.amazonaws.com", "admin", "101383139", "master_database");

if (!$conn) {     // display error connection if unable to connect.
    echo "<p> Database Connection Error!</p>";
}



$photo_title = $_GET["photo_title"];
$keyword = $_GET["keyword"];
$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];


if (!empty($photo_title) && empty($keyword) && empty($from_date) && empty($to_date) ) // title only
{

    $query = "SELECT * FROM photos WHERE Title='$photo_title'"; // sql query


    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {

        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";

            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";
            }

            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found matching title: $photo_title";
            mysqli_close($conn);
        }

    }

}


if (!empty($photo_title) && !empty($keyword) && empty($from_date) && empty($to_date)) // title & keyword only
{

    $query = "SELECT * FROM photos WHERE Title='$photo_title' OR FIND_IN_SET('$keyword', Keywords) <> 0 "; // sql query


    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {

        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";

            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";
                
            }

            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found matching TITLE: $photo_title or KEYWORD: $keyword";
            mysqli_close($conn);
        }

    }

    

}

if (!empty($keyword) && empty($photo_title) && empty($from_date) && empty($to_date)) // keyword only
{
    $query = "SELECT * FROM photos WHERE FIND_IN_SET('$keyword', Keywords) <> 0"; // sql query



    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {

        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";



            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";


            }

            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found matching $keyword";
            mysqli_close($conn);
        }

    }

}

if (!empty($keyword) && !empty($from_date) && !empty($to_date) && empty($photo_title) ) //  keyword & date range
{
    $query = "SELECT * FROM photos  WHERE (Date BETWEEN '$from_date' AND '$to_date') OR (FIND_IN_SET('$keyword', Keywords) <> 0)"; // sql query


    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {

        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";

            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found matching $dates between $from_date & $to_date with the following keywords: $keyword";
            mysqli_close($conn);
        }

    }

}

if (empty($keyword) && empty($photo_title) && !empty($from_date) && !empty($to_date)) // date-range only
{
    $query = "SELECT * FROM photos WHERE Date BETWEEN '$from_date' AND '$to_date'"; // sql query



    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {

        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";



            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";


            }

            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found between the dates $from_date & $to_date";
            mysqli_close($conn);
        }

    }

}

if (!empty($photo_title) && !empty($keyword) && !empty($from_date) && !empty($to_date) ) // all fields
{
    $query = "SELECT * FROM photos WHERE (Title='$photo_title') OR (Date BETWEEN '$from_date' AND '$to_date') OR (FIND_IN_SET('$keyword', Keywords) <> 0)"; // sql query


    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p> Something is wrong with query</p>";
        mysqli_close($conn);
    }

    else
    {
        $num_rows = mysqli_num_rows($result);

        if ($num_rows >= 1 )
        {
            echo "<table class=\"photos\">\n";
            echo "<tr>\n"
            ."<th scope=\"col\">Id</th>\n"
            ."<th scope=\"col\">Tilte</th>\n"
            ."<th scope=\"col\">Description</th>\n"
            ."<th scope=\"col\">Date</th>\n"
            ."<th scope=\"col\">Keywords</th>\n"
            ."<th scope=\"col\">URL</th>\n"
            ."<th scope=\"col\">Image</th>\n"
            ."</tr>\n";

            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>\n";
                echo "<td>", $row["Id"], "</td>\n";
                echo "<td>", $row["Title"], "</td>\n";
                echo "<td>", $row["Description"], "</td>\n";
                echo "<td>", $row["Date"], "</td>\n";
                echo "<td>", $row["Keywords"], "</td>\n";
                echo "<td>", "<a href='". $row["URL"]. "'>". $row["URL"] . "</a></td>\n";
                echo "<td>", "<img src='". $row["URL"] ."'alt='". $row["Description"] ."' width='250' height='150'>" , "</td>\n";
                echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
            mysqli_close($conn);
        }

        else
        {
            echo "No images found matching '$photo_title' between the dates $from_date & $to_date with the following keyword: $keyword";
            mysqli_close($conn);
        }

    }
   

}













?>