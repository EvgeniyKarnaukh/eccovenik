		<section id="home" class="section welcome-area bg-overlay d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Welcome Intro Start -->
                    <div class="col-12 col-lg-7">
                        <div class="welcome-intro">
                            <h1 class="text-white">Панель<br />администратора</h1>
                            <p class="text-white my-4"><?php if ($answer) {echo $answer;} ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-5">
                        <!-- Contact Box -->
                        <div class="contact-box bg-white text-center rounded p-4 p-sm-5 mt-5 mt-lg-0 shadow-lg">
                            <!-- Contact Form -->
                            <form id="auth" method="post" action="index.php">
                                <div class="contact-top">
                                    <h3 class="contact-title">Форма входа</h3>
                                    <h5 class="text-secondary fw-3 py-3">Введите логин и пароль</h5>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                              </div>
                                              <input type="text" class="form-control" name="login" placeholder="Логин" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                              </div>
                                              <input type="password" class="form-control" name="password" placeholder="Пароль" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button name="auth" class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit">Войти</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>