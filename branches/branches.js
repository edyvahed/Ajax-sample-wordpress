/**
 * Created by shervin on 1/21/2015.
 */
jQuery(document).ready( function($){
    $('#branchselect').change(function(){
        var post= {};
        post.action = 'getbranches';
        post.cat_id = $(this).val();

        $('#branchTable').hide();
        $('#results').hide();
        $('.loading').show();


        $.ajax({
            type:'POST',
            url:'http://192.168.1.150:88/www/rayen-new/wp-admin/admin-ajax.php',
            data:post,
            success: function(x) {
                $('#results').html($(x));
                $('#results').show();
                $('.loading').hide();
            },
            error: function(r){}
        });
    });
});