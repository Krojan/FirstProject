$(document).ready(function(){
	var name, phone, table, cname, total, message;
	var foods = [];
	var foodsqty = [];
	var extra = [];
	var extraqty = [];
	var r_foods = [];
	var r_foodsqty = [];
	loginform();

	function loginform(){
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{loginform:1},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.instaorder').css({'width':'360px'});
				$('.instaorder').html(data);
			}
		});
	}

	$('.loginform').submit(function(e){
		e.preventDefault;
		name = $('.pname').val();
		phone = $('.phoneno').val();
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{tables:1},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.adminnav').hide();
				$('.instaorder').css({'width':'400px'});
				$('.instaorder').html(data);
			}
		});
	});

	$('.adminform').submit(function(e){
		e.preventDefault;
		uname = $('.uname').val();
		pass = $('.pass').val();
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{adminlogin:1,uname:uname,pass:pass},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				if (data=="success"){
					window.location.href = "admin.php";
				} else {
					alert(data);
				}
			}
		});
	});
	
	$("body").delegate(".tables table input.btn","click",function(){
		table = $(this).val();
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{country:1},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.instaorder').css({'width':'540px'});
				$('.instaorder').html(data);
			}
		});
	});

	$("body").delegate(".country table button.btn","click",function(){
		cid = $(this).attr('cid');
		cname = $(this).attr('cname');
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{foodlist:1,cid:cid},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.instaorder').css({'width':'680px'})
				$('.instaorder').html(data);
			}
		});
	});

	$("body").delegate(".techno","change",function(){
		var indexr = 0;
		$('.techno:checkbox:checked').each(function(){
			if(this.checked) {
				r_foods[indexr] = $(this).attr("id");
				indexr++;
			}
		});
		$('.selfood:checkbox:checked').each(function(){
			if(this.checked) {
				r_foods[indexr] = $(this).attr("id");
				indexr++;
			}
		});
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{recommend:1,r_foods:JSON.stringify(r_foods),phone:phone},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				var res = data.split(",");
				$('.techno:checkbox').each(function(){
					$(this).closest("tr").find(".recommendedfood").html("");
					for (i = 0; i < res.length; i++) {
						if($(this).attr("id") == res[i]) {
							$(this).closest("tr").find(".recommendedfood").html("recommended");
						}
					}
				});
				$('.selfood:checkbox').each(function(){
					$(this).closest("tr").find(".recommendedfood").html("");
					for (i = 0; i < res.length; i++) {
						if($(this).attr("id") == res[i]) {
							$(this).closest("tr").find(".recommendedfood").html("recommended");
						}
					}
				});
			}
		});
	});

	$("body").delegate(".confirm","click",function(){
		$('.myModal').hide();
		$('.modal-backdrop.fade.in').hide();
		var index = 0;
		$('.techno:checkbox:checked').each(function(){
			foods[index] = $(this).attr("id");
			foodsqty[index] = $(this).closest("tr").find(".qty").val();
			index++;
		});
		$('.selfood:checkbox:checked').each(function(){
			foods[index] = $(this).attr("id");
			foodsqty[index] = $(this).closest("tr").find(".qtys").val();
			index++;
		});
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{calculate:1,foods:JSON.stringify(foods),foodsqty:JSON.stringify(foodsqty)},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.modal-open').css('overflow','auto');
				$('.foodlist').hide();
				$('.instaorder').css({'width':'680px'});
				$('.instaorder').append(data);
			}
		});
	});

	$("body").delegate(".editfoods","click",function(){
		$('.pricelist').hide();
		$('.foodlist').show();
		foods = [];foodsqty = [];
	});
	$("body").delegate(".kitchen","click",function(){
		$('.myModal1').hide();
		$('.modal-backdrop.fade.in').hide();
		total = $('#totalprice').html();
		message = $('#message').val();
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{final:1,pname:name,phoneno:phone,table:table,cname:cname,
							foods:JSON.stringify(foods),foodsqty:JSON.stringify(foodsqty),
							total:total,message:message},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				$('.instaorder').css({'width':'680px'});
				$('.instaorder').html(data);
			}
		});
	});

	$("body").delegate(".servedbtn","click",function(){
		var obj = $(this);
		oid = $(this).attr('oid');
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{served:1,oid:oid},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				obj.html("<b>Served</b>");
				obj.addClass('btn-success');
			}
		});
	});

	$("body").delegate(".paidbtn","click",function(){
		var obj = $(this);
		oid = $(this).attr('oid');
		$.ajax({
			url	:	"process.php",
			method:	"POST",
			data	:	{paid:1,oid:oid},
			dataType:	"html",
			async	:	false,
			success	:	function(data){
				obj.html("<b>Paid</b>");
				obj.addClass('btn-success');
			}
		});
	});
});