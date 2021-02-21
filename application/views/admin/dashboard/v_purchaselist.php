<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                    <!-- <h3 class="card-title">PURCHASE LIST</h3> -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo site_url('admin/C_purchaselist/index'); ?>" method="GET"  >
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="search_by1" id="search_by1" class="form-control">
                                            <option selected="selected">Search By</option>
                                            <option value="">Search By</option>
                                            <option value="purchase_code">Purchase Code</option>
                                            <!-- <option value="date">Purchase Date [format : yyyy-mm-dd]</option> -->
                                            <option value="item_code">Item Code</option>
                                            <option value="item_name">Item Name</option>
                                            <!-- <option value="barcode">Barcode</option> -->
                                            <option value="Entry">Status : Entry</option>
                                            <option value="Received">Status : Received</option>
                                            <option value="Putaway">Status : Putaway</option>
                                            <option value="Finish">Status : Finish</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="search_by2" id="search_by2" class="form-control">
                                            <option value="">Search By</option>
                                            <option value="purchase_code">Purchase Code</option>
                                            <!-- <option value="date">Purchase Date [format : yyyy-mm-dd]</option> -->
                                            <option value="item_code">Item Code</option>
                                            <option value="item_name">Item Name</option>
                                            <!-- <option value="barcode">Barcode</option> -->
                                            <option value="Entry">Status : Entry</option>
                                            <option value="Received">Status : Received</option>
                                            <option value="Putaway">Status : Putaway</option>
                                            <option value="Finish">Status : Finish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" size="60" maxlength="200" placeholder="Search Value 1" name="search_value1" id="search_value1" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" size="60" maxlength="200" placeholder="Search Value 2" name="search_value2" id="search_value2" type="text" />
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <input class="btn btn-primary" type="submit" name="yt0" value="SEARCH" /> -->
                                    <button type="submit" class="btn btn-block bg-gradient-info">SEARCH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-list"></i> PURCHASE LIST</h3>
                        
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">                     
                        <table id="purchase" id="packinglist-grid" class="table table-bordered table-striped table-sm" style="font-size:13px">
                            <thead>
                                <tr>
                                    <th id="packinglist-grid_c0">PURCHASE CODE</th>
                                    <th id="packinglist-grid_c1">ITEM CODE</th>
                                    <th id="packinglist-grid_c2">ITEM NAME</th>
                                    <th id="packinglist-grid_c3">QUANTITY</th>
                                    <th id="packinglist-grid_c4">RECEIVED</th>
                                    <th id="packinglist-grid_c5">PUTAWAY</th>
                                    <th id="packinglist-grid_c6">DAMAGED</th>
                                    <th id="packinglist-grid_c7">STATUS</th>
                                    <th style="text-align: center;" id="packinglist-grid_c8">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($purchaselist as $row) 
                                    {
                                ?>
                                    <tr class="odd">
                                        <td><?php echo $row->purchase_code; ?></td>
                                        <td><?php echo $row->item_code; ?></td>
                                        <td width="350px"><?php echo $row->item_name; ?></td>
                                        <td><?php echo $row->quantity; ?></td>
                                        <td><?php echo $row->received; ?></td>
                                        <td><?php echo $row->putaway; ?></td>
                                        <td><?php echo $row->damaged; ?></td>
                                        <td>
                                                    <?php
                                                        if($row->color == 'label-red')
                                                        {
                                                            echo '<span class="badge bg-danger">';
                                                        }
                                                        else if($row->color == 'label-lightgreen' || $row->color == 'label-green')
                                                        {
                                                            echo '<span class="badge bg-success">';
                                                        }
                                                        else if($row->color == 'label-blue')
                                                        {
                                                            echo '<span class="badge bg-primary">';
                                                        }
                                                        else if($row->color == 'label-orange')
                                                        {
                                                            echo '<span class="badge bg-warning">';
                                                        }
                                                        else if($row->color == 'label-purple')
                                                        {
                                                            echo '<span class="badge bg-secondery">';
                                                        }
                                                        else if($row->color == 'label-turquoise')
                                                        {
                                                            echo '<span class="badge bg-info">';
                                                        }
                                                    ?>
                                                        <?php echo $row->status; ?>
                                                    </span>
                                                </td>
                                        <td width="75px" align="center">
                                            <a class="view" title="View" href="/index.php?r=packinglist/view&amp;id=441103">
                                            <img src="<?= base_url(); ?>assets/admin/dist/img/CButtonColumn/search.png" alt="View" /></a><a target="_new" title="print" href="/index.php?r=packinglist/print&amp;id=69697">
                                            <img src="<?= base_url(); ?>assets/admin/dist/img/CButtonColumn/clipboard.png" alt="print" /></a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


<script type="text/javascript">


<?php if($this->session->flashdata('success')){ ?>

    toastr.success("<?php echo $this->session->flashdata('success'); ?>");

<?php }else if($this->session->flashdata('error')){  ?>

    toastr.error("<?php echo $this->session->flashdata('error'); ?>");

<?php }else if($this->session->flashdata('warning')){  ?>

    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");

<?php }else if($this->session->flashdata('info')){  ?>

    toastr.info("<?php echo $this->session->flashdata('info'); ?>");

<?php } ?>


</script>


<script>
    function myFunction()
    {
        var active1 = document.getElementById("search_by1");
        var strUser1 = active1.options[active1.selectedIndex].value;
        var active2 = document.getElementById("search_by2");
        var strUser2 = active2.options[active2.selectedIndex].value;
        // alert(strUser1);
        if(strUser1 == "Entry" || strUser1 == "Received" || strUser1 == "Finish" || strUser1 == "Putaway")
        {
            // document.getElementById("search_by2").disabled = true;
            document.getElementById("searchvalue1").disabled = true;
            // document.getElementById("searchvalue2").disabled = true;
        }
        else if(strUser2 == "Entry" || strUser2 == "Received" || strUser2 == "Finish" || strUser2 == "Putaway")
        {
            // document.getElementById("search_by1").disabled = true;
            // document.getElementById("searchvalue1").disabled = true;
            document.getElementById("searchvalue2").disabled = true;
        }else
        {
            document.getElementById("search_by1").disabled = false;
            document.getElementById("search_by2").disabled = false;
            document.getElementById("searchvalue1").disabled = false;
            document.getElementById("searchvalue2").disabled = false;
        }
    }

</script>

<script>
    $(function () {
        $("#purchase").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        });
    });
</script>