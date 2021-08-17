<ul class="nav nav-pills">
                            <?php
                            $htmlSubCatList =  "";
                            $activeKey = $_GET["activeKey"] ?? 0;
                            foreach ($categoryList as $key => $category) {
                                $active  = 0;
                                $panediv =  '<div id="' . $key . '" class="tab-pane fade">';

                                if ($key == $activeKey) {
                                    $panediv =  '<div id="' . $key . '" class="tab-pane fade in active">';

                                    $active = 1;
                                } ?>
                                <li class="<?php $active = 1 ? "active" : "" ?>"><a data-toggle="tab" href="#<?php echo $key; ?>"> <?php echo $category['categoryName']; ?></a></li>
                            <?php
                                $htmlSubCatList .= $panediv;

                                $SubCatList  = $category["subCategory"];
                                $subCAthtml = '';
                                foreach ($SubCatList as $key2 => $subCat) {
                                    $subCAthtml .= "<list id  = '" . $subCat['subCategoryId'] . "'>" . $subCat['subCategory'] . "</list>";
                                }
                                $htmlSubCatList .= $subCAthtml;
                                $htmlSubCatList .= ' </div>';
                            } ?>
                        </ul>

                        
                        <div class="tab-content">
                        <?php echo $htmlSubCatList; ?>