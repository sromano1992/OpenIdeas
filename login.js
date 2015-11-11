  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
          console.log('statusChangeCallback');
          console.log(response);
          // The response object is returned with a status field that lets the
          // app know the current login status of the person.
          // Full docs on the response object can be found in the documentation
          // for FB.getLoginStatus().
          if (response.status === 'connected') {
            // Logged into your app and Facebook.
            loggedInWithFacebook();
          } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app
          } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
          }
    });
  }

  function logOut(){
      FB.logout(function(response) {
        document.getElementById('status').innerHTML = '';
        document.getElementById('logout').style.visibility = 'hidden';
        document.getElementById('menu1').style.visibility = 'visible';
        location.href = "index.php";
     });
  }

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1665118703736231',
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.2
      });
   
      // Now that we've initialized the JavaScript SDK, we call 
      // FB.getLoginStatus().  This function gets the state of the
      // person visiting this page and can return one of three states to
      // the callback you provide.  They can be:
      //
      // 1. Logged into your app ('connected')
      // 2. Logged into Facebook, but not your app ('not_authorized')
      // 3. Not logged into Facebook and can't tell if they are logged into
      //    your app or not.
      //
      // These three cases are handled in the callback function.
      
         
   };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function loggedInWithFacebook() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email,birthday,gender,picture', function(response) {
      //console.log('Successful login for: ' + response.name);
      console.log(JSON.stringify(response));
      console.log(response.picture.data.url);
      console.log(encodeURIComponent(response.picture.data.url));
      checkSession(response);
      if (window.location.href == "http://localhost/WebSemantico/OpenIdeas/login.php") {
        location.href = "index.php";
      }
    });
    
    function checkSession(userData) {
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
        }
      }
      xhttp.open("POST", "checkUserMemberFB.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("email="+userData.email+"&name="+userData.name+"&sex="+userData.gender+"&picture="+encodeURIComponent(userData.picture.data.url)+"&birthday="+userData.birthday);
    }
}