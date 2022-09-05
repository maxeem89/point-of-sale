
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <p>Sales Amount</p>
                    <h3> <?= $data->invoices_total?></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-social-usd"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <p>Total Invoices</p>
                    <h3> <?= $data->invoices_count ?></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-printer"></i>
                </div>

            </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3> </h3>

                    <p>Top Five Items Sale</p>
                    <?php foreach($data->top as $item){?>
                    <h3><?= $item->name ?></h3>
                    <?php } ?>
                </div>
                <div class="icon">
                    <i class="ion ion-alert-circled"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3></h3>

                    <p>Top five expensive items to buy</p>
                    <?php foreach($data->topExpinsive as $top){?>
                    <h3><?= $top->name ?></h3>
                    <?php } ?>
                    
                </div>
                <div class="icon">
                    <i class="ion ion-load-a"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- 2nd row -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    
                    <p>Total Products</p>
                    <h3> <?= $data->items_count ?></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-social-dropbox"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner text-center">
                    <h3></h3>

                    <p>Total Users</p>
                    <h3> <?= $data->users_count ?></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people"></i>
                </div>

               
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3></h3>

                    <p>Paid Bills</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-paper"></i>
                </div>

            </div>
        </div>
    </div>

</section>
<!-- /.content -->

<?php

?>