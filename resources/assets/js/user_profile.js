$(document).ready(function () {
    $('.movie-list-add').click(function (e) {
        e.preventDefault();

        $this = $(this);
        var listName = $this.closest('div[class^="row"]').attr('id');
        var currentInList = [];
        $('.modal-title').text('Add movie to '+listName+' wishlist');

        $.ajax({
            url: "/wishlist/movies",
            type: "POST",
            data: {
                'name' : listName
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function success(response) {
                $.each(response,function (key,value) {
                    $('#title').append('<option value="'+value+'">'+key+'</option>');
                    $('#list').attr('value',listName);
                    $('#listModal').modal();
                    $('#formAddToList').attr('action','/wishlist/'+listName);
                })
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    });
});