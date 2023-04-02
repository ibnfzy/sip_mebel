<?php $pager->setSurroundCount(2); ?>

<div style="padding: 3em 0" class="center-block">
  <div class="container">
    <nav>
      <ul style="padding-left: 30em" class="pagination pagination-lg ">
        <?php if ($pager->hasPrevious()) : ?>
        <li><a href="<?= $pager->getPrevious() ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <?php else : ?>
        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <!-- FALSE -->
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
        <li class="<?= $link['active'] ? 'active' : '' ?>"><a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
        <li><a href="<?= $pager->getNext() ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
        <?php else : ?>
        <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
        <!-- FALSE -->
        <?php endif ?>

      </ul>
    </nav>
  </div>
</div>