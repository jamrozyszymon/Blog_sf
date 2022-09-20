//Display form for add comment after click
$(function(){
    $('.give-answer').on('click', function() {
        var id=$(this).attr('id');

        $('.answer-post-id-' + id).show();
    });
});
