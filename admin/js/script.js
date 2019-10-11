

$(document).ready(function(){

var user_href;
var user_href_splitted;
var user_id;


var photo_id;
var image_src;
var image_href_splitted;
var image_name;

$(".modal_thumbnails").click(function(){

	//this gona take the value of given id and make it true or false 
$("#set_user_image").prop('disabled', false);

// to find the id 
user_href = $("#user-id").prop('href');
user_href_splitted = user_href.split("=");
user_id = user_href_splitted[user_href_splitted.length -1];

// to find the image path
image_src = $(this).prop('src');
image_href_splitted = image_src.split("/");
image_name = image_href_splitted[image_href_splitted.length -1];


photo_id = $(this).attr("data");
	$.ajax({
		url: "includes/ajax_code.php",
		data:{photo_id:photo_id},
		type:"POST",
		success:function(data)	{
			if(!data.error)	{
				 // location.reload(true);
				$("#modal_sidebar").html(data);
			}
		}
	});


});


// this is for sending image by useing POST super global
$("#set_user_image").click(function(){

	$.ajax({
		url: "includes/ajax_code.php",
		data:{image_name: image_name,user_id:user_id},
		type:"POST",
		success:function(data)	{
			if(!data.error)	{
				 // location.reload(true);
				$(".user_image_box a img").prop('src',data);
			}
		}
	});

});
// Code for dropdown
$(".info-box-header").click(function(){

$(".inside").slideToggle("fast");
$("#toggle").toggleClass("glyphicon glyphicon-menu-down , glyphicon glyphicon-menu-up ");

});
$(".delete_link").click(function(){
	return confirm("Are you sure to delete this");
});
 tinymce.init({selector:'textarea'}); 
});

