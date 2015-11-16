function nextToStep2(){
    document.getElementById("step2_a").href="#step2";
    document.getElementById("step2_a").setAttribute("data-toggle", "tab");
    document.getElementById("step2_li").className = "";
}

function nextToSummary(){
	
    document.getElementById("summary_a").href="#summary";
    document.getElementById("summary_a").setAttribute("data-toggle", "tab");
    document.getElementById("summary_li").className = "";
    completeFormSummary()
}

function completeFormSummary(){
document.getElementById("name_summary").value=document.getElementById("name_idea").value;
document.getElementById("description_summary").value=document.getElementById("description").value;
document.getElementById("image_summary").src="gallery/"+document.getElementById("iframe_text").contentWindow.document.body.innerHTML
//alert(document.getElementById("video_upload").value);
document.getElementById("video_summary").src=document.getElementById("video_upload").value;
document.getElementById("path_sum").value="gallery/"+document.getElementById("iframe_text").contentWindow.document.body.innerHTML
document.getElementById("url_sum").value=document.getElementById("video_upload").value
}


