@extends('frontend.layouts.master')

@section('content')
    <!--=========== BREADCRUMB START=============-->
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--============== BREADCRUMB END ==============-->


    <!--================ CART VIEW START =================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="fp__pro_img">
                                            Image
                                        </th>

                                        <th class="fp__pro_name">
                                            details
                                        </th>

                                        <th class="fp__pro_status">
                                            price
                                        </th>

                                        <th class="fp__pro_select">
                                            quantity
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="{{ route('cart.destroy') }}">clear all</a>
                                        </th>
                                    </tr>

                                    @foreach (Cart::content() as $product)
                                        <tr>
                                            <td class="fp__pro_img">
                                                <img src="{{ asset($product->options->product_info['image']) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="fp__pro_name">
                                                <a
                                                    href="{{ route('product.show', $product->options->product_info['slug']) }}">
                                                    {{ $product->name }}
                                                </a>
                                                <span>
                                                    {{ @$product->options->product_size['name'] }}
                                                    {{ @$product->options->product_size['price']
                                                        ? '(' . currencyPosition(@$product->options->product_size['price']) . ')'
                                                        : '' }}
                                                </span>
                                                @foreach ($product->options->product_options as $option)
                                                    <p>{{ $option['name'] }} ({{ currencyPosition($option['price']) }})</p>
                                                @endforeach
                                            </td>

                                            <td class="fp__pro_status">
                                                <h6>{{ currencyPosition($product->price) }}</h6>
                                            </td>

                                            <td class="fp__pro_select">
                                                <div class="quentity_btn">
                                                    <button class="btn btn-danger decrement"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input type="text" data-id="{{ $product->rowId }}" class="quantity"
                                                        placeholder="1" value="{{ $product->qty }}" readonly>
                                                    <button class="btn btn-success increment"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="fp__pro_tk">
                                                <h6 class="product_cart_total">
                                                    {{ currencyPosition(productTotal($product->rowId)) }}</h6>
                                            </td>

                                            <td class="fp__pro_icon">
                                                <a href="#" class="remove_cart_product"
                                                    data-id="{{ $product->rowId }}"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (Cart::content()->count() === 0)
                                        <tr>
                                            <td colspan="6" class="text-center d-inline" style="width: 100%;">Cart is
                                                empty!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="subtotal">{{ currencyPosition(cartTotal()) }}</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount:
                            <span id="discount">
                                @if (isset(session()->get('coupon')['discount']))
                                    {{ currencyPosition(session()->get('coupon')['discount']) }}
                                @else
                                    {{ currencyPosition('0') }}
                                @endif
                            </span>
                        </p>
                        <p class="total">
                            <span>total:</span>
                            <span id="final_total">
                                @if (isset(session()->get('coupon')['discount']))
                                    {{ currencyPosition(cartTotal() - session()->get('coupon')['discount']) }}
                                @else
                                    {{ currencyPosition(cartTotal()) }}
                                @endif
                            </span>
                        </p>
                        <form id="coupon_form">
                            <input type="text" id="coupon_code" name="code" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>

                        <div class="coupon_card">
                            @if (session()->has('coupon'))
                                <div class="card mt-2">
                                    <div class="m-3">
                                        <span><b class="v_coupon_code">Applied Coupon:
                                                {{ session()->get('coupon')['code'] }}</b></span>
                                        <span>
                                            <button id="destroy_coupon"><i class="far fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <a class="common_btn" href="{{ route('checkout.index') }}">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= CART VIEW END =============-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var cartTotal = parseFloat("{{ cartTotal() }}");

            $('.increment').on('click', function() {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                inputField.val(currentValue + 1);

                cartQtyUpdate(rowId, inputField.val(), function(response) {
                    if (response.status === 'success') {
                        inputField.val(response.qty);

                        let productTotal = response.product_total;
                        inputField.closest("tr")
                            .find(".product_cart_total")
                            .text("{{ currencyPosition(':productTotal') }}"
                                .replace(":productTotal", productTotal));

                        cartTotal = response.cartTotal;
                        $('#subtotal').text("{{ config('settings.site_currency_icon') }}" +
                            cartTotal);
                        $('#final_total').text("{{ config('settings.site_currency_icon') }}" +
                            response.grand_cart_total);
                    } else if (response.status === 'error') {
                        inputField.val(response.qty);
                        toastr.error(response.message);
                    }
                });
            });

            $('.decrement').on('click', function() {
                let inputField = $(this).siblings(".quantity");
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");

                if (currentValue > 1) {
                    inputField.val(currentValue - 1);

                    cartQtyUpdate(rowId, inputField.val(), function(response) {
                        inputField.val(response.qty);

                        if (response.status === 'success') {
                            let productTotal = response.product_total;
                            inputField.closest("tr")
                                .find(".product_cart_total")
                                .text("{{ currencyPosition(':productTotal') }}"
                                    .replace(":productTotal", productTotal));

                            cartTotal = response.cartTotal;
                            $('#subtotal').text("{{ config('settings.site_currency_icon') }}" +
                                cartTotal);
                            $('#final_total').text("{{ config('settings.site_currency_icon') }}" +
                                response.grand_cart_total);
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    });
                } else {
                    toastr.warning('Quantity cannot be less than 1');
                }
            });

            function cartQtyUpdate(rowId, qty, callback) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('cart.quantity-update') }}",
                    data: {
                        'rowId': rowId,
                        'qty': qty,
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        if (callback && typeof callback === 'function') {
                            callback(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        hideLoader();
                    }
                })
            }

            //========== Remove Products from cart =========== //
            $('.remove_cart_product').on('click', function(e) {
                e.preventDefault();
                let rowId = $(this).data('id');
                removeCartProduct(rowId)
                $(this).closest('tr').remove();
            })

            function removeCartProduct(rowId) {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart-product-remove', ':rowId') }}".replace(":rowId", rowId),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        updateSidebarCart();
                        cartTotal = response.cartTotal;
                        $('#subtotal').text("{{ config('settings.site_currency_icon') }}" +
                            cartTotal);
                        $('#final_total').text("{{ config('settings.site_currency_icon') }}" +
                            response.grand_cart_total);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage)
                    },
                    complete: function() {
                        hideLoader();
                    }
                })
            }

            /**============== Apply coupon =============== */
            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let code = $('#coupon_code').val();
                let subTotal = cartTotal;

                couponApply(code, subTotal);
            })

            function couponApply(code, subTotal) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('apply-coupon') }}", //FrontendController
                    data: {
                        code: code,
                        subTotal: subTotal,
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('#coupon_code').val('');
                        $('#discount').text("{{ config('settings.site_currency_icon') }}" + response
                            .discount)
                        $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response
                            .finalTotal)
                        couponCartHtml = `<div class="card mt-2">
                                                <div class="m-3">
                                                    <span><b class="v_coupon_code">Applied Coupon: ${response.coupon_code}</b></span>
                                                    <span>
                                                        <button id="destroy_coupon"><i class="far fa-times"></i></button>
                                                    </span>
                                                </div>
                                            </div>`
                        $('.coupon_card').html(couponCartHtml);
                        toastr.success(response.message)
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        hideLoader();
                    }
                })
            }

            /**============== Delete coupon =============== */

            $(document).on('click', '#destroy_coupon', function(){
                destroyCoupon();
            })

            function destroyCoupon() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('destroy-coupon') }}",
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        $('#discount').text("{{ currencyPosition('0') }}");
                        $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response
                            .grand_cart_total);
                        $('.coupon_card').html("");

                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        hideLoader();

                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        hideLoader();
                    }
                })
            }
        })
    </script>
@endpush
