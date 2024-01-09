<?php
// Short code for popular domain card in DOMAIN PAGE
add_shortcode('popular-domain-card', function($attrs){
	$default = array(
		'domain_name' => 'Domain name',
		'domain_price' => 'Domain price',
		'type' => 'global'
	);
	$domain_name = shortcode_atts($default, $attrs);
	$domain_price = shortcode_atts($default, $attrs);
	$type = shortcode_atts($default, $attrs);
	return "<div class='popular-domain-card'>
	<span class='".$type['type']."-domain'></span>
	<span class='domain-name'>".$domain_name['domain_name']."</span>
	<span class='domain-price'>".$domain_price['domain_price']."đ</span>
	</div>";
});

// Short code for review section at HOME PAGE
add_shortcode('feedback-section-home', function($atts){
	$default = array('viewport' => 'desktop');
	$attributes = shortcode_atts($default, $atts);
	$feedbacks = get_field('feedbacks', 'option');
	$shortcode_content = '';
	$count = 1;
	foreach($feedbacks as $feedback) {
		$img = $feedback['avatar'];
		if($attributes['viewport'] == 'desktop'){
			if($count % 2 != 0){
				$shortcode_content .= '[row_inner style="collapse" width="full-width"][col_inner span="6"]';
			} else {
				$shortcode_content .= '[col_inner span="6"]';
			}
			$count++;
		}
		elseif($attributes['viewport'] == 'mobile') $shortcode_content .= '[row_inner style="collapse" width="full-width"][col_inner span__sm="12"]';
		$shortcode_content .= '[testimonial image="'.$img['id'].'" image_width="160" name="'.$feedback['name'].'" company="'.$feedback['job'].'" stars="'. $feedback['rating'] .'"]';
		$shortcode_content .= '<p class="lead">'.$feedback['feedback'].'</p>';
		$shortcode_content .= '[/testimonial][/col_inner]';
		if($attributes['viewport'] == 'mobile' || ($attributes['viewport'] == 'desktop' && $count % 2 != 0) || ($attributes['viewport'] == 'desktop' && ($count - 1) == count($feedbacks))) {
			$shortcode_content .= '[/row_inner]';
		}
	}
	return do_shortcode($shortcode_content);
// 	return do_shortcode('[row_inner style="collapse" width="full-width"]'. $shortcode_content .'[/row_inner]');
});

// Short code for banner slide HOME PAGE
add_shortcode('banner-slide', function(){
	$banners = get_field('banner_slide', 'option');
	$shortcode_content = '';
	$link = null;
	foreach($banners as $banner) {
		$img = $banner['image'];
		$bg_color = $banner['bg_color'];
		$shortcode_content .= '[row_inner style="collapse" col_bg="rgba('. $bg_color['red'] .', '. $bg_color['green'] .','. $bg_color['blue'] .','. $bg_color['alpha'] .')" v_align="equal"]
			[col_inner span="6" span__sm="12"]
				<h4>'. $banner['sub_title'] .'</h4>
				<h2>'. $banner['title'] .'</h2>
				<p>'. $banner['desc'] .'</p>
				<p><a class="leaf-filled" href="'.$banner['lien_ket'].'"><span>Đăng ký ngay</span></a></p>
			[/col_inner]
			[col_inner span="6" span__sm="12"]
				[ux_image id="'. $img['id'] .'" image_size="original"]
			[/col_inner]
		[/row_inner]';
	}
	return do_shortcode($shortcode_content);
});

// Short code for domain card at HOME PAGE
add_shortcode('domain-card-at-home', function(){
	$domain_cards = get_field('domain_card', 'option');
	foreach($domain_cards as $card) {
		$hot_sale = $card['is_hot_sale'] ? 'hot-sale' : '';
		echo do_shortcode('[section_inner padding="0px"]' .
		'<div class="domain-card ' . $hot_sale . '"><span class="name">'.$card['domain_name'].'</span>' .
		'<span class="sale-price">'.$card['domain_sale_price'].'</span>' .
		'<span class="regular-price">'.$card['domain_regular_price'].'</span>' .
		"</div>" .
		'[/section_inner]');
	}
});

// Short code for price table at DOMAIN PAGE
add_shortcode('price-table-at-domain', function(){
	$price_tags = get_field('domain_price_table_data', 'option');
	echo "<table><thead><tr><th>Tên miền</th><th>Phí đăng ký lần đầu</th><th>Phí duy trì mỗi năm</th><th>Phí chuyển về</th><th></th></tr></thead><tbody>";
	$count = 0;
	foreach($price_tags as $price) {
		$odd_or_even = $count++ % 2 == 0 ?  "even-row" : "odd-row";
		echo "<tr class='" . $odd_or_even . "'>
		<td>".$price['name']."</td>
		<td>".$price['domain_register_fee']."</td>
		<td>".$price['domain_maintaince_fee']."</td>
		<td>".$price['transfering_fee']."</td>
		<td><a class='button' href='/dang-ky-ten-mien/'>Đăng ký</a></td>
		</tr>";
	}
	echo "</tbody></table>";
});

// Short code for webdesign package at WEBDESIGN PAGE
add_shortcode('web-design-packages', function () {
    $packages = get_field('web_design_packages', 'option');
    $shortcode_content = '';

    foreach ($packages as $package) {
        $shortcode_content .= '[col span="4" span__sm="12" span__md="12"]
            <div class="web-design-package-card ' . strtolower($package['package_name']) . '">
                <div class="package-title">
                    <h3 class="title '.strtolower($package['package_name']).'">' . $package['package_name'] . '</h3>
                    <p class="description">' . $package['description'] . '</p>
                </div>
                <div class="package-price gradient-bg">
                    <span>Chỉ từ: </span><span class="price-amount">' . $package['price'] . '</span><span>đ</span>
                </div>
                <div class="package-features">
                    <ul>';
		$features = $package['features'];
		$count = 0;
		foreach ($package['features'] as $feature) {
			if($count == 0 && strlen($feature) > 0) {
				$shortcode_content .= '<li class="name">Bao gồm gói <span class="'.strtolower($feature).'">' . esc_html($feature) . '</span> và cộng thêm:</li>';
			}
			elseif($count != 0 && strlen($feature) == 0) continue;
			elseif(strlen($feature) > 0) {
				$shortcode_content .= '<li>' . esc_html($feature) . '</li>';
			}
			$count++;
		}
        
        $shortcode_content .= '</ul>
                </div>
                <div class="button-container">
                    <a class="gradient-bg button" href="#">Đăng ký ngay</a>
                </div>
            </div>
        [/col]';
    }

    return do_shortcode('[row style="collapse" v_align="equal"]' . $shortcode_content . '[/row]');
});

// Short code for HOSTING PACKAGE
add_shortcode('hosting-packages', function(){
	$hosting_cards = get_field('hosting_package_card', 'option');
	$shortcode_content = '';
	foreach($hosting_cards as $card) {
		$shortcode_content .= '[col span="4" span__sm="12" span__md="6"]';
		$shortcode_content .= '<div class="hosting-price-card"><div class="title-container">[ux_image id="1829" image_size="original"]<div class="sub-title-and-icon"><h4 class="package-name">';
		$shortcode_content .= $card['name'] .'</h4><div class="gift-icon">[ux_image id="1818" image_size="original"]</div></div><div class="sale-price"><h2>';
		$shortcode_content .= $card['sale_price'] .'</h2><p>đ/tháng</p></div><div class="regular-price"><p>Giá gốc: <span>';
		$shortcode_content .= $card['regular_price'] .'</span> đ/tháng</p></div></div><div class="host-benefits"><ul><li><strong>';
		$shortcode_content .= $card['storage_space'] .' GB</strong> SSD lưu trữ</li><li>';
		$shortcode_content .= $card['core'] .' vCore CPU</li><li>';
		$shortcode_content .= $card['ram'] .' GB Ram</li><li>Không giới hạn băng thông</li><li>Không giới hạn tên miền</li><li>Không giới hạn Inodes</li><li>Backup hàng ngày</li><li><strong>Tối ưu miễn phí ';
		$shortcode_content .= $card['page_optimize'] .' website</strong></li></ul></div><div class="button-container"><a href="' . ($card['link'] ?? '/dang-ky-ten-mien/') . '" class="gradient-button">Đăng ký ngay</a></div></div>';
		$shortcode_content .= '[/col]';
	}
	return do_shortcode('[row style="collapse" class="hosting-packages-row"]' . $shortcode_content . "[/row]");
});

// Short code for WEBSITE MANAGEMENT PACKAGES
add_shortcode('web-management-packages', function(){
	$packages = get_field('web_management_packages', 'option');
	$shortcode_content = '';
	foreach($packages as $package) {
		$features = $package['features'];
		$link_inside_value = "";
		if($features['link_inside'] == 1) $link_inside_value = "checked";
		else $link_inside_value = "cross";
		$shortcode_content .= '[col span="4" span__sm="12" span__md="12"]
			<div class="website management-card">
				<div class="title">
					<h2>Gói quản trị '. $package['name'] .'</h2>
				</div>
				<div class="price">
					<h3 class="amount">'. $package['price'] .'</h3>
					<p>VNĐ/tháng</p>
				</div>
				<div class="features">
					<div class="feature-item">
						<div class="feature-name">Kiểm tra website hàng ngày</div>
						<div class="feature-value checked"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Cài đặt Google Analytic</div>
						<div class="feature-value checked"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Sao lưu dữ liệu</div>
						<div class="feature-value">0'. $features['backup_data'] .' lần/tháng</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Viết bài chuẩn SEO:</div>
						<div class="feature-value">'. (intval($features['write_SEO_contents']) < 10 ? "0" . $features['write_SEO_contents'] : $features['write_SEO_contents']) .' bài (800-1000 từ)</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Quảng báo trên website/forum:</div>
						<div class="feature-value">'. (intval($features['share_link_on_website']) < 10 ? "0" . $features['share_link_on_website'] : $features['share_link_on_website']) .' Website/Forum</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Đăng bài theo yêu cầu:</div>
						<div class="feature-value">'. (intval($features['post_on_demand']) < 10 ? "0" . $features['post_on_demand'] : $features['post_on_demand']) .' bài</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Thiết kế banner:</div>
						<div class="feature-value">'.(intval($features['banner_design']) == 0 ? "0" : "0".$features['banner_design']) .' banner</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Share link SEO lên mạng xã hội:</div>
						<div class="feature-value">'. (intval($features['share_link_on_socials']) < 10 ? "0" . $features['share_link_on_socials'] : $features['share_link_on_socials']) .' link</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Đi link nội bộ:(theo kế hoạch của khách hàng)</div>
						<div class="feature-value '. $link_inside_value .'"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Báo cáo lượt truy cập hàng tháng</div>
						<div class="feature-value checked"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Khôi phục dữ liệu khi có lỗi xảy ra</div>
						<div class="feature-value checked"></div>
					</div>
				</div>
				<div class="button-container"><a href="#" class="button">Đăng ký ngay</a></div>
			</div>
		[/col]';
	}
	return do_shortcode($shortcode_content);
});

// Short code for FANPAGE MANAGEMENT PACKAGES
add_shortcode('fanpage-management-packages', function(){
	$packages = get_field('fanpage_management_packages', 'option');
	$shortcode_content = '';
	foreach($packages as $package) {
		$features = $package['features'];
		$shortcode_content .= '[col span="4" span__sm="12" span__md="12"]
			<div class="fanpage management-card">
				<div class="title">
					<h2>Gói quản trị '. $package['name'] .'</h2>
				</div>
				<div class="price">
					<h3 class="amount">'. $package['price'] .'</h3>
					<p>VNĐ/tháng</p>
				</div>
				<div class="features">
					<div class="feature-item">
						<div class="feature-name">Viết nội dung:</div>
						<div class="feature-value">'. $features['write_content'] .' bài</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Seeding group: </div>
						<div class="feature-value">'. (intval($features['seeding_group']) < 10 ? "0" . $features['seeding_group'] : $features['seeding_group']) .' Group/tháng</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Thiết kế hình ảnh:</div>
						<div class="feature-value">1 - 3 hình/post</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Chèn video thương hiệu</div>
						<div class="feature-value">'. $features['embed_brand_video'] .' video</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Thiết kế banner:</div>
						<div class="feature-value">'. $features['banner_design'] .' banner</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Tạo minigame/event:</div>
						<div class="feature-value">1 game</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Viết bài quảng cáo:</div>
						<div class="feature-value">'. $features['ads_post'] .' bài</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Thiết kế banner:</div>
						<div class="feature-value">'.(intval($features['banner_design']) == 0 ? "0" : "0".$features['banner_design']) .' banner</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Trả lời comment Fanpage (Theo yêu cầu khách hàng)</div>
						<div class="feature-value checked"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Viết nội dung sản phẩm:</div>
						<div class="feature-value">'. $features['product_post'] .' bài</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Viết nội dung tin tức:</div>
						<div class="feature-value">'. $features['news_post'] .' bài</div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Báo cáo lượt truy cập hàng tháng</div>
						<div class="feature-value checked"></div>
					</div>
					<div class="feature-item">
						<div class="feature-name">Khôi phục dữ liệu khi có lỗi xảy ra</div>
						<div class="feature-value checked"></div>
					</div>
				</div>
				<div class="button-container"><a href="#" class="button">Đăng ký ngay</a></div>
			</div>
		[/col]';
	}
	return do_shortcode($shortcode_content);
});

// Shortcode for LEGAL DOCUMENTS PAGE
add_shortcode('legal-documents-table', function(){
	$legal_documents = get_field('legal_documents', 'option');
	$shortcode_content = '<table id="legal-documents-table"><thead><tr>';
	if(have_rows('legal_documents', 'option')) {
		$count = 0;
		while(have_rows('legal_documents', 'option')) {
			$number = get_sub_field_object('number');
			$agency_issued = get_sub_field_object('agency_issued');
			$written_form = get_sub_field_object('written_form');
			$date_issued = get_sub_field_object('date_issued');
			$content_summary = get_sub_field_object('content_summary');
			$detail_link = get_sub_field_object('detail_link');
			$count++;
			$shortcode_content .= '<th class="text-center">'. $number['label'] .'</th>
			<th class="text-center">'. $agency_issued['label'] .'</th>
			<th class="text-center">'. $written_form['label'] .'</th>
			<th class="text-center">'. $date_issued['label'] .'</th>
			<th class="text-center">'. $content_summary['label'] .'</th>
			<th class="text-center">'. $detail_link['label'] .'</th>
			';
			if( $count == 1) break;
		}
	}
	$shortcode_content .= '</tr></thead><tbody>';
	if(have_rows('legal_documents', 'option')) {
		foreach($legal_documents as $doc) {
			$shortcode_content .= '<tr>
				<td>'. $doc['number'] .'</td>
				<td>'. $doc['agency_issued'] .'</td>
				<td class="text-center">'. $doc['written_form'] .'</td>
				<td class="text-center">'. $doc['date_issued'] .'</td>
				<td>'. $doc['content_summary'] .'</td>
				<td class="text-center">'. ($doc['detail_link'] != NULL ? '<a href="'. $doc['detail_link'] .'">Xem tiếp</a>' : "Xem tiếp") .'</td>
			</tr>';
		}
	}
	$shortcode_content .= '<tbody></table>';
	return $shortcode_content;
});

// Shortcode for BOOK GIVINGAWAY EVENT
add_shortcode('event-tang-sach', function($atts){
	$default = array('lan_thu' => '1');
	$attributes = shortcode_atts($default, $atts);
	$event_contents = get_field('event_contents', 'option');
	$books = NULL;
	foreach($event_contents as $content) {
		if($content['turn'] == $attributes['lan_thu']) {
			$books = $content['books_info'];
			break;
		}
	}
	$shortcode_content = '';
	$book_count = 1;
	foreach($books as $book) {
		$img = $book['book_img'];
// 		$shortcode_content .= wp_get_attachment_image( $img['id'], 'medium' );
		$shortcode_content .= '<div class="book"><h3>Sách "'. $book['title'] .'" - '. $book['author'] .'</h3>';
		$shortcode_content .= '[caption id="attachment_'.$img['id'].'" align="aligncenter" width="'. $img['sizes']['medium-width'] .'"]<img class="size-medium wp-image-'.$img['id'].'" src="'. $img['sizes']['medium'] .'" alt="'. $img['alt'] .'" width="'. $img['sizes']['medium-width'] .'" height="'. $img['sizes']['medium-height'] .'" /> <strong><em>'. $img['caption'] .'</em></strong>[/caption]';
		$shortcode_content .= '<p class="review">'. $book['description'] .'</p>
		<a class="button leaf-outline" href="#book-'. $book_count .'" book-title="'. $book['title'] .' - '. $book['author'] .'" style="margin: 2rem 0;"><span>Đăng ký</span></a>
		[lightbox id="book-'. $book_count++ .'" width="600px" padding="20px"][contact-form-7 id="c7e7d05" title="Đăng ký thông tin nhận sách"][/lightbox]</div>
		';
	}
	return do_shortcode($shortcode_content);
});