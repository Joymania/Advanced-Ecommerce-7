@extends('Frontend.layouts.master')

@section('content')
<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" href="#"><i class="icon_close"></i></a>
        <div class="cart-content">
            <h3>Shopping Cart</h3>

            <ul>
                @php
                    $total=0;
                @endphp
                @if(Auth::user())
                @foreach ($cartpage as $cart)
                     <li class="single-product-cart">
                     <div class="cart-img">
                         <a href="#"><img src="{{ asset('upload/products_images/'.$cart->product->image) }}" alt=""></a>
                     </div>
                     <div class="cart-title">
                         <h4><a href="#">{{ $cart->product->name }}</a></h4>
                         @if ($cart->product->promo_price)
                         <span> {{ $cart->qty }} × {{ $cart->product->promo_price }} tk	</span>
                         @else
                         <span> {{ $cart->qty }} × {{ $cart->product->price }} tk	</span>
                         @endif

                     </div>
                     <div class="cart-delete">
                         <a href="{{ route('delete.authcart',$cart->id) }}">×</a>
                     </div>
                 </li>
                 @php
                     $total+=$cart->subtotal;
                 @endphp
                @endforeach
             </ul>
             <div class="cart-total">
                 <h4>Subtotal: <span>{{ $total }}tk</span></h4>
             </div>
            @else
            <ul>
               @php
                   $contents=Cart::content();
                   $total=0;
               @endphp
               @foreach ($contents as $content)
                    <li class="single-product-cart">
                    <div class="cart-img">
                        <a href="#"><img src="{{ asset('upload/products_images/'.$content->options->image) }}" alt=""></a>
                    </div>
                    <div class="cart-title">
                        <h4><a href="#">{{ $content->name }}</a></h4>
                        <span> {{ $content->qty }} × {{ $content->price }} tk	</span>
                    </div>
                    <div class="cart-delete">
                        <a href="{{ route('delete.cart',$content->rowId) }}">×</a>
                    </div>
                </li>
                @php
                    $total+=$content->subtotal;
                @endphp
               @endforeach


            </ul>
            <div class="cart-total">
                <h4>Subtotal: <span>{{ $total }}tk</span></h4>
            </div>
            @endif
            <div class="cart-checkout-btn">
                <a class="btn-hover cart-btn-style" href="{{ route('show.cart') }}">view cart</a>
                <a class="no-mrg btn-hover cart-btn-style" href="{{ route('checkout') }}">checkout</a>
            </div>
        </div>
    </div>
</div>
            <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">Checkout </li>
                    </ul>
                </div>
            </div>
        </div>
        @php
            $contents=Cart::content();
        @endphp
        <div class="checkout-main-area pt-120 pb-120">
            <div class="container">
                <div class="customer-zone mb-20">
                    <p class="cart-page-title">Have a coupon? <a class="checkout-click3" href="#">Click here to enter your code</a></p>
                    <div class="checkout-login-info3">
                        <form action="{{ route('apply.cuppon') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Coupon code" name="cupon">
                            <input type="submit" value="Apply Coupon">
                        </form>
                    </div>
                </div>
                {{-- <div class="customer-zone mb-20">
                    <p class="cart-page-title">Returning customer? <a class="checkout-click1" href="#">Click here to login</a></p>
                    <div class="checkout-login-info">
                        <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="sin-checkout-login">
                                        <label>Username or email address <span>*</span></label>
                                        <input type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="sin-checkout-login">
                                        <label>Passwords <span>*</span></label>
                                        <input type="password" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="button-remember-wrap">
                                <button class="button" type="submit">Login</button>
                                <div class="checkout-login-toggle-btn">
                                    <input type="checkbox">
                                    <label>Remember me</label>
                                </div>
                            </div>
                            <div class="lost-password">
                                <a href="#">Lost your password?</a>
                            </div>
                        </form>

                    </div>
                </div> --}}
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="checkout-wrap pt-30">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="billing-info-wrap mr-50">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info mb-20">
                                                <label>First Name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="name"  value="{{ @$users->name }}">
                                                <font color="red">{{ ($errors->has('name'))?($errors->first('name')): '' }}</font>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info mb-20">
                                                <label>Last Name <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="lname"  value="{{ @$users->lname }}">

                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="billing-info mb-20">
                                                <label>Street Address <abbr class="required" title="required">*</abbr></label>
                                                <input class="billing-address"  placeholder="House number and street name" type="text" name="address" value="{{ @$users->address }}">
                                                <font color="red">{{ ($errors->has('address'))?($errors->first('address')): '' }}</font>

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="billing-info mb-20">
                                                <label>Town / City <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="city"  value="{{ @$users->city }}">
                                                <font color="red">{{ ($errors->has('city'))?($errors->first('city')): '' }}</font>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="phone"  value="{{ @$users->phone }}">
                                                <font color="red">{{ ($errors->has('phone'))?($errors->first('phone')): '' }}</font>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info mb-20">
                                                <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="email"  value="{{ @$users->email }}">
                                                <font color="red">{{ ($errors->has('email'))?($errors->first('email')): '' }}</font>
                                            </div>
                                        </div>
                                    </div>


                                    {{--  <div class="checkout-account mt-25">
                                        <input class="checkout-toggle" type="checkbox">
                                        <span>Ship to a different address?</span>
                                    </div>
                                    <div class="different-address open-toggle mt-30">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info mb-20">
                                                    <label>First Name</label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info mb-20">
                                                    <label>Last Name</label>
                                                    <input type="text">
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="billing-info mb-20">
                                                    <label>Street Address</label>
                                                    <input class="billing-address" placeholder="House number and street name" type="text">

                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="billing-info mb-20">
                                                    <label>Town / City</label>
                                                    <input type="text">
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info mb-20">
                                                    <label>Phone</label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info mb-20">
                                                    <label>Email Address</label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <div class="additional-info-wrap">
                                        <label>Order notes</label>
                                        <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="your-order-area">
                                    <h3>Your order</h3>
                                    <div class="your-order-wrap gray-bg-4">
                                        <div class="your-order-info-wrap">
                                            <div class="your-order-info">
                                                <ul>
                                                    <li>Product <span>Total</span></li>
                                                </ul>
                                            </div>
                                            @if (Auth::user())
                                            <div class="your-order-middle">

                                                @foreach ($showCart as $show)
                                                @if ($show['product']['promo_price'])
                                                <li> Product :{{ $show['product']['name'] }} <span> ({{ $show->qty }}x{{ $show['product']['promo_price'] }} )</span></li>
                                                @else
                                                <li> Product :{{ $show['product']['name'] }} <span> ({{ $show->qty }}x{{ $show['product']['price'] }} )</span></li>
                                                @endif


                                                @endforeach
                                            </div>
                                            @php
                                            $subammount=0;
                                                foreach ($showCart as $show) {
                                                $subammount+=$show->subtotal;
                                                }
                                            @endphp
                                            <div class="your-order-info order-subtotal">
                                                <ul>
                                                    <li>Subtotal <span> {{ $subammount }} tk</span></li>
                                                </ul>
                                            </div>

                                            <div class="your-order-info order-total">

                                                @if (Session::has('cartcupon-'.auth()->id()))
                                                <ul>
                                                    <li>Total <span>{{ ($subammount +20)- Session::get('cartcupon-'.auth()->id())[0]}} tk </span></li>
                                                </ul>
                                                @else
                                                <ul>
                                                    <li>Total <span>{{ $subammount +20}} tk </span></li>
                                                </ul>
                                                @endif

                                            </div>
                                            @else
                                            <div class="your-order-middle">
                                                @foreach ($contents as $content)
                                                    <li> Product :{{ $content->name }} <span> ({{ $content->qty }}x{{ $content->price }} )</span></li>
                                                @endforeach
                                                <div class="your-order-info order-subtotal">
                                                     <ul>
                                                        <li>Subtotal <span> {{ Cart::subtotal() }} tk</span></li>
                                                    </ul>
                                                </div>

                                                <div class="your-order-info order-total">
                                                    <ul>
                                                        {{--  @php
                                                            (float)$sum=Cart::subtotal();
                                                        @endphp  --}}

                                                        <li>Total <span>{{ Cart::subtotal() }} tk </span></li>
                                                    </ul>
                                                </div>

                                            </div>
                                            @endif


                                        </div>
                                        <div class="payment-method">
                                            <div class="pay-top sin-payment">
                                                <input id="payment_method_1" class="input-radio" type="radio" value="Bkash" name="payment">
                                                <label for="payment_method_1"> Bkash </label>
                                                <input type="text" placeholder="Bkash Mobile No"  name="bkash_mobile">
                                                <input type="text" placeholder="Transaction Id"  name="transaction">
                                                {{--  <div class="payment-box">
                                                    <input type="text" placeholder="Bkash Mobile No"  name="bkash_mobile">
                                                    <br>
                                                 </div>
                                                 <div class="payment-box ">
                                                <input type="text" placeholder="Transaction Id"  name="transaction">
                                                <br><br>
                                             </div>  --}}
                                             <br><br><br>

                                            </div>


                                            <div class="pay-top sin-payment">
                                                <input id="payment-method-3" class="input-radio" type="radio" value="Handcash" name="payment">
                                                <font color="red">{{ ($errors->has('payment'))?($errors->first('payment')): '' }}</font>
                                                <label for="payment-method-3">Cash on delivery </label>
                                                <div class="payment-box payment_method_bacs">
                                                    {{--  <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>  --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="Place-order">
                                        {{--  <a href="">Place Order</a>  --}}
                                        <input type="submit" class="btn btn btn-danger" value="Place Order">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
@endsection

