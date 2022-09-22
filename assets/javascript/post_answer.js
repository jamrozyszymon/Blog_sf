//Display form for add comment after click and set id of parent post

$(function(){
    $('.give-answer').on('click', function() {
        var id=$(this).attr('id');

        $('.answer-post-id-' + id).show();

        res=$('.input-id-' +id).find('#create_post_parentID').val(id);
      
    });

});
