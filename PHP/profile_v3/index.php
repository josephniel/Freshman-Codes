<!doctype html>

<html lang="en">
    
<head>
    
    <meta charset="utf-8">
    
    <title>Joseph Niel Tuazon</title>
    
    <link rel="icon" type="image/png" href="assets/images/others/favicon.ico">
    
    <link rel="stylesheet" href="assets/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
    
<body>

    <?php include_once("includes/navbar.php"); ?>
    
    <div class="main">
       
        <div id="profile" class="section">
            <div class="section-body">
                <?php include_once("includes/profile.php"); ?>
            </div>
        </div>
        
        <div id="experience" class="section">
            <div class="section-header">
                <h3 class="green-text">Experience</h3>
            </div>
            <div class="section-body">
                <?php include_once("includes/experience.php"); ?>
            </div>
        </div>
        
        <div id="projects" class="section">
            <div class="section-header">
                <h3 class="green-text">Projects</h3>
            </div>
            <div class="section-body">
                <?php include_once("includes/projects.php"); ?>
            </div>
        </div>
        
        <div id="skills" class="section">
            <div class="section-header">
                <h3 class="green-text">Skills</h3>
            </div>
            <div class="section-body">
                <?php include_once("includes/skills.php"); ?>
            </div>
        </div>
        
    </div>
    
    <?php include_once("includes/otherElements.php"); ?>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
    <script src="assets/js/app.js"></script>
    
</body>

</html>