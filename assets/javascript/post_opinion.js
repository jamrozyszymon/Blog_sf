$(function(){

    $('.userPositivePost').show();
    $('.userNegativePost').show();
    $('.noAction').show();

    $('.toogle-opinion').on('click', function(event) {
        event.preventDefault();
        var $link=$(event.currentTarget);
        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data){
            switch(data.action)
            {
                case 'positive':
                var num_of_positive_str = $('.num-positive-' + data.id);
                var num_of_positive = parseInt( num_of_positive_str.html())+1;
                num_of_positive_str.html(num_of_positive);
                $('.positive-id-'+data.id).show();
                $('.negative-id-'+data.id).hide();
                $('.post-id-'+data.id).hide();
                break;

                case 'negative':
                var num_of_negative_str = $('.num-negative-' + data.id);
                var num_of_negative = parseInt( num_of_negative_str.html())+1;
                num_of_negative_str.html(num_of_negative);
                $('.negative-id-'+data.id).show();
                $('.positive-id-'+data.id).hide();
                $('.post-id-'+data.id).hide();
                break;

                case 'click-to-back-positive':
                var num_of_positive_str = $('.num-positive-' + data.id);
                var num_of_positive = parseInt( num_of_positive_str.html())-1;
                num_of_positive_str.html(num_of_positive);
                $('.post-id-'+data.id).show();
                $('.negative-id-'+data.id).hide();
                $('.positive-id-'+data.id).hide();
                break;

                case 'click-to-back-negative':
                var num_of_negative_str = $('.num-negative-' + data.id);
                var num_of_negative = parseInt( num_of_negative_str.html())-1;
                num_of_negative_str.html(num_of_negative);
                $('.post-id-'+data.id).show();
                $('.negative-id-'+data.id).hide();
                $('.positive-id-'+data.id).hide();
                break;

            }
        })
    });
});