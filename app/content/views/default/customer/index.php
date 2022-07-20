<div class="col-sm-12 text-center"> 
    <h2>Customer</h2>
</div>
<div class="col-sm-12 text-center board-section builder"> 
    <table>
        <thead class="text-center filter-bg">
		<td><h5c>name</h5c></td>
		<td><h5c>surname</h5c></td>
		<td><h5c>city</h5c></td>
		<td><h5c>country</h5c></td>
        </thead>
    <?php foreach ($data['items'] as $singleItem) { ?>
        <tr>
		<td><?= $singleItem['name'] ?></td>
		<td><?= $singleItem['surname'] ?></td>
		<td><?= $singleItem['city'] ?></td>
		<td><?= $singleItem['country'] ?></td>
        </tr>
    <?php } ?>
    </table>
</div>