<!doctype>

<html>
<head>
    
    <title>Ticket Assigner and Productivity Tracker</title>
    
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico')?>">
    
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/app.css')?>"
    
</head>

<body ng-app="tapt">
    
    <header class="hp-background container">
        
        <h1 class="text-center">Ticket Assigner and Productivity Tracker</h1>
        
    </header>
    
    <section class="container">

        <nav class="row clearfix">
            
            <a href="<?=base_url("assign")?>">
                <button class="btn col-md-2 col-sm-3 col-xs-12 <?=($activeTab == 1)?"active":""?>">
                    Assign Ticket
                </button>
            </a>
            
            <a href="<?=base_url("generate")?>">
                <button class="btn col-md-2 col-sm-3 col-xs-12 <?=($activeTab == 2)?"active":""?>">
                    Generate PR
                </button>
            </a>
            
            <a href="<?=base_url("admin")?>">
                <button class="btn col-md-2 col-sm-3 col-xs-12 pull-right no-margin-right <?=($activeTab == 3)?"active":""?>">
                    Admin Panel
                </button>
            </a>
            
        </nav>
        
        <section id="main" class="row">
            
            <?php include_once($content) ?>
            
        </section>
    
    </section>
    
    <footer class="hp-background container">
    
        <h4 class="text-center">All Rights Reserved. Copyright 2015</h4>
        
    </footer>
    
    <div id="loader">
        <img src="<?=base_url('assets/images/loader.gif')?>">
    </div>
    
    <script src="<?=base_url('assets/js/angular.min.js')?>"></script>
    <script src="<?=base_url('assets/js/ui-bootstrap-tpls.min.js')?>"></script>
    
    <script src="<?=base_url('assets/js/app.js')?>"></script>
    
</body>
</html>