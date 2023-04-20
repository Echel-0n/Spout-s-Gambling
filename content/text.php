<div class="cont_page_text clair_sombre">
    <div class="droite_relative_content">
        <div class="droite_part_content scrollbar">
            <?php
                if (isset($_GET["id"])){
                    $inclut_text = $link_include."/ressources/text/".$_GET["id"].".php";
                    if (file_exists($inclut_text)) {
                        include $inclut_text;
                    };
                };
            ?>
        </div>
    </div>
</div>