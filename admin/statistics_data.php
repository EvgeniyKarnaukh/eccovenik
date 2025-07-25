		<section class="section bg-overlay align-items-center mh_100">
            <div class="container">
                <div class="row justify-content-center ptb_100">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="work-content text-center">
                            <h1 class="text-white">Статистика</h1>
                        </div>						
                    </div>
                </div>
				<div class="row">
					<div class="col-12 col-md-5 col-lg-5">
						<div class="admin-form">
							<?php if (isset($answer)) { ?><p class="text-center" style="color: #FF9900"><?=$answer?></p><?php } ?>
							<form id="statistics" name="statistics" action="statistics.php" method="post">
								<h4 class="text-center mb-2">Фильтры</h4>
								<div class="form-group">
									<label>От:</label> <input class="form-control contrast" type="text" name="from" value="<?php if (isset($request["from"])) { ?><?=$request["from"]?><?php } else { ?><?=date(FORMAT_DATE, time() - 30*86400)?><?php } ?>" />
								</div>
								<div class="form-group">
									<label>До:</label> <input class="form-control contrast" type="text" name="to" value="<?php if (isset($request["to"])) { ?><?=$request["to"]?><?php } else { ?><?=date(FORMAT_DATE)?><?php } ?>" />
								</div>
								
								<?php if (isset($utm_source) and $utm_source) { ?>
								<div class="form-group">
									<label>UTM Source:</label>
									<select class="form-control contrast" name="utm_source">
										<?php if (isset($data_st["utm_source"])) { ?>
											<option value="<?=$data_st["utm_source"]?>"><?=$data_st["utm_source"]?></option>
										<? } ?>
										<option value=""></option>
										<?php foreach ($utm_source as $value) {											
											echo "<option value='".$value."'>".$value."</option>";
											} ?>
									</select>
								</div>
								<?php } ?>
								<?php if (isset($utm_campaign) and $utm_campaign) { ?>
								<div class="form-group">
									<label>UTM Campaign:</label>
									<select class="form-control contrast" name="utm_campaign">
										<?php if (isset($data_st["utm_campaign"])) { ?>
											<option value="<?=$data_st["utm_campaign"]?>"><?=$data_st["utm_campaign"]?></option>
										<? } ?>
										<option value=""></option>
										<?php foreach ($utm_campaign as $value) {											
											echo "<option value='".$value."'>".$value."</option>";
											} ?>
									</select>
								</div>	
								<?php } ?>
								<?php if (isset($utm_content) and $utm_content) { ?>
								<div class="form-group">
									<label>UTM Content:</label>
									<select class="form-control contrast" name="utm_content">
										<?php if (isset($data_st["utm_content"])) { ?>
											<option value="<?=$data_st["utm_content"]?>"><?=$data_st["utm_content"]?></option>
										<? } ?>
										<option value=""></option>
										<?php foreach ($utm_content as $value) {											
											echo "<option value='".$value."'>".$value."</option>";
											} ?>
									</select>
								</div>
								<?php } ?>
								<?php if (isset($utm_term) and $utm_term) { ?>
								<div class="form-group">
									<label>UTM Term:</label>
									<select class="form-control contrast" name="utm_term">
										<?php if (isset($data_st["utm_term"])) { ?>
											<option value="<?=$data_st["utm_term"]?>"><?=$data_st["utm_term"]?></option>
										<? } ?>
										<option value=""></option>
										<?php foreach ($utm_term as $value) {											
											echo "<option value='".$value."'>".$value."</option>";
											} ?>
									</select>
								</div>
								<?php } ?>
								<?php if (isset($split) and $split) { ?>
								<div class="form-group">
									<label>SPLIT тест:</label>
									<select class="form-control contrast" name="split">
										<?php if (isset($data_st["split"])) { ?>
											<option value="<?=$data_st["split"]?>"><?=$data_st["split"]?></option>
										<? } ?>
										<option value=""></option>
										<?php foreach ($split as $value) {											
											echo "<option value='".$value."'>".$value."</option>";
										} ?>
									</select>
								</div>
								<?php } ?>
								
								<div>
									<label>И:</label> <input class="chb" type="radio" name="log" value="AND" <?php if (isset($request["log"]) && $request["log"] == "AND") { ?>checked<?php } ?> />
									<label>ИЛИ:</label> <input class="chb" type="radio" name="log" value="OR" <?php if (isset($request["log"]) && $request["log"] == "OR") { ?>checked<?php } ?> />
								</div>
								<div class="form-group">
									<input class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit" name="statistics" value="Вывести" />
								</div>								
							</form>
						</div>
					</div>					
					<div class="col-12 col-md-7 col-lg-7">
						<div class="row m_div">
							<div class="col-12 col-md-6 col-lg-4">								
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
							<div class="col-12 col-md-6 col-lg-4">	
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
							<div class="col-12 col-md-6 col-lg-4">	
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
							<div class="col-12 col-md-6 col-lg-4">	
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
							<div class="col-12 col-md-6 col-lg-4">	
								<div class="text-center box-styles">
									<div class="featured-img mb-3">
										<i class="fas fa-dollar-sign i-new"></i>
									</div>
									<div class="icon-text">
										<h3 class="mb-2"><?=getSumOrders($data_st)?> р.</h3>
										<p>Общая стоимость всех заказов</p>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-4">	
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
							<div class="col-12 col-md-6 col-lg-4">	
								<div class="text-center box-styles">
									<div class="featured-img mb-3">
										<i class="fas fa-dollar-sign i-new"></i>
									</div>
									<div class="icon-text">
										<h3 class="mb-2"><?=getSumPayOrders($data_st)?> р.</h3>
										<p>Получено денег</p>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-4">	
								<div class="text-center box-styles">
									<div class="featured-img mb-3">
										<i class="fas fa-dollar-sign i-new"></i>
									</div>
									<div class="icon-text">
										<h3 class="mb-2"><?=getSumCancelOrders($data_st)?> р.</h3>
										<p>Аннулировано денег</p>
									</div>
								</div>
							</div>
						</div>
					</div>					
				</div>				
			</div>
        </section>

		
		
		
		
		
		