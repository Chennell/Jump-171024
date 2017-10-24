<?php
    include("config.php");
    include("menu.php");
?>

<div class="search" action="">
    <i class="fa fa-search" aria-hidden="true"></i>
    <form class="searchForm" action="envents.php" method="POST">
        <INPUT type="text" name="search">
        <INPUT class='submitBtn' type="submit" name="submit" value="Search">
    </form>
</div>
<div class="searchResult">
    
</div>


<?php
    include("footer.php");
?>