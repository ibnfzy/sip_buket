<?php $pager->setSurroundCount(2)  ?>

<div class="aa-product-catg-pagination">
  <nav>
    <ul class="pagination">
      <?php if ($pager->hasPrevious()) : ?>
        <li>
          <a href="<?= $pager->getPrevious() ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      <?php else : ?>
        <li class="disabled">
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      <?php endif ?>
      <?php foreach ($pager->links() as $link) : ?>
        <li class="<?= $link['active'] ? 'active' : '' ?>"><a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
      <?php endforeach ?>
      <?php if ($pager->hasNext()) : ?>
        <li>
          <a href="<?= $pager->getNext() ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php else : ?>
        <li class="disabled">
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php endif ?>

    </ul>
  </nav>
</div>