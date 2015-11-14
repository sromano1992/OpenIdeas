function signUp(){    
    name = document.getElementById('reg_name').value;
    surname = document.getElementById('reg_surname').value;
    email = document.getElementById('reg_email').value;
    imgFile = document.getElementById('reg_imPath').files[0];
    webPage = document.getElementById('reg_webPage').value;
    dateOfBirth = document.getElementById('reg_dateOfBirth').value;
    password = document.getElementById('reg_password').value;
    acceptedCondition = document.getElementById('acceptedCondition').checked;
    console.log(acceptedCondition);
    //console.log(imgFile.name);
    if (name == ""){        
        console.log("void name");
        document.getElementById("reg_name").style.border ="1px solid #ff3333";
        return;
    }
    else{        
        document.getElementById("reg_name").style.border ="";
    }
    if (surname == "") {
        console.log("void surname");
        document.getElementById("reg_surname").style.border ="1px solid #ff3333";
        return;        
    }
    else{
        document.getElementById("reg_surname").style.border =""
    }
    if (email == "") {
        document.getElementById("reg_email").style.border ="1px solid #ff3333";
        console.log("void email");
        return;        
    }
    else{
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (!re.test(email)){
            document.getElementById("reg_email").style.border ="1px solid #ff3333";
            console.log("email not valid");
            return;        
        }
        else{
            document.getElementById("reg_email").style.border ="";
        }
    }
    if (password == ""){
        console.log("void password");
        return;        
    }
    else{
        document.getElementById("reg_password").style.border =""
    }
    if (acceptedCondition == false) {
        document.getElementById('acceptedConditionDiv').style.border = "solid 1px red";
        return;
    }
    else{
        document.getElementById('acceptedConditionDiv').style.borderColor = "";
    }
    if (imgFile != null) {
       if (imgFile.name != ""){            
            uploadFile(imgFile,email);
       }
    }
    
    
    
    console.log("test ok");
    //addUSer
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
        console.log(xhttp.responseText);
        alert(xhttp.responseText);
      }
    }
    xhttp.open("POST", "registerUser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    picture = "userImg/" + email + ".png";
    xhttp.send("email="+email+"&password="+password+"&name="+name+"&surname="+surname+"&picture="+picture+"&webPage"+webPage+"&birthday="+dateOfBirth+"&password="+password);
}
    
    function uploadFile(file,email){
        var url = 'uploadImg.php';
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Every thing ok, file uploaded
                console.log(xhr.responseText); // handle response.
            }
        };
        fd.append("file_name", email + ".png");
        fd.append("upload_file", file);
        //alert(email);
        xhr.send(fd);
    }

