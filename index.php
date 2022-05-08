<?php 
    if(file_exists("./tmp_download/output_file.txt")) {
        unlink("./tmp_download/output_file.txt");
    }
?>

<?php require("includes/header.php"); ?>
<?php require("includes/nav.php"); ?>

<div id="container" class="container-fluid row">
    <div id="left" class="col-8 p-4">
        <div id="description" class="container-fluid p-4">
            <p>This tool concatenates multiple text/log files of a similar type into a single file.</p>
            <p>It takes the header (first line) from the first file only and ignores the first line in all subsequent files.</p>
            <p>It was written to merge multiple ELE Course Creation files into a single file.</p>
        </div>
    </div> <!-- #left -->

    <div id="right" class="col-4 p-4">
        <div class="container-fluid pt-4">
            <div class="pb-3">
            <form id="file-select" action="process.php" method="post" enctype="multipart/form-data">
                <input class="m-2" type="file" name="files[]" id="file-input" multiple="multiple">
            </form>
            </div>
            <div>
                <button class="btn btn-primary m-2" type="submit" form="file-select">Process files</button>
            </div>
        </div>
    </div> <!-- #right -->

</div>

<?php require("includes/footer.php"); ?>

</body>
</html>