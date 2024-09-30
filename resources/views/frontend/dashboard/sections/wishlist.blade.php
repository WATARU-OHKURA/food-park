<div class="tab-pane fade " id="v-pills-messages2" role="tabpanel" aria-labelledby="v-pills-messages-tab2">
    <div class="fp_dashboard_body">
        <h3>wishlist</h3>
        <div class="fp__dashoard_wishlist">

            <div class="row">
                @foreach ($wishlist as $item)
                    <div class="col-xl-4 col-sm-6 col-lg-6">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ $item->product->thumb_image }}" alt="menu"
                                    class="img-fluid w-100">
                                <a class="category" href="#">{{ $item->product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                <a class="title" href="menu_details.html">{{ $item->product->name }}</a>
                                <h5 class="price">
                                    @if ($item->product->offer_price > 0)
                                        {{ currencyPosition($item->product->offer_price) }}
                                        <del>{{ currencyPosition($item->product->price) }}</del>
                                    @else
                                        {{ currencyPosition($item->product->price) }}
                                    @endif
                                </h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li>
                                        <a href="javascript:;" onclick="loadProductModal('{{ $item->product->id }}')">
                                            <i class="fas fa-shopping-basket"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('product.show', $item->product->slug) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($wishlist->hasPages())
                <div class="fp__pagination mt_60">
                    <div class="row">
                        <div class="col-12">
                            {{ $wishlist->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
