<?php

class SantuarioContactInfo extends \Elementor\Widget_Base {
	
	public function get_style_depends() {
		return [ 'santuario-contact-info-style'];
	}

	public function get_name() {
		return 'santuario_contact_info';
	}

	public function get_title() {
		return esc_html__( 'Santuario - Informação de Contato', 'santuario-contact-info' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function render() {

		$phones = carbon_get_theme_option( 'santuario_telefones' );
		if($phones || $waze_url || $gmaps_url){
	
			echo '<div class="d-flex flex-row gap-4 justify-content-end">';

			if($phones){
	
				foreach($phones as $phone){
					$phone_number = $phone['santuario_telefone'];
					$phone_whatsapp = $phone['santuario_telefone_whatsapp'];
					$message = "Olá, preciso de informações!";
					if($phone_whatsapp == '1'){
						$whatsappNumber = preg_replace('/\D/', '', $phone['santuario_telefone']); // Remove non-digit characters
						$phone_link = "https://wa.me/$whatsappNumber?text=" . urlencode($message);
						$phone_text = 'WhatsApp Secretaria';
						$phone_icon = 'fa-brands fa-whatsapp';
					}else{
						$phone_link = 'tel:' . $phone_number;
						$phone_text = '+55 ' . $phone_number;
						$phone_icon = 'fa-solid fa-phone';
					}
					?>
					<a href="<?php echo $phone_link; ?>" target="_blank" class="text-decoration-none santuario-contact-item">
						<i class="<?php echo $phone_icon; ?> me-2"></i>
						<span><?php echo $phone_text; ?></span>
					</a>
					<?php
				}
	
			}
			
			$waze_url = carbon_get_theme_option( 'santuario_waze' );
			$gmaps_url = carbon_get_theme_option( 'santuario_google_maps' );

			if($waze_url || $gmaps_url){
				?>
				<div class="d-flex flex-row align-items-center santuario-contact-item">					
					<i class="fa-solid fa-signs-post me-2"></i><span>Como Chegar:</span> 
				</div>
				<div class="d-flex flex-row gap-2 justify-content-end">
					<?php if($waze_url){ ?>
						<a href="<?php echo $waze_url; ?>" target="_blank" class="text-decoration-none santuario-contact-item">
							<i class="fa-brands fa-waze me-2"></i>
						</a>
					<?php } ?>
					<?php if($gmaps_url){ ?>
						<a href="<?php echo $gmaps_url; ?>" target="_blank" class="text-decoration-none santuario-contact-item">
							<i class="fa-solid fa-map-location-dot me-2"></i>
						</a>
					<?php } ?>
				</div>
				<?php
			}
	
			echo '</div>';

		}
		
	}

}

