<div class="content-wrapper pt-2">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Outbound Aging Information</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="col-md-14">
                                <div class="card card-info shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Outbound Aging Information</h3>
                                    <div class="card-tools">
                                    <button type="button" id="reload" onclick="outboundAging()" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo base_url() ?>admin/outbound/C_outbound_aging" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="tab-content">
                                            <form id="inbound-form" action="<?= base_url('admin/C_home/download_outbound_aging');?>" method="post">
                                            <div class="tab-pane active" id="tab_9">
                                                <!-- HALAMAN OUTBOUND AGING -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-info">
                                                            <div class="box-body">
                                                                <div class="table-responsive" id="outbound_aging-grid">
                                                                    <table id="outboundagingtable" class="table table-bordered table-striped table-sm" style="font-size:13px">
                                                                        <thead>
                                                                            <tr>
                                                                                <th id="outbound_aging-grid_c0">CLIENT</th>
                                                                                <th id="outbound_aging-grid_c1">ORDER</th>
                                                                                <th id="outbound_aging-grid_c2">STATUS</th>
                                                                                <th id="outbound_aging-grid_c3">DATE</th>
                                                                                <th id="outbound_aging-grid_c4">TIME</th>
                                                                                <th id="outbound_aging-grid_c5">AGE</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="queryoutboundaging">
                                                                            <?php
                                                                                foreach ($queryoutboundaging as $row) 
                                                                                {
                                                                            ?>
                                                                            <tr class="odd">
                                                                                <td><?php echo $row->program_name; ?></td>
                                                                                <td><?php echo $row->order_code; ?></td>
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
                                                                                    <?php echo $row->last_status; ?>
                                                                                </td>
                                                                                <td><?php echo $row->rtp_date; ?></td>
                                                                                <td><?php echo $row->rtp_time; ?></td>
                                                                                <td><?php echo $row->age; ?> hour</td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <button type="submit" style="width: 40%;" class="btn btn-block bg-gradient-info">DOWNLOAD</button>
                                                                        <!-- <a class="btn btn-block bg-gradient-primary" style="width: 40%;" href="<?php //echo base_url(" admin/C_dashboard/download_all_status "); ?>">Download</a> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END HALAMAN OUTBOUND AGING -->
                                            </div>
                                        </form>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
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

<script type="text/javascript">
    
    function outboundAging() 
    {
        var date = new Date();
        var chart;
        var reload = $('#reload').val();
        var uri = '<?php echo base_url(); ?>admin/outbound/C_outbound_aging/getOutboundAging';
        

        axios.post(uri)
        .then(response => {
            var outbounds = [];
            var result = response.data;
            $(".queryoutboundaging").find('tr').remove();
            var queryoutboundaging = $(".queryoutboundaging");
            $.each(result.queryoutboundaging, function(key, item) 
            {
                var inti;
                var out = [];
                out.push(item.program_name);
                out.push(item.order_code);
                out.push(item.last_status);
                // out.push(item.color);
                out.push(item.rtp_date);
                out.push(item.rtp_time);
                out.push(item.age + ' Hour');
                outbounds.push(out);
                // inti = '<tr class="odd">';
                // inti += '<td style="text-align:center">' + item.program_name + '</td>';
                // inti += '<td style="text-align:center">' + item.order_code + '</td>';
                // inti += '<td style="text-align:center">' + item.last_status + '</td>';
                // inti += '<td style="text-align:center">' + item.color + '</td>';
                // inti += '<td style="text-align:center">' + item.rtp_date + '</td>';
                // inti += '<td style="text-align:center">' + item.rtp_time + '</td>';
                // inti += '<td style="text-align:center">' + item.age + ' Hour</td>';
                // inti += '</tr>';
                // queryoutboundaging.append(inti);
            });

            $("#outboundagingtable").dataTable().fnDestroy();
            $("#outboundagingtable").DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                data: outbounds
            });
            // console.log(response);
        })
        .catch(errors => {
            console.log(errors);
        });
    }
</script>
<script>
    $(function () {
        $("#outboundagingtable").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        });
    });
</script>