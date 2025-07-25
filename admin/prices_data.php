		<section class="section bg-overlay align-items-center mh_100">
            <div class="container">
                <div class="row justify-content-center ptb_100">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="work-content text-center">
                            <h1 class="text-white">Цены на веники</h1>
                        </div>
                    </div>
                </div>
				<?php if (isset($answer) and $answer) { ?>
					<p class="text-center info_block"><?=$answer?></p>
				<?php } ?>
				<div class="row">                   
					<?php foreach ($prices as $price) {?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="icon-box text-center p-4">
							<div class="featured-icon mb-3">
								<img src="/assets/img/brand/<?=$price["img_src"]?>" alt="<?=$price["title"]?>" />
							</div>
							<div class="icon-text">
								<h3 class="mb-2"><?=$price["title"]?></h3>
								<form name="price_change" method="post" action="">
									<div class="form-group">
										<p>Цена: <input class="prices_input" type="text" name="price" value="<?=$price["price"]?>" required="required"> р.</p>
									</div>
									<input type="hidden" name="id" value="<?=$price["id"]?>">
									<button class="prices_button" type="submit" name="price_change">Сохранить</button>
								</form>
							</div>
						</div>
					</div>
					<?php } ?>
                </div>				
            </div>
        </section>
