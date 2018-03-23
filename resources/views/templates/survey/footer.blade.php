        <!-- ******FOOTER****** --> 
        <footer class="footer">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-lg-4 col-md-4 col-12 links-col">
                            <div class="footer-col-inner">
                                <h3 class="sub-title">@lang('lang.about_us')</h3>
                                <div class="list-unstyled">
                                    @lang('lang.about_us_content')
                                </div>
                            </div>
                        </div>
                        <div class="footer-col col-lg-4 col-md-8 col-12 blog-col">
                            <div class="footer-col-inner">
                                <h3 class="sub-title">@lang('lang.contact_info')</h3>
                                <ul class="contact-info">
                                    <li>@lang('lang.contact_us')</li>
                                    <li>
                                        <i class="fa fa-home"></i>
                                        @lang('lang.company_address')
                                    </li>
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        @lang('lang.company_phone')
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        @lang('lang.email'):
                                        <a href="#">{{ config('settings.company.hr_email_company') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!--//foooter-col--> 
                        <div class="footer-col col-lg-4 col-12 contact-col">
                            <div class="footer-col-inner">
                                <h3 class="sub-title">@lang('lang.more_info')</h3>
                                <div class="list-unstyled">
                                    @lang('lang.more_info_content')
                                </div>
                                <div class="more-tool">
                                    <a href="{{ config('settings.company.tools_company') }}" target="_blank">
                                        <i class="fa fa-gears"></i>
                                        @lang('lang.more_tools')
                                    </a>
                                </div>
                            </div>           
                        </div>   
                    </div>   
                </div>        
            </div>
            <div class="bottom-bar">
                <div class="container center">                                   
                    <ul class="social-icons list-inline">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>                        
                        <li class="list-inline-item">
                            <a href="{{ config('settings.company.fb_company') }}">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ config('settings.company.github_company') }}">
                                <i class="fa fa-github"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ config('settings.company.linkedin_company') }}">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="last list-inline-item">
                            <a href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>                     
                    </ul> 
                    <small class="copyright text-center">@lang('lang.copyright')</small>   
                </div>
            </div>
        </footer>
        <!-- Main Javascript -->
        {{ Html::script(asset('js/jquery.min.js')) }}
        {{ Html::script(asset('js/bootstrap.min.js')) }}
        {{ Html::script(elixir(config('settings.public_template') . 'js/jquery.matchHeight-min.js')) }}
        {{ Html::script(elixir(config('settings.public_template') . 'js/main.js')) }}
    </body>
</html>
