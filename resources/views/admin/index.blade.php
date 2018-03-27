@extends('layouts.master')

@section('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>

        $(document).ready(function () {
             $('#syncAll').click(function (event) {
                 event.preventDefault();

                 var movies = <?php echo json_encode($movies) ?>;
                 $.each(movies,function (key,movie) {

                     $.ajax({
                         url: "http://www.omdbapi.com/",
                         type: "GET",
                         data: {
                             'apikey' : '8dd0eb03',
                             'i' : movie,
                             'plot' : 'full',
                             'r' : 'json'
                         },
                         success : function (response) {

                             if(response.Response === "True") {
                                 syncData(response);
                             }
                         },
                         error : function (error) {
                             console.log(error);
                         }

                     });
                 });
             });

            function syncData(data) {
                $.ajax({
                    url: "/admin/sync",
                    type: "POST",
                    data: data,
                    async: false,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function (response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
    <div class="container-fluid">
    @author
        @include('admin.partials.add_movie')

        @include('admin.partials.add_movie_manually')

        @include('admin.partials.edit_movie')

        @include('admin.partials.delete_movie')

        @include('admin.partials.add_actor')

        @include('admin.partials.edit_actor')

        @include('admin.partials.delete_actor')

        @include('admin.partials.add_genre')

        @include('admin.partials.edit_genre')

        @include('admin.partials.delete_genre')

        @editor

        @include('admin.partials.synchronize')

        @endeditor
    @endauthor

    @admin
        @include('admin.partials.add_user')

        @include('admin.partials.edit_user_role')

        @include('admin.partials.edit_user')

        @include('admin.partials.delete_user')
    @endadmin
    </div>
@endsection