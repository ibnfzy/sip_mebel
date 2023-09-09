<?php $pager->setSurroundCount(0); ?>

<div class="btn-group btn-group-sm" style="padding-bottom: 20px;" role="group">

  <?php if ($pager->hasPrevious()) : ?>
  <a href="<?= $pager->getPrevious() ?>" type="button" class="btn btn-info"><i class="fa-solid fa-chevron-left"></i></a>
  <?php else : ?>
  <button disabled type="button" class="btn btn-info"><i class="fa-solid fa-chevron-left"></i></button>
  <?php endif ?>

  <?php if ($pager->hasNext()) : ?>
  <a href="<?= $pager->getNext() ?>" type="button" class="btn btn-info"><i class="fa-solid fa-chevron-right"></i></a>
  <?php else : ?>
  <button disabled type="button" class="btn btn-info"><i class="fa-solid fa-chevron-right"></i></button>
  <?php endif ?>

</div>