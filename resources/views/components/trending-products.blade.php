<section class="trending-product section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>{{$title}}</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Product -->

                <x-producrt-card :$product="$product"/>

                <!-- End Single Product -->
            </div>
            @endforeach
        </div>
    </div>
</section>