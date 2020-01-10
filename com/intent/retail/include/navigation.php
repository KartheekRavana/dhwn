<section class="content-header">
      <h1>
        <?php echo $_GET["action"]?>
        <small><?php echo $_GET["c"]?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?action=index&c=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> <?php echo $_GET["c"]?></a></li>
        <li class="active"><?php echo $_GET["action"]?></li>
      </ol>
    </section>