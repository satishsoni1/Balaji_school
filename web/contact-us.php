<?php include("inc/head.php") ?>
<?php include("inc/header.php") ?>
<?php include("inc/nav.php") ?>
<?php include("inc/slidebar.php") ?>
        <!--Start Page Banner-->
        <div class="page-banner-area bg-2">
            <div class="container">
                <div class="page-banner-content">
                    <h1>Contact Us</h1>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Page Banner-->

        <!--Start Contact Us Area-->
        <div class="contact-us-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contacts-form">
                            <h3>Leave a message</h3>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Your name</label>
                                            <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Your email</label>
                                            <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Your phone</label>
                                            <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Your message</label>
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input
                                                name="gridCheck"
                                                value="I agree to the terms and privacy policy."
                                                class="form-check-input"
                                                type="checkbox"
                                                id="gridCheck"
                                                required
                                            >
                                            <label class="form-check-label" for="gridCheck">
                                                I agree to the <a href="#">terms</a> and <a href="#">privacy policy</a>
                                            </label>
                                            <div class="help-block with-errors gridCheck-error"></div>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn">
                                            <span>Send message</span>
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-and-address">
                            <h2>Contact 🇮🇳</h2>
                            <p></p>
                            <div class="contact-and-address-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact-card">
                                            <div class="icon">
                                                <i class="ri-phone-line"></i>
                                            </div>
                                            <h4>Contact</h4>
                                            <p>Mobile: <a href="tel:+919604044131">+91-9604044131</a></p>
                                            <p>Mail: <a href="mailto:info@shribalajieng.com">info@shribalajieng.com</a></p>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact-card">
                                            
                                            <div class="icon">
                                                <i class="ri-map-pin-line"></i>
                                            </div>
                                            <h4>Address</h4>
                                            <p>Wadegaon</p>
                                            <p>Tq. Balapur, Dist. Akola</p>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    
            
                                </div>
                            </div>
                            <div class="social-media">
                               
                                <p></p>
                                <ul>
                                    <li>
                                
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Contact Us Area-->
        <?php include("inc/footer.php") ?>
    <?php include("inc/foot.php") ?>