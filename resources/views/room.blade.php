<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('includes.head')
@include('layouts.navbar')
<body>
<section class="body">
    <section role="main" class="content-body">
        <div class="inner-wrapper">
            <div style="height: 200px;"></div>
            @if(!empty($propMessage))
            <div class="row" id="searchMain" style="display:none;">
                <div class="sideBar">
                    <p style="font-size: 30px;padding: 10px 0 0 30px;">Filter</p>
                    <select class="form-control selectboxRoom" id="roomType2">
                        <option disabled="disabled" selected="true">Selecteer type kamer</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                    <select class="form-control selectboxRoom" id="persons2">
                        <option disabled="disabled" selected="true">Aantal Personen</option>
                        <option value="2">2 Persoons</option>
                        <option value="4">4 Persoons</option>
                        <option value="6">6 Persoons</option>
                    </select>
                    <button class="form-control roomSearch" id="setFilter2"><i class="fas fa-search"></i></button>
                </div>
                <!--<div style="width:100%;"></div>-->
                <div class="divSmallRooms" id="divSmallRooms">
                @foreach($rooms as $r)
                    @if(!$r->reservations->isEmpty())
                        @foreach($r->reservations as $reservation)
                            @if($reservation->reserved_till < $endDate)
                                <div class="smallRooms">
                                    <div class="input-group">
                                        <div style="background-image:url(/room/{{ $r->typeRoom->type }}.jpg)" class="smallCoverImg"></div>
                                        <div class="roomText">
                                            <h3>Kamer {{ $r->number}}</h3>
                                            <a href="kamers/{{ $r->type_id }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="smallRooms">
                            <div class="input-group">
                                <div style="background-image:url(/room/{{ $r->typeRoom->type }}.jpg)" class="smallCoverImg"></div>
                                <div class="roomText">
                                    <h3>Kamer {{ $r->number}}</h3>
                                    <a href="kamers/{{ $r->type_id }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
            @endif
            <div class="row" id="Main" style="display:flex;">
                <div class="sideBar">
                    <p style="font-size: 30px;padding: 10px 0 0 30px;">Filter</p>
                    <select class="form-control selectboxRoom" id="roomType">
                        <option disabled="disabled" selected="true">Selecteer type kamer</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                    <select class="form-control selectboxRoom" id="persons">
                        <option disabled="disabled" selected="true">Aantal Personen</option>
                        <option value="2">2 Persoons</option>
                        <option value="4">4 Persoons</option>
                        <option value="6">6 Persoons</option>
                    </select>
                    <button class="form-control roomSearch" id="setFilter"><i class="fas fa-search"></i></button>
                </div>
                @foreach($roomTypes as $type)
                    @if($type->id == 1)
                        @if($type->type == "Standaard")
                            <div class="roomListFirst">
                                <div class="input-group">
                                    <div style="background-image:url(/room/{{ $type->type }}.jpg)" class="roomCoverImg"></div>
                                    <div class="roomText">
                                        <h3 style="margin-left: auto;margin-right: auto;">{{ $type->type }}</h3>
                                        <p>Geniet van onze standaard hotel kamers met de laagste prijs in het hotel! Deze mooie standaard kamer bied u alle comfort dat u nodig heeft met een vaste lage prijs!
                                        <br><br>
                                        Er zijn op did moment <b>{{ $rooms->where('type_id', 1)->where('status', 'A')->count() }} kamer(s)</b> beschikbaar!</p>
                                        <a href="{{ url('kamers/'.$type->id) }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if($type->type == "Luxe")
                            <div class="roomList">
                                <div class="input-group">
                                    <div style="background-image:url(/room/{{ $type->type }}.jpg)" class="roomCoverImg"></div>
                                    <div class="roomText">
                                        <h3 style="margin-left: auto;margin-right: auto;">{{ $type->type }}</h3>
                                        <p>Wilt u liever iets luxer dan een standaard kamer? Dan kiest u natuurlijk voor een luxe kamer! Deze luxe kamers zijn uitgerust met een betere design en een mooier uitzicht dan onze standaard kamers!
                                        <br><br>
                                        Er zijn op did moment <b>{{ $rooms->where('type_id', 2)->where('status', 'A')->count() }} kamer(s)</b> beschikbaar!</p>
                                        <a href="{{ url('kamers/'.$type->id) }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($type->type == "Suite")
                            <div class="roomList">
                                <div class="input-group">
                                    <div style="background-image:url(/room/{{ $type->type }}.jpg)" class="roomCoverImg"></div>
                                    <div class="roomText">
                                        <h3 style="margin-left: auto;margin-right: auto;">{{ $type->type }}</h3>
                                        <p>Bent u uit met uw bedrijf en wilt u graag een top notch kamer? Dan kiest u dus voor suite! Onze suites zijn extreem luxe voor de scherpe prijs, zoek niet verder en boek onze suites nu!
                                        <br><br>
                                        Er zijn op did moment <b>{{ $rooms->where('type_id', 3)->where('status', 'A')->count() }} kamer(s)</b> beschikbaar!</p>
                                        <a href="{{ url('kamers/'.$type->id) }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($type->type == "Penthouse")
                            <div class="roomList">
                                <div class="input-group">
                                    <div style="background-image:url(/room/{{ $type->type }}.jpg)" class="roomCoverImg"></div>
                                    <div class="roomText">
                                        <h3 style="margin-left: auto;margin-right: auto;">{{ $type->type }}</h3>
                                        <p>Net getrouwd? Uit met uw geliefde en zoekt u een super deluxe hotel kamer? Onze penthouses zijn hier als beste getest! De penthouse bevind zich op onze hoogste verdieping, de penthouse bied u veel luxe.
                                        <br><br>
                                        Er zijn op did moment <b>{{ $rooms->where('type_id', 4)->where('status', 'A')->count() }} kamer(s)</b> beschikbaar!</p>
                                        <a href="{{ url('kamers/'.$type->id) }}"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="row" id="Filter" style="display:none;">
                <div class="sideBar">
                    <p style="font-size: 30px;padding: 10px 0 0 30px;">Filter</p>
                    <select class="form-control selectboxRoom" id="roomType2">
                        <option disabled="disabled" selected="true">Selecteer type kamer</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                    <select class="form-control selectboxRoom" id="persons2">
                        <option disabled="disabled" selected="true">Aantal Personen</option>
                        <option value="2">2 Persoons</option>
                        <option value="4">4 Persoons</option>
                        <option value="6">6 Persoons</option>
                    </select>
                    <button class="form-control roomSearch" id="setFilter2"><i class="fas fa-search"></i></button>
                </div>
                <div id="searchCount" class="searchCount"></div>
                <!--<div style="width:100%;"></div>-->
                <div class="divSmallRooms" id="divSmallRooms">

                </div>
            </div>
        </div>
    </section>
</section>
</body>
@include('includes.footer')

<script>
$( document ).ready(function() {

    if(location.pathname=="/kamers/search")
    {
        document.getElementById("searchMain").style.display="flex";
        document.getElementById("Main").style.display="none";   
    }

    $(document).on("click", "#setFilter", function (e) {	
        $.ajax({
            url: "/kamers/filter",
            type: "POST",
            data: {
                type: $('#roomType option:selected').val(),
                persons: $('#persons option:selected').val()
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                $('#divSmallRooms').empty();
                $('#searchCount').empty();
                if(response.length == 0)
                {
                    new PNotify({
                        title: 'Error!',
                        text: 'Geen beschikbare hotel kamers gevonden!',
                        type: 'error',
                        delay: 5000                   
                    });                    
                }else{
                    document.getElementById("Main").style.display="none";
                    document.getElementById("Filter").style.display="flex";
                    $.each(response, function( index, value ) {						
                        $('#divSmallRooms').append('<div class="smallRooms">\
                                                        <div class="input-group">\
                                                            <div style="background-image:url(/room/' + value.type_room['type'] + '.jpg)" class="smallCoverImg"></div>\
                                                            <div class="roomText">\
                                                                <h3>Kamer ' + value.number +'</h3>\
                                                                <a href="kamers/' + value.type_id + '"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>\
                                                            </div>\
                                                        </div>\
                                                    </div>');
                    });
                    $('#searchCount').append('Beschikbare kamers voor uw zoekopdracht: <b>' + response.length + '</b>');
                    response = [];
                }
                
            },
            error: function (data) {
                new PNotify({
                    title: 'Error!',
                    text: 'Error',
                    type: 'error',
                    delay: 5000
                });
            }
        });
    });
    $(document).on("click", "#setFilter2", function (e) {	
        $.ajax({
            url: "/kamers/filter",
            type: "POST",
            data: {
                type: $('#roomType2 option:selected').val(),
                persons: $('#persons2 option:selected').val()
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                $('#divSmallRooms').empty();
                $('#searchCount').empty();
                if(response.length == 0)
                {
                    new PNotify({
                        title: 'Error!',
                        text: 'Geen beschikbare hotel kamers gevonden!',
                        type: 'error',
                        delay: 5000                   
                    });                    
                }else{
                    document.getElementById("Main").style.display="none";
                    document.getElementById("Filter").style.display="flex";
                    $.each(response, function( index, value ) {						
                        $('#divSmallRooms').append('<div class="smallRooms">\
                                                        <div class="input-group">\
                                                            <div style="background-image:url(/room/' + value.type_room['type'] + '.jpg)" class="smallCoverImg"></div>\
                                                            <div class="roomText">\
                                                                <h3>Kamer ' + value.number +'</h3>\
                                                                <a href="kamers/' + value.type_id + '"><button class="form-control"><i class="fas fa-shopping-cart"></i> Boek deze kamer!</button></a>\
                                                            </div>\
                                                        </div>\
                                                    </div>');
                    });
                    $('#searchCount').append('Beschikbare kamers voor uw zoekopdracht: <b>' + response.length + '</b>');
                    response = [];
                }
                
            },
            error: function (data) {
                new PNotify({
                    title: 'Error!',
                    text: 'Error',
                    type: 'error',
                    delay: 5000
                });
            }
        });
    });
});
</script>
</html>
