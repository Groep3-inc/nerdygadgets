<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php

include __DIR__ . "/header.php";
$stockGroups = getStockGroups($databaseConnection);

?>
<div id="Wrap">
    <?php if (isset($stockGroups)) {
        $i = 0;
        foreach ($stockGroups as $stockGroup) {
            if ($i < 6) {
                ?>
                <a href="<?php print "browse.php?category_id=";
                print $stockGroup["StockGroupID"]; ?>">
                    <div id="StockGroup<?php print $i + 1; ?>"
                        style="background-image: url('Public/StockGroupIMG/<?php print $stockGroup["ImagePath"]; ?>')"
                        class="StockGroups">
                        <h1><?php print $stockGroup["StockGroupName"]; ?></h1>
                    </div>
                </a>
                <?php
            }
            $i++;
        }
    } ?>
</div>