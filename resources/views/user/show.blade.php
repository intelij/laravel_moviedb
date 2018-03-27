@extends('layouts.master')

@section('content')
    <script src="{{ asset('js/user_profile.js') }}"></script>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h3>User Profile</h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    @if(auth()->check() && auth()->id() == $id)
                        @subscriber
                        <a href="{{ route('subscription.index') }}" class="btn btn-success float-right">Current Plan</a>
                        @else
                        <a href="{{ route('subscription.create') }}" class="btn btn-success float-right">Subscribe</a>
                        @endsubscriber
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h2 id="wishlists">
                        Wishlists
                        @if(count($wishlists) < \App\Wishlist::wishlistLimit($id) && auth()->check() && auth()->id() == $id)
                            <button class="btn btn-dark" data-toggle="modal" data-target="#newListModal">Add another list</button>
                        @endif
                    </h2>
                    <hr>
                    @foreach($wishlists as $wl)
                        <h3>
                            {{ $wl->name }}
                            @if(auth()->check() && auth()->id() == $id)
                                <form method="POST" action="{{ route('wishlist.destroy',$wl->id) }}" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="btn btn-dark">Delete list</button>
                                </form>
                            @endif
                        </h3>
                        <div class="row" id="{{ $wl->name }}">
                            @foreach($wl->movies as $movie)
                                <div class="col-md-2">
                                    <div class="card card-01 height-fix">
                                        <a href="/movie/{{$movie->id}}">
                                            <img class="card-img-top" src="{{ $movie->poster }}" alt="Card image cap" id="{{ $movie->id }}">
                                        </a>
                                        @if(auth()->check() && auth()->id() == $id)
                                            <form method="POST" action="{{ route('wishlist.detach',[$wl->id,$movie->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="movie-list-remove btn btn-light"><i class="fas fa-minus"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            @if($wl->movies->count() < \App\Wishlist::movieLimit($id) && auth()->check() && auth()->id() == $id)
                                <div class="col-md-2">
                                    <div class="card card-01 height-fix">
                                        <a data-toggle="modal" href="#" class="movie-list-add">
                                            <img class="card-img-top" src="{{ asset('storage/images/brand/Plus-sign.png') }}" alt="Card image cap">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="listModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" id="formAddToList">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}

                                <div class="form-group row">
                                    <label for="title" class="col-sm-4 col-form-label text-md-right">Movie Title</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="title" name="title">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-dark" style="width: 30%">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="newListModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('wishlist.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label text-md-right">Wishlist name</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="name" name="name" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-dark" style="width: 30%">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection