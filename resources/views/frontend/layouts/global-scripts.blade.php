<script>
    // Load product modal
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route('load-product-modal', ':productId') }}'.replace(':productId', productId),
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
    function updateSidebarCart() {
        $.ajax({
            method: 'GET',
            url: '{{ route('get-cart-products') }}',
            beforeSend: function() {
            },
            success: function(resposnce) {
                $('.cart_contents').html(resposnce);
                let cartTotal = $('#cart_total').val();
                $('.cart_subtotal').text("{{ currencyPosition(':cartTotal') }}".replace(':cartTotal', cartTotal));
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
            }
        })
    }
</script>
