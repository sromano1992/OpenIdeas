<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenIdeas - About</title>

    <link href="css/bootstrap_endpoint.css" rel='stylesheet' type='text/css' />
    <link href="css/style_endpoint.css" rel='stylesheet' type='text/css' />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    
     <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--<script src="endpointSPARQL/sparqlQuery.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('click', '#querySparql', function()  {
                    var format = document.getElementById('menuOutputFormat').firstChild.data;
                    //console.log(format);
                    var dataString = 'query=' + document.getElementById("queryArea").value +"&format="+format;
                    $.ajax({
                            type: "POST",
                            url: "endpointSPARQL/querySparql.php",
                            data: dataString,
                            cache: true,
                            success: function(html){
                                //alert(html);                                
                                $('#result').html("");
                                $('#result').html(html);
                                var now = new Date().toString();
                                
                                
                                var element = document.createElement('a');
                                element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(html));
                                element.setAttribute('download', "OpenIdeasQuery." + format);                                
                                element.style.display = 'none';
                                document.body.appendChild(element);                                
                                element.click();                                
                                document.body.removeChild(element);
                            },
                            error: function(html){
                                alert("error: " + html);
                            }
                        });
                return false;
            })
        });
    $(document).ready(function(){
            $('body').on('click', '#allIdeas', function()  {
                $('#queryArea').html("");
                $('#queryArea').html("prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n\n"
                    +"SELECT ?subject \n"
                    +"WHERE {\n"
                    +"\t?subject rdf:type <http://www.OpenIdeas.org/openIdeasKB#Idea>\n" 
                    +"}");
                $('#result').html("");
            })          
    });
    </script>
    <script>        
        $(document).ready(function(){
                $('body').on('click', '#allCategories', function()  {
                    $('#queryArea').html("");
                    $('#queryArea').html("prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n\n"
                        +"SELECT DISTINCT ?object\n"
                        +"WHERE {\n"
                        +"\t?subject <http://www.OpenIdeas.org/openIdeasKB#hasCategory> ?object\n}");
                    $('#result').html("");
                })
        });
    </script>
    <script>        
        $(document).ready(function(){
                $('body').on('click', '#allSoftwareIdeas', function()  {
                    $('#queryArea').html("");
                    $('#queryArea').html("prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n\n"
                        +"SELECT ?subject \n"
                        +"WHERE {\n"
                        +"\t?subject rdf:type <http://www.OpenIdeas.org/openIdeasKB#Idea>;\n"
                        +"\t<http://www.OpenIdeas.org/openIdeasKB#hasCategory> \"Software\".}");
                })
        });
        function changeOutput(type){
            document.getElementById('menuOutputFormat').innerHTML = type + "<span class=\"caret\"></span>";
        }
    </script>   
</head>
<body>
    <div class="brand">OpenIdeas</div>
    <div class="address-bar">Insert your idea HERE!</div>
 <?php
        error_reporting(0);
        include("navbar.php");
        require "manageDB.php";
    ?>
<div class="container">
    <div class="row">
         <div class="col-md-6 content-left">                
                            <div class="contact">                                
                                <h3>ENDPOINT</h3>
                                <input id="fname" name="name" type="text" class="form-control" value="http://simrom.ddns.net/OpenIdeas/query" readonly>

                                <h3>TESTO DELLA QUERY</h3>
                                <textarea id="queryArea" style="color: black" value="Inserisci la query" ></textarea>
                                                                                      
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="menuOutputFormat" data-toggle="dropdown">xml<span class="caret"></span></button>
                                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a onclick="changeOutput('xml')" role="menuitem" tabindex="1">xml</a></li>
                                    <li role="presentation"><a onclick="changeOutput('json')" role="menuitem" tabindex="2">json</a></li>
                                  </ul>
                                </div>
                                    
                                <input id="querySparql" type="submit" value="QUERY"/>
                                <textarea id="result" style="color: black" readonly></textarea>
                                
                            </div>                  
                        </div>
                        <div class="col-md-6 content-right">
                            <div class="contact">                                
                                <h3>QUERY</h3>
                                <input type="submit" id="allIdeas" value="Visualizza tutte le idee" >
                                <input type="submit" id="allCategories" value="Visualizza tutte le categorie" >
                                <input type="submit" id="allSoftwareIdeas" value="Visualizza tutte le idee della categoria software" >  
                                
                            </div>  
                        </div>
        

    </div> <!--row -->
<br>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; OpenIdeas 2015</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>