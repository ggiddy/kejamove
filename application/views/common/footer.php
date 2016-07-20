     </section><!-- ******FOOTER****** --> 

    <?php if(!isset($no_footer) || !$no_footer): ?>

        <footer class="app-footer">

            <div class="footer-content">

                <div class="container">

                    <div class="row">
                        <div class="footer-col col-md-4 col-sm-12 contact">

                            <div class="footer-col-inner">

                                <h3 class="title">Get in touch</h3>

                                <div class="row">

                                    <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a href="#">info@kejamove.com</a></p>

                                    <p class="tel col-md-12 col-sm-4"><i class="fa fa-phone"></i>+254 718 388 667, +254 711 931 212</p>

                                    <p class="email col-md-12 col-sm-4"><i class="fa fa-map-marker"></i><a href="#">4th Floor, Bishop Magua

                                    George Padmore Lane, Off Ngong Road

                                    (Opp Uchumi Hyper)</a></p>    

                                </div> 

                            </div><!--//footer-col-inner-->            

                        </div><!--//foooter-col--> 

                        <div style="margin-left:40px;" class="footer-col col-md-4 col-sm-4 links social-links pull-right">

                            <div  class="footer-col-inner">

                                <h3 class="title share-via">Share Via</h3>

                                <ul class="list-unstyled list-inline">

                                    <li><a target="_blank" href="http://www.twitter.com/kejamove"><i class="fa fa-twitter"></i></a></li>

                                    <li><a target="_blank" href="http://www.facebook.com/kejamove"><i class="fa fa-facebook"></i></a></li>

                                 </ul>


                            </div><!--//footer-col-inner-->

                        </div><!--//foooter-col-->                 
  

                    </div><!--//row-->

                </div><!--//container-->        

            </div><!--//footer-content-->

        </footer><!--//footer-->
    <?php endif; ?>

    <!--<![endif]--> 

    <!---Autoload Scripts-->
    <?php global $app_scripts; ?>
    <?php if(is_array($app_scripts)): ?>
     <?php foreach($app_scripts as $id=>$script): ?>
        <?php if(isset($script)): ?>
            <?php if(defined('ENVIRONMENT') && ENVIRONMENT=='development'): ?>
                <script id="<?php echo $id; ?>" src="<?php echo base_url($script); ?>"></script>
            <?php else: ?>
                <script type="text/javascript">
                 <?php echo file_get_contents($this->config->item('js-root').$script); ?>
                </script>
            <?php endif; ?>
        <?php endif; ?>
     <?php endforeach; ?>
    <?php endif; ?>
</body>
  <!-- Google Analytics -->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43256611-5', 'auto');
  ga('send', 'pageview');

</script>
        

    <script type="text/javascript">
      window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var n=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(n?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(a,o);for(var r=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["clearEventProperties","identify","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=r(p[c])};
      heap.load("2887828215");
    </script>

    </head>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    
            
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/56bb295f5bf1a5ac68ba405d/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</html> 