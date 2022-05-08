
<?php require("includes/header.php"); ?>
<?php require("includes/nav.php"); ?>

<div id="container" class="container-fluid row">
    <div id="left-container" class="col-8 p-4">
        <div id="left-content" class="p-4">
            <!-- Upload files  -->
            <div id="file-load-result" class="container-fluid">
            <?php 
            if(isset($_FILES['files'])) {

                $upload_dir = './tmp_input_files';
                $fileErrorCount = 0;

                for($i = 0; $i < sizeof($_FILES['files']['name']); $i++) {
                    if($_FILES['files']['error'][$i] != 0 || $_FILES['files']['type'][$i] != 'text/plain') {
                        $fileErrorCount += 1;
                        if($fileErrorCount == 1) {
                            echo '<p>Errors found ...</p><ul class="list-group mb-4">';
                        }
                        echo "<li class=\"list-group-item list-group-item-danger\"><i class=\"fas fa-times-circle\"></i>&emsp;<strong>{$_FILES['files']['name'][$i]}</strong> couldn't be processed. Please check it and try again</li>";
                    } else {
                        $filename = basename($_FILES['files']['name'][$i]);     // basename() may prevent filesystem traversal attacks;
                        $tmp_name = $_FILES['files']['tmp_name'][$i];
                        move_uploaded_file($tmp_name, "$upload_dir/$filename");
                    }
                } 
                
                if($fileErrorCount != 0) {
                    echo "</ul>";
                }
                ?>
                
            </div>  <!-- #file-load-result -->

            <!-- Process files -->
            <div id="process-file-result" class="container-fluid">
                <?php
                $dir = new FilesystemIterator("./tmp_input_files/");
                $date = date('Y-m-d');
                $outputFile = fopen("./tmp_download/output_file.txt", 'w');
                $counter = 0;   // This counter is used to include the first line of the file for the first file only
                ?>

                <p>Processing ...</p>
                <ul class="list-group">

                <?php
                foreach($dir as $file) {

                    echo "<li class=\"list-group-item list-group-item-success\"><i class=\"fas fa-check-circle\"></i>&emsp;{$file->getFilename()}</li>";
                    $currentFile = fopen($file, 'r');

                    if ($counter != 0) {
                        fgets($currentFile);
                    }
                    while($buffer = fgets($currentFile)) {
                        if (strlen($buffer) == 1) {
                            continue;
                        } else {
                            fwrite($outputFile, $buffer);
                        }
                    }
                    fwrite($outputFile, "\n");
                    fclose($currentFile);   // Close the file
                    unlink($file);          // Delete the file from the temp folder
                    $counter++;    
                } ?>
                </ul>
                <?php
            } ?>

            </div> <!-- #process-file-result -->
        </div> <!-- #left-content -->
    </div> <!-- #left-container -->


    <div id="right-container" class="col-4 p-4">
        <div id="right-content" class="p-4">   
            <div class="container-fluid">
                <div class="pb-3">
                    <a  href="./tmp_download/output_file.txt" download="<?php echo $date; ?>_merged_file.txt">Download merged file</a>
                </div>
                <div>
                    <form action="index.php" method="get">
                        <button class="btn btn-primary" type="submit">Go back</button>
                    </form>
                </div>
            </div>
        </div> <!-- #right-content -->
    </div> <!-- #right-container -->


</div> <!-- #container -->

<?php require("includes/footer.php"); ?>

</body>
</html>