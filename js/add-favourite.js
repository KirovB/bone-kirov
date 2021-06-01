$( document ).ready(function() {
  $(".country__favorite").on("click", function(){
    var currentFavBox = $(this).attr("data-exists");
    var currentFavID = $(this).attr("data-id");
    var fav = $(this).attr("data-fav");
    console.log(fav);
    if (currentFavBox  == 'yes') {
      $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', boneData.nonce);
        },
        url: boneData.root_url + '/wp-json/bone/v1/manageFav',
        type: 'DELETE',
        data: {'fav': fav },
        success: (response) => {
         $(this).attr('data-exists', 'no');
         $(this).attr("data-fav", '');
          console.log(response);
        },
        error: (response) => {
          console.log(response);
        }
      });
    } else {
      $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', boneData.nonce);
        },
        url: boneData.root_url + '/wp-json/bone/v1/manageFav',
        type: 'POST',
        data: {'countryId': currentFavID },
        success: (response) => {
         $(this).attr('data-exists', 'yes');
         $(this).attr("data-fav", response);
          console.log(response);
        },
        error: (response) => {
          console.log(response);
        }
      });
    }

  });
});
