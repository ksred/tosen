<div class="trade-list-item col-lg-12">
	<form class="form-horizontal col-lg-6">
		<fieldset>
			<div class="alert alert-top">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<div class="text"></div>
		    </div>
			<div class="form-group col-lg-12">
				<select data-id="instrument" class="span2 form-control">
						<option value="" data-margin="" ><em>Choose symbol</em></option>
					<?php foreach($instrument as $i) : ?>
						<option value="<?= $i->symbol ?>" data-margin="<?= $i->margin ?>" ><?= $i->symbol ?> - <?= $i->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group col-lg-12">
				<div class="input-group direction">
					<span class="input-group-addon"><span class="glyphicon glyphicon-arrow-up"></span></span>
					<label data-id="direction" class="form-control label-success" style="text-align: center">Buy</label>
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Current</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="current" type="text" placeholder="Current">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Open</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="open" data-type="calc" type="text" placeholder="Open">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Stop</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="stop" data-type="calc" type="text" placeholder="Stop">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Limit</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="limit" data-type="calc" type="text" placeholder="Limit">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Spread</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="spread" data-type="calc" type="text" placeholder="Spread">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">No of shares</label>
				<div class="input-group">
					<input class="form-control" data-id="shares" data-type="calc" type="text" placeholder="No of shares">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Amount</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="amount" data-type="calc" type="text" placeholder="Amount">
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Margin</label>
				<div class="input-group">
					<input class="form-control" data-id="margin" data-type="calc" type="text" placeholder="Margin">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Fee Perc</label>
				<div class="input-group">
					<input class="form-control" data-id="feePerc" data-type="calc" type="text" placeholder="Fee percentage" value="<?= $fee * 100 ?>">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12">
				<label class="col-lg-3">Fee</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="fee" type="text" placeholder="Fee" value="">
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Profit</label>
				<div class="input-group">
					<input class="form-control" data-id="profit" type="text" placeholder="Profit">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Loss</label>
				<div class="input-group">
					<input class="form-control" data-id="loss" type="text" placeholder="Loss">
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Profit Real</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="profit-real" type="text" placeholder="Profit real">
				</div>
			</div>
			<div class="form-group col-lg-12 hidden">
				<label class="col-lg-3">Loss Real</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="loss-real" type="text" placeholder="Loss real">
				</div>
			</div>
			<div class="form-group col-lg-12 has-success bold">
				<label class="col-lg-3">Profit</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="net-profit-real" type="text" placeholder="Net profit real">
				</div>
			</div>
			<div class="form-group col-lg-12 has-error bold">
				<label class="col-lg-3">Loss</label>
				<div class="input-group">
					<span class="input-group-addon"><?= $currency ?></span>
					<input class="form-control" data-id="net-loss-real" type="text" placeholder="Net loss real">
				</div>
			</div>
		</fieldset>
	</form>

	<div class="col-lg-6">
		<canvas class="chart" width="400px" height="400px"></canvas>
		<div class='color-guide'>	
			<h4><span class='col-lg-3 label' style='background-color: #004853'>Margin</span></h4>
			<h4><span class='col-lg-3 label' style='background-color: #00B9BD'>Profit</span></h4>
			<h4><span class='col-lg-3 label' style='background-color: #FB6900'>Loss</span></h4>
		</div>
		<div class="submit-group pull-right col-lg-4">
			<button type="submit" class="ladda-button btn btn-primary btn-large pull-right submit-trade" data-style="zoom-out" data-spinner-size="60">Submit trade</button>
			<button type="button" class="btn btn-default pull-right">Cancel</button>
		</div>
	</div>
</div>
