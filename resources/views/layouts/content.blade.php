<gta-content _ngcontent-c0="" _nghost-c2="" class="is-hidden-touch">
    <div _ngcontent-c2="" class="content">
        <div _ngcontent-c2="" class="header"
             style="background-image: url('@yield('image')');">
			<div class="note">
				<a class="fa fa-bell" id="notificationsToggle">
					<span class="fa fa-comment"></span>
					<span class="num"></span>
				</a>
				
				<ul class="notification-menu" id="notification-list">
					<p class="left" id="notificationsAmount">Notifications:</p>
				</ul>
			</div>
		</div>
        <h1 _ngcontent-c2="">
            @yield('h1')
        </h1>
        <router-outlet _ngcontent-c2=""></router-outlet>
        <gta-login _nghost-c4="">
            <div _ngcontent-c4="" class="login">
                @yield('content')
            </div>
        </gta-login>
    </div>
</gta-content>


<div _ngcontent-c2="" class="content is-hidden-desktop is-hidden-fullhd is-hidden-widescreen">
    <div _ngcontent-c2="" class="header"
         style="background-image: url('@yield('image')');"></div>
    <div class="header-ucp">
        <h1 _ngcontent-c2="">
            @yield('h1')
        </h1>
    </div>
    <router-outlet _ngcontent-c2=""></router-outlet>
    <gta-login _nghost-c4="">
        <div _ngcontent-c4="" class="login">
            @yield('content')
        </div>
    </gta-login>
</div>
<script>
	 

$(document).ready(function(){	
	function UpdateNotes()
	{
		$("ul#notification-list").empty();
		$("ul#notification-list").append('<p class="left" id="notificationsAmount">Notifications:</p>');
		var unreadCount = 0;
		var formData = {
			"_token": "{{ csrf_token() }}",
			"user": "{{ auth()->id() }}",
			"type": "updateNotes",
		}
	
		$.ajax({
			type: "POST",
			url: "/getnotifications",
			data: formData,
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			success: function (data) {
				$.each(data.notifications, function( index, value ) {
					if(value.read == 1)
					{
						$("ul#notification-list").append('<li id="' + value.id + '"><strong>' + value.text + '</strong> <small><i>(by <strong>UCP</strong>)</i></small> &nbsp<span style="float:right; padding-top:5px; color:grey;"><a href="#" class="remove" id="' + value.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span></li>');
					}
					else
					{
						$("ul#notification-list").append('<li style="background-color:#fdaf0f" id="' + value.id + '"><strong>' + value.text + '</strong> <small><i>(by <strong>UCP</strong>)</i></small> &nbsp <span style="float:right; padding-top:5px; color:grey;"><a href="#" class="remove" id="' + value.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span></li>');
						unreadCount++;
					}
				});
				$("ul#notification-list").append('<a href="#" class="regular" id="markRead"><p class="center">Mark All Read</p></a>');
				$('span.num').text(unreadCount);
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
		setTimeout(UpdateNotes, 60000);
	}
	
	UpdateNotes();
	
	$(document).on('click', '#notificationsToggle',function(e) { 
		$('.notification-menu').slideToggle("slow"); 
	});
	
	$(document).on('click', '#markRead',function(e) { 
		e.preventDefault(); 
		
		var details = {
			"_token": "{{ csrf_token() }}",
			"user": "{{ auth()->id() }}",
			"type": "markRead",
		}
		
		$.ajax({
			type: "POST",
			url: "/getnotifications",
			data: details,
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			success: function (data) {
				console.log(data);
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
		$('.notification-menu').slideToggle("slow");
	});
	
	$(document).on('click', 'ul#notification-list li a',function(e) { 
		e.preventDefault(); 
		
		var details = {
			"_token": "{{ csrf_token() }}",
			"user": "{{ auth()->id() }}",
			"type": "removeNote",
			"note": $(this).attr('id'),
		}
		
		var note = $(this).attr('id');
		
		$.ajax({
			type: "POST",
			url: "/getnotifications",
			data: details,
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			success: function (data) {
				console.log(data);
				setTimeout( function(){ 
					 $("li#" + note).fadeOut('slow', function() {
						$("li#" + note).remove();
					});
				}, 1000);	
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});
	
});

</script>