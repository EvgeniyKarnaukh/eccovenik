		<section class="section bg-overlay align-items-center mh_100">
            <div class="container">
                <div class="row justify-content-center ptb_100">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="work-content text-center">
                            <h1 class="text-white">Общая статистика</h1>
                        </div>
                    </div>
                </div>
				<div class="row">
					<?php foreach ($counts as $id => $count) {?>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="text-center box-styles" style="min-height: auto">                           
                            <div>							
								<h4><?=$count["count"]?> <?=$count["unit"]?></h4><?=$count["title"]?>
                            </div>
                        </div>
                    </div>
					<?php } ?>
				</div>	
				<div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-sign-in-alt i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getCountOrders($data_st)?></h3>
                                <p>Всего заявок</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-phone i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getCountConfirmOrders($data_st)?></h3>
                                <p>Всего обработанных заявок</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-hand-holding-usd i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getCountPayOrders($data_st)?></h3>
                                <p>Всего оплаченных заявок</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-phone-slash i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getCountCancelOrders($data_st)?></h3>
                                <p>Всего аннулированных заявок</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-dollar-sign i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getSumOrders($data_st)?> р.</h3>
                                <p>Всего заявлено денег</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-dollar-sign i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getSumConfirmOrders($data_st)?> р.</h3>
                                <p>Договор на деньги</p>
                            </div>
                        </div>
                    </div>
					<div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-dollar-sign i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getSumPayOrders($data_st)?> р.</h3>
                                <p>Полученные деньги</p>
                            </div>
                        </div>
                    </div>
					<div class="col-12 col-md-4 col-lg-3">
                        <div class="text-center box-styles">
                            <div class="featured-img mb-3">
                                <i class="fas fa-dollar-sign i-new"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="mb-2"><?=getSumCancelOrders($data_st)?> р.</h3>
                                <p>Аннулированные деньги</p>
                            </div>
                        </div>
                    </div>
                </div>				
            </div>
        </section>
