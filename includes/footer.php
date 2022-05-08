<?php 
    $currentYear = date('Y');
    $displayYear = $currentYear == '2020' ? '2020' : "2020-{$currentYear}";
?>

<nav id="footer" class="navbar fixed-bottom navbar-light px-4 py-1" style="background-color: #E0E0FF;">
    <span class="navbar-brand mb-0 px-4">&#169; <?php echo $displayYear; ?> <a href="http://www.exeter.ac.uk">University of Exeter</a></span>
    <span class="navbar-brand mb-0 px-4">Maintained by <a href="mailto:a.homfray@exeter.ac.uk">Tony Homfray</a>, <a href="http://exeter.ac.uk/it/" target="_blank">Exeter IT</a></span>
</nav>