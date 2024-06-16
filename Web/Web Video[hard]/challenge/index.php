<?php 
    error_reporting(E_ERROR | E_PARSE);
    require("utils.php");
    $utils          = new Utils();
    $parameter      = $_GET;
    $utils ->_file  = "format.php";
    if (isset($parameter['mode'])) {
        switch ($parameter['mode']) {
            case "extract":
                $utils ->_id     = $parameter['id'];
                $utils ->_host   = $parameter['host'];
                $result          = $utils->extract_video_information();
                print($utils);
                break;
            case "redirect":
                $url             = $parameter['url'];
                header("Location: ".$url);
                
        }
    }
    else{
        ?>
        <html>
            <head>
                <title>Video Link Extractor</title>
                <script>
                    function extract(host, id){
                        url = "index.php?mode=extract&id="+id+"&host="+host;
                        fetch(url).then((response) => response.text()).then((data) => document.getElementById(host).textContent=data);
                    }
                </script>
            </head>
            <body>

                <h1><center>Video Link Extractor</center></h1>
                <h1>Youtube</h1>
                <a href="index.php?mode=redirect&url=https://www.youtube.com/watch?v=lmJPeFW75qQ&ab_channel=M2">https://www.youtube.com/watch?v=lmJPeFW75qQ&ab_channel=M2</a></br>
                <iframe width="800" height="500" src="https://www.youtube.com/embed/lmJPeFW75qQ" title="[입덕직캠] 뉴진스 하니 직캠 4K 'Hype Boy' (NewJeans HANNI FanCam) | @MCOUNTDOWN_2022.8.4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></br>
                <button onclick="extract('youtube','lmJPeFW75qQ')">Extract</button>
                <div id="youtube"></div></br>


                <h1>Vimeo</h1>
                <a href="index.php?mode=redirect&url=https://vimeo.com/345849012">https://vimeo.com/345849012</a></br>
                <iframe src="https://player.vimeo.com/video/345849012?h=6c59023e04" width="800" height="500" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></br>
                <button onclick="extract('vimeo','345849012')">Extract</button>
                <div id="vimeo"></div></br>

                <h1>Localhost</h1>
                <button onclick="extract('local','test')">Extract</button>
                <div id="local"></div></br>


            </body> 
        </html>
        <?php
    }
