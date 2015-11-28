<!DOCTYPE html>
<html>
<head>
    <title>Clean Free Ui Kit Flat Bootstrap responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Clean Free Ui Kit Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <link href="css/bootstrap_endpoint.css" rel='stylesheet' type='text/css' />
    <link href="css/style_endpoint.css" rel='stylesheet' type='text/css' />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
    <?php
        error_reporting(0);
        include("navbar.php");
        require "manageDB.php";
    ?>
	<!--content-starts-->
	<div class="content">
            <div class="container">
                <div class="content-top">
                        <div class="col-md-6 content-left">				
                            <div class="contact">                                
                                <h3>ENDPOINT</h3>
                                <input type="text" value="http://simrom.ddns.net:3030/OpenIdeas/query" readonly />
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
                </div>
            </div>                    
                
		<div class="footer">
			<p> Copyright &copy; OpenIdeas 2015</p>
		</div>
	<!--content-end-->
</body>
</html>