<?php foreach ($items as $item) { ?>
                <div class="checkbox">
                        <label>
                            <input type="checkbox" class="items-done"  value="<?php echo $item->getId() ?>" id="done-<?php echo $item->getId() ?>" <?php if($item->getDone()==1){echo 'checked';}?>>
                                <?php echo $item->getTitle() ?>
                        </label>
                    <button type="button" class="icon-trash-empty btn btn-danger btn-lg buttons btn-remove" value=<?php echo $item->getId(); ?>></button>
                    <button type="button" class="icon-pencil btn btn-info btn-lg buttons btn-edit" value=<?php echo $item->getId(); ?> data-toggle="modal" data-target="#myModal"></button>
                </div>
<?php } ?>
