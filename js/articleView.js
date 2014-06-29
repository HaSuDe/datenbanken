$(document).ready(function() {
    
    $(document).on('click', function(event) {
        console.log(event.target);
        if($(event.target).hasClass('articleItem')){
            var a = $(event.target);
            var classes = $(a).attr('class').split(' ');
            var id = classes[1];
            
            $.post( "php/getArticleInformation.php",{articleID : id}, function(data) {
                
                console.log(data);
                
		// Continue with Article Information
                var articleID = data[0].id;
                $('#articleName').val(data[0].name);
                var articleImage = data[0].image;
                $('#articleImage').attr("src", './uploads/' + articleImage);
                
                $('#articleBrand').val(data[1][0].brand);
                $('#articleSupermarket').val(data[1][0].marketName);
                $('#articlePrize').val(data[1][0].prize);
                $('#articleSize').val(data[1][0].size);
                $('#articleUnit').val(data[1][0].unit);
                
                
                $('#articleSubmitButton').unbind();
                $('#addMarket').unbind();
                $('#cancelAddMarket').unbind();
                var modal = $("#articleModal");
                modal.modal(); 
                
                $('#addMarket').on('click', function(event){
                    $('#showArticle').addClass('hidden');
                    $('#editArticle').removeClass('hidden');
                    $('#cancelAddMarket').removeClass('hidden');
                    $('#addMarket').addClass('hidden');
                    
                    //Fill Fields
                    $('#editArticleName').val(data[0].name);
                    
                });
                
                $('#cancelAddMarket').on('click', function(event){
                    $('#showArticle').removeClass('hidden');
                    $('#editArticle').addClass('hidden');
                    $('#cancelAddMarket').addClass('hidden');
                    $('#addMarket').removeClass('hidden');
                });
            }, 'json')
            .fail(function(data) {
                console.log(data);
                alertify.error("Oops Something went wrong please reload the page!");
            });
        }
    });
});



