<?php $this->load->view('patrials/header'); ?>

<?php 
  if(empty($blog['cover']))
    $cover = base_url().'assets/img/post-bg.jpg';
  else
    $cover = base_url().'uploads/'.$blog['cover']; 
?>

<header class="masthead" style="background-image: url('<?php echo $cover;?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
          	<h1> <?php echo $blog['title']; ?> </h1>
            <span class="meta">Sarifudin <?php echo $blog['date']; ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
			     <p><?php echo $blog['content']; ?> </p>
            <p class="post-meta">Posted on <?php echo $blog['date']; ?></p>
            <a href="<?php echo site_url('blog/update/'.$blog['id']);?>" style="text-decoration:none">EDIT</a> ||
            <a href="<?php echo site_url('blog/delete/'.$blog['id']);?>" style="text-decoration:none ; color:red">HAPUS</a>
        </div>
      </div>
    </div>
  </article>

  <hr>




<?php $this->load->view('patrials/footer'); ?>