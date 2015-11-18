function querySparql(){
    query = document.getElementById('queryArea').value;
    var xhttp;
    if (window.XMLHttpRequest) {// code for modern browsers
      xhttp = new XMLHttpRequest();
      } else {
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function() {
      console.log(xhttp.responseText);
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        //ok
        console.log(xhttp.responseText);
      }
    }
    xhttp.open("POST", "endpointSPARQL/querySparql.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query="+query);
}