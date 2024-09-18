<section class="fp__team pt_95 xs_pt_65 pb_50">
    <div class="container">

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_25">
                    <h4>{{ @$sectionTitles['our_team_top_title'] }}</h4>
                    <h2>{{ @$sectionTitles['our_team_main_title'] }}</h2>
                    <span>
                        <img src="{{ asset('frontend/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                    </span>
                    <p>{{ @$sectionTitles['our_team_sub_title'] }}</p>
                </div>
            </div>
        </div>

        <div class="row team_slider">
            @foreach ($ourTeam as $member)
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_team">
                        <div class="fp__single_team_img">
                            <img src="{{ asset($member->image) }}" alt="team" class="img-fluid w-100">
                        </div>
                        <div class="fp__single_team_text">
                            <h4>{{ $member->name }}</h4>
                            <p>{{ $member->title }}</p>
                            <ul class="d-flex flex-wrap justify-content-center">
                                @if ($member->fb)
                                    <li><a href="{{ $member->fb }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($member->in)
                                    <li><a href="{{ $member->in }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if ($member->x)
                                    <li><a href="{{ $member->x }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ($member->web)
                                    <li><a href="{{ $member->web }}"><i class="fas fa-link"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
