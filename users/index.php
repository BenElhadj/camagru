<?php
       $user = new User();

?>
<!DOCTYPE html>
<html>
<head>

    <title></title>

    <!-- Custom styles for this template -->
    <link href="<?php echo $appUrl; ?>assets/css/style.css" rel="stylesheet">

</head>

<body>
<nav>
  <ul>
    <li> 
      <a  href="<?php echo $appUrl; ?>index.php?page=user&action=register"> register </a>
    </li>
    <li>
       <a href="<?php echo $appUrl; ?>index.php?page=user&action=login"> login </a>
    </li>
  </ul>
</nav>



<!-- Begin page content -->
<div class="container">
    <div class="row">
      <?php
        $action = (! empty($_GET['action'])) ? $_GET['action'] : null;
       if ($action == 'register') {
            require('users/register.php');
        } elseif($action == 'login') {
            require('users/login.php');
        } elseif($action == 'save') {
            require('users/store.php');
        } elseif($action == 'thankyou') {
            require('users/thankyou.php');
        }else {
            require '404.php';
        }
       ?>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $appUrl; ?>assets/js/jquery.min.js" ></script>


<script type="text/javascript">
        $('.delete').click(function()
        {
            if (confirm('Delete article?')) {
                var url = $(this).val();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {},
                    success: function(result) {
                        document.location.reload(true);
                    },
                    error: function(xhr) {
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    }
                });
            };
        });
    </script>

    <script type="text/javascript">
        $("nav>button").click(function () {
  $("nav>ul").toggleClass("showNav");
});

    </script>
</body>
</html>
