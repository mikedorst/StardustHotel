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
							<p>Voor maar <font color="green"><b>&euro; {{ $room_type->price }}</b></font> per nacht voor 2 personen!<p></br>
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
						<table class="table table-bordered table-striped">
							<thead>
								<th>Kamer</th>
								<th>Aantal Persoonen</th>
								<th>Boeken</th>
							</thead>
							<tbody>
								@foreach($room as $r)
									<tr>
										<td>{{ $r->number }}</td>
										<td>{{ $r->space }}</td>
										<td><button href="#confirmBook_{{$r->id}}" data-target="#confirmBook_{{$r->id}}" data-toggle="modal" type="submit"  id="openBookModal_{{$r->id}}" class="modal-with-form btn btn-default">Boek</button></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						
					</div>
				
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
	@foreach($room as $r)
	<div class="modal" id="confirmBook_{{$r->id}}">
        <div class="modal-dialog col-xl-6">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Boek kamer {{ $r->number }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
			<div class="modal-body">    
				<div class="input-group mb-2">
					<div class="col-xl-12">
						<b>Datum aankomst:</b>
						<input type="text" id="datepickerArrive" class="form-control" placeholder="DD/MM/YYYY">
					</div>
				</div>
				<div class="input-group mb-2">
					<div class="col-xl-12">
						<b>Datum vertrek:</b>
						<input type="text" id="datepickerLeave" class="form-control" placeholder="DD/MM/YYYY">
					</div>	
				</div>
				<div class="input-group mb-2">
					<div class="col-xl-12">
						<b>Aantal Personen</b>
						<select class="form-control" id="persons">
							<option disabled="disabled" selected="true">Aantal Personen</option>
							<option value="2">2 Persoons</option>
							<option value="4">4 Persoons</option>
							<option value="6">6 Persoons</option>
						</select>
					</div>		
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Annuleren</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="submit_booking">Boeken</button>
			</div>

            </div>
        </div>
    </div>
	@endforeach
	
	
	@php
		$allDates = Array();
	@endphp		
	@foreach($Reservation as $r)
			@php $arr = (array)$r->reservation_dates; @endphp
			@php $x = implode(',', $arr); @endphp
			@php $x = str_replace(']', '', $x); @endphp
			@php $x = str_replace('[', '', $x); @endphp 
			@php $allDates[] = $x; @endphp
	@endforeach
	
	@php $string = ''; @endphp
	@foreach ($allDates as $d)
		@php $string .= $d.''; @endphp
	@endforeach
	
	<input type="text" id="arrayDates" value="{{ $string }}" hidden />
	

</body>
@include('includes.footer')
<script>
$( document ).ready(function() {
	
	//var array = ["2018-12-15","2018-12-25","2018-12-29"]
	var array = $('#arrayDates').val(); 

	$('#datepickerArrive').datepicker({
		beforeShowDay: function(date){
			var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
			return [ array.indexOf(string) == -1 ]
		}
	});
	
	$('#datepickerLeave').datepicker({
		beforeShowDay: function(date){
			var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
			return [ array.indexOf(string) == -1 ]
		}
	});
	
	$(document).on("click", "#openBookModal", function (e) {
		var dateFirst = $( "#datepickerArrive" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		var dateSecond = $( "#datepickerLeave" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		var price = {{ $room_type->price }};
		
		var startDate = Date.parse(dateFirst);
		var endDate = Date.parse(dateSecond);
		var timeDiff = endDate - startDate;
		daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
		
		console.log(daysDiff);
		
		var totalDays = daysDiff + 1;
		var totalPrice = price * totalDays;
		
		$('#payment').text(totalPrice);
	});
	
	$(document).on("click", "#submit_booking", function (e) {
		$.ajax({
			url: "/bookings/add",
			type: "POST",
			dataType: "json",
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data:{
				dateArrive: $( "#datepickerArrive" ).datepicker({ dateFormat: 'yy-mm-dd' }).val(),
				dateLeave: $( "#datepickerLeave" ).datepicker({ dateFormat: 'yy-mm-dd' }).val(),
				price: $('#payment').text(),
				room_type: {{ $room_type->id }},
				persons: $('#persons option:selected').val()
			}
		})
		.done(function(data) {
			new PNotify({
				title: 'Success!',
				text: 'De kamer is voor u geboekt!',
				type: 'success',
				delay: 5000                   
			});  
			console.log(data);
		})
		.fail(function(data) {
			new PNotify({
				title: 'Success!',
				text: 'De kamer is voor u geboekt!',
				type: 'success',
				delay: 5000                   
			});  
			  
			console.log(data);
		});
	});
});
</script>
</html>
