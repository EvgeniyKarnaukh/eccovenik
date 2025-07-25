		<section class="section bg-overlay align-items-center mh_100">
            <div class="container">
                <div class="row justify-content-center ptb_100">
                    <div class="col">
                        <div class="work-content text-center">
                            <h1 class="text-white">Ваши клиенты</h1>
                        </div>						
                    </div>
                </div>
				<div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="work-content">
                            <h4 class="text-white mb-2 text-center">Всего клиентов = <?php echo allUsers(); ?></h4>
                        </div>						
                    </div>
                </div>
				<div class="row">
					<div class="col-12 col-md-4 col-lg-4">
						<div class="admin-form">
							<?php if (isset($answer)) { ?><p class="text-center" style="color: #FF9900"><?=$answer?></p><?php } ?>
							<form id="admin-form" name="form_order" action="files.php<?php if (isset($fd["date_register"])) { echo "?func=edit&amp;id=".$fd["id"]; } ?>" method="post">
								<h4 class="text-center mb-2"><?php if (isset($fd["date_register"])) { ?>Изменить данные<?php } else { ?>Добавить клиента<?php } ?></h4>
								<p class="text-center"><?php if (isset($fd["date_register"])) {?>[карточка клиента № <?=$fd["id"]?>]<?php } ?></p>
								
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
									<input placeholder="E-mail" class="form-control contrast" type="email" name="email" value="<?php if (isset($fd["email"])) { echo $fd["email"]; } ?>" />
								</div>
								<div class="form-group">
									<input placeholder="День рождения" class="form-control contrast" type="text" name="date_birth" value="<?php if (isset($fd["date_birth"])) { echo $fd["date_birth"]; } ?>" />
								</div>
								<div class="form-group">
									<label>Мужчина:</label><input class="chb" type="radio" name="sex" value="М" <?php if (isset($fd["sex"]) and $fd["sex"] == "М") { echo "checked"; } ?> />
								</div>
								<div class="form-group">
									<label>Женщина:</label><input class="chb" type="radio" name="sex" value="Ж" <?php if (isset($fd["sex"]) and $fd["sex"] == "Ж") { echo "checked"; } ?> />
								</div>
								<div class="form-group">
									<textarea placeholder="Комментарии" class="form-control contrast" name="message" rows="5"><?php if (isset($fd["message"])) { echo $fd["message"]; } ?></textarea >
								</div>								
								<div class="form-group">
									<input class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit" name="<?php if (isset($fd["date_register"])) { ?>edit_user<?php } else { ?>add_user<?php } ?>" value="<?php if (isset($fd["date_register"])) { ?>Изменить<?php } else { ?>Добавить<?php } ?>" />
								</div>
								<?php if (isset($fd["date_register"])) { ?><p class="text-center"><a href="/admin/files.php">Отмена</a></p><?php } ?>	
							</form>
						</div>
					</div>					
					<div class="col-12 col-md-8 col-lg-8">
						<div class="row">
							<?php if (isset($users) and $users) { ?>
								<?php foreach ($users as $user) { ?>
								<div class="col-12 col-md-6 col-lg-6">								
									<div class="box-styles">
										<div class="co-main">
											<div class="row files-color">
												<div class="col-3">
													<p class="co-id"><?=$user["id"]?></p>
												</div>
												<div class="col-9">
													<p class="co-name"><?=$user["name"]?></p>
													<p class="co-phone"><a href="tel:<?=$user['phone']?>"><?=$user["phone"]?></a></p>										
												</div>
											</div>
											<div class="co-body">
												<?php if (isset($user["email"])) { ?><p class="co-email"><a href="tel:<?=$user['email']?>"><?=$user["email"]?></a></p><?php } ?>
												<?php if (isset($user["ip"])) { ?><p class="co-ip">IP: <?=$user["ip"]?></p><?php } ?>
												<hr />
											<p class="co-date">Дата регистрации: <?=$user["date_register"]?></p>
											<?php if (isset($user["date_birth"])) { ?><p class="co-field">День рождения: <?=$user["date_birth"]?></p><?php } ?>
											
											<?php if (isset($user["sex"])) { ?><p class="co-field">Пол: <?=$user["sex"]?></p><?php } ?>
											<?php if (isset($user["sum_paid"])) { ?><p class="co-field">Всего оплатил: <?=$user["sum_paid"]?> р.</p><?php } ?>
											<?php if (isset($user["status"])) { ?><p class="co-field">Статус: <?=$user["status"]?></p><?php } ?>
											<?php if (isset($user["message"])) { ?><p class="co-field"><a href="/admin/files.php?func=edit&amp;id=<?=$user["id"]?>">Сообщение (+1)</a></p><?php } ?>
											</div>
										</div>
										<div class="co-footer">
											<a href="/admin/files.php?func=edit&amp;id=<?=$user["id"]?>">Изменить</a> | 
											<a href="/admin/files.php?func=delete_user&amp;id=<?=$user["id"]?>" onclick="return confirm('Хотите удалить этого клиента?') ? true : false;">Удалить</a>
										</div>
									</div>								
								</div>	
								<?php } ?>
							<?php } ?>
							<?php if (!$users) { echo "<p class='text-white'>Клиентов пока нет.</p>"; } ?>
						</div>
					</div>					
				</div>				
			</div>
        </section>
