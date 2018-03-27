<div class="col-xs-12 col-lg-4">
    <div class="card text-xs-center">
        <div class="card-header">
            <h3 class="display-2"><span class="currency">€</span>15<span class="period">/month</span></h3>
        </div>
        <div class="card-block">
            <h4 class="card-title">
                Regular Plan
            </h4>
            <ul class="list-group">
                <li class="list-group-item">Up To 5 Personal Wishlists</li>
                <li class="list-group-item">Able to Rate Movies</li>
                <li class="list-group-item">24/7 Support System</li>
            </ul>
            @subscriber
                @if($user->subscribed('regular'))
                    <button class="btn btn-success" disabled>Current Plan</button>
                    <form action="{{ route('subscription.destroy','moviedb_regular') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                @else
                    @if($user->subscribed('basic'))
                        <form action="{{ route('subscription.update','moviedb_regular') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <button type="submit" class="btn btn-success">Upgrade</button>
                        </form>
                    @else
                        <form action="{{ route('subscription.update','moviedb_regular') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <button type="submit" class="btn btn-danger">Downgrade</button>
                        </form>
                    @endif
                @endif
            @else
                <form action="{{ route('subscription.store','plan=moviedb_regular') }}" method="POST">
                    {{ csrf_field() }}
                    <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_qHcu4GkdRFV7A45Wp5PPtuch"
                            data-amount="1500"
                            data-name="Codeart"
                            data-description="Regular Plan"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="auto"
                            data-currency="EUR"
                            data-email="{{ $user->email }}"
                            data-label="Subscribe">
                    </script>
                </form>
            @endsubscriber
        </div>
    </div>
</div>