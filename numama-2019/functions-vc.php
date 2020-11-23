<?php
class VCExtendAddAboutUs{
	function __construct() {
		add_action( 'init', array( $this, 'integrateWithVC' ) );
		add_shortcode( 'about_us', array( $this, 'about_us_short' ) );
	}

	public function integrateWithVC() {
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
			return;
		}
		vc_map( array(
			"name" => __("About us", 'vc_extend'),
			"description" => __("About us block", 'vc_extend'),
			"base" => "about_us",
			"class" => "class",
			"controls" => "full",
			"category" => __('Content', 'js_composer'),

			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => __( "Image", "vc_extend" ),
					"param_name" => "image",
					"value" => '',
					"description" => __( "Upload image.", "vc_extend" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __("Title", ''),
					"param_name" => "title",
					"value" => __("", 'vc_extend'),
					"description" => __("Title", 'vc_extend')
				),
				array(
					"type" => "textarea_html",
					"class" => "",
					"heading" => __( "Description", "vc_extend" ),
					"param_name" => "content",
					"value" => __( "", "vc_extend" ),
					"description" => __( "Enter description.", "vc_extend" )
				),
			)
		));
	}
	public function about_us_short( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'image'=> '',
			'title'=>'',
			'description'=>'',
		), $atts ) );
		$html = '';
		$title = $atts['title'];
		$image = $atts['image'];
		$html .= '<section class="section-about-home">
					<div class="container">
						<div class="d-flex f-align-center">
							<div class="left block-8 block">
								<h2>' . $title . '</h2>' . $content . '
							</div>
							<div class="right block-5 block">
								<img src="' . wp_get_attachment_image_url($image,'full') . '" alt="">
							</div>
						</div>
					</div>
				</section>';
		return $html;
	}
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data(__FILE__);
		echo '
        <div class="updated">
          <p>'.sprintf(__('Notice of visual composer', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
	}
}
new VCExtendAddAboutUs();

class VCExtendAddHowItWorks{
	function __construct() {
		add_action( 'init', array( $this, 'integrateWithVC' ) );
		add_shortcode( 'how_it_works', array( $this, 'how_it_works_short' ) );
	}

	public function integrateWithVC() {
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
			return;
		}
		vc_map( array(
			"name" => __("How it works", 'vc_extend'),
			"description" => __("How it works block", 'vc_extend'),
			"base" => "how_it_works",
			"class" => "class",
			"controls" => "full",
			"category" => __('Content', 'js_composer'),
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => __( "Background image", "vc_extend" ),
					"param_name" => "image",
					"value" => '',
					"description" => __( "Upload image.", "vc_extend" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __("Block title", ''),
					"param_name" => "title",
					"value" => __("", 'vc_extend'),
					"description" => __("Title", 'vc_extend')
				),
				array(
					"type" => "param_group",
					"param_name" => "tabs",
					"value" => '',
					"params" => array(
						array(
							"type" => "textfield",
							"holder" => "div",
							"class" => "",
							"heading" => __("Tab name", ''),
							"param_name" => "tab_name",
							"value" => __("", 'vc_extend'),
							"description" => __("Tab name", 'vc_extend')
						),
						array(
							"type" => "param_group",
							"param_name" => "items",
							"value" => '',
							"params" => array(
								array(
									"type" => "attach_image",
									"class" => "",
									"heading" => __( "Item image", "vc_extend" ),
									"param_name" => "item_image",
									"value" => '',
									"description" => __( "Upload image.", "vc_extend" )
								),
								array(
									"type" => "textarea",
									"holder" => "div",
									"class" => "",
									"heading" => __("Item text", ''),
									"param_name" => "item_text",
									"value" => __("", 'vc_extend'),
									"description" => __("Item text", 'vc_extend')
								),
							)
						),
					)
				),
			)
		));
	}
	public function how_it_works_short( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'image'=> '',
			'title'=>'',
			'description'=>'',
		), $atts ) );
		$html = '';
		$title = $atts['title'];
		$image = $atts['image'];
		$tabs = vc_param_group_parse_atts($atts['tabs']);
		$html .= '<section class="section-how-it-works" style="background-image: url('. wp_get_attachment_image_url($image,"full") .')">
					<div class="container">
						<h2>' . $title . '</h2>
						<div class="center-tabs">
							<div class="tabs">';
								$count = 1;
								foreach ($tabs as $tab) {
									$html .= '<div class="tab '; if($count == 1){ $html .= 'active'; }  $html .= '" data-tab="' . $count . '">' . $tab["tab_name"] . '</div>';
									$count++;
								}
					$html .= '</div>
						</div>
						<div class="tabs-contents">';
		$count = 1;
		foreach ($tabs as $tab) {
			$html .= '<div class="tab-content '; if($count == 1){ $html .= 'active';} $html .= '" data-tab-content="' . $count . '">';
			$items = vc_param_group_parse_atts($tab['items']);
					$html .= '<div class="d-flex">';
						foreach ($items as $item) {
						 $html .= '<div class="block-3">
										<div class="top-block">
											<img src="' . wp_get_attachment_image_url($item['item_image']) . '" alt="">
										</div>
										<p>' . $item['item_text'] . '</p>
									</div>';
						}
			$html .= '			</div>
							</div>';
						$count++;
		}
		$html .= '</div>
				</div>
			</section>';
		return $html;
	}
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data(__FILE__);
		echo '
        <div class="updated">
          <p>'.sprintf(__('Notice of visual composer', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
	}
}
new VCExtendAddHowItWorks();