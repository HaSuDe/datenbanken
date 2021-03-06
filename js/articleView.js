$(document).ready(function() {
    
    $(document).on('click', function(event) {
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
                $('#marketFinder').val(data[1][0].marketID);
                $('#articlePrize').val(data[1][0].prize);
                $('#articleSize').val(data[1][0].size);
                $('#articleUnit').val(data[1][0].unit);
                
                
                $('#articleSubmitButton').unbind();
                $('#addMarket').unbind();
                $('#cancelAddMarket').unbind();
                $('#articleChangeButton').unbind();
                $('#articleMarketButton').unbind();
                var modal = $("#articleModal");
                modal.modal(); 
                
                // Button Add Market to Article Pressed
                $('#addMarket').on('click', function(event){
                    $('#showArticle').addClass('hidden');
                    $('#editArticle').removeClass('hidden');
                    $('#cancelAddMarket').removeClass('hidden');
                    $('#addMarket').addClass('hidden');
                    $('#articleMarketAdd').removeClass('hidden');
                    $('#articleChange').addClass('hidden');
                    
                    //Fill Fields
                    $('#editArticleName').val(data[0].name);
                    
                });
                
                // Button Cancel Add Market to Article
                $('#cancelAddMarket').on('click', function(event){
                    $('#showArticle').removeClass('hidden');
                    $('#editArticle').addClass('hidden');
                    $('#cancelAddMarket').addClass('hidden');
                    $('#addMarket').removeClass('hidden');
                    $('#articleMarketAdd').addClass('hidden');
                    $('#articleChange').removeClass('hidden');
                });

                $('#marketFinder').on('click', function(e) {
                    $('#findMarketM').modal();
                });

                $('.finderedit').on('click', function(e) {
                    $('#findMarketM').modal();
                });

                $(document).on('keyup', function(e) {
                    if($(e.target).hasClass("modalSearch")) {
                        findMarkets();
                    }
                });
                
                $('#articleChangeButton').on('click', function(event){ 
                    // Get Values of Modal
                    var name = $('#articleName').val();
                    var brand = $('#articleBrand').val();
                    var market = $('#marketFinder').val();
                    var prize = $('#articlePrize').val();
                    var amount = $('#articleSize').val();
                    var unit = $('#articleUnit').val();
                    
                    $.post( "php/updateArticle.php", {id: articleID, aname: name, abrand: brand, amarket: market, aprize : prize, asize : amount, aunit : unit }, function(data) {
                            // add all lists 
                            //console.log(data);
                            if(data['1'] && data['2']){
                                location.reload(); 
                            }else{
                                alertify.error("Wrong Values, please correct your input");
                            }
                            
                    }, 'json')
                    // if something went wrong, give error message
                    .fail(function(data) {
                            alertify.error("Oops Something went wrong please reload the page!");
                            console.log(data);
                    });
                });
                
                $('#articleMarketButton').on('click', function(event){
                    // Get Values of Modal
                    var name = $('#editArticleName').val();
                    var brand = $('#editArticleBrand').val();
                    var market = $('.finderedit').val();
                    var prize = $('#editArticlePrize').val();
                    var amount = $('#editArticleSize').val();
                    var unit = $('#editArticleUnit').val();
                    
                    
                    $.post( "php/createArticleMarket.php", {id: articleID, aname : name, abrand: brand, amarket: market, aprize : prize, asize : amount, aunit : unit }, function(data) {
                        // Added
                        if(data){
                           location.reload(); 
                        }else{
                            alertify.error("Wrong Values, please correct your input");
                        }         
                    }, 'json')
                    // if something went wrong, give error message
                    .fail(function(data) {
                            alertify.error("Oops Something went wrong please reload the page!");
                            console.log(data);
                    });                    
                });
                
            }, 'json')
            .fail(function(data) {
                console.log(data);
                alertify.error("Oops Something went wrong please reload the page!");
            });
        } else if($(event.target).hasClass('marketChooser')) {
            $('#marketFinder').val("");
            var market = $(event.target).text().replace(/\:.*/,'');
            console.log(market);
            $('#marketFinder').val(market);
            $('.finderedit').val(market);
            $('#findMarketM').modal('hide');
        }
    });
    function findMarkets() {
        $.post( "ajax/findMarkets.php", $('#modalSearch').serialize(), function(data) {
            // list to be added to
            var list = $('#marketList');
            $(list).children('li').remove()
            // add every result set as li to the result list
            for(var i = 0; i<data.length; i++) {
                list.append('<li class=marketChooser>' + data[i]['id'] + ': "' + data[i]['name'] + ', ' + data[i]['country'] + ' ' +  data[i]['code'] + ' ' + data[i]['city'] + ' ' + data[i]['street'] + '</li>');
            }
        }, 'json')
        .fail(function(data) {
            alertify.error("Error while loading markets. Please try again");
            console.log(data);
        });
    }
});



