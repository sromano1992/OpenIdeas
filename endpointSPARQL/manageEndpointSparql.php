<?php
    /**
     * @author Simone Romano
     * This php script manage a fuseki sparql endpoint to store
     * new idea added in OpenIedas portal.
     */
    $endpoint =  "http://simrom.ddns.net:3030/OpenIdeas/update?";
    
    function uploadIdeaInSparqlEndpoint($id, $url, $category, $name){
        if (!function_exists('curl_init')){ 
           die('CURL is not installed!');
        }
        
        // get curl handle
        $ch= curl_init();
        $url = getUrl($id, $url, $category, $name);
        // set request url
        curl_setopt($ch, 
           CURLOPT_URL, $url);
     
        // return response, don't print/echo
        curl_setopt($ch, 
           CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
      
        /*
        Here you find more options for curl:
        http://www.php.net/curl_setopt
        */    
     
        $response = curl_exec($ch);
        print_r($response);
        curl_close($ch);
        
        return $response;      
    }
    
    function getUrl($id, $url, $category, $name){        
        global $endpoint;
        $format = 'json';
     
        $query ="
         prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
         prefix :<http://www.OpenIdeas.org/openIdeasKB#> 
         INSERT DATA{ 
            :{$id} rdf:type :Idea;
            :hasUrl \"{$url}\";
            :hasName \"{$name}\";
            :hasCategory \"{$category}\".
         }";
                
        $searchUrl = $endpoint
           .'update='.urlencode($query)
           .'&format='.$format;
     
        return $searchUrl;
    }
?>