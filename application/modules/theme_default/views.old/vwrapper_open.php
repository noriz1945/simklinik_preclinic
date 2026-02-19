<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a href="<?php echo base_url(''); ?>">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/logoklinik.png'); ?>" alt="Theme-Logo" width="150px" height="auto"/>
                            </a>
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="feather icon-menu icon-toggle-right"></i>
                            </a>
                            <a class="mobile-options waves-effect waves-light">
                                <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li>
                                    <a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light" data-cf-modified-799ddc403e80b1cc26e7d64d-="">
                                        <i class="full-screen feather icon-maximize"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="
												<?php echo base_url('assets/core/images/Sample_User_Icon.png'); ?>" class="img-radius" alt="User-Profile-Image">
                                            <span> <?php echo $this->session->userdata['sp']->name; ?> </span>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <!--<li><a href="#!"><i class="feather icon-settings"></i> Settings
</a></li><li><a href="#"><i class="feather icon-user"></i> Profile
</a></li><li><a href="email-inbox.html"><i class="feather icon-mail"></i> My Messages
</a></li><li><a href="auth-lock-screen.html"><i class="feather icon-lock"></i> Lock Screen
</a></li>-->
                                            <li>
                                                <a href="
														<?php echo base_url('auth/logout'); ?>">
                                                    <i class="feather icon-log-out"></i> Logout </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar">
                                <ul class="pcoded-item"> 
									<?php foreach($rs as $k => $v) { ?> 
									<li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-sidebar"></i>
                                            </span>
                                            <i class="
													<?php echo $v['icon']; ?>">
                                            </i>
                                            </span>
                                            <span class="pcoded-mtext"> <?php echo $v['menu']; ?> </span>
                                        </a>
                                        <ul class="pcoded-submenu"> 
										<?php foreach($v['rs_submenu'] as $kk => $vv) 
										{ 
											if($vv['is_grup_submenu']==1)
											{
										?> 
											<li class="pcoded-hasmenu is-hover" subitem-icon="style1" dropdown-icon="style1">
                                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"><?php echo $vv['submenu'] ?></span>
                                                </a>
											
												<ul class="pcoded-submenu">
												<?php foreach($vv['anak'] as $kkk => $vvv)  { ?>
													<li class="">
														<a href="<?php echo base_url($vvv['url']) ?>" class="waves-effect waves-dark">
															<span class="pcoded-mtext"><?php echo $vvv['submenu'] ?></span>
														</a>
													</li>
												<?php
												}											
												?>
												</ul>
											</li>
										<?php
											}
											else
											{
										?>
											<li class=" ">
                                                <a href="<?php echo base_url($vv['url']) ?>" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"><?php echo $vv['submenu'] ?></span>
                                                </a>
                                            </li>
										<?php
											}
										?>
											
											<?php } ?> 
										</ul>
                                    </li> 
									<?php } ?> 
									
									
									
									
								</ul>
                            </div>
                        </nav>