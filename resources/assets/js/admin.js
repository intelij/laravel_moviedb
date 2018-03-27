$(document).ready(function () {

    $('#sync').click(function (event) {
        event.preventDefault();

        var title = $('#title').text();

        if($("#title").val().replace(/^\s+|\s+$/g, "").length == 0) {
            alert('The field must not be empty or contain only spaces.');
        }
        else {
            $.ajax({
                url: "http://www.omdbapi.com/",
                type: "GET",
                data: {
                    'apikey' : '8dd0eb03',
                    't' : $('#title').val(),
                    'plot' : 'full',
                    'r' : 'json'
                },
                success : function (response) {

                    if(response.Response === "True") {
                        syncData(response);
                    }
                    else {
                        alert(response.Error);
                    }
                }

            });
        }
    });

    $('#movieToEdit').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editMovieLink').attr('href','movie/'+valueSelected+'/edit');
    });

    $('#editUsers').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editUsersLink').attr('href','user/'+valueSelected+'/edit');
    });

    $('#editActor').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editActorLink').attr('href','actor/'+valueSelected+'/edit');
    });

    $('#editGenre').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editGenreLink').attr('href','genre/'+valueSelected+'/edit');
    });
});

function syncData(data) {
    $.ajax({
        url: "/admin/sync",
        type: "POST",
        data: data,
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function (response) {
            alert('Movie has been syncronized');
        },
        error : function (error) {
            console.log(error);
        }
    });
}