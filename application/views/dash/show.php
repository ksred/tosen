<?php $this->load->view('_template/header.php'); ?>
Tosen.co.za
logged in

<hr>
<div class="btn btn-primary add-trade span2" data-trade-type="<?= $type ?>">Add trade</div>
<div class="alert pull-right alert-notify">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<div class="text"></div>
</div>
<hr>
<div class="col-lg-12 trade-list"></div>
<div class="col-lg-12 all-trades-list"></div>
<hr>

<?php $this->load->view('_template/footer.php'); ?>
