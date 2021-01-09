const xhr = new XMLHttpRequest();


function search()
{

    var title = document.getElementById("photo_title").value;
    var keyword = document.getElementById("keyword").value;
    var from_date = document.getElementById("from_date").value;
    var to_date = document.getElementById("to_date").value;


    xhr.open("GET","process_search.php?" + "photo_title=" + encodeURIComponent(title) + "&keyword=" + encodeURIComponent(keyword) + "&from_date=" + encodeURIComponent(from_date) + "&to_date=" + encodeURIComponent(to_date), true);

    xhr.onreadystatechange = function() {

        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var result = xhr.responseText;

            //alert(xhr.responseText);
            
            document.getElementById("display_photo").innerHTML = result;
        }  
    }

    xhr.send(null);
}
