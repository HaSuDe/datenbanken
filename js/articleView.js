$(document).ready(function() {
    
    $(document).on('click', function(event) {
        console.log(event.target);
        if($(event.target).hasClass('articleItem')){
            var a = $(event.target);
            var classes = $(a).attr('class').split(' ');
            var id = classes[1];
            
            
            $.get( "php/getArticleInformation.php", function(data) {
		// Continue with Article Information
                var articleID = data.id;
                var articleName = data.name;
                var articleImage = data.image;
                
               
                
            }, 'json')
            .fail(function(data) {
                    alertify.error("Oops Something went wrong please reload the page!");
                    console.log(data);
            });
        }
    });
});



