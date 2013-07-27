$(document).ready( function() {
	var baseUrl = 'http://tosen.co.za/';
	var tradeType = $('.add-trade').attr('data-trade-type');
	$('.all-trades-list').load(baseUrl+'a/get_all_user_trades/' + tradeType);
	//Add trade to trade page
	$(document).on('click', '.add-trade', function() {
		$('.trade-list').load(baseUrl+'a/get_trade_item/' + tradeType);
	});

	$(document).on('change', '.trade-list-item [data-id="instrument"]', function() {
		$(this).parent().parent().find('[data-id="margin"]').val($(this).find('option:selected').attr('data-margin')*100);
		$(this).parent().parent().parent().find('[data-id="current"]').val('');
		$(this).parent().parent().parent().find('[data-id="open"]').val('');
		$(this).parent().parent().parent().find('[data-id="stop"]').val('');
		$(this).parent().parent().parent().find('[data-id="limit"]').val('');
		$(this).parent().parent().parent().find('[data-id="spread"]').val('');
		$(this).parent().parent().parent().find('[data-id="amount"]').val('');
		$(this).parent().parent().parent().find('[data-id="fee"]').val('');
		$(this).parent().parent().parent().find('[data-id="net-profit-real"]').val('');
		$(this).parent().parent().parent().find('[data-id="net-loss-real"]').val('');
	});

	$(document).on('change', '.trade-list-item [data-id="shares"]', function() {
		var price = $(this).parent().parent().parent().find('[data-id="open"]').val();
		var shares = $(this).val();
		if (price != '') {
			$(this).parent().parent().parent().find('[data-id="amount"]').val(((price*shares)/10).toFixed(2));
		}
	});

	$(document).on('change', '.trade-list-item [data-id="amount"]', function() {
		var price = $(this).parent().parent().parent().find('[data-id="open"]').val();
		var amount = $(this).val();
		if (price != '') {
			$(this).parent().parent().parent().find('[data-id="shares"]').val(((amount/price)*10).toFixed(2));
		}
	});

	$(document).on('click', '.trade-list-item .direction', function() {
		var currEl = $(this).find('[data-id="direction"]');
		var curr = $(this).find('[data-id="direction"]').html();
		if (curr == 'Buy') {
			currEl.removeClass('label-success').addClass('label-danger').html('Sell');
			currEl.parent().find('.glyphicon').removeClass('glyphicon-arrow-up').addClass('glyphicon-arrow-down');
		} else if (curr == 'Sell') {
			currEl.removeClass('label-danger').addClass('label-success').html('Buy');
			currEl.parent().find('.glyphicon').removeClass('glyphicon-arrow-down').addClass('glyphicon-arrow-up');
		}
	});

	$(document).on('change', '.trade-list-item input:not(.submit-trade), .trade-list-item select', function() {
		var calc = $(this).parent().parent().parent().find('[data-type="calc"]');
		var isValid = true;
		$(calc).each( function() {
			if ($.trim($(this).val()) == '') {
				isValid = false;
			}
		});
		if (isValid == true) {
			var direction = $(this).parent().parent().parent().find('[data-id="direction"]').html();
			var open = parseFloat($(this).parent().parent().parent().find('[data-id="open"]').val());
			var stop = parseFloat($(this).parent().parent().parent().find('[data-id="stop"]').val());
			var limit = parseFloat($(this).parent().parent().parent().find('[data-id="limit"]').val());
			var spread = parseFloat($(this).parent().parent().parent().find('[data-id="spread"]').val())/100;
			var margin = parseFloat($(this).parent().parent().parent().find('[data-id="margin"]').val());
			var feePerc = parseFloat($(this).parent().parent().parent().find('[data-id="feePerc"]').val());
			var amount = parseFloat($(this).parent().parent().parent().find('[data-id="amount"]').val());
			
			var profit = $(this).parent().parent().parent().find('[data-id="profit"]');
			var loss = $(this).parent().parent().parent().find('[data-id="loss"]');
			var profitReal = $(this).parent().parent().parent().find('[data-id="profit-real"]');
			var lossReal = $(this).parent().parent().parent().find('[data-id="loss-real"]');
			var netProfitReal = $(this).parent().parent().parent().find('[data-id="net-profit-real"]');
			var netLossReal = $(this).parent().parent().parent().find('[data-id="net-loss-real"]');
			var fee = $(this).parent().parent().parent().find('[data-id="fee"]');

			//Do the calculations
			if (direction == 'Buy') {
				var feeAmt = (amount*(1/margin))*feePerc;
				var profitC = ((limit-spread)/open)-1;
				var lossC = 1-(open/(stop-spread));
				var profitRealC = ((profitC*100)/margin)*amount;
				var lossRealC = ((lossC*100)/margin)*amount;
				var netProfitRealC = profitRealC-feeAmt;
				var netLossRealC = lossRealC+feeAmt;
				profit.val((profitC*100).toFixed(2)); //show percentage
				loss.val((lossC*100).toFixed(2)); //show percentage
				profitReal.val(profitRealC.toFixed(2));
				lossReal.val(lossRealC.toFixed(2));
				netProfitReal.val(netProfitRealC.toFixed(2));
				netLossReal.val(netLossRealC.toFixed(2));
				fee.val(feeAmt.toFixed(2));

				drawChart($(this), margin, netProfitRealC, netLossRealC);

			} else if (direction == 'Sell') {
				var feeAmt = (amount*(1/margin))*feePerc;
				var profitC = ((open-spread)/limit)-1;
				var lossC = 1-((open-spread)/stop);
				var profitRealC = ((profitC*100)/margin)*amount;
				var lossRealC = ((lossC*100)/margin)*amount;
				var netProfitRealC = profitRealC-feeAmt;
				var netLossRealC = lossRealC+feeAmt;
				profit.val((profitC*100).toFixed(2)); //show percentage
				loss.val((lossC*100).toFixed(2)); //show percentage
				profitReal.val(profitRealC.toFixed(2));
				lossReal.val(lossRealC.toFixed(2));
				netProfitReal.val(netProfitRealC.toFixed(2));
				netLossReal.val(netLossRealC.toFixed(2));
				fee.val(feeAmt.toFixed(2));

				console.log(margin+netProfitRealC+netLossRealC);
				drawChart($(this), amount, netProfitRealC, netLossRealC);
			}
		}

		function drawChart (currObj, amount, profit, loss) {
			var data = [
				{
					value: Math.abs(amount),
					color:"#004853"
				},
				{
					value : Math.abs(profit),
					color : "#00B9BD"
				},
				{
					value : Math.abs(loss),
					color : "#FB6900"
				}			
			];
			var chartObj = $(currObj).parent().parent().parent().parent().parent().find('.chart').get(0).getContext('2d');
			var options = { onAnimationComplete : notation, animateScale : true };
			var ch = new Chart(chartObj).Pie(data, options);
		}

		function notation () {
			$('.color-guide').fadeIn();
			$('.submit-group').delay(500).fadeIn()
			Ladda.bind('button .submit-trade');
		}
	});

	$(document).on('click', 'button.submit-trade', function() {
		doFormSubmit();
	});

	function doFormSubmit () {
		var instrument = $('.trade-list-item').find('[data-id="instrument"] option:selected').val();
		var direction = $('.trade-list-item').find('[data-id="direction"]').html();
		var current = parseFloat($('.trade-list-item').find('[data-id="current"]').val()).toFixed(5);
		var open = parseFloat($('.trade-list-item').find('[data-id="open"]').val()).toFixed(5);
		var stop = parseFloat($('.trade-list-item').find('[data-id="stop"]').val()).toFixed(5);
		var limit = parseFloat($('.trade-list-item').find('[data-id="limit"]').val()).toFixed(5);
		var spread = parseFloat($('.trade-list-item').find('[data-id="spread"]').val()).toFixed(5);
		var margin = parseFloat($('.trade-list-item').find('[data-id="margin"]').val()).toFixed(5);
		var feePerc = parseFloat($('.trade-list-item').find('[data-id="feePerc"]').val()).toFixed(5);
		var amount = parseFloat($('.trade-list-item').find('[data-id="amount"]').val()).toFixed(5);
		var shares = parseFloat($('.trade-list-item').find('[data-id="shares"]').val()).toFixed(5);
		var profit = parseFloat($('.trade-list-item').find('[data-id="profit"]').val()).toFixed(5);
		var loss = parseFloat($('.trade-list-item').find('[data-id="loss"]').val()).toFixed(5);
		var profitReal = parseFloat($('.trade-list-item').find('[data-id="profit-real"]').val()).toFixed(5);
		var lossReal = parseFloat($('.trade-list-item').find('[data-id="loss-real"]').val()).toFixed(5);
		var netProfitReal = parseFloat($('.trade-list-item').find('[data-id="net-profit-real"]').val()).toFixed(5);
		var netLossReal = parseFloat($('.trade-list-item').find('[data-id="net-loss-real"]').val()).toFixed(5);
		var fee = parseFloat($('.trade-list-item').find('[data-id="fee"]').val()).toFixed(5);

		var d = 'instrument='+instrument+'&direction='+direction+'&current='+current+'&open='+open+'&stop='+stop+'&limit='+limit+'&spread='+spread+'&margin='+margin+'&feePerc='+feePerc+'&amount='+amount+'&shares='+shares+'&profit='+profit+'&loss='+loss+'&profitReal='+profitReal+'&lossReal='+lossReal+'&netProfitReal='+netProfitReal+'&netLossReal='+netLossReal+'&fee='+fee;
		$.ajax({
			type: "POST",
			url: baseUrl+'a/trade_add/',
			data: d,
			dataType : 'json',
			success: success
		});
	}

	function success (data) {
		if (data.success == '1') {
			$('.trade-list-item').slideUp(1000);
			$('.alert-notify .text').html('Trade entered successfully');
			$('.alert-notify').removeClass('alert-danger').fadeIn();
			$('.alert-notify').addClass('alert-success').fadeIn();
			$('.alert-notify').delay(3000).fadeOut();
			$('.all-trades-list').load(baseUrl+'a/get_all_user_trades/' + tradeType);
		} else {
			$('.alert-notify .text').html('Something went wrong');
			$('.alert-notify').removeClass('alert-success').fadeIn();
			$('.alert-notify').addClass('alert-danger').fadeIn();
			$('.alert-notify').delay(10000).fadeOut();
		}
	}

	//Edit trade page
	$(document).on('click', '.btn-active', function() {
		var v = parseInt($(this).attr('data-value'));
		if (v == 1) {
			$(this).removeClass('alert-success').addClass('alert-info').html('Inactive').attr('data-value', 0);
		} else if (v == 0) {
			$(this).removeClass('alert-info').addClass('alert-success').html('Active').attr('data-value', 1);
		}
	});

	$(document).on('click', '.btn-result', function() {
		var v = parseInt($(this).attr('data-value'));
		if (v == 0) {
			$(this).removeClass('alert-danger').removeClass('alert-info').addClass('alert-success').html('Win').attr('data-value', 1);
		} else if (v == 1) {
			$(this).removeClass('alert-info').removeClass('alert-success').addClass('alert-danger').html('Loss').attr('data-value', 2);
		} else if (v == 2) {
			$(this).removeClass('alert-danger').removeClass('alert-success').addClass('alert-info').html('Neutral').attr('data-value', 0);
		}
	});

	$(document).on('click', '.chart-show', function() {
		var amount = parseFloat($('.trade-list-single').find('[data-id="amount"]').val()).toFixed(5);
		var profit = parseFloat($('.trade-list-single').find('[data-id="net-profit-real"]').val()).toFixed(5);
		var loss = parseFloat($('.trade-list-single').find('[data-id="net-loss-real"]').val()).toFixed(5);
		var data = [
			{
				value: Math.abs(amount),
				color:"#004853"
			},
			{
				value : Math.abs(profit),
				color : "#00B9BD"
			},
			{
				value : Math.abs(loss),
				color : "#FB6900"
			}			
		];
		var chartObj = $(this).parent().parent().find('.chart').get(0).getContext('2d');
		var options = { animateScale : true };
		var ch = new Chart(chartObj).Pie(data, options);
		$('.color-guide').fadeIn();
	});

	$(document).on('click', '.btn-update-trade', function() {
		var id = $('.trade-list-single .btn-id').attr('data-value');
		var active = $('.trade-list-single .btn-active').attr('data-value');
		var result = $('.trade-list-single .btn-result').attr('data-value');
		var d = 'id='+id+'&active='+active+'&result='+result;
		$.ajax({
			type: "POST",
			url: baseUrl+'a/update_trade/',
			data: d,
			dataType : 'json',
			success: successEdit
		});
	});

	function successEdit (data) {
		if (data.success == '1') {
			$('.alert-notify .text').html('Trade entered successfully');
			$('.alert-notify').removeClass('alert-danger').fadeIn();
			$('.alert-notify').addClass('alert-success').fadeIn();
			$('.alert-notify').delay(3000).fadeOut();
			window.location.href = baseUrl+'a/show';
		} else {
			$('.alert-notify .text').html('Something went wrong');
			$('.alert-notify').removeClass('alert-success').fadeIn();
			$('.alert-notify').addClass('alert-danger').fadeIn();
			$('.alert-notify').delay(10000).fadeOut();
		}
	}

});
