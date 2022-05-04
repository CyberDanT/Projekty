<?php
function footer(){
echo '<div id="infocookies" style="position: fixed; bottom: 0px; width: 100%; z-index: 100; color: white; background-color: rgba(51,51,51, 0.8);">
				<div style="text-align: center; line-height: 50px;">Korzystając z serwisu, przyjmujesz do wiadomości, że używamy plików cookie i podobnych technologii do dostosowania treści, 
					analizy ruchu oraz dostarczania reklam. <a style="color: white; border-bottom: 1px solid white;" href="https://www.bezgrosika.pl/regulamin.pdf">Więcej informacji...</a>
					<a tabindex="0" id="accept" style="cursor: pointer;"><b>Akceptuję, zamknij.</b></a>
				</div>
			</div>
	
	<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6">
                <h2 class="footer-heading mb-4">O nas</h2>
                <p>Ogłoszenia BezGrosika.pl to darmowy nowo powstający serwis ogłoszeniowy dla ludzi z całej Polski. Chcesz coś kupić, lub sprzedać? To miejsce idealne do tego! 
				Wystawiaj swoje ogłoszenia za darmo w kategorii motoryzacja, elektronika, nieruchomości, dla domu i ogrodu, praca, odzież, zwierzęta i pozostałe.
				<br>Działamy dla Ciebie!</p>
              </div>
              
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Nawigacja</h2>
                <ul class="list-unstyled">
                  <li><a href="https://www.bezgrosika.pl/kontakt.php">Kontakt</a></li>
                  <li><a href="https://www.bezgrosika.pl/reklama.php">Reklama</a></li>
                  <li><a href="https://www.bezgrosika.pl/regulamin.pdf">Regulamin</a></li>
				  <li><a href="https://www.bezgrosika.pl/cennik.php">Cennik</a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Odwiedź nas na</h2>
                <a href="https://www.facebook.com/pg/BezGrosikapl-102037107869113/posts/?ref=page_internal" target="_blank" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <!-- <a href="#" class="pl-3 pr-3" target="_blank"><span class="icon-twitter" ></span></a> -->
                <a href="https://www.instagram.com/bezgrosika.pl/" target="_blank" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="https://www.youtube.com/channel/UCId4i2X_8Jdff8Ve5MybIPQ" class="pl-3 pr-3" target="_blank"><span class="icon-youtube"></span></a>
              </div>
            </div>
          </div>
          <!--<div class="col-md-3">
            <form action="#" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Search products..." aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="button" id="button-addon2">Search</button>
                </div>
              </div>
            </form>
          </div>-->
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            </p>
            </div>
          </div>
          
        </div>
      </div>
	  
    </footer>
	
	
	<script type="text/javascript">
		function checkcookies(){
			if(localStorage.bezgrosika_cookiesinfo_accepted){
				document.getElementById(\'infocookies\').style.display="none";
			} 
		}
		window.onload = checkcookies;
		
		x = document.getElementById(\'accept\');
		x.onclick = function(){
			localStorage.bezgrosika_cookiesinfo_accepted = true; 
			document.getElementById(\'infocookies\').style.display="none";
		}
	</script>
	';
}

	
