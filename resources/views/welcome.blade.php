<!doctype html>
<html lang="{{ app()->getLocale() }}">
	@include('includes.head')
	@include('layouts.navbar')
    <body>
		<section class="body">		
			<section role="main" class="content-body">
				<div class="inner-wrapper">
					
					<div class="row" style="display:block;">
						<div class="col-xl-12 header-photo">
							<section class="card-body">

							</section>
						</div>
					</div>
					<div class="row">
                        <div class="card-body">
                            <div class="col-xl-12 col-sm-12 col-md-12">
                                <div class="backgroundSearch">
                                    <div class="col-xl-12 col-sm-12 col-md-12 middleSearch">
                                        <form method="POST" action="/kamers/search">
                                            @csrf
                                            <div class="input-group">
                                                <div class="left-col">
                                                    <div id="icon"><i class="fas fa-users " style="font-size:25px;margin-top:15px;margin-bottom:15px;"></i></div>&nbsp;&nbsp;<b>2-6</b>
                                                </div>
                                                <div class="right-col">
                                                    <select class="form-control" id="persons" name="persons">
                                                        <option>Aantal Personen</option disabled>
                                                        <option value="2">2 Persoons</option>
                                                        <option value="4">4 Persoons</option>
                                                        <option value="6">6 Persoons</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="left-col">
                                                    <div id="icon"><i class="fas fa-calendar-plus" style="font-size:25px;"></i></div>&nbsp;&nbsp;<b>Aankomst Datum</b>
                                                </div>
                                                <div class="right-col">
                                                    <input type="date" id="startDate" name="startDate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="left-col">
                                                    <div id="icon"><i class="fas fa-calendar-minus" style="font-size:25px;"></i></div>&nbsp;&nbsp;<b>Vertrek Datum</b>
                                                </div>
                                                <div class="right-col">
                                                    <input type="date" id="endDate" name="endDate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="left-col">

                                                </div>
                                                <div class="right-col">
                                                    <button class="form-control" id="search" name="search"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
						</div>
					</div>
					<div class="row" style="margin-top:3%;margin-left:1%;">
						<div class="col-md-4">
							<center><i class="fas fa-hotel" style="font-size:4rem;margin-bottom:5px;"></i></center>
							<p>Ons hotel heeft een verschillend aanbod aan kwaliteit kamers. Op dit moment heeft ons hotel <b>{{ $roomTypes->count() }}</b> verschillende typen kamers beschikbaar om geboekt te worden! Zoek niet verder en kijk snel wat ons hotel u te bieden heeft!</p>
						</div>
						<div class="col-md-4">
							<center><i class="fas fa-bed" style="font-size:4rem;margin-bottom:5px;"></i></center>
							<p>Van standaard kamers tot extreem luxe penthouses! Ons hotel heeft een groot aanbod kamers met op dit moment maar liefst <b>{{ $rooms }}</b> kamers beschikbaar! Neem snel een kijkje op onze kamer pagina!</p>
					    </div>
						<div class="col-md-4">
							<center><i class="fas fa-star" style="font-size:4rem;margin-bottom:5px;"></i></center>
							<p>Ons hotel heeft een van de hoogste beoordeelings van alle hotels in nederland, onze score ligt gemiddeld op <b>9.3</b>! Neem snel een kijkje en genieg persoonlijk van onze klanvriendelijke service!</p>						
						</div>
					</div>
				</div>	
			</section>
		</section>
    </body>
	@include('includes.footer')
    <script>
        $( document ).ready(function() {
            document.getElementsByClassName("footer").style.position = 'unset';
        });
    </script>
</html>
