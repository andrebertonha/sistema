/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    
	// Adjust table snippet image screenshot 
	$(".img-responsive").each(function(){
        var imgSrc = $(this).attr("src");
        if(imgSrc.indexOf("table") >= 0){
            $(this).addClass("adjust");
        }
    }); 

	// Insert facebook like button
	$("#facebook-like-btn").click(function(){
		var likeCode = '<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Ftutorialrepublic&width=77&layout=button_count&action=like&size=small&show_faces=false&share=false&height=21&appId" width="77" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
    	$("#like-container").toggle().html(likeCode);
	});
	
	// Hide facebook like button  
	$(document).on("click", function(event){
        var $trigger = $(".social-widget");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $("#like-container").hide();
        }            
    });
	
	// Highlight selected tag
	var queryTag = location.href.toLowerCase().split("?")[1];
	$(".snippet-tags a").each(function(){            
		var linkTag = $(this).attr("href").toLowerCase().split("?")[1];            
		if(linkTag == queryTag){
			$(this).addClass("selected");
		}
	});
});