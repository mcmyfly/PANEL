<?php 
function vip_time($pre){
	if ($pre == 0){
		return "Yok";
	}
	if ($pre < time()){
		$mtext = " önce bitmiş.";
		$time_difference =  time() - $pre;
	}else{
		$mtext = " kaldı.";
		$time_difference = $pre - time();
	}  
	$condition = array( 
		12 * 30 * 24 * 60 * 60 	=>  'Yıl',
		24 * 60 * 60    		=>  'Gün',
		60 * 60                 =>  'Saat',
		60                      =>  'Dakika',
		1                       =>  'Saniye'
	);
										  
	foreach( $condition as $secs => $str )
	{
		$d = $time_difference / $secs;
										  
		if( $d >= 1 )
		{
			$t = round( $d );
			return ' ' . $t . ' ' .$str . ( $t > 1 ? '' : '' ) . $mtext;
		}
	}   
}
function vip($level, $limit){
	// LEVEL 1 = SERI NO
	// LEVEL 2 = AD SOYAD
	// LEVEL 3 = AD SOYAD + SERI NO
	// LEVEL 4 = SERI NO HAK
	// LEVEL 5 = AD SOYAD HAK
	$time = time();
	if ($level == 1){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 2){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 3){
		if ($limit > $time){
			return true;
		}else{
			// VIP SINIRSIZ SURE SONU
			return false;
		}
	}else if ($level == 4){
		if ($limit > 0){
			return true;
		}else{
			// SERI NO VIP HAK BITIMI
			return false;
		}
	}else if ($level == 5){
		if ($limit > 0){
			return true;
		}else{
			// AD SOYAD VIP HAK BITIMI
			return false;
		}
	}else{
		//  BILINMEYEN LEVEL
		return false;
	}
}

function get_vip($level, $limit){
	$time = time();
	if ($level == 1){
		$paket = "Elite Vip I";
		return '<dt class="fs-3">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 2){
		$paket = "Elite Vip II";
		return '<dt class="fs-3">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 3){
		$paket = "Super Vip V";
		return '<dt class="fs-3">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.vip_time($limit).'</dd>';
	}else if ($level == 4){
		$paket = "Vip I";
		return '<dt class="fs-3">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.$limit.' Hak Kaldı.</dd>';
	}else if ($level == 5){
		$paket = "Vip II";
		return '<dt class="fs-3">'.$paket.'</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">'.$limit.' Hak Kaldı.</dd>';
	}else{
		//  BILINMEYEN LEVEL
		return "Vip Paket Yok!";
	}
}