
<?php $this->load->view('patrials/header'); ?>

  <header class="masthead" style="background-image: url('<?php base_url(); ?>assets/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>SELAMAT DATANG</h1>
              <span class="subheading">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-10 mx-auto">

        <?php echo $this->session->flashdata('massage'); ?>

        <form>
          <input class="form-controls" type="text" name="find">
          <button class="btn-info" type="submit">Cari</button>
       </form>
    <br>
<?php foreach ($blogs as $key => $blog): ?>

        <div class="post-preview">
            <a href="<?php echo site_url('blog/detail/'.$blog['url']); ?>">
              <h2 class="post-title">
                  <?php echo $blog['title']; ?>
             </h2>
           </a>
            <p>
              <?php echo $blog['content']; ?>
            </p>
          <p class="post-meta">Posted on <?php echo $blog['date']; ?></p>

          <?php if(isset($_SESSION['username'])): ?>
              <a href="<?php echo site_url('blog/update/'.$blog['id']);?>" style="text-decoration:none">EDIT</a> ||
              <a href="<?php echo site_url('blog/delete/'.$blog['id']);?>" onclick="return confirm('Apakah Anda yakin menghapus data ini...?');" style="text-decoration:none ; color:red">HAPUS</a>
            <?php  endif; ?>
        </div>
<?php endforeach; ?>
<br>
  <?php echo $this->pagination->create_links(); ?>
        <hr>

        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

 <?php $this->load->view('patrials/footer'); ?>