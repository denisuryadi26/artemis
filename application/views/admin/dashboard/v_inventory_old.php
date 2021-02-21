<!-- <div class="card-body">
    <section class="content-header">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active">inventoryitem</li>
        </ol>
        <h1>
				<div class="btn-group">
			      <button type="button" class="btn btn-info">MORE ACTIONS</button>
			      <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
			        <span class="sr-only">Toggle Dropdown</span>
			        <div class="dropdown-menu" role="menu">
			          <a class="dropdown-item" href="#"><i class="fa fa-ban"></i>NO ACTION</a>
			        </div>
			      </button>
			     </div>
			</h1>
    </section>
</div> -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">INVENTORY</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_13" data-toggle="tab">INVENTORY BASED ON ITEM</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_14" data-toggle="tab">INVENTORY BASED ON GRID</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_13">
                                <form id="yw0" action="/index.php?r=inventory/index" method="get">
                                    <div style="display:none">
                                        <input type="hidden" value="inventory/index" name="r" />
                                    </div>
                                    <div class="box box-solid box-primary">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="Inventory[search_by1]">
                                                        <option value="">Search By</option>
                                                        <option value="market_place">Market Place</option>
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <option value="barcode">Barcode</option>
                                                        <option value="category">Category</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="Inventory[search_value1]" id="Inventory_search_value1" type="text" /> </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="Inventory[search_by2]">
                                                        <option value="">Search By</option>
                                                        <option value="market_place">Market Place</option>
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <option value="barcode">Barcode</option>
                                                        <option value="category">Category</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="Inventory[search_value2]" id="Inventory_search_value2" type="text" /> </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="card-header"> -->
                                    <h3 class="card-title p-3"> INVENTORY BASED ON ITEM</h3>
                                <!-- </div> -->
                                <div class="box-body">
                                    <div class="table-responsive" id="inventory_item-grid">
                                        <table class="table table-bordered table-striped table-sm">
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
                                                  foreach ($inventoryitem as $row) {
                                                      
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
                                        <div class="row pt-3">
                                            <div class="col-sm-6">
                                                Result : <?= $total_rows; ?> Item
                                            </div>
                                            <div class="col-sm-6" align="right">
                                                <?= $pagination; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_14">
                                <form id="yw2" action="/index.php?r=inventory/index" method="get">
                                    <div style="display:none">
                                        <input type="hidden" value="inventory/index" name="r" />
                                    </div>
                                    <div class="box box-solid box-primary">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="InventoryDetail[search_by1]">
                                                        <option value="">Search By</option>
                                                        <option value="market_place">Market Place</option>
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <option value="barcode">Barcode</option>
                                                        <option value="category">Category</option>
                                                        <option value="grid">Grid</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="InventoryDetail[search_value1]" id="InventoryDetail_search_value1" type="text" /> </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="search_by" class="form-control" name="InventoryDetail[search_by2]">
                                                        <option value="">Search By</option>
                                                        <option value="market_place">Market Place</option>
                                                        <option value="item_code">Item Code</option>
                                                        <option value="item_name">Item Name</option>
                                                        <option value="barcode">Barcode</option>
                                                        <option value="category">Category</option>
                                                        <option value="grid">Grid</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" size="60" maxlength="200" placeholder="Search Value" name="InventoryDetail[search_value2]" id="InventoryDetail_search_value2" type="text" /> </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <h3 class="card-title p-3"> INVENTORY BASED ON GRID</h3>
                                <div class="box-body">
                                    <div class="table-responsive" id="inventory_grid-grid">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th id="inventory_grid-grid_c0">MARKET PLACE</th>
                                                    <th id="inventory_grid-grid_c1">GRID</th>
                                                    <th id="inventory_grid-grid_c2">ITEM INFORMATION</th>
                                                    <th id="inventory_grid-grid_c3">ITEM CODE</th>
                                                    <th id="inventory_grid-grid_c4">ITEM NAME</th>
                                                    <th id="inventory_grid-grid_c5">READY ORDER</th>
                                                    <th id="inventory_grid-grid_c6">ONHAND</th>
                                                    <th id="inventory_grid-grid_c7">DAMAGED</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                  foreach ($inventorygrid as $row) {
                                                ?>
                                                <tr class="odd">
                                                    <td width="100px"><?php echo $row->market_place; ?></td>
                                                    <td width="80px"><?php echo $row->grid_name; ?></td>
                                                    <td width="150px"><?php echo $row->item_information; ?></td>
                                                    <td width="100px"><?php echo $row->item_code; ?></td>
                                                    <td width="150px"><?php echo $row->item_name; ?></td>
                                                    <td width="100px"><?php echo $row->ready_order; ?> pcs</td>
                                                    <td width="40px"><?php echo $row->onhand; ?> pcs</td>
                                                    <td width="40px"><?php echo $row->damage; ?> pcs</td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="row pt-3">
                                            <div class="col-sm-6">
                                                Result : <?= $total_rows; ?> Item
                                            </div>
                                            <div class="col-sm-6" align="right">
                                                <?= $pagination; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>