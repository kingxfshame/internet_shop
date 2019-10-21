//Slider jQuery
  $(document).ready(function(){
    $('.slider').slider(
        {
            height: 500,
            indicators: true,
            duration: 500,
            interval: 3500,
          }
    );

  });


  $(document).ready(function(){
    $('.modal').modal();
  });


  $(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});

$(document).ready(function(){
  $('.sidenav').sidenav();
});