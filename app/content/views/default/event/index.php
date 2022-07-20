<div class="col-sm-12 text-center"> 
    <h2>Event</h2>
</div>
<div class="col-sm-12 text-center board-section builder"> 
    <table>
        <thead class="text-center filter-bg">
		<td><h5c>section</h5c></td>
		<td><h5c>start</h5c></td>
		<td><h5c>duration</h5c></td>
		<td><h5c>title</h5c></td>
		<td><h5c>price</h5c></td>
        </thead>
    <?php foreach ($data['items'] as $singleItem) { ?>
        <tr>
		<td><?= $singleItem['section'] ?></td>
		<td><?= $singleItem['start'] ?></td>
		<td><?= $singleItem['duration'] ?></td>
		<td><?= $singleItem['title'] ?></td>
		<td><?= $singleItem['price'] ?></td>
        </tr>
    <?php } ?>
    </table>
</div>