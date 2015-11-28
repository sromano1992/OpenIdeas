    function login(){
      email = document.getElementById("log_email").value;
      password = document.getElementById("log_password").value;
      
      var xhttp;
      if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest();
        } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          //ok
          //alert(xhttp.responseText);
          console.log(xhttp.responseText);
          if (parseInt(xhttp.responseText)<0) {
            //alert("Credenziali errate");
            //document.getElementById("errorLabel").style.visibility = "visible";
            document.getElementById("log_email").style.border ="1px solid #ff3333";
            document.getElementById("log_password").style.border ="1px solid #ff3333";
          }
          else{
            location.href = "index.php";
          }
        }
      }
      xhttp.open("POST", "checkLogin.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("email="+email+"&password="+password);
    }
    
    function restorePassword(){
      email = document.getElementById("log_email").value;
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      if (!re.test(email)){
        document.getElementById("log_email").style.border ="1px solid #ff3333";
        return;
      }
      else
        document.getElementById("log_email").style.border ="";
      
      var xhttp;
      if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest();
        } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          //ok
          alert(xhttp.responseText);
          console.log(xhttp.responseText);
        }
      }
      
      xhttp.open("POST", "restorePassword.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("email="+email);
    }