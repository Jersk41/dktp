<?= $this->include('layouts/_head') ?>

<body>

    <?= $this->include('layouts/_header') ?>

    <?= $this->include('layouts/_sidebar') ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?= $title ?></h1>
            <?php
            $segments = current_url(true)->getSegments();
            // array_splice($segments,0,1);
            if(is_numeric($segments[count($segments)-1])){
                array_splice($segments,count($segments)-1,1);
            }
            ?>

            <nav>
                <ol class="breadcrumb">
                    <?php
                    $base = (session()->get('level') != 'user')? 'main' : 'dktp' ;
                    echo '<li class="breadcrumb-item">
                    <a href="' . site_url($base) . '">'. ucwords($base) .'</a>
                    </li>';
                    for ($i = 1; $i < count($segments); $i++) :
                        $active_page = ($i===(count($segments)-1)) ? 'active' : '' ; 
                        echo '<li class="breadcrumb-item '.$active_page.'">
                        <a href="' . site_url("$base/$segments[$i]") . '">'. ucwords($segments[$i]) .'</a>
                        </li>';
                    endfor;
                    ?>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?= $this->renderSection('content') ?>
    </main><!-- End #main -->

    <?= $this->include('layouts/_footer') ?>