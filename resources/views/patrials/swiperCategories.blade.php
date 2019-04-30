<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-grab" data-arrow="false" data-dots="false" data-items-xl="6" data-items-lg="5" data-items-md="4" data-items-sm="3" data-items-xs="2">
                    @foreach($swiperCategories as $category)
                        <div class="item">
                            <img class="w-75" src="{{ $category->pathAttachment() }}" alt="{{ $category->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
