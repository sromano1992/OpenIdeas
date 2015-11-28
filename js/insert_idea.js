cat_value=""
function checkParameterStep1(){
	name = document.getElementById("name_idea").value;
	description = document.getElementById("description").value;
	catId = document.getElementById("select_cat")
    cat_value = catId.options[catId.selectedIndex].value
	if (name != "" && description!="" && cat_value!="Select category"){
		document.getElementById("step1_div").className = "";
		 document.getElementById("step2_a").href="#step2";
    document.getElementById("step2_a").setAttribute("data-toggle", "tab");
    document.getElementById("step2_li").className = "";
	}
}

function checkParameterStep2(){
   document.getElementById("step2_div").className = "";
	document.getElementById("summary_a").href="#summary";
    document.getElementById("summary_a").setAttribute("data-toggle", "tab");
    document.getElementById("summary_li").className = "";
    //completeFormSummary()
}


function nextToSummary(){
	document.getElementById("step1_li").className = "disabled";
    document.getElementById("step2_li").className = "disabled";
    
    document.getElementById("step1_a").removeAttribute("data-toggle");
    document.getElementById("step2_a").removeAttribute("data-toggle");
    document.getElementById("step1_a").className = "disabled";
    document.getElementById("step2_a").className = "disabled";

    path1 = document.getElementById("iframe_text").contentWindow.document.body.innerHTML;
    path2 = path1.split("<em>");
    path3 = path2[1].split("</em>");
    res=path3[0]
    document.getElementById("image_summary").src="galleryTmp/"+res;
    document.getElementById("path_sum").value="galleryTmp/"+res;
    document.getElementById("name_summary").value=document.getElementById("name_idea").value;
    //document.getElementById("cat_summary").value=cat_value;
    document.getElementById("select_cat1").innerHTML="<option value="+cat_value+">"+cat_value+"</option>"
    document.getElementById("description_summary").value=document.getElementById("description").value;
    url = document.getElementById("video_upload").value
    try{
        url1 = url.split("=")
        url2 = url1[1].split("&")
        if(url2[0] == null)
            final_url=url1[1] 
        else
            final_url=url2[0]
    document.getElementById("url_sum").src="http://www.youtube.com/embed/"+final_url 
    document.getElementById("urlvideo_sum").value="http://www.youtube.com/embed/"+final_url 
    }
    catch(err) {
    document.getElementById("video_upload").value="error!"    
    } 
}

function getCategories() {
  
if (window.XMLHttpRequest) {
    send= new XMLHttpRequest();
    send.onreadystatechange = get;
    send.open("GET", "getCategory.php", true);
    send.send(null); 
    } else if (window.ActiveXObject) {
        send= new ActiveXObject("Microsoft.XMLHTTP");
        if (send) {
            send.onreadystatechange = get;
            send.open("GET","getCategory.php", true);
            send.send();
        }
    }
}
function get() {   
    var creaHTML;       
      if (send.readyState == 4) {     
          creaHTML=send.responseText;
            document.getElementById("select_cat").innerHTML = creaHTML;
             }
}

function modify(){
    document.getElementById('name_summary').readOnly = false;
    document.getElementById('description_summary').readOnly = false;
    //document.getElementById('cat_summary').disabled = false;
    document.getElementById('video_uploadM').style.display=""
    document.getElementById('video_uploadM').disabled = false;
    document.getElementById('select_cat1').disabled = false;
    document.getElementById('formModifyImage').style.visibility="visible"
    document.getElementById('submit_conferma').disabled = true;
    getCategoriesM()
}

function setNewVideo(){
    url = document.getElementById("video_uploadM").value
    final_url=""
    try{
        url1 = url.split("=")
        url2 = url1[1].split("&")
        if(url2[0] == null)
            final_url=url1[1] 
        else
            final_url=url2[0]
    document.getElementById("url_sum").src="http://www.youtube.com/embed/"+final_url 
    document.getElementById("video_uploadM").disabled=true
    document.getElementById("urlvideo_sum").value="http://www.youtube.com/embed/"+final_url
    
    }
    catch(err) {
    document.getElementById("video_uploadM").value="error!" 
    document.getElementById("url_sum").src=""   
    }
    
    
}
function setReadonly(x){
    elemId = x.id
    document.getElementById(elemId).readOnly=true
    checkSummary()
}

function getCategoriesM() {
  
if (window.XMLHttpRequest) {
    send= new XMLHttpRequest();
    send.onreadystatechange = getM;
    send.open("GET", "getCategory.php", true);
    send.send(null); 
    } else if (window.ActiveXObject) {
        send= new ActiveXObject("Microsoft.XMLHTTP");
        if (send) {
            send.onreadystatechange = getM;
            send.open("GET","getCategory.php", true);
            send.send();
        }
    }
}
function getM() {   
    var creaHTML;       
      if (send.readyState == 4) {     
          creaHTML=send.responseText;
            document.getElementById("select_cat1").innerHTML = creaHTML;
             }
}

function viewButtonView(){
    document.getElementById("button_view").disabled=false
}

function viewNewImage(){
 path1 = document.getElementById("iframe_text2").contentWindow.document.body.innerHTML;
 path2 = path1.split("<em>");
 path3 = path2[1].split("</em>");
 res=path3[0]
 document.getElementById("image_summary").src="galleryTmp/"+res;    
 document.getElementById("path_sum").value="galleryTmp/"+res;

}

function cancelDisabled(){
    document.getElementById("name_summary").disabled=true
    document.getElementById("description_summary").disabled=true
    document.getElementById("name_summary").disabled=true

}

function checkSummary(){
   nome = document.getElementById('name_summary').value
   descrizione = document.getElementById('description_summary').value
   catId = document.getElementById("select_cat1")
   cat_value = catId.options[catId.selectedIndex].value
   path = document.getElementById("path_sum")

   //alert(nome+"<br>"+descrizione+"<br>"+cat_value+"<br>"+path)
   if (nome != "" && descrizione!="" && cat_value!="Select category" && path!="")
        document.getElementById('submit_conferma').disabled = false;
    else
       document.getElementById('submit_conferma').disabled = true;

}