<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('includes.head')
@include('layouts.navbar')
<body>
<section class="body">
    <section role="main" class="content-body">
        <div class="inner-wrapper">
            <div style="height: 200px;"></div>
				<div class="col-xl-8 roomBody">
					&nbsp;
					<div class="input-group">
						<div class="imgIRoom" style="background-image:url(/room/{{ $room_type->type }}.jpg)"></div>
						<div style="margin-left:auto;margin-right:auto;"><h1>{{ $room_type->type }}</h1>
						
						<p>Op dit moment zijn er {{ $room->count() }} kamers beschikbaar voor dit type kamer!</p><br />
						<p>Deze kamer is volzien met de volgende items:</p><br>
						@if($room_type->id == 1)
							<p>WC</p>
							<p>Badkamer</p>
							<p>2 Persoons bedden</p>
						@elseif($room_type->id == 2)
							<p>TV</p>
						@elseif($room_type->id == 3)
							<p>Minibar</p>
						@elseif($room_type->id == 4)
							<p>Luxe douche</p>
						@endif
						</div>
					</div>
					<div style="width:50%">
						<div class="input-group" style="margin-top:2.5%;">
							@for($i = 1; $i < 5; $i++)		
								<img src="/room/{{ $room_type->type}}{{ $i }}.jpg" data-toggle="modal" data-target="#modal{{$i}}" id="roomImg{{$i}}" class="imgIRoomSmall"></img>							
							@endfor
						</div>
					</div>
				</div>
				
			<p>Date: <input type="text" id="datepicker"></p>
			
			@for($i = 1; $i < 5; $i++)
				<div class="modal fade bd-example-modal-lg" id="modal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <img src="/room/{{ $room_type->type}}{{$i}}.jpg"></img>
					</div>
				  </div>
				</div>
			@endfor
        </div>
    </section>
</section>
</body>
@include('includes.footer')
<script>
$( document ).ready(function() {
	var array = ["2018-12-15","2018-12-25","2018-12-29"]

	$('#datepicker').datepicker({
		beforeShowDay: function(date){
			var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
			return [ array.indexOf(string) == -1 ]
		}
	});
});
</script>
</html>
