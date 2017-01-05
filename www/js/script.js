var list = $(".comments-list");
//Comment button
list.on( "click",'.comment-delete', function() {
    var id = $(this).data("id");
    $.post("/?p=post/commentDelete", {id: id})
        .done(function (data) {
            $('#comment-'+data).remove();
        });
});
list.on( "click",'.comment-edit', function() {
    var id = $(this).data("id");
    $('#comment-'+id+'-update-form').toggle();
});
list.on( "click",'.comment-answer', function() {
    var id = $(this).data("id");
    $('#comment-'+id+'-answer-form').toggle();
});


list.on( "click",'.btn-update', function() {
    var id = $(this).data("id");
    var textarea = $(this).prev().children()[1];
    $.post("/?p=post/commentUpdate", {id: id,text:textarea.value})
        .done(function (data)  {
            var json = JSON.parse( data );
            textarea.value = json.text;
            console.log('.comment'+json.id+'text');
            $('.comment-'+json.id+'-text').html(json.text);
            $('#comment-'+json.id+'-update-form').toggle();
        });
});

list.on( "click",'.btn-answer', function() {
    var parent_id = $(this).data("parent_id");
    var textarea = $(this).prev().children()[1];
    var post_id = $(this).data("id");
    var div = $(this).closest( ".unvisible" );

    $.post("/?p=post/commentAdd", {parent_id: parent_id,text:textarea.value,post_id: post_id})
        .done(function (data)  {
            div.hide();
            div.next().append(data);
        });
});


$(".btn-add").on( "click", function() {
    var post_id = $(this).data("id");
    var textarea = $(this).prev().children()[1];
    $.post("/?p=post/commentAdd", {post_id: post_id,text:textarea.value})
        .done(function (data)  {
            $('.comments-list').append(data);
        });
});