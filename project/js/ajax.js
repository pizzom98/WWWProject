function searchtitle(){
       var title = document.getElementById('ptitle').value;
        if (title != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var msg = this.responseText;
                document.getElementById("table_ajax").innerHTML = msg;
              }
        };
        xmlhttp.open("GET", "search_table.php?ptitle=" + title, true);
        xmlhttp.send();  
}         
}