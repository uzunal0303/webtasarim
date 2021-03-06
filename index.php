<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'indexform1')
{
   $mailto = 'yourname@yourdomain.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website form';
   $message = 'Values submitted from web site form:';
   $success_url = '';
   $error_url = '';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response", "h-captcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;

   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<title>Serdivan Belediye'sine ho??geldiniz</title>
<meta name="generator" content="WYSIWYG Web Builder 12 - http://www.wysiwygwebbuilder.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="??rnek.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="util.min.js"></script>
<script src="scrollspy.min.js"></script>
<script src="wb.panel.min.js"></script>
<script src="wb.carousel.min.js"></script>
<script>
$(document).ready(function()
{
   $("a[href*='#about_us_section']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#about_us_section').offset().top }, 600, 'linear');
   });
   $("a[href*='#services_section']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#services_section').offset().top }, 600, 'linear');
   });
   $("a[href*='#indexLayer4']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#indexLayer4').offset().top }, 600, 'linear');
   });
   $("a[href*='#portfolio_section']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#portfolio_section').offset().top }, 600, 'linear');
   });
   $("a[href*='#contact_section']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#contact_section').offset().top }, 600, 'linear');
   });
   $("#indexPanelMenu1").panel({animate: true, animationDuration: 200, animationEasing: 'linear', dismissible: true, display: 'push', position: 'left', toggle: true});
   $("#indexPanelMenu1_markup ul li a").click(function(event)
   {
       $.panel.hide($("#indexPanelMenu1_panel"));
   });
   $("a[href*='#master_pageLayer1']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#master_pageLayer1').offset().top }, 1000, 'linear');
   });
   var indexCarousel1Opts =
   {
      delay: 3000,
      duration: 500,
      easing: 'linear',
      mode: 'forward',
      direction: '',
      scalemode: 2,
      pagination: true,
      pause: null,
      start: 0
   };
   $("#indexCarousel1").carousel(indexCarousel1Opts);
   $("#indexCarousel1_back a").click(function()
   {
      $('#indexCarousel1').carousel('prev');
   });
   $("#indexCarousel1_next a").click(function()
   {
      $('#indexCarousel1').carousel('next');
   });
});
</script>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body data-spy="scroll">
<div id="master_pageLayer2">
<div id="master_pageLayer2_Container">
<div id="wb_master_pageText1">
<span class="lato_10_black">All rights reserved &#0169; dapsonishmea lweb hub</span></div>
<div id="master_pageLayer3">
<div id="master_pageLayer3_Container">
<div id="wb_master_pageFontAwesomeIcon3">
<div id="master_pageFontAwesomeIcon3"><i class="fa fa-twitter"></i></div></div>
<div id="wb_master_pageFontAwesomeIcon2">
<div id="master_pageFontAwesomeIcon2"><i class="fa fa-facebook"></i></div></div>
<div id="wb_master_pageFontAwesomeIcon1">
<div id="master_pageFontAwesomeIcon1"><i class="fa fa-instagram"></i></div></div>
<div id="wb_master_pageFontAwesomeIcon4">
<div id="master_pageFontAwesomeIcon4"><i class="fa fa-pinterest-p"></i></div></div>
</div>
</div>
</div>
</div>
<div id="container">


<div id="wb_indexText7">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Telefon, dilek??e yada e-posta yolu ile gelen ??ikayetler kullan??lan sampa?? program?? ??zerinden&nbsp; kalem personeli taraf??ndan kayda al??n??r. Sokak hayvanlar?? toplama sorumlusuna haber verilerek Sokak hayvanlar??n??n toplanmas??, rehabilitasyon merkezine naklinin ger??ekle??tirilmesi, k??s??rla??t??r??lan ve a????lanan hayvanlar??n al??nd?????? ortama b??rak??lmas?? sa??lan??r.</strong></span></div>
<div id="wb_indexText11">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Bu prosed??r Temizlik ????leri M??d??r?? taraf??ndan haz??rlan??r. ISO 9001 Kalite Y??netim Sistemi???ne uygunluk a????s??ndan Kalite Y??netim Sistemi Koordinat??r?? taraf??ndan do??rulan??r ve Belediye Ba??kan??n??n onay?? ile y??r??rl????e girer. Bu prosed??r??n y??r??t??lmesinden m??d??rl??kte g??revli olan personel sorumludur. Prosed??r??n kullan??c??lar?? da m??d??rl??kte g??rev yapan personeldir.</strong></span></div>
<a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:441px;top:4488px;margin: 0;border-width:0;z-index:250" width="88" height="31"></a>
<div id="wb_indexCarousel1">
<div id="indexCarousel1">
<div class="frame">
<div id="wb_indexImage7">
<img src="images/belediye1.jpg" id="indexImage7" alt="" width="916" height="610"></div>
</div>
<div class="frame">
<div id="wb_indexImage8">
<img src="images/belediye ??st.jpg" srcset="images/belediye.jpg 2x" id="indexImage8" alt="" width="936" height="621"></div>
</div>
<div class="frame">
<div id="wb_indexImage9">
<img src="images/belediye1.jpg" srcset="images/belediye.jpg 2x" id="indexImage9" alt="" width="290" height="193"></div>
<div id="wb_indexImage10">
<img src="images/belediye.jpg" srcset="images/belediye1.jpg 2x" id="indexImage10" alt="" width="366" height="103"></div>
</div>
</div>
<div id="indexCarousel1_back"><a class="carousel-control-prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a></div>
<div id="indexCarousel1_next"><a class="carousel-control-next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span></a></div>
</div>
</div>
<div id="about_us_section">
<div id="about_us_section_Container">
<div id="wb_indexText3">
<span class="lato_20_black">Serdivan Tarihi</span></div>
<div id="wb_indexText4">
&nbsp;</div>
<div id="wb_indexImage2">
<img src="images/belediye ??st.jpg" id="indexImage2" alt="" width="391" height="259"></div>
<div id="wb_indexYouTube1">
<iframe id="indexYouTube1" src="https://www.youtube.com/embed/yT2XcXc_JWI&amp;ab_channel=SerdivanBelediyesi?rel=1&amp;autoplay=1&amp;autohide=0"></iframe>
</div>
<div id="wb_indexText41">
<span class="lato_14_black">Serdivan?????n da i??inde bulundu??u Sakarya (Adapazar??) b??lgesi, verimli topraklar??, ormanlar??, akarsular??, g??lleri ve ??nemli g???? yollar?? ??zerinde bulunmas?? dolay??s??yla eski ??a??lardan beri s??ras??yla Frigler, Bithinyal??lar, Kimmerler, Lidyal??lar, Persler, Romal??lar ve Bizansl??lar??n h??kimiyeti alt??na bulunmu??tur.<br><br><br>Roma Bizans devrinde bug??nk?? Adapazar?? havzas??nda yerle??im izine rastlanmamaktad??r. B??lgenin Osmanl?? taraf??ndan fethinden sonra 1300???l?? y??llar??n ilk yar??s??nda g????ebe T??rk boylar?? buralara yerle??mi??lerdir.<br><br></span></div>
</div>
</div>
<div id="services_section">
<div id="services_section_Container">
<div id="wb_indexText5">
<span class="lato_20_black">H??ZMETLER</span></div>
<div id="indexLayer14">
<div id="indexLayer14_Container">
<div id="wb_indexText8">
<span style="color:#000000;font-family:Arial;font-size:19px;"><strong>Geri D??n??????m</strong></span></div>
<div id="wb_indexImage3">
<img src="images/geri d??n??m.jpg" srcset="images/geri d??n??m.jpg 2x" id="indexImage3" alt="" width="59" height="51"></div>
</div>
</div>
<div id="indexLayer15">
<div id="indexLayer15_Container">
<div id="wb_indexText6">
<span style="color:#000000;font-family:Arial;font-size:19px;"><strong>Veterinerlik</strong></span></div>
<div id="wb_indexImage4">
<img src="images/veteriner.jpg" srcset="images/veteriner.jpg 2x" id="indexImage4" alt="" width="81" height="57"></div>
</div>
</div>
<div id="indexLayer13">
<div id="indexLayer13_Container">
<div id="wb_indexText10">
<span style="color:#000000;font-family:Arial;font-size:19px;"><strong>Temizlik</strong></span></div>
<div id="wb_indexImage5">
<img src="images/commercial.png" srcset="images/commercial.png 2x" id="indexImage5" alt="" width="83" height="47"></div>
</div>
</div>
<div id="wb_indexText9">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Geri D??n??????m<br>Belediyemiz s??n??rlar?? i??erisindeki geri d??n??????m at??klar?? s??zle??me yap??lan firma taraf??ndan toplanmakta ve at??k miktarlar??na ait raporlar firman??n ??evre m??hendisi taraf??ndan d??zenlenerek m??d??rl??????m??ze teslim edilmektedir.<br>.</strong></span></div>
</div>
</div>
<div id="indexLayer4">
<div id="indexLayer4_Container">
<div id="wb_indexText12">
<span style="color:#FF0000;font-family:Arial;font-size:37px;"><strong>??ZEL DESTEK M?? LAZIM !</strong></span></div>
<div id="wb_indexShape3">
<a href="#contact_section"><img src="images/img0003.png" id="indexShape3" alt="" width="152" height="45"></a></div>
<div id="wb_indexImage1">
<img src="images/-afetlere-.jpg" id="indexImage1" alt="https://www.serdivanbelediyesi.com" title="https://www.serdivanbelediyesi.com" width="599" height="312"></div>
</div>
</div>
<div id="portfolio_section">
<div id="portfolio_section_Container">
<div id="wb_indexText18">
<span class="lato_20_black">TANIMLAR VE KISALTMALAR</span></div>
<div id="wb_Marquee1">
<div id="Marquee1">
<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Zab??ta: </strong></span><span style="color:#000000;font-family:Arial;font-size:13px;">5393 Say??l?? Belediye kanunun 51.maddesinde Belediye Zab??tas?? ??? Beldede esenlik, huzur, sa??l??k ve d??zenin sa??lanmas??yla g??revli olup bu ama??la, belediye meclisi taraf??ndan al??nan ve belediye zab??tas?? taraf??ndan yerine getirilmesi gereken emir ve yasaklarla bunlara uymayanlar hakk??nda mevzuatta ??n g??r??len ceza ve di??er yapt??r??mlar?? uygular??? diye belirtilmi??tir.<br><br></span><span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Tebligat</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;">: Belediye Enc??meninin alm???? oldu??u kararlar ile ??e??itli kamu kurum veya kurulu??lardan gelen ve tebli?? edilmesi istenen evraklar,<br><br></span><span style="color:#000000;font-family:Arial;font-size:12px;"><strong>???? Yeri Denetimleri: </strong></span><span style="color:#000000;font-family:Arial;font-size:13px;">Belediyemiz s??n??rlar?? d??hilinde faaliyet g??steren i?? yerlerinin denetimi.</span></div></div>
<div id="wb_Marquee2">
<div id="Marquee2">
<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>M??h??r: </strong></span><span style="color:#000000;font-family:Arial;font-size:13px;">Ruhsata ba??lanmas?? gerekirken ruhsat alamadan faaliyet g??steren i?? yeri veya in??aatlar??n faaliyetlerinin durdurulmas?? i??in zab??ta personeli taraf??ndan i??in durduruldu??unun g??sterilmesidir.<br></span><span style="color:#000000;font-family:Arial;font-size:12px;"><strong><br>M??h??r Fekki: </strong></span><span style="color:#000000;font-family:Arial;font-size:13px;">Faaliyeti yasal nedenler sonucu durdurulan, ancak ilgilisi taraf??ndan m??hr??n kopar??lmak suretiyle faaliyet g??steren i?? yeri ilgilisi hakk??nda Cumhuriyet Ba??savc??l??????na su?? duyurunda bulunulmas??,</span></div></div>
</div>
</div>
<div id="contact_section">
<div id="contact_section_Container">
<div id="wb_indexText35">
<span class="lato_20_black">??LET??????M</span></div>
<div id="wb_indexForm1">
<form name="indexForm1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="indexForm1">
<input type="hidden" name="formid" value="indexform1">
<input type="submit" id="indexButton1" name="" value="G??nder">
</form>
</div>
<div id="wb_indexText37">
&nbsp;</div>
<div id="wb_indexText28">
<span style="color:#000000;font-family:Arial;font-size:13px;">TELEFON<br>444 5 450<br><br>ADRES<br>Arabac??alan??, ??ark Cd. No:328, 54100 Adapazar??/Sakarya<br><br>E-POSTA<br>serdivanbelediyesi@hs01.kep.t</span></div>
<div id="wb_indexIconFont1">
<a href="05434662600"><div id="indexIconFont1"><i class="fa fa-phone"></i></div></a></div>
<div id="wb_indexIconFont2">
<div id="indexIconFont2"><i class="indexIconFont2"></i></div></div>
<div id="wb_indexIconFont3">
<div id="indexIconFont3"><i class="indexIconFont3"></i></div></div>
<textarea name="indexTextArea1" id="indexTextArea1" rows="5" cols="69" autocomplete="off" spellcheck="false" placeholder="Mesaj??n??z"></textarea>
<input type="text" id="indexEditbox3" name="indexEditbox3" value="" spellcheck="false" placeholder="Telefon numaran??z">
<input type="text" id="indexEditbox2" name="indexEditbox2" value="" spellcheck="false" placeholder="E-postan??z">
<input type="text" id="indexEditbox1" name="indexEditbox1" value="" spellcheck="false" placeholder="Ad??n??z ve Soyad??n??z">
</div>
</div>
<div id="master_pageLayer1">
<div id="master_pageLayer1_Container">
<div id="wb_indexPanelMenu1">
<a href="#indexPanelMenu1_markup" id="indexPanelMenu1">&nbsp;</a>
<div id="indexPanelMenu1_markup">
<ul role="menu" class="nav">
   <li class="nav-item" role="menuitem"><a href="#home_section" class="nav-link">HOME</a></li>
   <li class="nav-item" role="menuitem"><a href="#about_us_section" class="nav-link">ABOUT US</a></li>
   <li class="nav-item" role="menuitem"><a href="#services_section" class="nav-link">OUR SERVICES</a></li>
   <li class="nav-item" role="menuitem"><a href="#portfolio_section" class="nav-link">OUR PORTFOLIO</a></li>
   <li class="nav-item" role="menuitem"><a href="#contact_section" class="nav-link">CONTACT</a></li>
</ul>
</div>
</div>
<div id="wb_indexImage6">
<img src="images/serdivan logo.png" srcset="images/serdivan logo.png 2x" id="indexImage6" alt="" width="104" height="104"></div>
<div id="wb_master_pageTextMenu1" class="nav">
<span class="nav-item"><a href="#home_section" class="nav-link nav" title="ANASAYFA">ANASAYFA</a></span><span class="nav-item"><a href="#about_us_section" class="nav-link nav">SERD??VAN TAR??H??</a></span><span class="nav-item"><a href="#services_section" class="nav-link nav">H??ZMETLER</a></span><span class="nav-item"><a href="#portfolio_section" class="nav-link nav">TANIMLAR</a></span><span class="nav-item"><a href="#contact_section" class="nav-link nav">??LET??????M</a></span></div>
</div>
</div>
</body>
</html>