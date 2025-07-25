		<section class="section bg-overlay align-items-center mh_100">
            <div class="container">
                <div class="row justify-content-center ptb_100">
                    <div class="col">
                        <div class="work-content text-center">
                            <h1 class="text-white">Заказы с лендинга</h1>
                        </div>						
                    </div>
                </div>
				<div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="work-content">
                            <h4 class="text-white mb-2 text-center">Всего заявок = <?php echo allOrders(); ?></h4>
                        </div>						
                    </div>
                </div>
				<div class="row">
					<div class="col-12 col-md-4 col-lg-4">
						<div class="admin-form">
							<?php if (isset($answer)) { ?><p class="text-center" style="color: #FF9900"><?=$answer?></p><?php } ?>
							<form id="admin-form" name="form_order" action="orders.php<?php if (isset($fd["date_order"])) { echo "?func=edit&amp;id=".$fd["id"]; } ?>" method="post">
								<h4 class="text-center mb-2"><?php if (isset($fd["date_order"])) { ?>Редактировать<?php } else { ?>Добавить<?php } ?> заказ</h4>
								<p class="text-center"><?php if (isset($fd["date_order"])) {?>[заказ № <?=$fd["id"]?>]<?php } ?></p>
								<div class="form-group">
									<?php if (isset($fd["phone"])) {
										$input = "<input class='form-control phone3 contrast' type='text' name='phone'";
										$input.="value='".$fd["phone"]."'";
										if ($readonly == true) $input.= " readonly";
										$input.= " />";
										echo $input;
									} else {
										echo "<input placeholder='Телефон' class='form-control phone3 contrast' type='text' name='phone' value='' />";
									}
									?>
								</div>
								<div class="form-group">
									<input placeholder="Имя" class="form-control contrast" type="text" name="name" value="<?php if (isset($fd["name"])) { echo $fd["name"]; } ?>" />
								</div>
								<div class="form-group">
									<input placeholder="Цена" class="form-control contrast" type="text" name="price" value="<?php if (isset($fd["price"])) { echo $fd["price"]; } ?>" />
								</div>								
								<div class="form-group">
									<label>Подтвержден:</label><input class="chb" type="checkbox" name="confirm" <?php if (isset($fd["confirm"]) || isset($fd["date_confirm"])) { echo "checked"; } ?> />
								</div>
								<div class="form-group">
									<label>Оплачен:</label><input class="chb" type="checkbox" name="pay" <?php if (isset($fd["pay"]) || isset($fd["date_pay"])) { echo "checked"; } ?> />
								</div>
								<div class="form-group">
									<label>Аннулирован:</label><input class="chb" type="checkbox" name="cancel" <?php if (isset($fd["cancel"]) || isset($fd["date_cancel"])) { echo "checked"; } ?> />
									<input type="hidden" name="id" value="<?php if (isset($fd["date_order"])) echo $fd["id"]; ?>" />
								</div>
								<div class="form-group">
									<textarea placeholder="Комментарии" class="form-control contrast" name="message"><?php if (isset($fd["message"])) { echo $fd["message"]; } ?></textarea>
								</div>
								<div class="form-group">
									<input class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit" name="<?php if (isset($fd["date_order"])) { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($fd["date_order"])) { ?>Редактировать<?php } else { ?>Добавить<?php } ?>" />
								</div>
								<?php if (isset($fd["date_order"])) { ?><p class="text-center"><a href="/admin/orders.php">Отмена</a></p><?php } ?>	
							</form>
						</div>
					</div>					
					<div class="col-12 col-md-8 col-lg-8">
						<div class="row">
							<?php if (isset($orders) and $orders) { ?>
								<?php foreach ($orders as $order) { ?>
								<div class="col-12 col-md-6 col-lg-6">								
									<div class="box-styles">
										<div class="co-main">
											<div class="row order-color">
												<div class="col-3">
													<p class="co-id"><?=$order["order_id"]?></p>
												</div>
												<div class="col-9">
													<p class="co-name"><?=$order["name"]?></p>
													<p class="co-phone"><a href="tel:<?=$order['phone']?>"><?=$order["phone"]?></a></p>										
												</div>
												<hr />
											</div>
											<div class="co-body">
												<p class="co-date"><?=$order["date_order"]?></p>
												<p class="co-price">Стоимость - <?=$order["price"]?></p>
												<?php if (isset($order["date_confirm"])) { ?><p class="co-field">Дата подтверждения - <?=$order["date_confirm"]?></p><?php } ?>
												<?php if (isset($order["date_pay"])) { ?><p class="co-field">Дата оплаты - <?=$order["date_pay"]?>.</p><?php } ?>
												<?php if (isset($order["date_cancel"])) { ?><p class="co-field">Дата аннулирования - <?=$order["date_cancel"]?></p><?php } ?>
												<?php if (isset($order["utm_source"])) { ?><p class="co-field">UTM-source: <?=$order["utm_source"]?></p><?php } ?>
												<?php if (isset($order["utm_campaign"])) { ?><p class="co-field">UTM-campaign: <?=$order["utm_campaign"]?></p><?php } ?>
												<?php if (isset($order["utm_content"])) { ?><p class="co-field">UTM-content: <?=$order["utm_content"]?></p><?php } ?>
												<?php if (isset($order["utm_term"])) { ?><p class="co-field">UTM-term: <?=$order["utm_term"]?></p><?php } ?>								
												<?php if (isset($order["split"])) { ?><hr /><p class="co-field">SPLIT-тест: <?=$order["split"]?></p><?php } ?>
												<?php if (isset($order["message"])) { ?><p class="co-field"><a href="/admin/orders.php?func=edit&amp;id=<?=$order["order_id"]?>">Сообщение (+1)</a></p><?php } ?>
											</div>
										</div>
										<div class="co-footer">
											<a href="/admin/orders.php?func=edit&amp;id=<?=$order["order_id"]?>">Изменить</a> | 
											<a href="/admin/orders.php?func=delete&amp;id=<?=$order["order_id"]?>" onclick="return confirm('Хотите удалить этот заказ?') ? true : false;">Удалить</a>
										</div>
									</div>								
								</div>	
								<?php } ?>
							<?php } ?>
							<?php if (!$orders) { echo "<p class='text-white'>Заказов пока нет.</p>"; } ?>
						</div>
					</div>					
				</div>				
			</div>
        </section>
