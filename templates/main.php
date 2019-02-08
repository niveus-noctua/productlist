<div class="container">
	<div class="row">
		<div class="col"><a href="/?sort=vendor_code">Артикул</a></div>
		<div class="col"><a href="/?sort=name">Название</a></div>
		<div class="col"><a href="/?sort=brand">Бренд</a></div>
		<div class="col"><a href="/?sort=type">Тип</a></div>
		<div class="col"><a href="/?sort=color">Цвет</a></div>
		<div class="col"><a href="/?sort=discount">Cкидка</a></div>
		<div class="col"><a href="/?sort=price">Цена</a></div>
		<div class="col"><a href="/?sort=date">Дата</a></div>
	</div>
	<?php foreach ($this->table as $row): ?>
	<div class="row">
		<?php foreach ($row as $item=>$value): ?>
			<div class="col"><?=$value; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
    <nav>
        <ul class="pagination">
			<?php for ($i = 0; $i < $this->page_count; $i++): ?>
                <?php if ($i + 1 == $this->current_page): ?>
                    <li class="page-item <?='active'?>"><a class="page-link" href="/?page=<?=$i+1; ?>&sort=<?=$this->sort; ?>"><?=$i+1; ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="/?page=<?=$i+1; ?>&sort=<?=$this->sort; ?>"><?=$i+1; ?></a></li>
			    <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </nav>
	<form method="post" action="/?action=search">
		<div class="form-group form-inline">
			<div class="col"><input placeholder="Артикул" name="vendor_code"></div>
			<div class="col"><input placeholder="Название" name="name"></div>
			<div class="col"><input placeholder="Бренд" name="brand"></div>
			<div class="col"><input placeholder="Тип" name="type"></div>
		</div>
		<div class="form-group form-inline">
			<div class="col"><input placeholder="Цвет" name="color"></div>
			<div class="col"><input placeholder="Скидка" name="discount"></div>
			<div class="col"><input placeholder="Цена" name="price"></div>
			<div class="col"><input placeholder="Дата" name="date"></div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Искать</button>
		</div>
	</form>
	<button type="button" class="btn btn-warning">
		<a href="/?action=fill" style="text-decoration: none; color: azure">
			Заполнить
		</a>
	</button>
</div>
