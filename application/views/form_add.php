
<?php $this->load->view('patrials/header') ?>

<header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
          	<h1> + Tambah Artikel Baru</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="alert alert-warning">
				<?php echo validation_errors();?>
			</div>

			<?php echo form_open_multipart(); ?>
				<div  class="form-group">
					<label>Judul</label>
					<?php echo form_input('title', set_value('title'), 'class="form-control"'); ?>	
<!-- 					<input class="form-control" type="text" name="title"> -->
				</div>
				<div  class="form-group">
					<label>URL</label>
					<?php echo form_input('url', set_value('url'), 'class="form-control"'); ?>	
<!-- 					<input class="form-control" type="text" name="url"> -->
				</div>
				<div  class="form-group">
					<label>Konten</label>
					<?php echo form_textarea('content', set_value('content'), 'class="form-control"'); ?>	
<!-- 					<textarea class="form-control" name="content"></textarea> -->
				</div>
				<div  class="form-group">
					<label>Cover</label>
					<?php echo form_upload('cover', set_value('cover'), 'class="form-control"'); ?>	
				</div>
				<br>
				<button class="btn btn-primary" type="submit">Simpan Artikel</button>

			<?php echo form_close(); ?>

		</div>
	</div>
</div>

<?php $this->load->view('patrials/footer'); ?>
