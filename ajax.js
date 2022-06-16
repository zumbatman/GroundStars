$('form.ajax').on('submit', function(){
    var that = $(this),
    url = that.attr('action'),
    type = that.attr('method'),
    data = {};

that.find('[name]').each(function(index, value){
    var that =$(this),
        name = that.attr('name'),
        value = that.val();

    data[name] = value;
});
    console.log(data);
$.ajax({
    url: url,
    type: type,
    data: data,
    success: function(response) {
        location.reload(true);
        //alert("Success");
    }
});
return false;
});

$('.ajaxbtn').click(function (e) {
        e.preventDefault();
        url = $(this).attr("href");
    $.ajax({
        url: url,
        type: "get",
        success: function (response) {
            location.reload(true);
            //alert('Success');
        }
    });
});
