$(document).ready(function(){
     $(document).on('submit','#add_module',function(e){
          e.preventDefault();
          var formdata = new FormData($(this)[0]);
          $.ajax({
              type: 'post',
              url: $(this).attr('action'),
              data: formdata,
              processData: false,
              contentType: false,
              success: function(data) {
                  var line_id = parseInt($('input[name="line_id"]').val());
                  $('input[name="line_id"]').val((line_id += 1));
              }
          });
     });

     $(document).on('click','.getGroupRightBtn',function(e){
          var id = $(this).attr('data-id');

     });
});

// $.ajax({
//     type: "POST",
//     url: "yourURL",// where you wanna post
//     data: formData,
//     processData: false,
//     contentType: false,
//     error: function(jqXHR, textStatus, errorMessage) {
//         console.log(errorMessage); // Optional
//     },
//     success: function(data) {console.log(data)}
// });
