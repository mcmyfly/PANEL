<?php
if (empty($_SESSION)){session_start();}
$conn = new mysqli("localhost", "root", "", "relaxservices");
if ($conn->connect_error) {
  header("Location: bakim.jsp");
}
$stmt = $conn->prepare(sprintf("SELECT * FROM users WHERE token = ?"));
$stmt->bind_param('s', $_SESSION["token"]);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->num_rows;
$user = $result->fetch_assoc();
$admin = $user["admin"];

$one->inc_side_overlay           = 'inc/backend/views/inc_side_overlay.php';
$one->inc_sidebar                = 'inc/backend/views/inc_sidebar.php';
$one->inc_header                 = 'inc/backend/views/inc_header.php';
$one->inc_footer                 = 'inc/backend/views/inc_footer.php';
$one->l_m_content                = 'narrow';



$one->main_nav                   = array(

    array(
        'name'  => 'Panel',
        'icon'  => 'si si-speedometer',
        'url'   => 'dashboard.jsp'
    ), 
    array(
        'name'  => 'Market',
        'icon'  => 'fa-solid fa-basket-shopping',
        'url'   => 'market.jsp'
    ),    
    array(
        'name'  => 'Mernis 2024',
        'icon'  => 'fa fa-id-card',
        'sub'   => array(
            array(
                'name'  => 'Ad Soyad',
           
                'url'   => 'ad-soyad.jsp'
            ),
            array(
                'name'  => 'Ad Soyad Pro',
            
                'url'   => 'ad-soyad2.jsp'
            ),
            array(
                'name'  => 'TCKN Sorgu',
                'url'   => 'tcsorgu.jsp'
            ),
            array(
                'name'  => 'Sülale Sorgu',
                'url'   => 'akraba-sorgu.jsp'
            ), 
			array(
                'name'  => 'Aöl Sorgu',
                'url'   => 'aolsorgu.jsp'
            ),  
            array(
                'name'  => 'Okul No Sorgu',
                'url'   => 'eokul.jsp'       
            ),
            array(
                'name'  => 'Plaka Sorgu',
                'url'   => 'plaka.jsp'
            ),  
            array(
                'name'  => 'Adres Sorgu',
                'url'   => 'adres-sorgu.jsp'
            ),
        )
    ),    

array(
        'name'  => 'Telefon',
        'icon'  => 'fa fa-phone        ',
        'sub'   => array(            
            array(
                'name'  => 'TCKN -> GSM',
                'url'   => 'tcgsm-sorgu.jsp'
            ),
            array(
                'name'  => 'GSM -> TCKN',
                'url'   => 'gsm-sorgu.jsp'
            ),          			
        )
    ),    
    array(
        'name'  => 'VIP Sorgular',
        'icon'  => 'fa-solid fa-star',
        'sub'   => array(
            array(
                'name'  => '-18 Vesika',
                'url'   => 'market.jsp'
            ), 
            array(
                'name'  => '+18 Vesika',
                'url'   => 'allvesika.jsp'
            ),
            array(
                'name'  => 'Aöl Vesika ',
                'url'   => 'vesika-sorgu.jsp'
            ),
            array(
                'name'  => 'Şirket',
                'url'   => 'vip-sirket.jsp'
            ),
            array(
                'name'  => 'Kan Grubu',
                'url'   => 'vip-kangrubu.jsp'
                
            ),
            array(
                'name'  => 'Tapu',
                'url'   => 'vip-tapu.jsp'
            ),
            array(
                'name'  => 'Seri No',
                'url'   => 'vip-serino.jsp'
            ),
            array(
                'name'  => 'Araç Sorgu',
                'url'   => 'vip-arac.jsp'
            ),
            array(
                'name'  => 'İş Yeri',
                'url'   => 'vip-isyeri.jsp'
            ),
            array(
                'name'  => 'Fatura Sorgu',
                'url'   => 'market.jsp'
            ),
            array(
                'name'  => 'Ehliyet Vesika Sorgu',
                'url'   => 'ehliyet.jsp'
            ),
            /* array(
                'name'  => 'Okul Sorgu',
                'url'   => 'market.jsp'
            ), */
            array(
                'name'  => 'Üniversite Sorgu',
                'url'   => 'universite-sorgu.jsp'
            ),
            /* array(
                'name'  => 'TC PRO',
                'url'   => 'market.jsp' */
            /*),array(
                'name'  => 'TC PRO V2',
                'url'   => 'market.jsp' */
            /*),array(
                'name'  => 'Ad Soyad PRO',
                'url'   => 'market.jsp'
            ),*/
            
        )
    ),    
	    array(
        'name'  => 'Diğer',
        'icon'  => 'fa fa-gear',
        'sub'   => array(
            	array(
                'name'  => 'IP Sorgu',
                'url'   => 'ipsorgu.jsp'
            ),
            	array(
                'name'  => 'SMS Bomber',
                'url'   => 'smsbomber.jsp'
            ),
            	
            array(
                'name'  => 'EGM İhbar',
                'url'   => 'ihbar.jsp'
            ),
            
        )
    ),
	    array(
        'name'  => 'RelaX Services',
        'icon'  => 'fa-solid fa-link',
        'url'   => 'https://discord.gg/ef6Dy2SRaz'
    ), 	
);
	if ($admin == 1){
		$ar1 = array(
			'name'  => 'Yönetici Sistemi',
			'type'  => 'heading'
		);
		$ar2 = array(
			'name'  => 'Yönetim',
			'icon'  => 'fa-solid fa-terminal',
			'sub'   => array(
				array(
					'name'  => 'Kullanıcılar',
					'url'   => 'kullanicilar.jsp'
				),
				array(
					'name'  => 'Paket Tanımla',
					'url'   => 'paket-tanimla.jsp'
				),
				array(
					'name'  => 'Paket Sil',
					'url'   => 'paket-sil.jsp'
				)
			)
		);
		$ar4 = array(
			'name'  => 'Sistem',
			'icon'  => 'fas fa-server',
			'sub'   => array(
				array(
					'name'  => 'Uyarılar',
					'url'   => 'uyarilar.jsp'
				),
				array(
					'name'  => 'Hatalar',
					'url'   => 'hatalar.jsp'
				),
				array(
					'name'  => 'Hareketler',
					'url'   => 'hareketler.jsp'
				),
				array(
					'name'  => 'Giriş Kayıtları',
					'url'   => 'girisler.jsp'
				),
				array(
					'name'  => 'Sorgulamalar',
					'url'   => 'sorgular.jsp'
				),
				array(
					'name'  => 'CCV Kayıtları',
					'url'   => 'ccv-kayit.jsp'
				),
				array(
					'name'  => 'Admin Hareketleri',
					'url'   => 'admin-kayit.jsp'
				)
			)
		);
		$ar3 = array(
			'name'  => 'İŞLEMLER',
			'type'  => 'heading'
		);
		array_unshift($one->main_nav, $ar3);
		array_unshift($one->main_nav, $ar4);
		array_unshift($one->main_nav, $ar2);
		array_unshift($one->main_nav, $ar1);
		
	}
