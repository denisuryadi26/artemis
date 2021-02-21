<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="content-header">
                            <!--       <div class="container-fluid">
                            <div class="row mb-2">
                              <div class="col-sm-6">
                                <h1>PURCHASE LIST</h1>
                              </div>
                              <div class="col-sm-6"> -->
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/C_dashboard'); ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="<?= base_url('admin/C_reporting'); ?>">reporting</a>
                                </li>
                                <li class="breadcrumb-item active">empty inventory</li>
                            </ol>
                            <h1>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-info">MORE ACTIONS</button>
                                      <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                        <div class="dropdown-menu" role="menu">
                                          <a class="dropdown-item" href="#"><i class="fa fa-table"></i> LIST</a>
                                          <a class="dropdown-item" href="#"><i class="fa fa-file"></i> CREATE</a>
                                          <a class="dropdown-item" href="#"><i class="fa fa-upload"></i> UPLOAD</a>
                                          <a class="dropdown-item" href="#"><i class="fa fa-list-ol"></i> PRINT PICKLIST</a>
                                        </div>
                                      </button>
                                     </div>
                                </h1>
                        </section>

                        <section class="content">
                            <form id="inbound-form" action="<?php echo base_url("admin/reportinglist/C_emptyinventory/download_emptyinventory_report"); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">PURCHASE INFORMATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <table class="detail-view" id="yw0"><tr class="odd"><th>STATUS</th><td>Finish</td></tr>
                                                <tr class="even"><th>PURCHASE CODE</th><td>TOALALIVING120620-GOLDENDRAGON</td></tr>
                                                <tr class="odd"><th>PURCHASE DATE</th><td>2020-06-12 14:50:15</td></tr>
                                                <tr class="even"><th>FINISHING DATE</th><td>2020-06-12 15:56:58</td></tr>
                                                <tr class="odd"><th>DOCUMENT NUMBER</th><td></td></tr>
                                                <tr class="even"><th>REMARK</th><td><span class="null">Not set</span></td></tr>
                                                <tr class="odd"><th>CREATED BY</th><td>Ade Aryani</td></tr>
                                                <tr class="even"><th>CREATED DATE</th><td>2020-06-12 14:50:15</td></tr>
                                                </table>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">ARRIVAL INFORMATION</h3>

                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <div class="table-responsive" id="packinglistdetail-grid">
                                                <table class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                <th id="packinglistdetail-grid_c0">ARRIVAL DATE</th><th id="packinglistdetail-grid_c1">COURIER NAME</th><th id="packinglistdetail-grid_c2">DRIVER NAME</th><th id="packinglistdetail-grid_c3">DRIVER PHONE</th><th id="packinglistdetail-grid_c4">VEHICLE</th><th id="packinglistdetail-grid_c5">LICENSE PLATE</th></tr>
                                                </thead>
                                                <tbody>
                                                <tr class="odd">
                                                <td>2020-06-12 15:42:32</td><td>PT LAVERA EXCITO INDONESIA</td><td>SUHARDI</td><td>082110735554</td><td>MOBIL</td><td>B 2305 UKN</td></tr>
                                                </tbody>
                                                </table><tr><td style="border-top:none;"><div class="dataTables_info">Showing 1 to 1 of 1 entries</div></td></tr><div class="keys" style="display:none" title="/index.php?r=packinglist/view&amp;id=959693"><span>78441</span></div>
                                                </div>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">ITEM INFORMATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <table class="detail-view" id="yw2"><tr class="odd"><th>ITEM CODE</th>
                                                <td>TTGD-MTG0309-UNGU</td></tr>
                                                <tr class="even"><th>ITEM NAME</th><td>Mangkok Tutup Gagang ( T0309 ) - Golden Dragon Melamine</td></tr>
                                                <tr class="odd"><th>STATUS</th><td>Finish</td></tr>
                                                <tr class="even"><th>PURCHASE QUANTITY</th><td>12 pcs</td></tr>
                                                <tr class="odd"><th>RECEIVED QUANTITY</th><td>12 pcs</td></tr>
                                                <tr class="even"><th>PUTAWAY QUANTITY</th><td>12 pcs</td></tr>
                                                <tr class="odd"><th>DAMAGED QUANTITY</th><td>0 pcs</td></tr>
                                                <tr class="even"><th>BUYING PRICE</th><td>IDR 0</td></tr>
                                                <tr class="odd"><th>REMARK</th><td><span class="null">Not set</span></td></tr>
                                                </table>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">ALLOCATION INFORMATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <div class="table-responsive" id="packinglistdetail-grid">
                                                    <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                    <th id="packinglistdetail-grid_c0">MARKET PLACE</th><th id="packinglistdetail-grid_c1">ITEM CODE</th><th id="packinglistdetail-grid_c2">ITEM NAME</th><th id="packinglistdetail-grid_c3">GRID</th><th id="packinglistdetail-grid_c4">ALLOCATION</th><th id="packinglistdetail-grid_c5">PUTAWAY</th><th style="text-align: center;" id="packinglistdetail-grid_c6">ACTION</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd">
                                                    <td>None Market Place</td><td>TTGD-MTG0309-UNGU</td><td>Mangkok Tutup Gagang ( T0309 ) - Golden Dragon Melamine</td><td>K-G1-D-21-1</td><td>12 pcs</td><td>12 pcs</td><td width="100px" align="center"><a class="update" title="Update" href="/index.php?r=packinglist/updateallocation&amp;id=972663"><img src="/themes/adminLTE/dist/img/CButtonColumn/update.png" alt="Update" /></a></td></tr>
                                                    </tbody>
                                                    </table><tr><td style="border-top:none;"><div class="dataTables_info">Showing 1 to 1 of 1 entries</div></td></tr><div class="keys" style="display:none" title="/index.php?r=packinglist/view&amp;id=959693"><span>972663</span></div>
                                                </div>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">RECEIVED INFORMATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <div class="table-responsive" id="putaway-grid">
                                                    <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                    <th id="putaway-grid_c0">ITEM CODE</th><th id="putaway-grid_c1">ITEM NAME</th><th id="putaway-grid_c2">BARCODE</th><th id="putaway-grid_c3">QUANTITY</th><th id="putaway-grid_c4">RECEIVED BY</th><th id="putaway-grid_c5">RECEIVED DATE</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd">
                                                    <td>GD-MBE6-KUNING</td><td>Mangkok Bulat Enamel 6,5 inch - Golden Dragon Melamine</td><td>GD-MBE6-KUNING</td><td>8 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:46:31</td></tr>
                                                    <tr class="even">
                                                    <td>GD882-UNGU</td><td>Mangkok Bunga Oval 11,5 Inci ( 882 ) - Golden Dragon</td><td>GD882-UNGU</td><td>6 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:46:15</td></tr>
                                                    <tr class="odd">
                                                    <td>GD885-UNGU</td><td>Mangkok Relief Tulip 10,5 Inci ( 885 ) - Golden Dragon</td><td>GD885-UNGU</td><td>6 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:45:52</td></tr>
                                                    <tr class="even">
                                                    <td>GD-MCS7-ABU</td><td>Mangkok Ceper Stone Series 7 inch - Golden Dragon Melamine</td><td>GD-MCS7-ABU</td><td>6 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:45:30</td></tr>
                                                    <tr class="odd">
                                                    <td>TTGD-MTG0307-UNGU</td><td>Mangkok Tutup Gagang ( T0307 ) - Golden Dragon Melamine</td><td>TTGD-MTG0307-UNGU</td><td>12 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:45:08</td></tr>
                                                    <tr class="even">
                                                    <td>TTGD-MTG0309-UNGU</td><td>Mangkok Tutup Gagang ( T0309 ) - Golden Dragon Melamine</td><td>TTGD-MTG0309-UNGU</td><td>12 pcs</td><td>Agus Supriyanto</td><td>2020-06-12 15:44:48</td></tr>
                                                    </tbody>
                                                    </table><tr><td style="border-top:none;"><div class="dataTables_info">Showing 1 to 6 of 6 entries</div></td></tr><div class="keys" style="display:none" title="/index.php?r=packinglist/view&amp;id=959693"><span>1134783</span><span>1134775</span><span>1134767</span><span>1134765</span><span>1134763</span><span>1134761</span></div>
                                                </div>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-info">
                                          <div class="card-header">
                                            <h3 class="card-title">PUTAWAY INFORMATION</h3>
                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                            <!-- /.card-tools -->
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                            <div class="box-body">
                                                <div class="table-responsive" id="putaway-grid">
                                                    <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                    <th id="putaway-grid_c0">IS DAMAGED</th><th id="putaway-grid_c1">ITEM CODE</th><th id="putaway-grid_c2">ITEM NAME</th><th id="putaway-grid_c3">BARCODE</th><th id="putaway-grid_c4">GRID</th><th id="putaway-grid_c5">QUANTITY</th><th id="putaway-grid_c6">PUTAWAY BY</th><th id="putaway-grid_c7">PUTAWAY DATE</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd">
                                                    <td>No</td><td>GD-MBE6-KUNING</td><td>Mangkok Bulat Enamel 6,5 inch - Golden Dragon Melamine</td><td>GD-MBE6-KUNING</td><td>K-G1-D-23-1</td><td>8 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:56:17</td></tr>
                                                    <tr class="even">
                                                    <td>No</td><td>GD-MCS7-ABU</td><td>Mangkok Ceper Stone Series 7 inch - Golden Dragon Melamine</td><td>GD-MCS7-ABU</td><td>K-G1-D-23-1</td><td>6 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:56:02</td></tr>
                                                    <tr class="odd">
                                                    <td>No</td><td>GD885-UNGU</td><td>Mangkok Relief Tulip 10,5 Inci ( 885 ) - Golden Dragon</td><td>GD885-UNGU</td><td>K-G1-A-25-3</td><td>6 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:55:18</td></tr>
                                                    <tr class="even">
                                                    <td>No</td><td>TTGD-MTG0307-UNGU</td><td>Mangkok Tutup Gagang ( T0307 ) - Golden Dragon Melamine</td><td>TTGD-MTG0307-UNGU</td><td>K-G1-D-22-2</td><td>12 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:53:52</td></tr>
                                                    <tr class="odd">
                                                    <td>No</td><td>TTGD-MTG0309-UNGU</td><td>Mangkok Tutup Gagang ( T0309 ) - Golden Dragon Melamine</td><td>TTGD-MTG0309-UNGU</td><td>K-G1-D-21-1</td><td>6 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:52:52</td></tr>
                                                    <tr class="even">
                                                    <td>No</td><td>TTGD-MTG0309-UNGU</td><td>Mangkok Tutup Gagang ( T0309 ) - Golden Dragon Melamine</td><td>TTGD-MTG0309-UNGU</td><td>K-G1-B-21-2</td><td>6 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:52:05</td></tr>
                                                    <tr class="odd">
                                                    <td>No</td><td>GD882-UNGU</td><td>Mangkok Bunga Oval 11,5 Inci ( 882 ) - Golden Dragon</td><td>GD882-UNGU</td><td>K-G1-B-21-1</td><td>6 pcs</td><td>Agus Aris Setiawan</td><td>2020-06-12 15:50:42</td></tr>
                                                    </tbody>
                                                    </table><tr><td style="border-top:none;"><div class="dataTables_info">Showing 1 to 7 of 7 entries</div></td></tr><div class="keys" style="display:none" title="/index.php?r=packinglist/view&amp;id=959693"><span>912635</span><span>912625</span><span>912605</span><span>912561</span><span>912543</span><span>912529</span><span>912497</span></div>
                                                </div>
                                            </div>
                                          </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>                                    
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>