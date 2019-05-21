<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="" style="color: white;font-size: 25px;font-weight: 700;" href="/">Simple Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <form class="form-inline my-2 my-lg-0">
                
                <a class="btn btn-success btn-sm ml-3" href="{{ route('getCart') }}">
                    <i class="fa fa-shopping-cart"></i> Cart
                    @if(session()->has('cart'))
                     <?php
                        $session_count = session('cart')['count'];
                    ?>
                    <span class="badge badge-light cartCount">{{ $session_count }}</span>
                    @else 
                    <span class="badge badge-light cartCount">0</span>    
                    @endif
                </a>
            </form>
        </div>
    </div>
</nav>

