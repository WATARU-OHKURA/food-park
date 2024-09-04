<script>
    /** Show sweet alert confirm message **/
    $('body').on('click', '.delete-item', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: 'DELETE',
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });

                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    });

    
    // Show Loader
    function showLoader() {
        $(".overlay-container").removeClass('d-none');
        $(".overlay").addClass('active');
    }

    // Show Loader
    function hideLoader() {
        $(".overlay").removeClass('active');
        $(".overlay-container").addClass('d-none');
    }

    // Load product modal
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: "{{ route('load-product-modal', ':productId') }}".replace(':productId', productId),
            beforeSend: function() {
                $(".overlay-container").removeClass('d-none');
                $(".overlay").addClass('active');
            },
            success: function(resposnce) {
                $(".load_product_modal_body").html(resposnce);
                $('#cartModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                $(".overlay").removeClass('active');
                $(".overlay-container").addClass('d-none');
            }
        })
    }

    // Update sidebar cart
    function updateSidebarCart(callback = null) {
        $.ajax({
            method: 'GET',
            url: "{{ route('get-cart-products') }}",
            success: function(resposnce) {
                $('.cart_contents').html(resposnce);
                let cartTotal = $('#cart_total').val();
                let cartCount = $('#cart_poduct_count').val();
                $('.cart_subtotal').text("{{ currencyPosition(':cartTotal') }}".replace(':cartTotal',
                    cartTotal));
                $('.cart_count').text(cartCount);

                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
        })
    }

    // Remove cart product from sidebar
    function removeProductFromSidebar($rowId) {
        $.ajax({
            method: 'GET',
            url: "{{ route('cart-product-remove', ':rowId') }}".replace(":rowId", $rowId),
            beforeSend: function() {
                $(".overlay-container").removeClass('d-none');
                $(".overlay").addClass('active');
            },
            success: function(responce) {
                if (responce.status === 'success') {
                    updateSidebarCart(function() {
                        toastr.success(responce.message);
                        $(".overlay").removeClass('active');
                        $(".overlay-container").addClass('d-none');
                    })
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
        })
    }

    /* GET CURRENT CART TOTAL AMOUNCT */
    function getCartTotal() {
        return parseFloat("{{ cartTotal() }}");
    }
</script>
