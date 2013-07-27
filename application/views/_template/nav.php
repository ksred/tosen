
        <div class="navbar navbar-inverse navbar-fixed-top">
                    <a class="navbar-brand" href="#">Project name</a>
                        <ul class="navbar-nav nav">
                            <li class="active"><a href="<?= BASE_URL ?>">Home</a></li>
                            <li><a href="<?= BASE_URL ?>/a/show">Trades</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php if (!$this->tank_auth->is_logged_in()) : ?>
							<form class="navbar-form pull-right">
								<input class="span2" type="text" placeholder="Email">
								<input class="span2" type="password" placeholder="Password">
								<button type="submit" class="btn">Sign in</button>
							</form>
						<?php else : ?>
							<div class="navbar-text pull-right">Welcome <?= $this->tank_auth->get_username() ?></div>
                        <?php endif; ?>
        </div>
