

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					<th id="inventory_item-grid_c0">MARKET PLACE</th>
					<th id="inventory_item-grid_c1">ITEM CODE</th>
					<th id="inventory_item-grid_c2">ITEM NAME</th>
					<th id="inventory_item-grid_c3">ITEM BARCODE</th>
					<th id="inventory_item-grid_c4"><a class="sort-link" href="/index.php?r=inventory/index&amp;sort=exist">READY ORDER</a>
					</th>
					<th id="inventory_item-grid_c5">ONHAND</th>
					<th id="inventory_item-grid_c6">DAMAGED</th>
					<th style="text-align: center;" id="inventory_item-grid_c7">ACTION</th>
					</tr>
					</thead>
				<tbody>
				<?php
				foreach ($table as $row) {
					
				?>
				<tr class="odd">
					<td width="100px"><?php echo $row->market_place; ?></td>
					<td width="100px"><?php echo $row->item_code; ?></td>
					<td width="200px"><?php echo $row->item_name; ?></td>
					<td width="100px"><?php echo $row->item_barcode; ?></td>
					<td width="100px"><?php echo $row->ready_order; ?> pcs</td>
					<td width="50px"><?php echo $row->onhand; ?> pcs</td>
					<td width="50px"><?php echo $row->damage; ?> pcs</td>
					<td width="50px" align="center">
						<a class="view" title="View" href="/index.php?r=inventory/view&amp;id=204709"><img src="<?= base_url(); ?>assets/admin/dist/img/CButtonColumn/search.png" alt="View" />
						</a>
					</td>
				</tr>
				<?php
				}
				?>

				</tbody>
				</table>

                </div>
            </div>
        </div>
    </section>
</div>


<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>