<?php $this->load->view('_template/header') ?>
<hr style="margin-top: 50px">
<div class="trade-list-single col-lg-12">
	<form class="form-horizontal col-lg-6">
		<fieldset>
			<div class="alert alert-top">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<div class="text"></div> </div>
			<div class="form-group col-lg-12">
				<select data-id="instrument" class="span2 form-control">
						<option value="<?= $trade->instrument ?>" data-margin="" ><?= $trade->instrument ?></option>
				</select>
			</div>
			<div class="form-group col-lg-12">
				<div class="input-group direction">
					<span class="input-group-addon"><span class="glyphicon glyphicon-arrow-<?= ($trade->direction == 'Buy') ? "up" : "down" ?>"></span></span>
					<label data-id="direction" class="form-control <?= ($trade->direction == 'Buy') ? "label-success" : "label-danger" ?>" style="text-align: center"><?= $trade->direction ?></label>
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Current</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="current" type="text" placeholder="Current" value="<?= $trade->current ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Open</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="open" data-type="calc" type="text" placeholder="Open" value="<?= $trade->open ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Stop</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="stop" data-type="calc" type="text" placeholder="Stop" value="<?= $trade->stop ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Limit</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="limit" data-type="calc" type="text" placeholder="Limit" value="<?= $trade->limit ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Spread</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="spread" data-type="calc" type="text" placeholder="Spread" value="<?= $trade->spread ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">No of shares</label>
				<div class="input-group">
					<input class="form-control" data-id="shares" data-type="calc" type="text" placeholder="No of shares" value="<?= $trade->shares ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Amount</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="amount" data-type="calc" type="text" placeholder="Amount" value="<?= $trade->amount ?>">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Margin</label>
				<div class="input-group">
					<input class="form-control" data-id="margin" data-type="calc" type="text" placeholder="Margin" value="<?= $trade->margin ?>">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Fee</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="fee" type="text" placeholder="Fee" value="<?= $trade->fee ?>">
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Profit</label>
				<div class="input-group">
					<input class="form-control" data-id="profit" type="text" placeholder="Profit" value="<?= $trade->profit ?>">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Loss</label>
				<div class="input-group">
					<input class="form-control" data-id="loss" type="text" placeholder="Loss" value="<?= $trade->loss ?>">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Profit Real</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="profit-real" type="text" placeholder="Profit real" value="<?= $trade->profit_real ?>">
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Loss Real</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="loss-real" type="text" placeholder="Loss real" value="<?= $trade->loss_real ?>">
				</div>
			</div>
			<div class="form-group col-lg-12 has-success bold">
				<label class="col-lg-3">Profit</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="net-profit-real" type="text" placeholder="Net profit real" value="<?= $trade->net_profit_real ?>">
				</div>
			</div>
			<div class="form-group col-lg-12 has-error bold">
				<label class="col-lg-3">Loss</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="net-loss-real" type="text" placeholder="Net loss real" value="<?= $trade->net_loss_real ?>">
				</div>
			</div>

		</fieldset>
	</form>

	<?php
		switch ($trade->active) {
			case "0":
				$active_class="alert-info";
				$active_text="Inactive";
			break;
			case "1":
				$active_class="alert-success";
				$active_text="Active";
			break;
		}

		switch ($trade->result) {
			case "0":
				$result_class="alert-info";
				$result_text="Neutral";
			break;
			case "1":
				$result_class="alert-success";
				$result_text="Win";
			break;
			case "1":
				$result_class="alert-danger";
				$result_text="Loss";
			break;
		}
	?>
	<div class="col-lg-6">
		<canvas class="chart" width="400px" height="400px"></canvas>
		<div class='color-guide'>	
			<h4><span class='col-lg-3 label' style='background-color: #004853'>Margin</span></h4>
			<h4><span class='col-lg-3 label' style='background-color: #00B9BD'>Profit</span></h4>
			<h4><span class='col-lg-3 label' style='background-color: #FB6900'>Loss</span></h4>
		</div>
		<div class="col-lg-12">
			<?php $d = strtotime($trade->date_open); echo date('j F, Y', $d) ?>
		</div>
	</div>
	<div class="col-lg-12 pull-left">
		<button data-for="active" class="btn btn-large btn-active <?= $active_class ?>" data-value="<?= $trade->active ?>"><?= $active_text ?></button>
		<button data-for="result" class="btn btn-large btn-result <?= $result_class ?>" data-value="<?= $trade->result ?>"><?= $result_text ?></button>
		<button class="btn btn-large btn-id hidden" data-value="<?= $trade->id ?>"></button>
		<button class="btn btn-large pull-right btn-default chart-show hidden">Show chart</button>
		<button class="btn btn-large pull-right btn-default btn-update-trade">Save</button>
	</div>
</div>
<script>
$(document).ready( function() {
	$('.chart-show').click();
});
</script>

<?php $this->load->view('_template/footer') ?>
