<div class="row buttons-block">
    
    <div class="col s13">
        <button class="challengr-btn">
            {!! $today->format('d M Y'); !!}   
        </button>
    </div>
    @php
        $i=1;
        $incrementingDays=1;
    @endphp
    @for($i=1; $i<7; $i++)
        <div class="col s13">
            <button class="challengr-btn">
                {!! $today->addDays($incrementingDays)->format('d M Y'); !!}   
            </button>
        </div>
    @endfor
</div>
<div class="col s12">
    <div class="time-block">
        <ul class="timing disabled_for_mobile">
            @php($hours = 0)
            @while($hours<24)
                <li>{!! sprintf('%02d:00', $hours) !!}</li>
                @php($hours = $hours + $escChallengeInterval)
            @endwhile
        </ul>
        <div class="timing display_for_mobile_drop">
            <select id="leave" class="no-material-select"  style="display: block">
                @php($hours = 0)
                @while($hours <24)
                    <option value="tab1">
                        <a href="#">{!! sprintf('%02d:00', $hours) !!}</a>
                    </option>
                    @php($hours = $hours + $escChallengeInterval)
                @endwhile
            </select>
            <i class="fa fa-caret-down" aria-hidden="true"></i> 
        </div>
        <div class="ist-time">
            <i class="fa fa-angle-down" aria-hidden="true"></i><span>{!! \Carbon\Carbon::now()->format('H:i:s') !!} (IST)</span>
        </div>
    </div>
</div>