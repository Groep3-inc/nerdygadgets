<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";

$stockItem = getStockItem($_GET['id'], $databaseConnection);
$stockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
?>
<div id="CenteredContent">
    <?php
    if ($stockItem != null) {
        ?>
        <?php
        if (isset($stockItem['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $stockItem['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader">
            <?php
            if (isset($stockItemImage)) {
                // één plaatje laten zien
                if (count($stockItemImage) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $stockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($stockItemImage) >= 2) { ?>
                    <!-- meerdere plaatjes laten zien -->
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($stockItemImage); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($stockItemImage); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $stockItemImage[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- knoppen 'vorige' en 'volgende' -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $stockItem['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>


            <h1 class="StockItemID">Artikelnummer: <?php print $stockItem["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $stockItem['StockItemName']; ?>
            </h2>
            <div class="QuantityText"><?php print $stockItem['QuantityOnHand']; ?></div>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $stockItem['SellPrice']); ?></b></p>
                        <h6> Inclusief BTW </h6>
                    </div>
                </div>
            </div>
        </div>

        <div id="StockItemDescription">
            <h3>Artikel beschrijving</h3>
            <p><?php print $stockItem['SearchDetails']; ?></p>
        </div>
        <div id="StockItemSpecifications">
            <h3>Artikel specificaties</h3>
            <?php
            $customFields = json_decode($stockItem['CustomFields'], true);
            if (is_array($customFields)) { ?>
                <table>
                <thead>
                <th>Naam</th>
                <th>Data</th>
                </thead>
                <?php
                foreach ($customFields as $specName => $specText) { ?>
                    <tr>
                        <td>
                            <?php print $specName; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($specText)) {
                                foreach ($specText as $subText) {
                                    print $subText . " ";
                                }
                            } else {
                                print $specText;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </table><?php
            } else { ?>

                <p><?php print $stockItem['CustomFields']; ?>.</p>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>
