@foreach($ads as $ad)

    <div class="offer__item stripe">
        <div class="offer__preview-top">
            <div class="offer__preview-top-box">
                <p class="offer__preview-top-title">{{$ad->name}}</p>
                <div class="offer__preview-top-price-box">
                    <div class="offer__preview-top-price">
                        @if($ad->salary_from>0&&$ad->salary_to>0)
                            <span>$</span>
                            @if($ad->salary_from>0)
                                <span>{{$ad->salary_from}}</span>
                            @endif
                            @if($ad->salary_to>$ad->salary_from)
                                <span>-</span>
                                <span>{{$ad->salary_to}}</span>
                            @endif
                        @endif
                    </div>
                    @if($ad->logo)
                        <a class="offer__preview-top-logo"
                           href="/?company={{$ad->company_id}}">

                            <img class="offer__preview-top-img" src="{{$ad->logo}}"
                                 alt="Logo">
                        </a>
                    @endif
                </div>
            </div>
            @foreach($ad->locations as $location)
                <a class="offer__preview-top-link"
                   href="?location[]={{$location->id}}">{{$location->name_en}}</a>
            @endforeach
        </div>
        <p class="offer__lead">
            {!! $ad->short !!}

        </p>
        <div class="offer__meta">
            <a class="offer__meta-btn" href="/ad/{{$ad->id}}">
                Apply
                <span class="material-symbols-outlined">
                        arrow_right_alt
                      </span>
            </a>
            <span class="offer__meta-data">{{date('d M',strtotime($ad->public_at))}}</span>
        </div>
    </div>

@endforeach
