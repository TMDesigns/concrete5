<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div id="ccm-block-social-links<?php echo $bID?>" class="ccm-block-social-links">
    <ul class="list-inline">
    <?php foreach($links as $link) {
        $service = $link->getServiceObject();
        $serviceTitle = $link->getServiceHandle();
        ?>
        <li><a target="_blank" href="<?php echo h($link->getURL()); ?>" title="<?php echo $serviceTitle ?>"><?php echo $service->getServiceIconHTML(); ?></a></li>
    <?php } ?>
    </ul>
</div>
