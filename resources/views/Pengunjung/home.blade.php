@extends('layouts.app')

@section('content')
<header class="text-center">
    <h1>
        Explore The Beautiful World
        <br />
        As Easy One Click
    </h1>
    <p class="mt-3">
        You will see beautiful
        <br />
        moment you never see before
    </p>
   <p></p>
</header>
<main>
    <div class="container">
        <section class="section-stats row justify-content-center" id="stats">
            <div class="col-3 col-md-2 stats-detail">
                <h2>20K</h2>
                <p>Members</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>12</h2>
                <p>Countries</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>3K</h2>
                <p>Hotels</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>72</h2>
                <p>Partners</p>
            </div>
        </section>
    </div>
    <section class="section-popular" id="popular">
        <div class="container">
            <div class="row">
                <div class="col text-center section-popular-heading">
                    <h2>Wisata Popular</h2>
                    <p>
                        Something that you never try
                        <br />
                        before in this world
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-popular-content" id="popularContent">
        <div class="container">
           
            <div class="section-popular-travel row justify-content-center">
                <?php foreach ($wisata as $item) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column" style="background-image: url({{ asset('storage/wisata/' . $item->gambar_wisata) }});">
                            <div class="travel-country">{{$item->alamat}}</div>
                            <div class="travel-location">{{$item->nama_wisata}}</div>
                            <div class="travel-button mt-auto">
                                <a href="wisata/{{$item->id}}" class="btn btn-travel-details px-4">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <section class="section-terbaru" id="terbaru">
        <div class="container">
            <div class="row">
                <div class="col text-center section-terbaru-heading">
                    <h2>Wisata Lainnya</h2>
                    <p>
                        Something that you never try
                        <br />
                        before in this world
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-terbaru-content" id="terbaruContent">
        <div class="container">
           
            <div class="section-terbaru-travel row justify-content-center">
                <?php foreach ($wisata1 as $item) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column" style="background-image: url({{ asset('storage/wisata/' . $item->gambar_wisata) }});">
                            <div class="travel-country">{{$item->alamat}}</div>
                            <div class="travel-location">{{$item->nama_wisata}}</div>
                            <div class="travel-button mt-auto">
                                <a href="wisata/{{$item->id}}" class="btn btn-travel-details px-4">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <section class="section-testimonials-heading" id="testimonialsHeading">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>They Are Loving Us</h2>
                    <p>
                        Moments were giving them
                        <br />
                        the best experience
                    </p>
                </div>
            </div>
        </div>
    </section>
   
</main>
@endsection