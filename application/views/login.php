<?php $this->load->view('patrials/header'); ?>

<header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1> Assalamu'aikum</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

      <?php echo $this->session->flashdata('massage'); ?>

      <?php echo form_open(); ?>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control"> 
          </div>
          <div class="form-group">
            <label for="username">Password</label>
            <input type="password" name="password" class="form-control">  
          </div>
          <button type="submit" class="btn btn-primary">Masuk</button>

      </form >
      </div> 
    </div>
  </div>

  <?php $this->load->view('patrials/footer');